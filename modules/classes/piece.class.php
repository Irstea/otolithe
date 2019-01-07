<?php

/**
 * ORM de gestion de la table piece
 * @author quinton
 *
 */
class Piece extends ObjetBdd
{
	function __construct($bdd, $param = array())
	{
		$this->param = $param;
		$this->table = "piece";
		$this->id_auto = "1";
		$this->colonnes = array(
			"piece_id" => array(
				"type" => 1,
				"key" => 1,
				"requis" => 1,
				"defaultValue" => 0
			),
			"individu_id" => array(
				"type" => 1,
				"requis" => 1,
				"parentAttrib" => 1
			),
			"piecetype_id" => array(
				"type" => 1,
				"requis" => 1
			),
			"piececode" => array(
				"longueur" => 255
			),
			"traitementpiece_id" => array(
				"type" => 1
			)
		);
		$param["fullDescription"] = 1;
		parent::__construct($bdd, $param);
	}
	/**
	 * Affiche le detail d'une piece
	 * 
	 * @param int $id        	
	 * @return array
	 */
	function getDetail($id)
	{
		if ($id > 0) {
			$sql = "select piece_id, individu_id, piecetype_id, piecetype_libelle, piececode, 
				traitementpiece_id, traitementpiece_libelle
				from " . $this->table . " left outer join piecetype using (piecetype_id)
				  left outer join traitementpiece using (traitementpiece_id)
				 where piece_id = " . $id;
			return $this->lireParam($sql);
		} else {
			return null;
		}
	}
	/**
	 * Retourne la liste des pieces attachees a un individu
	 * 
	 * @param int $individu_id        	
	 * @return array
	 */
	function getListFromIndividu($individu_id)
	{
		if ($individu_id > 0) {
			$sql = "select piece_id, individu_id, piececode,
				piecetype_libelle, traitementpiece_libelle, 
				count(photo_id) as nbphoto
				from " . $this->table . " 
						left outer join piecetype using (piecetype_id)
						left outer join traitementpiece using (traitementpiece_id)
						left outer join photo using (piece_id)
				where individu_id = " . $individu_id . "
				group by piece_id, individu_id, piecetype_libelle, traitementpiece_libelle
						";
			return $this->getListeParam($sql);
		} else {
			return null;
		}
	}
	/**
	 * Surcharge de la fonction suppression pour
	 * effacer les donnees liees
	 *
	 * @param int $id
	 * @return void
	 */
	function supprimer($id)
	{
		if (is_numeric($id) && $id > 0) {
			/** Suppression des tables liees */
			/** Suppression des photos */
			include_once 'modules/classes/photo.class.php';
			$photo = new Photo($this->connection, $this->paramori);
			$lp = $photo->getListePhotoFromPiece($id);
			foreach ($lp as $row) {
				$photo->supprimer($row["photo_id"]);
			}
			/** Suppression des metadonnees */
			include_once 'modules/classes/piecemetadata.class.php';
			$pm = new Piecemetadata($this->connection, $this->paramori);
			$pm->supprimerChamp($id, "piece_id");
			parent::supprimer($id);
		} else {
			throw new ObjetBDDException(_("La suppression d'une clé nulle ou non numérique n'est pas possible"));
		}
	}
	/**
	 * Suppression de toutes les pièces rattachées
	 * à un individu
	 *
	 * @param int $id
	 * @return void
	 */
	function supprimerFromIndividu($id)
	{
		if ($id > 0) {
			$sql = "select piece_id from piece where individu_id = :id";
			$liste = $this->getListeParamAsPrepared($sql, array("id" => $id));
			foreach ($liste as $item) {

				$this->supprimer($item["piece_id"]);
			}
		}
	}
}
/**
 * ORM de gestion de la table piecetype
 * 
 * @author quinton
 *        
 */
class Piecetype extends ObjetBdd
{
	function __construct($bdd, $param = array())
	{
		$this->param = $param;
		$this->table = "piecetype";
		$this->id_auto = "1";
		$this->colonnes = array(
			"piecetype_id" => array(
				"type" => 1,
				"key" => 1,
				"requis" => 1,
				"defaultValue" => 0
			),
			"piecetype_libelle" => array(
				"longueur" => 255
			)
		);
		$param["fullDescription"] = 1;
		parent::__construct($bdd, $param);
	}
}
/**
 * ORM de gestion de la table traitement
 * 
 * @author quinton
 *        
 */
class Traitementpiece extends ObjetBdd
{
	function __construct($bdd, $param = array())
	{
		$this->param = $param;
		$this->table = "traitementpiece";
		$this->id_auto = "1";
		$this->colonnes = array(
			"traitementpiece_id" => array(
				"type" => 1,
				"key" => 1,
				"requis" => 1,
				"defaultValue" => 0
			),
			"traitementpiece_libelle" => array(
				"longueur" => 255
			)
		);
		$this->id_auto = "1";
		$this->colonnes = array(
			"traitement_id" => array(
				"type" => 1,
				"key" => 1,
				"requis" => 1,
				"defaultValue" => 0
			),
			"traitement_libelle" => array(
				"longueur" => 255
			)
		);
		$param["fullDescription"] = 1;
		parent::__construct($bdd, $param);
	}
}
?>