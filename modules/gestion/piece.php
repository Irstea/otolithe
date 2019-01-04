<?php
include_once 'modules/classes/piece.class.php';
$dataClass = new Piece($bdd, $ObjetBDDParam);
$id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);

switch ($t_module["param"]) {
    case "display":
		/*
         * Display the detail of the record
         */
        $data = $dataClass->getDetail($id);
        $dataT = $_SESSION["it_piece"]->translateRow($data);
        $dataT = $_SESSION["it_individu"]->translateRow($dataT);
        $vue->set($dataT, "data");

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
        $vue->set($dataIndiv, "individu");
        $listePhoto = $photo->getListePhotoFromPiece($id);

        include_once 'modules/classes/piecemetadata.class.php';
        $pm = new Piecemetadata($bdd, $ObjetBDDParam);
        try {
            $metadatas = $pm->getListFromPiece($id);
            $metadatas = $_SESSION["it_piece"]->translateList($metadatas);
            $vue->set($_SESSION["it_piecemetadata"]->translateList($metadatas), "metadatas");
            
        } catch (Exception $e) {
            $message->set(_("Problème lors de la lecture des métadonnées rattachées à la pièce"), true);
            $message->setSyslog($e->getMessage());
        }
        /*
         * Rajout du lien vers l'image
         */
        foreach ($listePhoto as $key => $value) {
            $listePhoto[$key]["photoPath"] = $photo->writeFilePhoto($value["photo_id"], 1);
        }
        $vue->set($_SESSION["it_photo"]->translateList($listePhoto), "photo");
        $vue->set("gestion/pieceDisplay.tpl", "corps");

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
        $vue->set($traitementpiece->getListe(), "traitementpiece");
        $piecetype = new Piecetype($bdd, $ObjetBDDParam);
        $vue->set($piecetype->getListe(), "piecetype");

        /*
         * Lecture du poisson
         */
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
        $dataIndiv = $individu->getDetail($_REQUEST["individu_id"]);
        $dataIndiv = $_SESSION["it_individu"]->translateRow($dataIndiv);
        $dataIndiv = $_SESSION["it_peche"]->translateRow($dataIndiv);
        $vue->set($dataIndiv, "individu");
        $data = dataRead($dataClass, $id, "gestion/pieceChange.tpl", $_REQUEST["individu_id"]);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $vue->set($data, "data");
        break;
    case "write":
		/*
         * write record in database
         */
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $_REQUEST["individu_id"] = $_SESSION["it_individu"]->getValue($_REQUEST["individu_id"]);
        $id = dataWrite($dataClass, $_REQUEST);
        if ($id > 0) {
            $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($id);
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