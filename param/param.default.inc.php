<?php

/**
 * Fichier cree le 4 mai 07 par quinton
 * UTF-8
 *
 * Parametres par defaut de l'application
 * Si des modifications doivent etre apportees, faites-les dans le fichier param.inc.php
 */
$APPLI_version = "2.2.1";
$APPLI_dbversion = "2.2";
$APPLI_versiondate = _("22/02/2019");
$language = "fr";
$DEFAULT_formatdate = "fr";
$APPLI_languageList = array("fr", "en");
/*
 * Navigation a partir du fichier xml
 */
$navigationxml = "param/actions.xml";
/*
 * Duree de la session par defaut
 * @var unknown_type
 */
// 4 heures
$APPLI_session_ttl = 14400;
// 3 mois
$APPLI_cookie_ttl = 7776000;
// 10 heures
$APPLI_absolute_session = 36000;
/*
 *
 * Nom du chemin de stockage des sessions
 * @var unknown_type
 */
$APPLI_path_stockage_session = "prototypephp";
/*
 * Duree de conservation des traces (en jours) dans la table log
 */
$LOG_duree = 365;
/*
 * Type d'identification
 *
 * BDD : mot de passe en base de donnees
 * CAS : utilisation d'un serveur CAS
 * LDAP : utilisation d'un serveur LDAP
 * LDAP-BDD : test d'abord aupres du serveur LDAP, puis du serveur BDD
 * HEADER : l'identification est fournie dans une variable HEADER (derriere un proxy comme
 * LemonLdap, par exemple)
 */
$ident_header_login_var = "AUTH_USER";
$ident_header_logout_address = "";
$ident_type = "BDD";
/* CAS parameters */
$CAS_address = "http://localhost/CAS";
$CAS_port = 443;
$CAS_CApath="";
/* LDAP parameters */
$LDAP = array(
    "address" => "localhost",
    "port" => 389,
    "rdn" => "cn=manager,dc=example,dc=com",
    "basedn" => "ou=people,ou=example,o=societe,c=fr",
    "user_attrib" => "uid",
    "v3" => true,
    "tls" => false,
    "upn_suffix" => "", //pour Active Directory
    "groupSupport" => false,
    "groupAttrib" => "supannentiteaffectation",
    "commonNameAttrib" => "displayname",
    "mailAttrib" => "mail",
    'attributgroupname' => "cn",
    'attributloginname' => "memberuid",
    'basedngroup' => 'ou=example,o=societe,c=fr'
);

/*
 * Parametres concernant la base de donnees
 */
$BDD_login = "proto";
$BDD_passwd = "proto";
$BDD_dsn = "pgsq:host=localhost;dbname=proto";
$BDD_schema = "public";
/*
 * Parametres concernant SMARTY
 */
$display = "display"; // Dossier de base contenant tout l'affichage
$SMARTY_param = array(
    "templates" => "display/templates",
    "templates_c" => "display/templates_c",
    "cache" => false,
    "cache_dir" => "display/smarty_cache",
    "template_main" => "main.htm"
);

/*
 * Variables de base de l'application
 */
$APPLI_mail = "proto@proto.com";
$APPLI_nom = "Prototype d'application";
$APPLI_code = 'proto';
$APPLI_fds = "$display/CSS/blue.css";
$APPLI_address = "http://localhost/proto";
$APPLI_modeDeveloppement = false;
$APPLI_modeDeveloppementDroit = false;
$APPLI_utf8 = true;
$APPLI_menufile = "param/menu.xml";
$APPLI_temp = "temp";
$APPLI_assist_address = "https://github.com/Irstea/otolithe/issues/new";
/*
 * Variables systematiques pour SMARTY
 */
$SMARTY_variables = array(
    "entete" => "entete.tpl",
    "enpied" => "enpied.tpl",
    "corps" => "main.tpl",
    "melappli" => $APPLI_mail,
    "ident_type" => $ident_type,
    "appliAssist" => $APPLI_assist_address,
    "display" => "/display",
    "favicon" => "/favicon.png"
);
/*
 * Variables liees a GACL et l'identification via base de donnees
 */
$GACL_dblogin = "proto";
$GACL_dbpasswd = "proto";
$GACL_aco = "col";
$GACL_dsn = "pgsql:host=localhost;dbname=proto";
$GACL_schema = "gacl";

/*
 * Gestion des erreurs
 */
$ERROR_level = E_ERROR;
/*
 * Pour le developpement :
 * $ERROR_level = E_ALL & ~E_NOTICE & E_STRICT
 * En production :
 * $ERROR_level = E_ERROR ;
 */
$ERROR_display = 0;
$ADODB_debugmode = 0;
$OBJETBDD_debugmode = 1;
/*
 * Modules de traitement des erreurs
 */
$APPLI_moduleDroitKO = "droitko";
$APPLI_moduleErrorBefore = "errorbefore";
$APPLI_moduleNoLogin = "errorlogin";
$APPLI_notSSL = false;
/*
 * Cles privee et publique utilisees
 * pour la generation des jetons
 */
$privateKey = "/etc/ssl/private/ssl-cert-snakeoil.key";
$pubKey = "/etc/ssl/certs/ssl-cert-snakeoil.pem";
/*
 * Duree de validite du token d'identification
 */
$tokenIdentityValidity = 36000; // 10 heures

/*
 * Nombre maximum d'essais de connexion
 */
$CONNEXION_max_attempts = 5;
/*
 * Duree de blocage du compte (duree reinitialisee a chaque tentative)
 */
$CONNEXION_blocking_duration = 600;
/*
 * Laps de temps avant de renvoyer un mail a l'administrateur en cas de blocage de compte
 */
$APPLI_mailToAdminPeriod = 7200;
$APPLI_admin_ttl = 600; // Duree maxi d'inactivite pour acceder a un module d'administration
$APPLI_lostPassword = 0; // Autorise la recuperation d'un nouveau mot de passe en cas de perte

/* Taille maximale d'une photo telechargee dans le navigateur.
 * Doit etre compatible avec les directives du fichier php.ini : post_max_size et upload_max_filesize
 * (directives non modifiables dans l'application)
 */

$APPLI_maxfilesize = 100000000;
/*
 * Activation de la recherche antivirale des pieces jointes
 */
$APPLI_virusscan = false;
/*
 * Stockage des photos temporaires
 */
$APPLI_photoStockage = "img";
?>
