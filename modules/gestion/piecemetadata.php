<?php
include_once 'modules/classes/piecemetadata.class.php';
$dataClass = new Piecemetadata($bdd, $ObjetBDDParam);
$id = $_SESSION["it_piecemetadata"]->getValue($_REQUEST["piecemetadata_id"]);
$piece_id = $_SESSION["it_piece"]->getValue($_REQUEST["piece_id"]);
switch ($t_module["param"]) {
    case "display":

        break;
    case "change":

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