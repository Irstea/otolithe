<?php
/**
 * Created : 14 févr. 2017
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2017 - All rights reserved
 */
require_once 'modules/classes/experimentation.class.php';
$dataClass = new Experimentation($bdd,$ObjetBDDParam);
$id = $_REQUEST["exp_id"];

switch ($t_module["param"]) {
	case "list":
		/*
		 * Display the list of all records of the table
		 */
		$smarty->assign("data", $dataClass->getListe());
		$smarty->assign("corps", "gestion/experimentationList.tpl");
		break;

	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		dataRead($dataClass, $id, "gestion/experimentationChange.tpl");
		break;
	case "write":
		/*
		 * write record in database
		 */
		dataWrite($dataClass, $_REQUEST);
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete($dataClass, $id);
		break;
}
?>