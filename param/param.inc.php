<?php
/** Fichier cree le 4 mai 07 par quinton
*
*UTF-8
*/

$APPLI_modeDeveloppement = true;
$ERROR_display=1;
$ERROR_level = E_ERROR ;
$ADODB_debugmode = 0;
$OBJETBDD_debugmode = 1;
$APPLI_utf8 = true;


$ident_type = "LDAP";

$BDD_type = "postgres7";
$BDD_server = "guzzi";
$BDD_login = "otolithe";
$BDD_passwd = "aic1Saewii";
$BDD_database = "thalassotoque";

$BDDDEV_type = "postgres7";
$BDDDEV_server = "guzzi";
$BDDDEV_login = "otolithe";
$BDDDEV_passwd = "aic1Saewii";
$BDDDEV_database = "thalassotoque";

$GACL_dbtype = "postgres7";
$GACL_dbserver = "guzzi";
$GACL_dblogin = "thalassotoque_gacl";
$GACL_dbpasswd = "eng4iech2I";
$GACL_database = "thalassotoque";

$APPLI_address = "http://guzzi/otolithe";
$APPLI_mail = "eric.quinton@irstea.fr";
$APPLI_nom = "otolithe";
$APPLI_code = 'otolithe';

$LDAPGROUP_address = "ldaps://ldap.irstea.fr";
$LDAPGROUP_attributnomgroupe = "cn";
$LDAPGROUP_attributnomlogin = "memberuid";
$LDAPGROUP_basedngroup = "dc=irstea,dc=fr";
$LDAP_address = "ldaps://ldap.irstea.fr";
$LDAP_port = 636;
$LDAP_basedn = "ou=people,dc=irstea,dc=fr";
$LDAP_tls = true;

?>
