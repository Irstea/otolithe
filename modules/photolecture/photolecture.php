<?php
include_once 'modules/example/example.class.php';
$dataClass = new Photolecture ( $bdd, $ObjetBDDParam );
$id = $_REQUEST ["photolecture_id"];

switch ($t_module ["param"]) {
	case "list":
		/*
		 * Display the list of all records of the table
		 */
		$smarty->assign ( "data", $dataClass->getListe () );
		$smarty->assign ( "corps", "example/exampleList.tpl" );
		break;
	case "display":
		/*
		 * Display the detail of the record
		 */
		$data = $dataClass->lire ( $id );
		$smarty->assign ( "data", $data );
		$smarty->assign ( "corps", "example/exampleDisplay.tpl" );
		break;
	case "change":
		/*
		 * open the form to modify the record
		 * If is a new record, generate a new record with default value :
		 * $_REQUEST["idParent"] contains the identifiant of the parent record
		 */
		/*
		 * Recuperation du lecteur
		 */
		$lecteur = new Lecteur ( $bdd, $ObjetBDDParam );
		$lecteur_id = $lecteur->getIdFromLogin ( $_SESSION ["login"] );
		if ($lecteur_id > 0) {
			if ($id > 0) {
				/*
				 * On verifie que le lecteur est celui qui a precedemment fait la lecture
				 */
				$data = $dataClass->lire ( $id );
				if ($data ["lecteur_id"] != $lecteur_id) {
					$message = "Vous n'êtes pas le lecteur initial : vous ne pouvez modifier cette lecture";
					$module_coderetour = - 1;
				}
			}
		} else {
			$module_coderetour = - 1;
			$message = "Vous ne disposez pas des droits nécessaires pour réaliser une lecture";
		}		
		if ($module_coderetour != - 1) {
			$data = dataRead ( $dataClass, $id, "photolecture/photolectureChange.tpl", $_REQUEST ["photo_id"] );
			/*
			 * Lecture des informations concernant la photo
			 */
			$photo = new Photo($bdd, $ObjetBDDParam);
			$dataPhoto = $photo->getDetail($_REQUEST["photo_id"]);
			/*
			 * Recuperation de la taille de l'image
			 */
			if ($_REQUEST["resolution"] == 2) {
				$image_width = 1024;
				$image_height = 768;
			}elseif ($_REQUEST["resolution"] == 3) {
				$image_width = 1280;
				$image_height = 1024;
			}else {
				$image_width = 800;
				$image_height = 600;
			}
			/*
			 * Calcul du coefficient de correction
			*/
			$coefx = $dataPhoto["photo_width"] / $image_width;
			$coefy = $dataPhoto["photo_height"] / $image_height;
			if ($coefx > $coefy) $coef = $coefy ;else $coef = $coefx;
			$image_width =  floor($dataPhoto["photo_width"] / $coef);
			$image_height = floor($dataPhoto["photo_height"] / $coef);
			
			$smarty->assign("image_width", $image_width);
			$smarty->assign("image_height", $image_height);
			/*
			 * Calcul du coefficient de correction
			 */
		
			$smarty->assign("coef_correcteur", $coef);
			$smarty->assign("photo", $dataPhoto);
		}
		break;
	case "write":
		/*
		 * write record in database
		 */
		print_r($_REQUEST);
		break;
		//$id = dataWrite ( $dataClass, $_REQUEST );
		//if ($id > 0) $_REQUEST["id"] = $id;
		//break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete ( $dataClass, $id );
		break;
}
?>