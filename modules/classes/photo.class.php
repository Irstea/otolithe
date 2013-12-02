<?php
/**
 * Classe de gestion des photos
 * @author quinton
 *
 */
class Photo extends ObjetBDD {
	public $format_thumbnail;
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "photo";
		$this->id_auto = "1";
		$this->colonnes = array (
				"photo_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"piece_id" => array (
						"type" => 1,
						"requis" => 1,
						"parentAttrib" => 1 
				),
				"photo_nom" => array (
						"longueur" => "255" 
				),
				"description" => array (
						"longueur" => 255 
				),
				"photo_filename" => array (
						"longueur" => 512 
				),
				"photo_date" => array (
						"type" => 2,
						"defaultValue" => "getDateJour" 
				),
				"color" => array (
						"longueur" => 2 
				),
				"lumieretype_id" => array (
						"type" => 1,
						"defaultValue" => 1 
				),
				"grossissement" => array (
						"type" => 1 
				),
				"repere" => array (
						"type" => 1 
				),
				"photo_data" => array (
						"type" => 0 
				),
				"photo_thumbnail" => array (
						"type" => 0 
				),
				"uri" => array (
						"longueur" => 512 
				),
				"long_reference" => array (
						"type" => 0,
						"defaultValue" => 100
				),
				"photo_height" => array (
						"type" => 1 
				),
				"photo_width" => array (
						"type" => 1 
				) 
		);
		$this->format_thumbnail = 200;
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	function ecrire($data) {
		/*
		 * On recherche si une photo a ete telechargee
		 */
		$flag_photo = 0;
		if (isset ( $data ["photoload"] )) {
			$dataPhoto = array ();
			$flag_photo = 1;
			/*
			 * Traitement de la photo
			 */
			/*
			 * Donnees "peripheriques"
			 */
			if (strlen ( $data ["photo_nom"] ) == 0 && strlen ( $data ["photo_filename"] ) > 0)
				$data ["photo_nom"] = $data ["photo_filename"];
			$image = new Imagick ();
			$image->readImageBlob ( $data ["photoload"] );
			$geo = $image->getimagegeometry ();
			$data ["photo_width"] = $geo ["width"];
			$data ["photo_height"] = $geo ["height"];
			$dataPhoto ["photo_data"] = pg_escape_bytea ( $data ["photoload"] );
			unset ( $data ["photoload"] );
			/*
			 * Generation du thumbnail
			 */
			$image->resizeImage ( $this->format_thumbnail, $this->format_thumbnail, imagick::FILTER_LANCZOS, 1, true );
			$image->setformat ( "jpeg" );
			$dataPhoto ["photo_thumbnail"] = pg_escape_bytea ( $image->getimageblob () );
		}
		$id = parent::ecrire ( $data );
		if ($id > 0 && $flag_photo == 1) {
			/*
			 * Ecriture de la photo en base
			 */
			// $this->UTF8 = false;
			// $this->codageHtml = false;
			// $dataPhoto["photo_id"] = $id;
			// parent::ecrire($dataPhoto);
			$sql = "update " . $this->table . " set photo_data = '" . $dataPhoto ["photo_data"] . "', photo_thumbnail = '" . $dataPhoto ["photo_thumbnail"] . "' where photo_id = " . $id;
			$this->executeSQL ( $sql );
		}
		return $id;
	}
	
	/**
	 * Retourne la liste des photos attachees a une piece
	 *
	 * @param int $piece_id        	
	 * @return array
	 */
	function getListePhotoFromPiece($piece_id) {
		$sql = "select photo_id, piece_id, photo_nom, description, photo_date, color, photo_height, photo_width
				from " . $this->table . " where piece_id = " . $piece_id;
		return $this->getListParam ( $sql );
	}
	/**
	 * Retourne une photo au format "blob" pour affichage
	 *
	 * @param int $id
	 *        	: $photo_id
	 * @param number $thumbnail
	 *        	: 0 - photo originale, 1 - photo au format vignette
	 * @param number $sizeX
	 *        	: si > 0, redimension a la taille indiquee
	 * @param number $sizeY
	 *        	: si > 0, redimension a la taille indiquee
	 * @return string
	 */
	function getPhoto($id, $thumbnail = 0, $sizeX = 0, $sizeY = 0) {
		if ($id > 0) {
			$this->UTF8 = false;
			$this->codageHtml = false;
			if ($thumbnail == 1) {
				$sql = "select photo_thumbnail as image ";
			} else {
				$sql = "select photo_data as image ";
			}
			$sql .= " from " . $this->table;
			$where = " where photo_id = " . $id;
			$data = $this->executeSQL ( $sql . $where );
			$photo = $data->fields ["image"];
			if ($sizeX > 0 && $sizeY > 0 && strlen ( $photo ) > 0) {
				/*
				 * Mise a l'image de la photo
				 */
				$image = new Imagick ();
				$image->readImageBlob ( $photo );
				$geo = $image->getimagegeometry ();
				if ($geo ["width"] > $sizeX || $geo ["height"] > $sizeY) {
					$image->resizeImage ( $sizeX, $sizeY, imagick::FILTER_LANCZOS, 1, true );
					$image->setformat ( "JPEG" );
					$photo = $image->getimageblob ();
				}
			}
			return $photo;
		}
	}
	/**
	 * Lit les informations generales d'une photo
	 * 
	 * @param int $id        	
	 * @return array
	 */
	function getDetail($id) {
		$sql = "select photo_id, piece_id, photo_nom, description, photo_filename, photo_date, color,
				lumieretype_libelle, grossissement, repere, uri, long_reference, photo_width, photo_height
				from " . $this->table . "
				left outer join lumieretype using(lumieretype_id)
				where photo_id = " . $id;
		return ($this->lireParam ( $sql ));
	}
}
/**
 * Table de reference des types de lumiere
 *
 * @author quinton
 *        
 */
