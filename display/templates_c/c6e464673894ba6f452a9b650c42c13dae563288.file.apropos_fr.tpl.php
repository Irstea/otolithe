<?php /* Smarty version Smarty-3.1.13, created on 2013-10-29 11:05:43
         compiled from "display/templates/apropos_fr.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1823719548526f8877301336-62240028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6e464673894ba6f452a9b650c42c13dae563288' => 
    array (
      0 => 'display/templates/apropos_fr.tpl',
      1 => 1383039427,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1823719548526f8877301336-62240028',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'version' => 0,
    'versiondate' => 0,
    'melappli' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_526f887733e8d5_68520510',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_526f887733e8d5_68520510')) {function content_526f887733e8d5_68520510($_smarty_tpl) {?><h2>A propos de PrototypePHP...
</h2>
<p>
Version <?php echo $_smarty_tpl->tpl_vars['version']->value;?>
 du <?php echo $_smarty_tpl->tpl_vars['versiondate']->value;?>
.
</p>
PrototypePHP est un canevas d'application basé sur le modéle MVC
(modéle - vue - contrôleur), qui s'appuie sur les classes suivantes :<br>
- <a href="http://adodb.sourceforge.net/">ADODB</a>
pour l'accés aux bases de données<br>
- <a href="http://objetbdd.sourceforge.net/">OBJETBDD</a>
pour gérer les données dans les tables<br>
- <a href="http://www.smarty.net/">SMARTY</a> pour
l'affichage des pages<br>
- <a href="http://phpgacl.sourceforge.net/">PHPGACL</a>
pour la gestion des droits<br>
- <a href="https://sourceforge.net/project/showfiles.php?group_id=88445">ESUP-CAS</a>
pour l'accés au SSO-CAS (également : <a href="http://www.ja-sig.org/wiki/display/CASC/phpCAS">http://www.ja-sig.org/wiki/display/CASC/phpCAS</a>)<br>
<br>
La navigation dans l'application est décrite dans un fichier xml. <br>
<p>publié sous licence LGPL et CECILL-C.
<br>
Réalisation : Eric Quinton - Copyright 2008-2013 - Tous droits réservés
</p>
<h3>Pour tout probléme, contactez <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['melappli']->value;?>
">l'équipe d'assistance</a>
</h3><?php }} ?>