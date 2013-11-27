<?php /* Smarty version Smarty-3.1.13, created on 2013-11-14 16:51:38
         compiled from "display/templates/ident/loginsaisie.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20275271825284f18a6d9f66-37722233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '185e9b1083cafc3054b4cbddabe9286c8dbd0cbd' => 
    array (
      0 => 'display/templates/ident/loginsaisie.tpl',
      1 => 1382779462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20275271825284f18a6d9f66-37722233',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'LANG' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5284f18a728950_53134654',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5284f18a728950_53134654')) {function content_5284f18a728950_53134654($_smarty_tpl) {?><form method="post" action="index.php">
<input type="hidden" name="action" value="M"> 
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
	<input type="hidden" name="module" value="loginmodif">
	<input type="hidden" name="password" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['password'];?>
">

<table class="tablesaisie">
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][0];?>
 :</td>
		<td><input name="login" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['login'];?>
" autofocus></td>
	</tr>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][9];?>
 :</td>
		<td><input name="nom" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['nom'];?>
"></td>
	</tr>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][10];?>
 :</td>
		<td><input name="prenom" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['prenom'];?>
"></td>
	</tr>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][8];?>
 :</td>
		<td><input name="mail" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['mail'];?>
"></td>
	</tr>
		<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][11];?>
 :</td>
		<td><input name="datemodif" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['datemodif'];?>
"></td>
	</tr>
	
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][1];?>
 :</td>
		<td><input type="password" name="pass1" onchange="verifieMdp(this.form.pass1, this.form.pass2)"></td>
	</tr>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][12];?>
 :</td>
		<td><input type="password" name="pass2" onchange="verifieMdp(this.form.pass1, this.form.pass2)"></td>
	</tr>
</table>
<div align="center">
<input type="submit" name="valid" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][19];?>
"/>
 <input type="submit" name="suppr" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][20];?>
" onClick="javascript:setAction(this.form, this.form.action,'S')"/>
 </div>
</form>
<?php }} ?>