<?php
include_once 'modules/classes/photo.class.php';
$dataClass = new Photolecture ( $bdd, $ObjetBDDParam );
$id = $_REQUEST ["photolecture_id"];

switch ($t_module ["param"]) {
	case "display":
		/*
		 * Affiche les lectures effectuees
		 */
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
		$smarty->assign("coef_correcteur", $coef);
		/*
		 * Generation de la photo dans le dossier temporaire, et du lien associe
		 */
		$dataPhoto["photoPath"] = $photo->writeFilePhoto($dataPhoto["photo_id"],0, $image_width, $image_height);
		/*
		 * Recuperation des lectures effectuees
		 */
		$data = $dataClass->getDetailLecture($id, $coef);
		$smarty->assign("data", $data);
		include_once 'modules/classes/piece.class.php';
		/*
		 * Lecture des informations concernant la piece et le poisson
		*/
		include_once 'modules/classes/piece.class.php';
		$piece = new Piece($bdd, $ObjetBDDParam);
		$dataPiece = $piece->getDetail($dataPhoto["piece_id"]);
		$smarty->assign("piece", $dataPiece);
		include_once 'modules/classes/individu.class.php';
		$individu = new Individu($bdd, $ObjetBDDParam);
		$smarty->assign("individu", $individu->getDetail($dataPiece["individu_id"]));
		/*
		 * Assignations finales
		 */
		$smarty->assign("photo", $dataPhoto);
		$smarty->assign ( "corps", "photolecture/photolectureDisplay.tpl" );
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
			 * Rajout de l'identifiant du lecteur
			 */
			if (! $data["lecteur_id"]>0) {
				$data["lecteur_id"] = $lecteur_id;
			}
			/*
			 * Lecture des informations concernant la photo
			 */
			$photo = new Photo($bdd, $ObjetBDDParam);
			$dataPhoto = $photo->getDetail($_REQUEST["photo_id"]);
			/*
			 * Lecture des informations concernant la piece et le poisson
			 */
			include_once 'modules/classes/piece.class.php';
			$piece = new Piece($bdd, $ObjetBDDParam);
			$dataPiece = $piece->getDetail($dataPhoto["piece_id"]);
			$smarty->assign("piece", $dataPiece);
			include_once 'modules/classes/individu.class.php';
			$individu = new Individu($bdd, $ObjetBDDParam);
			$smarty->assign("individu", $individu->getDetail($dataPiece["individu_id"]));
			/*
			 * Recuperation de la taille de l'image
			 */
			if ($data["photolecture_id"] == 0) {
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
			} else {
			$image_width = $data["photolecture_width"];
			$image_height = $data["photolecture_height"];
			/*
			 * Gestion des anomalies
			 */
			if (! $image_width > 0 && $image_height > 0) {
				$image_width = 800;
				$image_height = 600;
			}
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
			/*
			 * Calcul des points pour reaffichage en mode saisie
			 */
			if ($data["photolecture_id"] > 0) {
				$dataPoint = $dataClass->lirePoints($data["photolecture_id"]);
				if (strlen($dataPoint["points"]) > 0) 
					$data["points"] = $dataClass->calculPointsAffichage($dataPoint["points"], $coef);
				if (strlen($dataPoint["points_ref_lecture"])>0)
					$data["points_ref_lecture"] = $dataClass->calculPointsAffichage($dataPoint["points_ref_lecture"], $coef);
				/*
				 * Recalcul du rayon d'affichage du premier point
				 */
				$data["rayon_point_initial"] = floor($data["rayon_point_initial"] / $coef);
			}
			/*
			 * Reecriture de data dans smarty
			*/
			$smarty->assign("data", $data);
			/*
			 * Generation de la photo dans le dossier temporaire, et du lien associe
			*/
			$dataPhoto["photoPath"] = $photo->writeFilePhoto($dataPhoto["photo_id"],0, $image_width, $image_height);
			$smarty->assign("photo", $dataPhoto);
		}
		break;
	case "write":
		/*
		 * write record in database
		 */
		//print_r($_REQUEST);
		//break;
		$id = dataWrite ( $dataClass, $_REQUEST );
		if ($id > 0) $_REQUEST["id"] = $id;
		break;
	case "delete":
		/*
		 * delete record
		 */
		dataDelete ( $dataClass, $id );
		break;
	case "list":
		/*
		 * Lance la recherche des lectures effectuees
		 */
		/*
		 * Mise a jour du module d'affichage de la liste
		 */
		$_SESSION["moduleListe"]="photolectureList";
		/*
		 * Gestion des criteres de recherche
		*/
		$searchLecture->setParam ( $_REQUEST );
		if ($searchLecture->isSearch () == 1) {
			$dataRecherche = $searchLecture->getParam();
			$data = $dataClass->getListSearch ( $dataRecherche );
			$smarty->assign ( "data", $data );
			$smarty->assign ("isSearch", 1);
		}
		$smarty->assign("lectureSearch", $dataRecherche);
		/*
		 * Recuperation de l'ensemble des informations necessaires pour la recherche
		 */
		include_once "modules/classes/peche.class.php";
		$peche = new Peche($bdd, $ObjetBDDParam);
		$smarty->assign("site",$peche->getListeSite());
		$smarty->assign("zone",$peche->getListeZone());
		include_once 'modules/classes/individu.class.php';
		$experimentation = new Experimentation($bdd, $ObjetBDDparam);
		$smarty->assign("experimentation", $experimentation->getListe());
		$lecteur = new Lecteur($bdd, $ObjetBDDParam);
		$smarty->assign("lecteur", $lecteur->getListe());
		/*
		 * Affichage
		 */
		$smarty->assign("modulePostSearch", "photolectureList");
		$smarty->assign("corps", "photolecture/photolectureList.tpl");

		break;
	case "export":
		/*
		 * Creation d'un fichier au format csv pour exporter les lectures selectionnees
		 */
		/*
		 * Recuperation des parametres de recherche
		 */
		if ($searchLecture->isSearch () == 1) {
			$dataRecherche = $searchLecture->getParam();
			$data = $dataClass->getListSearch ( $dataRecherche );
			if (count($data) > 0) {
			/*
			 * Recuperation de la classe permettant l'export
			 */
			include_once 'modules/classes/importDataFile.class.php';
			$export = new ImportDataFile();
			$nomfichier = "lecture";
			$export->exportCSVinit($nomfichier, 'tab');
			$entete=array();
			/*
			 * Preparation de l'entete
			*/
			foreach ($data[0] as $key=>$value) {
				if($key != "points" && $key != "points_ref_lecture")
					$entete[] = $key;
			}
			/*
			 * Traitement des lignes - on rajoute les coordonnees des points
			 */
			$nbPoint = 0;
			foreach ($data as $key => $value) {
				if  (strlen($value["points"]) > 0) 
					$dataPoints["points"] = $dataClass->calculPointsAffichage($value["points"], 1);
				
				/*
				 * On rajoute les points a la suite
				 */
				$i=0;
				foreach($dataPoints["points"] as $key1=>$value1) {
					$data[$key]["pointX".$i] = $value1["x"];
					$data[$key]["pointY".$i] = $value1["y"];
					if ($i>0) {
						/*
						 * Rajout de la distance au point precedent
						 */
						$data[$key]["dist-".($i - 1) . "-" .$i] = $dataClass->calculDistance($x1, $y1, $value1["x"], $value1["y"]);
					}
					$x1 = $value1["x"];
					$y1 = $value1["y"];
					$i++;
					
				}
				if ($i > $nbPoint) $nbPoint = $i;
				/*
				 * Suppression des champs MULTIPOINTS
				 */
				unset ($data[$key]["points"]);
				unset ($data[$key]["points_ref_lecture"]);
			}
			/*
			 * On rajoute a l'entete les colonnes manquantes
			 */
			for ($i=0 ; $i <$nbPoint;$i++) {
				$entete[] = "pointX".$i;
				$entete[] = "pointY".$i;
				if ($i > 0) {
					$entete[] = "dist".($i - 1) . "-" .$i;
				}
			}
			/*
			 * Ecriture de l'entete
			 */
			$export->setLigneCSV($entete);
			/*
			 * Ecriture des donnees
			 */
			$export->setTableau($data);
			/*
			 * Envoi du fichier
			 */
			$export->exportCSV();
			}
			
		}
		break;
}
?>