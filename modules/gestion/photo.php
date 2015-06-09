<?php
include_once 'modules/classes/photo.class.php';
$dataClass = new Photo ( $bdd, $ObjetBDDParam );
$id = $_SESSION ["it_photo"]->getValue ( $_REQUEST ["photo_id"] );
switch ($t_module ["param"]) {
	
	case "display":
		/*
		 * Display the detail of the record
		 */
		$data = $dataClass->getDetail ( $id );
		$dataT = $_SESSION ["it_photo"]->translateRow ( $data );
		$dataT = $_SESSION ["it_piece"]->translateRow ( $dataT );
		/*
		 * Lecture des informations concernant la piece
		 */
		include_once 'modules/classes/piece.class.php';
		$piece = new Piece ( $bdd, $ObjetBDDParam );
		$dataPiece = $piece->getDetail ( $data ["piece_id"] );
		$dataPieceT = $_SESSION ["it_piece"]->translateRow ( $dataPiece );
		$dataPieceT = $_SESSION ["it_individu"]->translateRow ( $dataPieceT );
		$smarty->assign ( "piece", $dataPieceT );
		/*
		 * Lecture des informations concernant le poisson
		 */
		include_once 'modules/classes/individu.class.php';
		$individu = new Individu ( $bdd, $ObjetBDDParam );
		$dataIndiv = $individu->getDetail ( $dataPiece ["individu_id"] );
		$dataIndiv = $_SESSION ["it_individu"]->translateRow ( $dataIndiv );
		$dataIndiv = $_SESSION ["it_peche"]->translateRow ( $dataIndiv );
		$smarty->assign ( "individu", $dataIndiv );
		/*
		 * Recuperation de la liste des lectures effectuees
		 */
		$photolecture = new Photolecture ( $bdd, $ObjetBDDParam );
		$dataLecture = $photolecture->getListeFromPhoto ( $id );
		$dataLecture = $_SESSION ["it_photolecture"]->translateList ( $dataLecture );
		$dataLecture = $_SESSION ["it_piece"]->translateList ( $dataLecture );
		$smarty->assign ( "photolecture", $dataLecture );
		/*
		 * Recuperation de la demande d'affichage de l'age
		 */
		$smarty->assign ( "ageDisplay", $_REQUEST ["ageDisplay"] );
		/*
		 * Preparation de l'affichage de la miniature
		 */
		$smarty->assign ( "photoPath", $dataClass->writeFilePhoto ( $id, 1 ) );
		$smarty->assign ( "data", $dataT );
		$smarty->assign ( "corps", "gestion/photoDisplay.tpl" );
		break;
	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		/*
		 * Recuperation des informations sur la piece et le poisson
		 */
		include_once 'modules/classes/piece.class.php';
		$piece = new Piece ( $bdd, $ObjetBDDParam );
		$piece_id = $_SESSION ["it_piece"]->getValue ( $_REQUEST ["piece_id"] );
		$dataPiece = $piece->getDetail ( $piece_id );
		$dataPieceT = $_SESSION ["it_piece"]->translateRow ( $dataPiece );
		$dataPieceT = $_SESSION ["it_individu"]->translateRow ( $dataPieceT );
		$smarty->assign ( "piece", $dataPiece );
		/*
		 * Lecture des informations concernant le poisson
		 */
		include_once 'modules/classes/individu.class.php';
		$individu = new Individu ( $bdd, $ObjetBDDParam );
		$dataIndiv = $individu->getDetail ( $dataPiece ["individu_id"] );
		$dataIndiv = $_SESSION ["it_individu"]->translateRow ( $dataIndiv );
		$dataIndiv = $_SESSION ["it_peche"]->translateRow ( $dataIndiv );
		$smarty->assign ( "individu", $dataIndiv );
		/*
		 * Lecture des types de lumiere
		 */
		$lumieretype = new LumiereType ( $bdd, $ObjetBDDParam );
		$smarty->assign ( "lumieretype", $lumieretype->getListe () );
		$data = dataRead ( $dataClass, $id, "gestion/photoChange.tpl", $piece_id );
		$data = $_SESSION ["it_photo"]->translateRow ( $data );
		$data = $_SESSION ["it_piece"]->translateRow ( $data );
		$smarty->assign ( "data", $data );
		break;
	case "write":
		/*
		 * write record in database
		 */
		/*
		 * On recherche si une photo a ete telechargee
		 */
		if ($_FILES ["photoload"] ["size"] > 10) {
			$_REQUEST ["photoload"] = fread ( fopen ( $_FILES ["photoload"] ["tmp_name"], "r" ), $_FILES ["photoload"] ["size"] );
			$_REQUEST ["photo_filename"] = $_FILES ["photoload"] ["name"];
		}
		$_REQUEST ["photo_id"] = $_SESSION ["it_photo"]->getValue ( $_REQUEST ["photo_id"] );
		$_REQUEST ["piece_id"] = $_SESSION ["it_piece"]->getValue ( $_REQUEST ["piece_id"] );
		$id = dataWrite ( $dataClass, $_REQUEST );
		if ($id > 0)
			$_REQUEST ["photo_id"] = $_SESSION ["it_photo"]->setValue ( $id );
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete ( $dataClass, $id );
		break;
	case "getPhoto":
		/*
		 * Affiche le contenu d'une photo
		 */
		if (! isset ( $_REQUEST ["sizeX"] ))
			$_REQUEST ["sizeX"] = 0;
		if (! isset ( $_REQUEST ["sizeY"] ))
			$_REQUEST ["sizeY"] = 0;
		echo $dataClass->getPhoto ( $id, 0, $_REQUEST ["sizeX"], $_REQUEST ["sizeY"] );
		break;
	case "getThumbnail":
		/*
		 * Affiche le contenu de la vignette
		 */
		if (! isset ( $_REQUEST ["sizeX"] ))
			$_REQUEST ["sizeX"] = 0;
		if (! isset ( $_REQUEST ["sizeY"] ))
			$_REQUEST ["sizeY"] = 0;
		header ( "Content-Type: image/jpeg" );
		echo $dataClass->getPhoto ( $id, 1, $_REQUEST ["sizeX"], $_REQUEST ["sizeY"] );
		break;
	case "photoDisplay":
		/*
		 * Affiche a l'ecran la photo en pleine resolution
		 */
		$smarty->assign ( "photo_id", $id );
		$smarty->assign ( "photoPath", $dataClass->writeFilePhoto ( $id ) );
		$smarty->assign ( "corps", "gestion/photoDisplayPhoto.tpl" );
		break;
}
?>