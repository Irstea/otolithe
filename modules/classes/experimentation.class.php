<?php
/**
 * Created : 14 févr. 2017
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2017 - All rights reserved
 */
class Experimentation extends ObjetBdd {
	function __construct($bdd, $param) {
		$this->table = "experimentation";
		$this->id_auto = 1;
		$this->colonnes = array (
				"exp_id" => array (
						"type" => 1,
						"key" => 1,
						"requis" => 1 
				),
				"exp_nom" => array (
						"requis" => 1 
				),
				"exp_description" => array (
						"type" => 0 
				),
				"exp_debut" => array (
						"type" => 2 
				),
				"exp_fin" => array (
						"type" => 2 
				) 
		);
		if (! is_array ( $param ))
			$param = array ();
			$param ["fullDescription"] = 1;
			$oaram["auto_date"] = 1;
		parent::__construct ( $bdd, $param );
	}
}
?>