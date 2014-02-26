<?php
/**
 * ORM de gestion de la table piece
 * @author quinton
 *
 */
class Piece extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table="piece";
		$this->id_auto="1";
		$this->colonnes=array(
				"piece_id"=>array("type"=>1,"key"=>1, "requis"=>1, "defaultValue"=>0),
				"individu_id"=>array("type"=>1, "requis"=>1, "parentAttrib"=>1),
				"piecetype_id"=>array("type"=>1, "requis"=>1),
				"piececode"=>array("longueur"=>255),
				"traitementpiece_id"=>array("type"=>1)
		);
		if(!is_array($param)) $param==array();
		$param["fullDescription"]=1;
		parent::__construct($bdd,$param);
	}
	/**
	 * Affiche le detail d'une piece
	 * @param int $id
	 * @return array
	 */
	function getDetail($id) {
		$sql = "select piece_id, individu_id, piecetype_id, piecetype_libelle, piececode, 
				traitementpiece_id, traitementpiece_libelle
				from ".$this->table.
				" left outer join piecetype using (piecetype_id)
				  left outer join traitementpiece using (traitementpiece_id)
				 where piece_id = ".$id;
		return $this->lireParam($sql);
	}	
	/**
	 * Retourne la liste des pieces attachees a un individu
	 * @param int $individu_id
	 * @return array
	 */
	function getListFromIndividu($individu_id) {
		$sql = "select piece_id, individu_id, piececode,
				piecetype_libelle, traitementpiece_libelle, 
				count(photo_id) as nbphoto
				from ".$this->table." 
						left outer join piecetype using (piecetype_id)
						left outer join traitementpiece using (traitementpiece_id)
						left outer join photo using (piece_id)
				where individu_id = ".$individu_id."
				group by piece_id, individu_id, piecetype_libelle, traitementpiece_libelle
						";
		return $this->getListeParam($sql);
	}
}
/**
 * ORM de gestion de la table piecetype
 * @author quinton
 *
 */
class Piecetype extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table="piecetype";
		$this->id_auto="1";
		$this->colonnes=array(
				"piecetype_id"=>array("type"=>1,"key"=>1, "requis"=>1, "defaultValue"=>0),
				"piecetype_libelle"=>array("longueur"=>255)
		);
		if(!is_array($param)) $param==array();
		$param["fullDescription"]=1;
		parent::__construct($bdd,$param);
	}
}
/**
 * ORM de gestion de la table traitement
 * @author quinton
 *
 */
class Traitementpiece extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->param = $param;
		$this->table="traitementpiece";
		$this->id_auto="1";
		$this->colonnes=array(
				"traitementpiece_id"=>array("type"=>1,"key"=>1, "requis"=>1, "defaultValue"=>0),
				"traitementpiece_libelle"=>array("longueur"=>255)
				);
		$this->id_auto="1";
		$this->colonnes=array(
				"traitement_id"=>array("type"=>1,"key"=>1, "requis"=>1, "defaultValue"=>0),
				"traitement_libelle"=>array("longueur"=>255)
		);
		if(!is_array($param)) $param==array();
		$param["fullDescription"]=1;
		parent::__construct($bdd,$param);
	}
}
?>