class LumiereType extends ObjetBDD {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "lumieretype";
		$this->id_auto = "0";
		$this->colonnes = array (
				"lumieretype_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"lumieretype_libelle" => array (
						"type" => 0,
						"requis" => 1,
						"longueur" => 255 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
}
/**
 * ORM de gestion de la table des lecteurs
 *
 * @author quinton
 *        
 */
class Lecteur extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "lecteur";
		$this->id_auto = "1";
		$this->colonnes = array (
				"lecteur_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"login" => array (
						"type" => 0,
						"requis" => 1,
						"longueur" => 100 
				),
				"lecteur_nom" => array (
						"longueur" => 50 
				),
				"lecteur_prenom" => array (
						"longueur" => 50 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Retourne l'identifiant du lecteur
	 * 
	 * @param int $login        	
	 * @return number
	 */
	function getIdFromLogin($login) {
		$sql = "select lecteur_id from " . $this->table . " where login = '" . $login . "'";
		$res = $this->lireParam ( $sql );
		if ($res ["lecteur_id"] > 0) {
			return $res ["lecteur_id"];
		} else {
			return - 1;
		}
	}
	/**
	 * Reecriture de la fonction liste pour trier la table
	 * (non-PHPdoc)
	 * @see ObjetBDD::getListe()
	 */
	function getListe() {
		$sql = "select * from ".$this->table
		." order by lecteur_nom, lecteur_prenom";
		return $this->getListeParam($sql);
	}
}
/**
 * ORM de gestion de la table photolecture
 *
 * @author quinton
 *        
 */
class Photolecture extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "photolecture";
		$this->id_auto = "1";
		$this->colonnes = array (
				"photolecture_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"photo_id" => array (
						"type" => 1,
						"requis" => 1,
						"parentAttrib" => 1 
				),
				"lecteur_id" => array (
						"type" => 1,
						"requis" => 1 
				),
				"centre" => array (
						"longueur" => 50 
				),
				"bordure" => array (
						"longueur" => 50 
				),
				"points" => array (
						"type" => 4 
				),
				"photolecture_date" => array (
						"type" => 3,
						"defaultValue" => "getDateHeure" 
				),
				"points_ref_lecture" => array (
						"type" => 4 
				),
				"long_ref_mesuree" => array (
						"type" => 1 
				),
				"photolecture_width" => array (
						"type" => 1 
				),
				"photolecture_height" => array (
						"type" => 1 
				),
				"long_totale_lue" => array (
						"type" => 1 
				),
				"long_totale_reel" => array (
						"type" => 1 
				),
				"rayon_point_initial" => array(
						"type" => 1,
						"defaultValue" => 7
				)
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["srid"] = - 1;
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Reecriture de la fonction ecrire, pour preparer les points et realiser les calculs
	 * (non-PHPdoc)
	 * 
	 * @see ObjetBDD::ecrire()
	 */
	function ecrire($dataBrute) {
		$data = array ();
		/*
		 * Lecture des valeurs existantes, et mise a jour des donnees "classiques"
		 */
		foreach ( $this->colonnes as $key => $value ) {
			/*
			 * On recherche l'equivalence dans dataBrute
			 */
			if (isset ( $dataBrute [$key] )) {
				$data [$key] = $dataBrute [$key];
				unset ( $dataBrute [$key] );
			}
		}
		/*
		 * Mise a jour de l'heure
		 */
		$data["photolecture_date"] = $this->getDateHeure();
		/*
		 * Traitement des points
		 */
		$points = array ();
		$pointsMesure = array ();
		$coef = $dataBrute ["coef_correcteur"];
		/*
		 * Calcul du rayon du cercle initial
		 */
		$data["rayon_point_initial"] = $data["rayon_point_initial"] * $coef;
		/*
		 * Gestion des points
		 */
		foreach ( $dataBrute as $key => $value ) {
			$nomChamp = preg_replace ( '#[^a-zA-Z]+#', "", $key );
			if ($nomChamp == "rang") {
				/*
				 * Recuperation du numero de ligne
				 */
				$num = preg_replace ( '#[^0-9]#', "", $key );
				/*
				 * Recalcul des coordonnees exactes
				 */
				//$X = floor ( $dataBrute ["pointx" . $num] * $coef );
				//$Y = floor ( $dataBrute ["pointy" . $num] * $coef );
				/*
				 * Mise en tableau
				 */
				if ($dataBrute ["pointRef" . $num] == 1) {
					$pointsMesure [$dataBrute["rang" . $num]] ["x"] = $dataBrute ["pointx" . $num];
					$pointsMesure [$dataBrute["rang" . $num]] ["y"] = $dataBrute["pointy" . $num];
				} else {
					$points [$dataBrute["rang" . $num]] ["x"] = $dataBrute ["pointx" . $num];
					$points [$dataBrute["rang" . $num]] ["y"] = $dataBrute ["pointy" . $num];
				}
			}
		}
		/*
		 * Tri des tableaux
		 */
		ksort ( $points, SORT_NUMERIC );
		ksort ( $pointsMesure, SORT_NUMERIC );
		/*
		 * Mise en forme des coordonnees
		 */
		if (count ( $points ) > 0) {
			$data ["points"] = "MULTIPOINT(";
			$virgule = "";
			$x0 = 0;
			$y0 = 0;
			$i = 0;
			$longueur_totale = 0;
			foreach ( $points as $key => $value ) {
				$data ["points"] .= $virgule . floor($value ["x"] * $coef) . " " . floor($value ["y"]*$coef);
				/*
				 * Calcul de la longueur par rapport au point precedent
				 */
				if ($i > 0) {
					$long = $this->calculDistance ( $x0, $y0, $value ["x"], $value ["y"] );
					// echo $x0.' '.$y0.' '.$value["x"].' '. $value["y"].' '.$long."<br>";
					$longueur_totale = $longueur_totale + $long;
				}
				$x0 = $value ["x"];
				$y0 = $value ["y"];
				$i ++;
				$virgule = ",";
			}
			$data ["points"] .= ')';
			$data["long_totale_lue"] = $longueur_totale * $coef; 
		}
		
		/*
		 * Gestion de la longueur de reference
		 */
		if (count ( $pointsMesure ) > 0) {
			$data ["points_ref_lecture"] = "MULTIPOINT(";
			$virgule = "";
			$i = 0;
			$mesure = array ();
			foreach ( $pointsMesure as $key => $value ) {
				$i ++;
				$data ["points_ref_lecture"] .= $virgule . floor($value ["x"] * $coef) . " " . floor($value ["y"]*$coef);
				$mesure [$i] ["x"] = $value ["x"];
				$mesure [$i] ["y"] = $value ["y"];
				$virgule = ",";
			}
			$data ["points_ref_lecture"] .= ')';
			/*
			 * Calcul de la distance de la lecture de reference
			 */
			if ($i >= 2) {
				$data ["long_ref_mesuree"] = $this->calculDistance ( $mesure [1] ["x"], $mesure [1] ["y"], $mesure [2] ["x"], $mesure [2] ["y"] )* $coef;
			}
			/*
			 * Calcul de la distance reelle
			 */
			if ($data ["long_ref_mesuree"] > 0 && $data ["long_totale_lue"] > 0) {
				/*
				 * Recuperation de la valeur de la longueur de reference dans la photo
				 */
				$photo = new Photo ( $this->connection, $this->paramori );
				$dataPhoto = $photo->getDetail ( $data ["photo_id"] );
				if ($dataPhoto ["long_reference"] > 0) {
					$data ["long_totale_reel"] = $data ["long_totale_lue"] / $data ["long_ref_mesuree"] * $dataPhoto ["long_reference"];
				}
			}
		}
		// print_r($data);
		return parent::ecrire ( $data );
	}
	/**
	 * Calcul de la distance geometrique entre deux points
	 * 
	 * @param number $x1        	
	 * @param number $y1        	
	 * @param number $x2        	
	 * @param number $y2        	
	 * @return number
	 */
	function calculDistance($x1, $y1, $x2, $y2) {
		$dist = sqrt ( pow ( abs ( $x2 - $x1 ), 2 ) + (pow ( abs ( $y2 - $y1 ), 2 )) );
		return $dist;
	}
	
