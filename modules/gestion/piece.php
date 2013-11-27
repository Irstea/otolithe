<?php
include_once 'modules/classes/piece.class.php';
$dataClass = new Piece($bdd,$ObjetBDDParam);
$id = $_REQUEST["piece_id"];

switch ($t_module["param"]) {
	case "display":
		/*
		 * Display the detail of the record
		 */
		$data = $dataClass->getDetail($id);
		$smarty->assign("data", $data);
		/*
		 * Lecture des photos
		 */
		include_once 'modules/classes/photo.class.php';
		$photo = new Photo($bdd, $ObjetBDDParam);
		/*
		 * Lecture du poisson
		 */
		include_once 'modules/classes/individu.class.php';
		$individu = new Individu($bdd, $ObjetBDDParam);
		$smarty->assign("individu", $individu->getDetail($data["individu_id"]));
		$smarty->assign("photo", $photo->getListePhotoFromPiece($id));
		$smarty->assign("corps", "gestion/pieceDisplay.tpl");
		break;
	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		/*
		 * Recuperation des tables de parametres
		 */
		$traitementpiece = new Traitementpiece($bdd, $ObjetBDDParam);
		$smarty->assign("traitementpiece", $traitementpiece->getListe());
		$piecetype = new Piecetype($bdd, $ObjetBDDParam);
		$smarty->assign("piecetype", $piecetype->getListe());
		/*
		 * Lecture du poisson
		*/
		include_once 'modules/classes/individu.class.php';
		$individu = new Individu($bdd, $ObjetBDDParam);
		$smarty->assign("individu", $individu->getDetail($_REQUEST["individu_id"]));
		dataRead($dataClass, $id, "gestion/pieceChange.tpl", $_REQUEST["individu_id"]);
		break;
	case "write":
		/*
		 * write record in database
		 */
		$id = dataWrite($dataClass, $_REQUEST);
		if ($id > 0 ) $_REQUEST["piece_id"] = $id;
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete($dataClass, $id);
		break;
}
?>