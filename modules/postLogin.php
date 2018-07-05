<?php
/**
 * @author Eric Quinton
 * @copyright Copyright (c) 2014, IRSTEA / Eric Quinton
 * @license http://www.cecill.info/licences/Licence_CeCILL-C_V1-fr.html LICENCE DE LOGICIEL LIBRE CeCILL-C
 *  Creation 7 avr. 2014
 *  Programme execute si necessaire apres identification
 */
/*
 * Suppression des anciennes photos
 */
include "gestion/photoDeleteFile.php";
/*
 * Recherche de l'existence du login dans la table des lecteurs
 */
include_once 'modules/classes/photo.class.php';
$lecteur = new Lecteur ( $bdd, $ObjetBDDParam );
$lecteur_id = $lecteur->getIdFromLogin ( $_SESSION ['login'] );
if ($lecteur_id > 0) {
	$_SESSION ["droits"] ["lecture"] = 1;
	$vue->set( $_SESSION["droits"], "droits");
	
	/*
	 * Recuperation des experimentations autorisees
	 */
	require_once 'modules/classes/individu.class.php';
	$experimentation = new Experimentation ( $bdd, $ObjetBDDParam );
	$_SESSION ["experimentations"] = $experimentation->getExpAutorisees ( $lecteur_id );
}
?>