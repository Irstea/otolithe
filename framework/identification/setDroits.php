<?php
/**
 * Definit les droits si le login est connu
 */
if(isset($_SESSION["login"])) {
	include_once ("plugins/phpgacl/gacl.class.php");
	$phpgacl = new gacl();
	$gestionDroit->setgacl($phpgacl, $GACL_aco, $GACL_aro, $GACL_listeDroitsGeres);
	/*
	 * Recherche de l'existence du login dans la table des lecteurs
	 */
	include_once 'modules/classes/photo.class.php';
	$lecteur = new Lecteur($bdd, $ObjetBDDParam);
	$lecteur_id = $lecteur->getIdFromLogin($_SESSION['login']);
	if ($lecteur_id > 0 ) $gestionDroit->droits["lecture"] = 1;
	$smarty->assign("droits",$gestionDroit->getDroits());
}
?>