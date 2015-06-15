<?php
class Individu extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "individu";
		$this->id_auto = "1";
		$this->colonnes = array (
				"individu_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"espece_id" => array (
						"type" => 1 
				),
				"peche_id" => array (
						"type" => 1 
				),
				"sexe_id" => array (
						"type" => 1 
				),
				"codeindividu" => array (
						"longueur" => 100,
						"requis" => 1 
				),
				"tag" => array (
						"longueur" => 255 
				),
				"longueur" => array (
						"type" => 1 
				),
				"poids" => array (
						"type" => 1 
				),
				"remarque" => array (
						"longueur" => 255 
				),
				"parasite" => array (
						"longueur" => 255 
				),
				"age" => array (
						"type" => 1 
				),
				"pectorale_gauche" => array (
						"type" => 1 
				),
				"diam_occ_h" => array (
						"type" => 1 
				),
				"diam_occ_v" => array (
						"type" => 1 
				),
				"ht_mm" => array (
						"type" => 1 
				),
				"epaisseur" => array (
						"type" => 1 
				),
				"circonference" => array (
						"type" => 1 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Recherche les animaux selon les criteres de selection fournis
	 *
	 * @param array $data        	
	 * @return array
	 */
	function getListSearch($data) {
		$data = $this->encodeData ( $data );
		$sql = "select individu_id, codeindividu, tag, nom_id, count (piece_id) as nbrepiece,
				sexe_libellecourt, peche_date, site, zonesite, exp_nom
				from " . $this->table . "
					left outer join espece using (espece_id)
					left outer join piece using (individu_id)
					left outer join individu_experimentation using (individu_id)
					left outer join experimentation using (exp_id)
					left outer join peche using (peche_id)
					left outer join sexe using (sexe_id) 	
						";
		/*
		 * Preparation de la clause where
		 */
		$where = "";
		$is_where = 0;
		if (!$data ["exp_id"] > 0)
			$data ["exp_id"] = 0;
		
		if ($is_where == 0) {
			$where = " where ";
			$is_where = 1;
		} else {
			$where .= " and ";
		}
		$where .= "exp_id = " . $data ["exp_id"];
		
		if (strlen ( $data ["codeindividu"] ) > 0) {
			if ($is_where == 0) {
				$where = " where ";
				$is_where = 1;
			} else {
				$where .= " and ";
			}
			$where .= "(upper(codeindividu) like upper('%" . $data ["codeindividu"] . "%')
					or upper(tag) like upper('%" . $data ["codeindividu"] . "%')
							)";
		}
		if ($data ["sexe"] > 0) {
			if ($is_where == 0) {
				$where = " where ";
				$is_where = 1;
			} else {
				$where .= " and ";
			}
			$where .= "sexe_id = " . $data ["sexe"];
		}
		if (strlen ( $data ["site"] ) > 0) {
			if ($is_where == 0) {
				$where = " where ";
				$is_where = 1;
			} else {
				$where .= " and ";
			}
			$where .= "site = '" . $data ["site"] . "'";
		}
		if (strlen ( $data ["zone"] ) > 0) {
			if ($is_where == 0) {
				$where = " where ";
				$is_where = 1;
			} else {
				$where .= " and ";
			}
			$where .= "zonesite = '" . $data ["zone"] . "'";
		}
		/*
		 * Preparation du group by
		 */
		$group = " group by individu_id, codeindividu, nom_id, sexe_libellecourt, peche_date, site, zonesite, exp_nom, tag";
		/*
		 * Preparation de la clause de tri
		 */
		$tri = " order by codeindividu";
		$listData = $this->getListeParam ( $sql . $where . $group . $tri );
		/*
		 * Mise en forme des dates
		 */
		foreach ( $listData as $key => $value ) {
			$listData [$key] ["peche_date"] = $this->formatDateDBversLocal ( $value ["peche_date"] );
		}
		return $listData;
	}
	/**
	 * Retourne le detail d'un animal
	 *
	 * @param int $id        	
	 * @return array
	 */
	function getDetail($id) {
		if ($id > 0) {
			$sql = "select individu_id, peche_id, codeindividu, tag, longueur, poids, 
					remarque, parasite, age, pectorale_gauche, diam_occ_h, diam_occ_v, ht_mm,
					nom_id, epaisseur, circonference, sexe_libelle,
					naturetraitement_libelle, semaine_dissection, mortalite
				from " . $this->table . " 
						left outer join sexe using (sexe_id)
						left outer join traitementindividu using (individu_id)
						left outer join naturetraitement using (naturetraitement_id)
						left outer join espece using (espece_id)
						where individu_id = " . $id;
			return $this->lireParam ( $sql );
		}
	}
	
	/**
	 * Reecriture de la fonction lire pour integrer l'espece
	 * (non-PHPdoc)
	 * 
	 * @see ObjetBDD::lire()
	 */
	function lire($id) {
		if ($id >= 0) {
			$sql = "select individu_id, peche_id, espece_id, codeindividu, tag, longueur, poids,
					remarque, parasite, age, pectorale_gauche, diam_occ_h, diam_occ_v, ht_mm,
					nom_id, epaisseur, circonference
				from " . $this->table . "
						left outer join espece using (espece_id)
						where individu_id = " . $id;
			return $this->lireParam ( $sql );
		} else
			return null;
	}
	
	/**
	 * Surcharge de la fonction ecrire pour enregistrer les experimentations
	 * (non-PHPdoc)
	 * 
	 * @see ObjetBDD::write()
	 */
	function write($data) {
		$id = parent::ecrire ( $data );
		if ($id > 0) {
			/*
			 * Ecriture des experimentations
			 */
			$this->ecrireTableNN ( "individu_experimentation", "individu_id", "exp_id", $id, $data ["exp_id"] );
		}
		return $id;
	}
}

