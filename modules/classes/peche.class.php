<?php
/**
 * ORM de gestion de la table peche
 * @author quinton
 *
 */
class Peche extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "peche";
		$this->id_auto = 1;
		$this->colonnes = array (
				"peche_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1 
				),
				"site" => array (
						"longueur" => 100 
				),
				"zonesite" => array (
						"longueur" => 100 
				),
				"peche_date" => array (
						"type" => 2 
				),
				"campagne" => array (
						"longueur" => 100 
				),
				"peche_engin" => array (
						"longueur" => 100 
				),
				"personne" => array (
						"longueur" => 100 
				),
				"operateur" => array (
						"longueur" => 100 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Retourne la liste des sites peches
	 * 
	 * @return array
	 */
	function getListeSite() {
		$sql = "select distinct site from " . $this->table . " 
				order by site
				";
		return $this->getListParam ( $sql );
	}
	/**
	 * Retourne la liste des zones de peche
	 * 
	 * @return array
	 */
	function getListeZone() {
		$sql = "select distinct zonesite from " . $this->table . "
				order by zonesite
				";
		return $this->getListParam ( $sql );
	}
}
/**
 * ORM de gestion de la table physicochimie
 * 
 * @author quinton
 *        
 */
class Physicochimie extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table = "physicochimie";
		$this->id_auto = 1;
		$this->colonnes = array (
				"physicochimie_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1 
				),
				"peche_id" => array (
						"type" => 1,
						"requis" => 1,
						"parentAttrib" => 1 
				),
				"temp" => array (
						"type" => 1 
				),
				"temp_min" => array (
						"type" => 1 
				),
				"temp_max" => array (
						"type" => 1 
				),
				"o2" => array (
						"type" => 1 
				),
				"o2_min" => array (
						"type" => 1 
				),
				"o2_max" => array (
						"type" => 1 
				),
				"o2pourcent" => array (
						"type" => 1 
				),
				"o2pourcent_min" => array (
						"type" => 1 
				),
				"o2pourcent_max" => array (
						"type" => 1 
				),
				"conductivite" => array (
						"type" => 1 
				),
				"conductivite_min" => array (
						"type" => 1 
				),
				"conductivite_max" => array (
						"type" => 1 
				),
				"conductivitea" => array (
						"type" => 1 
				),
				"conductivitea_min" => array (
						"type" => 1 
				),
				"conductivitea_max" => array (
						"type" => 1 
				),
				"salinite" => array (
						"type" => 1 
				),
				"salinite_min" => array (
						"type" => 1 
				),
				"salinite_max" => array (
						"type" => 1 
				),
				"ph" => array (
						"type" => 1 
				),
				"ph_min" => array (
						"type" => 1 
				),
				"ph_max" => array (
						"type" => 1 
				) 
		);
		if (! is_array ( $param ))
			$param == array ();
		$param ["fullDescription"] = 1;
		parent::__construct ( $bdd, $param );
	}
	/**
	 * Retourne un enregistrement correspondant a une peche
	 * 
	 * @param int $id        	
	 * @return array
	 */
	function getByIdpeche($id) {
		if ($id > 0) {
			$sql = "select * from " . $this->table . " where peche_id = " . $id;
			return $this->lireParam ( $sql );
		} else
			return null;
	}
}
?>