<?php
include_once 'modules/classes/piece.class.php';
$dataClass = new Piece($bdd,$ObjetBDDParam);
$id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);

switch ($t_module["param"]) {
	case "display":
		/*
		 * Display the detail of the record
		 */
		$data = $dataClass->getDetail($id);
		$dataT = $_SESSION["it_piece"]->translateRow($data);
		$dataT = $_SESSION["it_individu"]->translateRow($dataT);
		$smarty->assign("data", $dataT);
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
		$dataIndiv = $individu->getDetail($data["individu_id"]);
		$dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
		$dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
		$smarty->assign("individu", $dataIndiv);
		$listePhoto = $photo->getListePhotoFromPiece($id);
		/*
		 * Rajout du lien vers l'image
		 */
		foreach($listePhoto as $key=>$value) {
			$listePhoto[$key]["photoPath"] = $photo->writeFilePhoto($value["photo_id"],1);
		}
		$smarty->assign("photo", $_SESSION["it_photo"] -> translateList($listePhoto));
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
		$_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
		$dataIndiv = $individu->getDetail($_REQUEST["individu_id"]);
		$dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
		$dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
		$smarty->assign("individu", $dataIndiv);
		$data = dataRead($dataClass, $id, "gestion/pieceChange.tpl", $_REQUEST["individu_id"]);
		$data = $_SESSION["it_piece"]->translateRow($data);
		$data = $_SESSION["it_individu"]->translateRow($data);
		$smarty->assign( "data", $data);
		break;
	case "write":
		/*
		 * write record in database
		 */
		$_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
		$_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
		$id = dataWrite($dataClass, $_REQUEST);
		if ($id > 0 ) $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($id);
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete($dataClass, $id);
		break;
}
?>