/**
 * ORM de gestion de la table experimentation
 *
 * @author quinton
 *        
 */
class Experimentation extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "experimentation";
		$this->id_auto = "1";
		$this->colonnes = array (
				"exp_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"exp_nom" => array (
						"longueur" => 100 
				),
				"exp_description" => array (
						"longueur" => 255 
				),
				"exp_debut" => array (
						"type" => 2,
						"defaultValue" => "getDebutAnnee" 
				),
				"exp_fin" => array (
						"type" => 2,
						"defaultValue" => "getFinAnnee" 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Reecriture de l'affichage de la liste
	 * (non-PHPdoc)
	 *
	 * @see ObjetBDD::getListe()
	 */
	function getListe() {
		$sql = "select * from " . $this->table . " order by exp_fin desc, exp_nom";
		return $this->getListeParam ( $sql );
	}
	
	/**
	 * Fonction permettant de calculer la date de debut d'annee
	 *
	 * @return string
	 */
	function getDebutAnnee() {
		$data = date ( "Y" ) . "-01-01";
		return $this->formatDateDBversLocal ( $data );
	}
	/**
	 * Fonction permettant de calculer la date de fin d'annee
	 *
	 * @return string
	 */
	function getFinAnnee() {
		$data = date ( "Y" ) . "-12-31";
		return $this->formatDateDBversLocal ( $data );
	}
	
	/**
	 * Retourne la liste de toutes les experimentations, avec le lecteur associe
	 * (saisie des experimentations autorisees)
	 * 
	 * @param int $lecteur_id        	
	 * @return tableau
	 */
	function getAllListFromLecteur($lecteur_id) {
		if ($lecteur_id >= 0) {
			$sql = "select e.exp_id, exp_nom, lecteur_id
					from experimentation e
					left outer join lecteur_experimentation l 
					on (e.exp_id = l.exp_id and l.lecteur_id = " . $lecteur_id . ")
					order by exp_nom";
			return $this->getListeParam ( $sql );
		}
	}
	
	/**
	 * Retourne la liste de toutes les experimentations, pour saisie par individu
	 * 
	 * @param int $individu_id        	
	 * @return tableau
	 */
	function getAllListFromIndividu($individu_id) {
		if ($individu_id >= 0) {
			$sql = "select e.exp_id, exp_nom, individu_id
					from experimentation e
					left outer join individu_experimentation ie 
					on (e.exp_id = ie.exp_id and ie.individu_id = " . $individu_id . ")
					order by exp_nom";
			return $this->getListeParam ( $sql );
		}
	}
	
	/**
	 * Retourne la liste des experimentations autorisees pour un lecteur
	 * 
	 * @param unknown $lecteur_id        	
	 * @return tableau|NULL
	 */
	function getExpAutorisees($lecteur_id) {
		if ($lecteur_id >= 0) {
			$sql = "select e.exp_id, e.exp_nom
					from experimentation e
					join lecteur_experimentation using (exp_id)
					where lecteur_id = " . $lecteur_id . "
					order by e.exp_nom";
			return $this->getListeParam ( $sql );
		} else
			return null;
	}
}
/**
 * ORM de gestion de la table individu_experimentation
 *
 * @author quinton
 *        
 */
