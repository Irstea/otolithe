<?php /* Smarty version 3.1.24, created on 2015-06-08 12:16:13
         compiled from "display/templates/ident/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:152392365755756b6de1ed33_79305774%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1fe117b354aabdeec35a55d266dc2fc9841e538' => 
    array (
      0 => 'display/templates/ident/login.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152392365755756b6de1ed33_79305774',
  'variables' => 
  array (
    'module' => 0,
    'LANG' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756b6de2f7c5_20679727',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756b6de2f7c5_20679727')) {
function content_55756b6de2f7c5_20679727 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '152392365755756b6de1ed33_79305774';
?>
	<form method="POST" action="index.php">
	<table class="tablesaisie">
	<tr>
	<input type="hidden" name="module" value=<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
>
	<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][0];?>
 :</td><td> <input name="login" maxlength="32" required autofocus></td>
	</tr>
	<tr><td>
	<?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][1];?>
 :</td><td><input name="password" type="password" autocomplete="off" required maxlength="32"></td>
	</tr>
	<tr>
	<td><input type="submit"></td><td> <input type="reset"></td>
	</tr>
	</table>
<?php }
}
?>