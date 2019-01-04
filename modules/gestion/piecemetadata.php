<?php
include_once 'modules/classes/piecemetadata.class.php';
$dataClass = new Piecemetadata($bdd, $ObjetBDDParam);
$id = $_SESSION["it_piecemetadata"]->getValue($_REQUEST["piecemetadata_id"]);
$piece_id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
switch ($t_module["param"]) {
    case "display":

        break;
    case "change":
        $data = dataRead($dataClass, $id, "gestion/piecemetadataChange.tpl", $piece_id);
        $data = $_SESSION["it_piece"]->translateRow($data);
        $data = $_SESSION["it_individu"]->translateRow($data);
        $data = $_SESSION["it_piecemetadata"]->translateRow($data);
        $vue->set($data, "data");
        /** Recuperation des donnees des objets precedents */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($bdd, $ObjetBDDParam);
        $dpiece = $piece->getDetail($piece_id);
        $vue->set($_SESSION["it_piece"]->translateRow($dpiece), "piece");
        include_once 'modules/classes/individu.class.php';
        $individu = new Individu($bdd, $ObjetBDDParam);
        $vue->set($_SESSION["it_individu"]->translateRow($individu->getDetail($dpiece["individu_id"])), "individu");
        /** Liste des types de metadonnees disponibles */
        include_once 'modules/classes/metadatatype.class.php';
        $mdt = new Metadatatype($bdd, $ObjetBDDParam);
        $vue->set($mdt->getListe(), "metadatatypes");
        break;
    case "write":
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
        $_REQUEST["piecemetadata_id"] = $id;
        $id = dataWrite($dataClass, $_REQUEST);
        if ($id > 0) {
            $_REQUEST["piecemetadata_id"] = $_SESSION["it_piecemetadata"]->setValue($id);
        }
        $_REQUEST["piece_id"] = $_SESSION["it_piece"]->setValue($_REQUEST["piece_id"]);
        break;
    case "delete":
        /*
         * delete record
         */
        dataDelete($dataClass, $id);
        break;
}
?>