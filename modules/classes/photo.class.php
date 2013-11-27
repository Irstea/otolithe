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
						"type" => 0 
				),
				"photo_height" => array (
						"type" => 1 
				),
				"photo_width" => array (
						"type" => 1 
				),
				"long_reference" => array (
						"type" => 0 
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
			$dataPhoto = array();
			$flag_photo = 1;
			/*
			 * Traitement de la photo
			 */
			/*
			 * Donnees "peripheriques"
			 */
			if (strlen($data["photo_nom"]) == 0 && strlen($data["photo_filename"])>0 ) 
				$data["photo_nom"] = $data["photo_filename"];
			$image = new Imagick ();
			$image->readImageBlob ( $data ["photoload"] );
			$geo = $image->getimagegeometry ();
			$data ["photo_width"] = $geo ["width"];
			$data ["photo_height"] = $geo ["height"];
			$dataPhoto ["photo_data"] = pg_escape_bytea($data ["photoload"]);
			unset($data["photoload"]);
			/*
			 * Generation du thumbnail
			 */
			$image->resizeImage ( $this->format_thumbnail, $this->format_thumbnail, imagick::FILTER_LANCZOS, 1, true );
			$image->setformat ( "jpeg" );
			$dataPhoto ["photo_thumbnail"] = pg_escape_bytea($image->getimageblob ());
		}
		$id = parent::ecrire ( $data );
		if ($id > 0 && $flag_photo == 1) {
			/*
			 * Ecriture de la photo en base
			 */
			//$this->UTF8 = false;
			//$this->codageHtml = false;
			//$dataPhoto["photo_id"] = $id;
			//parent::ecrire($dataPhoto);
			$sql = "update ".$this->table." set photo_data = '".
			$dataPhoto["photo_data"].
			"', photo_thumbnail = '".$dataPhoto["photo_thumbnail"].
			"' where photo_id = ".$id;
			$this->executeSQL($sql);			
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
			$data = $this->executeSQL ( $sql.$where );
			$photo = $data->fields ["image"];
			if ($sizeX > 0 && $sizeY > 0 && strlen ( $photo) > 0 ) {
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
	 * @param int $id
	 * @return array
	 */
	function getDetail($id) {
		$sql = "select photo_id, piece_id, photo_nom, description, photo_filename, photo_date, color,
				lumieretype_libelle, grossissement, repere, uri, long_reference, photo_width, photo_height
				from ".$this->table. "
				left outer join lumieretype using(lumieretype_id)
				where photo_id = ".$id;
		return ($this->lireParam($sql));
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
				"lecteur_nom" =>array("longueur"=>50),
				"lecteur_prenom"=>array("longueur"=>50)
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Retourne l'identifiant du lecteur
	 * @param int $login
	 * @return number
	 */
	function getIdFromLogin($login) {
		$sql = "select lecteur_id from ".$this->table
			." where login = '".$login."'";
		$res = $this->lireParam($sql);
		if ($res["lecteur_id"] > 0) {
			return $res["lecteur_id"];
		}else {
			return -1;
		}
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
				"photolecture_date" => array(
					"type" => 2,
					"defaultValue" => "getDateJour"
				),
				"points_ref_lecture" => array(
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
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	
	
	/**
	 * Retourne la liste des lectures realisees sur une photo
	 * @param int $photo_id
	 * @return array
	 */
	function getListeFromPhoto($photo_id) {
		$sql = "select photo_id, lecteur_id, lecteur_nom, lecteur_prenom, photolecture_date,
				ST_NumGeometries(points) - 1 as age
				from ".$this->table
				." left outer join lecteur using(lecteur_id)"
				." where photo_id = ".$photo_id
				." order by photolecture_date desc";
		return $this->getListeParam($sql);
	}
}
?>