class Individu_experimentation extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "individu_experimentation";
		$this->id_auto = "0";
		$this->colonnes = array (
				"individu_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"parentAttrib" => 1 
				),
				"exp_id" => array (
						"type" => 1,
						"requis" => 1,
						"key" => 1 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Retourne la liste des experimentations rattachees a un individu
	 *
	 * @param int $individu_id        	
	 * @return array
	 */
	function getListeFromIndividu($individu_id) {
		if ($individu_id > 0) {
			$sql = "select * from " . $this->table . "
				inner join experimentation using (exp_id)
				where individu_id = " . $individu_id;
			return $this->getListeParam ( $sql );
		} else
			return null;
	}
}
/**
 * ORM de gestion de la table sexe
 *
 * @author quinton
 *        
 */
class Sexe extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "sexe";
		$this->id_auto = "0";
		$this->colonnes = array (
				"sexe_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1,
						"defaultValue" => 0 
				),
				"sexe_libelle" => array (
						"longueur" => 255,
						"requis" => 1 
				),
				"sexe_libellecourt" => array (
						"longueur" => 255,
						"requis" => 1 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
}
/**
 * ORM de gestion de la table espece
 *
 * @author quinton
 *        
 */
class Espece extends ObjetBDD {
	public function __construct($p_connection, $param = NULL) {
		if (is_array ( $param ) == false)
			$param = array ();
		$this->table = "espece";
		$this->id_auto = 0;
		$this->colonnes = array (
				"espece_id" => array (
						"type" => 1,
						"requis" => 1,
						"key" => 1,
						"defaultValue" => 0 
				),
				"nom_id" => array (
						"longueur" => 100 
				),
				"nom_fr" => array (
						"longueur" => 100 
				),
				"nom_vern" => array (
						"longueur" => 100 
				),
				"nom_eng" => array (
						"longueur" => 100 
				),
				"nom_esp" => array (
						"longueur" => 100 
				),
				
				"auteur" => array (
						"longueur" => 100 
				),
				"phylum" => array (
						"longueur" => 100 
				),
				"subphylum" => array (
						"longueur" => 100 
				),
				"classe" => array (
						"longueur" => 100 
				),
				"ordre" => array (
						"longueur" => 100 
				),
				"famille" => array (
						"longueur" => 100 
				),
				"genre" => array (
						"longueur" => 100 
				),
				"code_asfis" => array (
						"longueur" => 100 
				),
				"taxocode" => array (
						"longueur" => 100 
				),
				"code_rubin" => array (
						"longueur" => 100 
				) 
		);
		$param ["fullDescription"] = 1;
		parent::__construct ( $p_connection, $param );
	}
	/**
	 * recherche une espece par rapport a son nom latin ou vernaculaire
	 * Retourne le resultat au format JSON, pour utilisation en ajax
	 *
	 * @param string $nom        	
	 */
	function getEspeceJSON($nom) {
		if (strlen ( $nom ) > 2) {
			$nom = $this->encodeData ( $nom );
			$sql = "select espece_id as id, nom_id ||' - ' || nom_fr as val 
				from " . $this->table . "
				where upper(nom_id) like upper('%" . $nom . "%')
						or upper(nom_fr) like upper ('%" . $nom . "%')
				order by nom_id";
			$data = $this->getListeParam ( $sql );
			return $data;
		}
	}
}
/**
 * ORM de la table naturetraitement
 *
 * @author quinton
 *        
 */
class Naturetraitement extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "naturetraitement";
		$this->id_auto = 1;
		$this->colonnes = array (
				"naturetraitement_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1 
				),
				"naturetraitement_libelle" => array (
						"longueur" => 255,
						"requis" => 1 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
}
/**
 * ORM de gestion de la table traitementindividu
 *
 * @author quinton
 *        
 */
class Traitementindividu extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "traitementindividu";
		$this->id_auto = 1;
		$this->colonnes = array (
				"traitementindividu_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1 
				),
				"individu_id" => array (
						"type" => 1,
						"requis" => 1,
						"parentAttrib" => 1 
				),
				"semaine_dissection" => array (
						"longueur" => 255 
				),
				"mortalite" => array (
						"longueur" => 255 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
}
?>