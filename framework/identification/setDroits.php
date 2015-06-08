<?php
/**
 * Definit les droits si le login est connu
 */
if (isset ( $_SESSION ["login"] )) {	
	require_once 'framework/droits/droits.class.php';
	$acllogin = new Acllogin ( $bdd_gacl, $ObjetBDDParam );
	$_SESSION ["droits"] = $acllogin->getListDroits ( $_SESSION ["login"], $GACL_aco );
        /*
         * Recherche de l'existence du login dans la table des lecteurs
         */
        include_once 'modules/classes/photo.class.php';
        $lecteur = new Lecteur($bdd, $ObjetBDDParam);
        $lecteur_id = $lecteur->getIdFromLogin($_SESSION['login']);
        if ($lecteur_id > 0 ) $_SESSION["droits"]["lecture"] = 1;
        $smarty->assign("droits",$_SESSION ["droits"]);
}
?>