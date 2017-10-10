<?php
/**
 * Import massif d'echantillons ou de containers
 * et creation des mouvements afferents
 * Created : 18 août 2016
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2016 - All rights reserved
 */
require_once 'modules/classes/import.class.php';
require_once 'modules/classes/individu.class.php';
require_once 'modules/classes/piece.class.php';
/*
 * Initialisations
 */
$import = new Import ();
$piecetype = new Piecetype( $bdd, $ObjetBDDParam );
$espece = new Espece( $bdd, $ObjetBDDParam );
$individu = new Individu( $bdd, $ObjetBDDParam );
$piece = new  Piece( $bdd, $ObjetBDDParam );
$peche = new Peche($bdd, $ObjetBDDParam);
$ie = new Individu_experimentation($bdd, $ObjetBDDParam);

$import->initClasses ( $individu, $piece, $ie );
$import->initControl ( $_SESSION ["experimentations"], $piecetype->getList(), $espece->getList());
/*
 * Traitement
 */
$smarty->assign("corps", "gestion/import.tpl" );
switch ($t_module ["param"]) {
	case "change":
		/*
		 * Affichage du masque de selection du fichier a importer
		 */
		break;
	
	case "control" :
		/*
		 * Lancement des controles
		 */
		unset ( $_SESSION ["filename"] );
		if (file_exists ( $_FILES ['upfile'] ['tmp_name'] )) {
			/*
			 * Lancement du controle
			 */
			try {
				$import->initFile ( $_FILES ['upfile'] ['tmp_name'], $_REQUEST ["separator"], $_REQUEST ["utf8_encode"] );
				$resultat = $import->controlAll ();
				if (count ( $resultat ) > 0) {
					/*
					 * Erreurs decouvertes
					 */
					$smarty->assign( "erreur" ,1 );
					$smarty->assign("erreurs" ,  $resultat);
				} else {
					/*
					 * Deplacement du fichier dans le dossier temporaire
					 */
					$filename = $APPLI_photoStockage . '/' . bin2hex ( openssl_random_pseudo_bytes ( 4 ) );
					if (! copy ( $_FILES ['upfile'] ['tmp_name'], $filename )) {
						$message.=  "Impossible de recopier le fichier importé dans le dossier temporaire<br>";
					} else {
						$_SESSION ["filename"] = $filename;
						$_SESSION ["separator"] = $_REQUEST ["separator"];
						$_SESSION ["utf8_encode"] = $_REQUEST ["utf8_encode"];
						$smarty->assign("controleOk" ,1 );
						$smarty->assign( "filename",$_FILES['upfile']['name'] );
					}
				}
			} catch ( Exception $e ) {
				$message.=  $e->getMessage ();
			}
		}
		$import->fileClose();
		$module_coderetour = 1;
		$smarty->assign("separator" , $_REQUEST ["separator"]);
		$smarty->assign( "utf8_encode",$_REQUEST ["utf8_encode"] );
		break;
	case "import" :
		if (isset ( $_SESSION ["filename"] )) {
			if (file_exists ( $_SESSION ["filename"] )) {
				try {
					$import->initFile ( $_SESSION ["filename"], $_SESSION["separator"], $_SESSION["utf8_encode"] );
					$import->importAll();
					$message .=  "Import effectué. ". $import->nbTreated . " lignes traitées<br>";
					$message .= "Premier id généré : ".$import->minuid."<br>";
					$message.= "Dernier id généré : ". $import->maxuid."<br>";
					$module_coderetour = 1;
				} catch ( Exception $e ) {
					$message.=  $e->getMessage ();
				}
			}
		}
		unset ( $_SESSION ["filename"] );
		break;
}

?>