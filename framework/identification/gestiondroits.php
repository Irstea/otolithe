<?php
/*
 * Enregistrement de l'acces au module de gestion des droits
 */
$log -> setLog($_SESSION["login"], "gacl");
header("Location: plugins/phpgacl/admin/index.php");
die;
?>