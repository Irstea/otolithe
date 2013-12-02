<?php
include_once 'modules/classes/individu.class.php';
$dataClass = new Individu($bdd,$ObjetBDDParam);
$id = $_REQUEST["individu_id"];

switch ($t_module["param"]) {
	case "list":
		/*
		 * Display the list of all records of the table
		 */
		/*
		 * Mise a jour du module d'affichage de la liste
		*/
		$_SESSION["moduleListe"]="individuList";
		/*
		 * Gestion des criteres de recherche
		*/
		$searchIndividu->setParam ( $_REQUEST );
		$dataRecherche = $searchIndividu->getParam ();
		if ($searchIndividu->isSearch () == 1) {
			$data = $dataClass->getListSearch ( $dataRecherche );
			$smarty->assign ( "data", $data );
			$smarty->assign ("isSearch", 1);
		}
		$sexe = new Sexe($bdd, $ObjetBDDParam);
		$smarty->assign("sexe", $sexe->getListe());
		/*
		 * Recherche des zones de peche
		 */
		include_once "modules/classes/peche.class.php";
		$peche = new Peche($bdd, $ObjetBDDParam);
		$smarty->assign("site",$peche->getListeSite());
		$smarty->assign("zone",$peche->getListeZone());
		$smarty->assign ("individuSearch", $dataRecherche);
		/*
		 * Recherche des experimentations
		 */
		$experimentation = new Experimentation($bdd, $ObjetBDDparam);
		$smarty->assign("experimentation", $experimentation->getListe());
		/*
		 * Affectation du nom du module pour le cartouche de recherche
		 */
		$smarty->assign("modulePostSearch", "individuList");
		$smarty->assign("data", $data);
		$smarty->assign("corps", "gestion/individuListe.tpl");
		break;
	case "display":
		/*
		 * Display the detail of the record
		 */
		$data = $dataClass->getDetail($id);
		$smarty->assign("data", $data);
		/*
		 * Lecture des experimentations
		 */
		$individu_experimentation = new Individu_experimentation($bdd, $ObjetBDDParam);
		$smarty->assign("experimentation", $individu_experimentation->getListeFromIndividu($id));
		
		/*
		 * Lecture des pieces
		 */
		include_once 'modules/classes/piece.class.php';
		$piece = new Piece($bdd, $ObjetBDDParam);
		$smarty->assign("piece", $piece->getListFromIndividu($id));
		/*
		 * Lecture des donnees sur la peche
		 */
		include_once 'modules/classes/peche.class.php';
		$peche = new Peche($bdd, $ObjetBDDParam);
		$smarty->assign("peche", $peche->lire($data["peche_id"]));
		$physicochimie = new Physicochimie($bdd, $ObjetBDDParam);
		$smarty->assign("pc",$physicochimie->getByIdpeche($data["peche_id"]));
		$smarty->assign("corps", "gestion/individuDisplay.tpl");
		break;
	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		dataRead($dataClass, $id, "example/exampleChange.tpl", $_REQUEST["idParent"]);
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