	/**
	 * Retourne la liste des lectures realisees sur une photo
	 * 
	 * @param int $photo_id        	
	 * @return array
	 */
	function getListeFromPhoto($photo_id) {
		$sql = "select photolecture_id, photo_id, lecteur_id, lecteur_nom, lecteur_prenom, photolecture_date,
				ST_NumGeometries(points) - 1 as age,
				long_totale_lue,
				long_totale_reel,
				long_ref_mesuree,
				photolecture_width,
				photolecture_height
				from " . $this->table . " left outer join lecteur using(lecteur_id)" . " where photo_id = " . $photo_id . " order by photolecture_date desc";
		return $this->getListeParam ( $sql );
	}
	/**
	 * Retourne la liste des lectures effectuees
	 * $id contient soit le numero unique de phototolecture_id, soit un tableau contenant la liste des identifiants a traiter
	 * 
	 * @param <int|array> $id        	
	 * @param number $coef        	
	 * @return array
	 */
	function getDetailLecture($id, $coef) {
		$sql = "select photolecture_id, photo_id, lecteur_id, lecteur_nom, lecteur_prenom, photolecture_date,
				st_astext(points) as listepoint,
				long_totale_lue,
				long_totale_reel,
				long_ref_mesuree,
				photolecture_width,
				photolecture_height,
				rayon_point_initial
				from " . $this->table . " left outer join lecteur using(lecteur_id)";
		/*
		 * Preparation de la clause where
		 */
		if (! is_array ( $id )) {
			$where = " where photolecture_id = " . $id;
		} else {
			/*
			 * Les identifiants sont en tableau
			 */
			$where = " where photolecture_id in (";
			$virgule = "";
			foreach ( $id as $key => $value ) {
				$where .= $virgule . $value;
				$virgule = ",";
			}
			$where .= ")";
		}
		$couleur = array("0"=>"red","1"=>"green", "2"=>"magenta", "3"=>"blue", "4"=>"purple", 
				"5"=>"darkred", "6"=>"darkgreen", "7"=>"darkmagenta", "8"=>"darkblue", "8"=>"darkpurple");
		/*
		 * Lecture de la liste concernee
		 */
		$icolor = 0;
		$data = $this->getListeParam ( $sql . $where );
		foreach ( $data as $key => $value ) {
			if (strlen ( $data [$key] ["listepoint"] ) > 0) {
				$data[$key]["points"] = $this->calculPointsAffichage($data[$key]["listepoint"], $coef);
				/*
				 * Rajout de la couleur
				 */
				$data[$key]["couleur"] = $couleur[$icolor];
				$icolor++;
			}
			/*
			 * Recalcul du rayon initial
			 */
			$data[$key]["rayon_point_initial"] = floor($data[$key]["rayon_point_initial"] / $coef);
		}
		return $data;
	}
	/**
	 * Calcule la position des points en pixels, pour affichage dans la resolution consideree
	 * $listepoint contient la valeur de st_astext(champ_postgis_concerne)
	 * @param string $listepoint
	 * @param number $coef
	 * @return array
	 */
	function calculPointsAffichage($listepoint, $coef){
		/*
		 * Nettoyage des donnees
		*/
		$lpt = preg_replace ( '#[^0-9 .,]#', "", $listepoint );
		$alpt = explode ( ",", $lpt );
		$i = 0;
		$data = array();
		foreach ( $alpt as $key1 => $value1 ) {
			/*
			 * Separation des valeurs x et y
			 */
			$xy = explode ( " ", $value1 );
			/*
			 * Calcul de l'emplacement en fonction de la resolution/coef de transformation
			 */
			$data [$i] ["x"] = floor ( $xy [0] / $coef );
			$data [$i] ["y"] = floor ( $xy [1] / $coef );
			$i ++;
		}
		return $data;
	}
	/**
	 * Retourne les points saisis en format lisible (st_astext)
	 * @param integer $id
	 * @return array
	 */
	function lirePoints($id) {
		$sql = "select photolecture_id,
		st_astext(points) as points,
		st_astext(points_ref_lecture) as points_ref_lecture
		from ".$this->table
		." where photolecture_id = ".$id;
		return $this->lireParam($sql);
	}
	/**
	 * Retourne la liste des lectures effectuees en fonction des criteres de recherche indiques
	 * @param array $param
	 * @return array
	 */
	function getListSearch($param) {
		$sql = "select photolecture_id, photo_id, lecteur_id, piece_id, individu_id,
				lecteur_nom, lecteur_prenom,
				photolecture_date,
				st_astext(points) as points,
				st_astext(points_ref_lecture) as points_ref_lecture,
				ST_NumGeometries(points) - 1 as age,
				long_ref_mesuree, long_totale_reel,
				photolecture_width, photolecture_height,
				photo_nom, photo_date, color, long_reference, photo_height, photo_width,
				piecetype_libelle, traitementpiece_libelle,
				codeindividu, tag, rayon_point_initial
				from ".$this->table
				." left join lecteur using(lecteur_id)
					left join photo using (photo_id)
					left join piece using (piece_id)
					left join individu using (individu_id)
					left outer join piecetype using (piecetype_id)
					left outer join traitementpiece using (traitementpiece_id)
					left outer join peche using (peche_id)
				";
		$where = " where ";
		$and = "";
		if (strlen($param["codeindividu"]) > 0) {
			$where .= $and."(upper(codeindividu) like upper('%".$param["codeindividu"]."%')
					or upper(tag) like upper('%".$param["codeindividu"]."%'))";
			$and = " and ";
		}
		if ($param["exp_id"] > 0) {
			$where .= $and."exp_id=".$param["exp_id"];
			$and = " and ";
		}
		if (strlen($param["site"])>0) {
			$where .= $and."site = '".pg_escape_string($param["site"])."'";
			$and = " and ";
		}
		if (strlen($param["zonesite"])>0) {
			$where .= $and."zonesite = '".pg_escape_string($param["zonesite"])."'";
			$and = " and ";
		}
		if ($param["lecteur_id"]>0) {
			$where .= $and."lecteur_id = ".$param["lecteur_id"];
			$and = " and ";
		}
		/*
		 * On verifie qu'on ait bien une clause where...
		 */
		if ($where == " where ") $where = "";
		$order = " order by codeindividu, tag, piece_id, photo_id, photolecture_date";
		$data = $this->getListeParam($sql.$where.$order);
		/*
		 * Mise au format des dates
		 */
		foreach ($data as $key=>$value) {
			if (strlen($data[$key]["photo_date"] > 1))
			$data[$key]["photo_date"] = $this->formatDateDBversLocal($value["photo_date"]);
		}
		return ($data);
	}
}
?>