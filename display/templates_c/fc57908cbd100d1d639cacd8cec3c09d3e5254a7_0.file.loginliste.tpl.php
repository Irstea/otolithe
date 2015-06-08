<?php /* Smarty version 3.1.24, created on 2015-06-08 12:26:02
         compiled from "display/templates/ident/loginliste.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:135893164155756dbac0f1a1_38689830%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc57908cbd100d1d639cacd8cec3c09d3e5254a7' => 
    array (
      0 => 'display/templates/ident/loginliste.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135893164155756dbac0f1a1_38689830',
  'variables' => 
  array (
    'LANG' => 0,
    'liste' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756dbac37240_82366268',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756dbac37240_82366268')) {
function content_55756dbac37240_82366268 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '135893164155756dbac0f1a1_38689830';
?>
<a href="index.php?module=loginmodif&id=0"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][5];?>
</a>
<table>
	<tr>
		<th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][6];?>
</td>
		<th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][7];?>
</td>
		<th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][8];?>
</td>
		<th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'][13];?>
</td>
		<tr>
	 <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['name'] = 'lst';
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['liste']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['total']);
?>
	<tr>
		<td><a href="index.php?module=loginmodif&id=<?php echo $_smarty_tpl->tpl_vars['liste']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['liste']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['login'];?>
</a></td>
		<td><?php echo $_smarty_tpl->tpl_vars['liste']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['nom'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['liste']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['prenom'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['liste']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['mail'];?>
&nbsp;</td>
		<td><?php if ($_smarty_tpl->tpl_vars['liste']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['actif'] == 1) {
echo $_smarty_tpl->tpl_vars['LANG']->value['message']['yes'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['message']['no'];
}?></td>
	</tr>
	<?php endfor; endif; ?>
</table>

<?php }
}
?>