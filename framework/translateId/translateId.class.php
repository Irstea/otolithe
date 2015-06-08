<?php
/**
 * Classe permettant de gerer les remplacements d'identifiants par des cles locales
 * 
 * Instanciation : 
 * if (!isset($_SESSION["ti_table"])
 * 		$_SESSION["ti_table"] = new TranslateId("cle_name");
 * @author Eric Quinton
 * @copyright Copyright (c) 2015, IRSTEA / Eric Quinton
 * @license http://www.cecill.info/licences/Licence_CeCILL-C_V1-fr.html LICENCE DE LOGICIEL LIBRE CeCILL-C
 *  Creation 8 juin 2015
 */
class TranslateId {
	/**
	 * Tableau de correspondance entre les identifiants de la base de donnees
	 * et les identifiants calcules
	 * 
	 * @var array[$this->cle] = $dbkey;
	 */
	private $corresp;
	private $corresp_reverse;
	private $fieldname;
	private $cle = 1;

	/**
	 * Initialisation du champ contenant le nom de la colonne
	 * @param string $fieldname
	 */
	function __construct($fieldname) {
		if (strlen($fieldname)> 0)
			$this->fieldname = $fieldname;
	} 

	/**
	 * Transforme toutes les valeurs du tableau
	 * @param array $data
	 * @param string $fieldname : nom de la colonne (si non precisee a l'instanciation)
	 * @return array
	 */
	function translateList($data, $reset=false) {
		/*
		 * Reinitialisation du tableau
		 */
		if ($reset == true)
			$this->reinit ();
		/*
		 * Traitement de chaque ligne du tableau
		 */
		foreach ( $data as $key => $value ) {
			if (isset ( $value [$this->fieldname  ])) {
				if (!isset($this->corresp_reverse[$value [ $this->fieldname ]]))
					$this->setValue($value[$this->fieldname]);
				$data [$key] [$this->fieldname] = $this->corresp_reverse[$value [ $this->fieldname ]];
			}
		}
		$corresp_reverse = array_flip($corresp);
		return $data;
	}
	/**
	 * Reinitialisation du tableau
	 */
	function reinit() {
		$this->cle = 1;
		$this->corresp = array ();
		$this->corresp_reverse = array();
	}

	/**
	 * Ajoute une valeur dans le tableau
	 * @param int $dbId
	 * @return number|NULL
	 */
	function setValue($dbId) {
		if ($dbId > 0) {
			$this->corresp [$this->cle] = $dbId;
			$this->corresp_reverse[$dbId] = $this->cle;
			$key = $this->cle;
			$this->cle ++;
			return $key;
		} else
			return null;
	}

	/**
	 * Retourne la cle correspondant a la valeur fournie
	 * @param int $id
	 * @return multitype:$this->cle |NULL
	 */
	function getValue($id) {
		if ($id > 0) {
			$dbId = $this->corresp[$id];
			return $dbId;
		} else
			return 0;
	}

	/**
	 * Retourne la valeur calculee correspondant a une cle de la table
	 * @param array $row
	 * @return array
	 */
	function translateRow($row) {
		foreach ($row as $key => $value) {
			if ($key = $this->fieldname) {
				if (!isset($this->corresp_reverse[$key])) {
					$this->setValue($value);
				}
				$row[$key] = $this->corresp_reverse[$key];
			}
		}
		return $row;
	}
}

?>