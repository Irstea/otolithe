<?php /* Smarty version 3.1.24, created on 2015-06-08 10:19:17
         compiled from "display/templates/entete.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:81438994555755005c378c6_22726689%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '829e8a8308d9f57bc8892557a7d077a7541740de' => 
    array (
      0 => 'display/templates/entete.tpl',
      1 => 1433749336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81438994555755005c378c6_22726689',
  'variables' => 
  array (
    'LANG' => 0,
    'ident_type' => 0,
    'menu' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55755005c3ec23_17477929',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55755005c3ec23_17477929')) {
function content_55755005c3ec23_17477929 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '81438994555755005c378c6_22726689';
?>
<h1><img src="favicon.png" width="40"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][1];?>



<div class="header_right">
<a href='index.php?module=setlanguage&langue=fr'>
<img src='display/images/drapeau_francais.png' height='20' border='0'>
</a>
<a href='index.php?module=setlanguage&langue=en'>
<img src='display/images/drapeau_anglais.png' height='20' border='0'>
</a>
&nbsp;
<?php if ($_smarty_tpl->tpl_vars['ident_type']->value == "BDD" || $_smarty_tpl->tpl_vars['ident_type']->value == "LDAP-BDD") {?>
<a href='index.php?module=loginChangePassword'>
<img src='display/images/key.png' height='20' border='0'>
</a>
&nbsp;
<?php }?>
</div>
</h1>
<div class="menu"><?php echo $_smarty_tpl->tpl_vars['menu']->value;?>
</div>
<div class="titre2"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<?php }
}
?>