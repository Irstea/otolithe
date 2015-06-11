<?php
include_once 'modules/classes/photo.class.php';
$dataClass = new Lecteur($bdd,$ObjetBDDParam);
$id = $_REQUEST["lecteur_id"];

switch ($t_module["param"]) {
	case "list":
		/*
		 * Display the list of all records of the table
		 */
		$smarty->assign("data", $dataClass->getListe());
		$smarty->assign("corps", "gestion/lecteurListe.tpl");
		break;
	case "display":
		/*
		 * Display the detail of the record
		 */
		$data = $dataClass->lire($id);
		$smarty->assign("data", $data);
		$smarty->assign("corps", "example/exampleDisplay.tpl");
		break;
	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		dataRead($dataClass, $id, "gestion/lecteurChange.tpl");
		require_once "modules/classes/individu.class.php";
		$experimentation = new Experimentation($bdd, $ObjetBDDParam);
		$smarty->assign("exps", $experimentation->getAllListFromLecteur($id));
		break;
	case "write":
		/*
		 * write record in database
		 */
		$id = dataWrite($dataClass, $_REQUEST);
		if ($id > 0) {
			$_REQUEST["lecteur_id"] = $id;
		}
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete($dataClass, $id);
		break;
}
?>