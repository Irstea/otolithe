<?php
include_once 'modules/classes/photo.class.php';
$dataClass = new Photolecture ( $bdd, $ObjetBDDParam );
if (is_array ( $_REQUEST ["photolecture_id"] )) {
	foreach ( $_REQUEST ["photolecture_id"] as $value )
		$id [] = $_SESSION ["it_photolecture"]->getValue ( $value );
} else
	$id = $_SESSION ["it_photolecture"]->getValue ( $_REQUEST ["photolecture_id"] );

switch ($t_module ["param"]) {
	case "display":
		/*
		 * Affiche les lectures effectuees
		 */
		/*
		 * Lecture des informations concernant la photo
		*/
		$photo = new Photo ( $bdd, $ObjetBDDParam );
		$dataPhoto = $photo->getDetail ( $_SESSION ["it_photo"]->getValue ( $_REQUEST ["photo_id"] ) );
		/*
		 * Recuperation de la taille de l'image
		 */
		switch ($_REQUEST ["resolution"]) {
			case 2 :
				$image_width = 1024;
				$image_height = 768;
				break;
			case 3 :
				$image_width = 1280;
				$image_height = 1024;
				break;
			case 4 :
				$image_width = 1600;
				$image_height = 1300;
				break;
			case 5 :
				$image_width = 10000;
				$image_height = 10000;
				break;
			default :
				$image_width = 800;
				$image_height = 600;
		}
		
		/*
		 * Calcul du coefficient de correction
		 */
		$coefx = $dataPhoto ["photo_width"] / $image_width;
		$coefy = $dataPhoto ["photo_height"] / $image_height;
		if ($coefx > $coefy)
			$coef = $coefy;
		else
			$coef = $coefx;
		$image_width = floor ( $dataPhoto ["photo_width"] / $coef );
		$image_height = floor ( $dataPhoto ["photo_height"] / $coef );
		$smarty->assign ( "image_width", $image_width );
		$smarty->assign ( "image_height", $image_height );
		$smarty->assign ( "coef_correcteur", $coef );
		/*
		 * Generation de la photo dans le dossier temporaire, et du lien associe
		 */
		$dataPhoto ["photoPath"] = $photo->writeFilePhoto ( $dataPhoto ["photo_id"], 0, $image_width, $image_height );
		/*
		 * Recuperation des lectures effectuees
		 */
		$data = $dataClass->getDetailLecture ( $id, $coef );
		$data = $_SESSION ["it_photolecture"]->translateList ( $data );
		$data = $_SESSION ["it_photo"]->translateList ( $data );
		$smarty->assign ( "data", $data );
		include_once 'modules/classes/piece.class.php';
		/*
		 * Lecture des informations concernant la piece et le poisson
		 */
		include_once 'modules/classes/piece.class.php';
		$piece = new Piece ( $bdd, $ObjetBDDParam );
		$dataPiece = $piece->getDetail ( $dataPhoto ["piece_id"] );
		$dataPieceT = $_SESSION ["it_piece"]->translateRow ( $dataPiece );
		$dataPieceT = $_SESSION ["it_individu"]->translateRow ( $dataPieceT );
		$smarty->assign ( "piece", $dataPieceT );
		include_once 'modules/classes/individu.class.php';
		$individu = new Individu ( $bdd, $ObjetBDDParam );
		$dataIndiv = $individu->getDetail ( $dataPiece ["individu_id"] );
		$dataIndiv = $_SESSION ["it_individu"]->translateRow ( $dataIndiv );
		$dataIndiv = $_SESSION ["it_peche"]->translateRow ( $dataIndiv );
		$smarty->assign ( "individu", $dataIndiv );
		/*
		 * Assignation du coefficient de transparence
		 */
		if (! isset ( $_REQUEST ["fill"] ))
			$_REQUEST ["fill"] = 0;
		$smarty->assign ( "fill", $_REQUEST ["fill"] );
		/*
		 * Assignations finales
		 */
		$dataPhoto = $_SESSION ["it_photo"]->translateRow ( $dataPhoto );
		$dataPhoto = $_SESSION ["it_piece"]->translateRow ( $dataPhoto );
		$smarty->assign ( "photo", $dataPhoto );
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
		/*
		 * Traitement du cas ou les mesures precedentes sont affichees
		 * $id contient le tableau des lectures a afficher, $photolecture_id_modif la lecture a modifier
		 */
		if (isset ( $_REQUEST ["photolecture_id_modif"] )) {
			$mesurePrecId = $id;
			$id = $_SESSION ["it_photolecture"]->getValue ( $_REQUEST ["photolecture_id_modif"] );
		}
		$data = $dataClass->getDetailLecture ( $id, $coef );
		$dataT = $_SESSION ["it_photolecture"]->translateRow ( $data );
		$dataT = $_SESSION ["it_photo"]->translateRow ( $dataT );
		$smarty->assign ( "data", $dataT );
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
			$data = dataRead ( $dataClass, $id, "photolecture/photolectureChange.tpl", $_SESSION ["it_photo"]->getValue ( $_REQUEST ["photo_id"] ) );
			/*
			 * Rajout de l'identifiant du lecteur
			 */
			if (! $data ["lecteur_id"] > 0) {
				$data ["lecteur_id"] = $lecteur_id;
			}
			/*
			 * Lecture des informations concernant la photo
			 */
			$photo = new Photo ( $bdd, $ObjetBDDParam );
			$dataPhoto = $photo->getDetail ( $_SESSION ["it_photo"]->getValue ( $_REQUEST ["photo_id"] ) );
			/*
			 * Lecture des informations concernant la piece et le poisson
			 */
			include_once 'modules/classes/piece.class.php';
			$piece = new Piece ( $bdd, $ObjetBDDParam );
			$dataPiece = $piece->getDetail ( $dataPhoto ["piece_id"] );
			$dataPieceT = $_SESSION ["it_piece"]->translateRow ( $dataPiece );
			$dataPieceT = $_SESSION ["it_individu"]->translateRow ( $dataPieceT );
			$smarty->assign ( "piece", $dataPieceT );
			include_once 'modules/classes/individu.class.php';
			$individu = new Individu ( $bdd, $ObjetBDDParam );
			$dataIndiv = $individu->getDetail ( $dataPiece ["individu_id"] );
			$dataIndiv = $_SESSION ["it_individu"]->translateRow ( $dataIndiv );
			$dataIndiv = $_SESSION ["it_peche"]->translateRow ( $dataIndiv );
			$smarty->assign ( "individu", $dataIndiv );
			/*
			 * Recuperation de la taille de l'image
			 */
			if ($data ["photolecture_id"] == 0) {
				switch ($_REQUEST ["resolution"]) {
					case 2 :
						$image_width = 1024;
						$image_height = 768;
						break;
					case 3 :
						$image_width = 1280;
						$image_height = 1024;
						break;
					case 4 :
						$image_width = 1600;
						$image_height = 1300;
						break;
					case 5 :
						$image_width = 10000;
						$image_height = 10000;
						break;
					default :
						$image_width = 800;
						$image_height = 600;
				}
			} else {
				$image_width = $data ["photolecture_width"];
				$image_height = $data ["photolecture_height"];
				/*
				 * Gestion des anomalies
				 */
				if (! $image_width > 0 && $image_height > 0) {
					$image_width = 800;
					$image_height = 600;
				}
			}
			/*
			 * Verification qu'on ne depasse pas la resolution initiale
			 */
			if ($image_width > $dataPhoto ["photo_width"])
				$image_width = $dataPhoto ["photo_width"];
			if ($image_height > $dataPhoto ["photo_height"])
				$image_height = $dataPhoto ["photo_height"];
				/*
			 * Calcul du coefficient de correction
			 */
			$coefx = $dataPhoto ["photo_width"] / $image_width;
			$coefy = $dataPhoto ["photo_height"] / $image_height;
			if ($coefx > $coefy)
				$coef = $coefy;
			else
				$coef = $coefx;
			$image_width = floor ( $dataPhoto ["photo_width"] / $coef );
			$image_height = floor ( $dataPhoto ["photo_height"] / $coef );
			
			$smarty->assign ( "image_width", $image_width );
			$smarty->assign ( "image_height", $image_height );
			/*
			 * Recuperation des lectures precedentes
			 */
			if (isset ( $mesurePrecId )) {
				$mesurePrec = $dataClass->getDetailLecture ( $mesurePrecId, $coef, $id );
				$smarty->assign ( "mesurePrec", $mesurePrec );
			}
			$smarty->assign ( "coef_correcteur", $coef );
			/*
			 * Calcul des points pour reaffichage en mode saisie
			 */
			if ($data ["photolecture_id"] > 0) {
				$dataPoint = $dataClass->lirePoints ( $data ["photolecture_id"] );
				if (strlen ( $dataPoint ["points"] ) > 0)
					$data ["points"] = $dataClass->calculPointsAffichage ( $dataPoint ["points"], $coef );
				if (strlen ( $dataPoint ["points_ref_lecture"] ) > 0)
					$data ["points_ref_lecture"] = $dataClass->calculPointsAffichage ( $dataPoint ["points_ref_lecture"], $coef );
					/*
				 * Recalcul du rayon d'affichage du premier point
				 */
				$data ["rayon_point_initial"] = floor ( $data ["rayon_point_initial"] / $coef );
			}
			/*
			 * Reecriture de data dans smarty
			 */
			$data = $_SESSION ["it_photolecture"]->translateRow ( $data );
			$data = $_SESSION ["it_photo"]->translateRow ( $data );
			$smarty->assign ( "data", $data );
			/*
			 * Generation de la photo dans le dossier temporaire, et du lien associe
			 */
			$dataPhoto ["photoPath"] = $photo->writeFilePhoto ( $dataPhoto ["photo_id"], 0, $image_width, $image_height );
			$dataPhoto = $_SESSION ["it_photo"]->translateRow ( $dataPhoto );
			$dataPhoto = $_SESSION ["it_piece"]->translateRow ( $dataPhoto );
			$smarty->assign ( "photo", $dataPhoto );
			/*
			 * Integration du facteur de transparence
			 */
			if (! isset ( $_REQUEST ["fill"] ))
				$_REQUEST ["fill"] = 0;
			$smarty->assign ( "fill", $_REQUEST ["fill"] );
			/*
			 * Recuperation de la table des stries finales
			 */
			$finalStripe = new Final_stripe ( $bdd, $ObjetBDDParam );
			$smarty->assign ( "finalStripe", $finalStripe->getListe ( 1 ) );
		}
		break;
	case "write":
		/*
		 * write record in database
		 */
		//print_r($_REQUEST);
		//break;
		$_REQUEST ["photolecture_id"] = $_SESSION ["it_photolecture"]->getValue ( $_REQUEST ["photolecture_id"] );
		$_REQUEST ["photo_id"] = $_SESSION ["it_photo"]->getValue ( $_REQUEST ["photo_id"] );
		$id = dataWrite ( $dataClass, $_REQUEST );
		if ($id > 0)
			$_REQUEST ["photolecture_id"] = $_SESSION ["it_photolecture"]->setValue ( $id );
		$_REQUEST ["photo_id"] = $_SESSION ["it_photo"]->setValue ( $_REQUEST ["photo_id"] );
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
		$_SESSION ["moduleListe"] = "photolectureList";
		/*
		 * Gestion des criteres de recherche
		 */
		if (isset ( $_REQUEST ["exp_id"] ))
			$_REQUEST ["exp_id"] = $_SESSION ["it_experimentation"]->getValue ( $_REQUEST ["exp_id"] );
		$searchLecture->setParam ( $_REQUEST );
		if ($searchLecture->isSearch () == 1) {
			$dataRecherche = $searchLecture->getParam ();
			$data = $dataClass->getListSearch ( $dataRecherche );
			$data = $_SESSION ["it_photolecture"]->translateList ( $data );
			$data = $_SESSION ["it_photo"]->translateList ( $data );
			$data = $_SESSION ["it_individu"]->translateList ( $data );
			$data = $_SESSION ["it_piece"]->translateList ( $data );
			$smarty->assign ( "data", $data );
			$smarty->assign ( "isSearch", 1 );
		}
		$dataRecherche ["exp_id"] = $_SESSION ["it_experimentation"]->setValue ( $dataRecherche ["exp_id"] );
		$smarty->assign ( "lectureSearch", $dataRecherche );
		/*
		 * Recuperation de l'ensemble des informations necessaires pour la recherche
		 */
		include_once "modules/classes/peche.class.php";
		$peche = new Peche ( $bdd, $ObjetBDDParam );
		$smarty->assign ( "site", $peche->getListeSite () );
		$smarty->assign ( "zone", $peche->getListeZone () );
		/*
		 * Integration des experimentations
		 */
		$smarty->assign ( "experimentation", $_SESSION ["it_experimentation"]->translateList ( $_SESSION ["experimentations"] ) );
		include_once 'modules/classes/individu.class.php';
		$lecteur = new Lecteur ( $bdd, $ObjetBDDParam );
		$smarty->assign ( "lecteur", $lecteur->getListe () );
		/*
		 * Affichage
		 */
		$smarty->assign ( "modulePostSearch", "photolectureList" );
		$smarty->assign ( "corps", "photolecture/photolectureList.tpl" );
		
		break;
	case "export":
		/*
		 * Creation d'un fichier au format csv pour exporter les lectures selectionnees
		 */
		/*
		 * Recuperation des parametres de recherche
		 */
		if ($searchLecture->isSearch () == 1) {
			$dataRecherche = $searchLecture->getParam ();
			$data = $dataClass->getListSearch ( $dataRecherche );
			$data = $_SESSION ["it_photolecture"]->translateList ( $data );
			$data = $_SESSION ["it_photo"]->translateList ( $data );
			$data = $_SESSION ["it_individu"]->translateList ( $data );
			$data = $_SESSION ["it_piece"]->translateList ( $data );
			if (count ( $data ) > 0) {
				/*
				 * Recuperation de la classe permettant l'export
				 */
				include_once 'modules/classes/importDataFile.class.php';
				$export = new ImportDataFile ();
				$nomfichier = "lecture";
				$export->exportCSVinit ( $nomfichier, 'tab' );
				$entete = array ();
				/*
				 * Preparation de l'entete
				 */
				foreach ( $data [0] as $key => $value ) {
					if ($key != "points" && $key != "points_ref_lecture")
						$entete [] = $key;
				}
				/*
				 * Traitement des lignes - on rajoute les coordonnees des points
				 */
				$nbPoint = 0;
				foreach ( $data as $key => $value ) {
					if (strlen ( $value ["points"] ) > 0)
						$dataPoints ["points"] = $dataClass->calculPointsAffichage ( $value ["points"], 1 );
						
						/*
					 * On rajoute les points a la suite
					 */
					$i = 0;
					foreach ( $dataPoints ["points"] as $key1 => $value1 ) {
						$data [$key] ["pointX" . $i] = $value1 ["x"];
						$data [$key] ["pointY" . $i] = $value1 ["y"];
						if ($i > 0) {
							/*
							 * Rajout de la distance au point precedent
							 */
							$data [$key] ["dist-" . ($i - 1) . "-" . $i] = $dataClass->calculDistance ( $x1, $y1, $value1 ["x"], $value1 ["y"] );
						}
						$x1 = $value1 ["x"];
						$y1 = $value1 ["y"];
						$i ++;
					}
					if ($i > $nbPoint)
						$nbPoint = $i;
						/*
					 * Suppression des champs MULTIPOINTS
					 */
					unset ( $data [$key] ["points"] );
					unset ( $data [$key] ["points_ref_lecture"] );
				}
				/*
				 * On rajoute a l'entete les colonnes manquantes
				 */
				for($i = 0; $i < $nbPoint; $i ++) {
					$entete [] = "pointX" . $i;
					$entete [] = "pointY" . $i;
					if ($i > 0) {
						$entete [] = "dist" . ($i - 1) . "-" . $i;
					}
				}
				/*
				 * Ecriture de l'entete
				 */
				$export->setLigneCSV ( $entete );
				/*
				 * Ecriture des donnees
				 */
				$export->setTableau ( $data );
				/*
				 * Envoi du fichier
				 */
				$export->exportCSV ();
			}
		}
		break;
	case "swap":
		/*
		 * Permet de choisir le mode de visualisation : visualisation simple ou modification/creation d'une lecture
		 */
		if (isset ( $_REQUEST ["photolecture_id_modif"] )) {
			$module_coderetour = 1;
		} else {
			$module_coderetour = 0;
		}
}
?>