<?php /* Smarty version 3.1.24, created on 2015-06-08 12:30:29
         compiled from "display/templates/droits/groupList.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:33147138955756ec53acb31_37858224%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e978468fe52c37d90b98c624438ef9e3a5765346' => 
    array (
      0 => 'display/templates/droits/groupList.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33147138955756ec53acb31_37858224',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756ec53db523_83837031',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756ec53db523_83837031')) {
function content_55756ec53db523_83837031 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '33147138955756ec53acb31_37858224';
?>
<h2>Liste des groupes de logins</h2>
<a href="index.php?module=groupChange&aclgroup_id=0">
Nouveau groupe racine...
</a>
<?php echo '<script'; ?>
>
setDataTables("groupListe");
<?php echo '</script'; ?>
>
<table id="groupListe" class="tableliste">
<thead>
<tr>
<th>Nom du groupe</th>
<th>Nombre de<br>logins déclarés</th>
<th>Rajouter un<br>groupe fils</th>
</tr>
</thead>
<tbody>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['name'] = 'lst';
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<td>
<a href="index.php?module=groupChange&aclgroup_id=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['aclgroup_id'];?>
&aclgroup_id_parent=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['aclgroup_id_parent'];?>
">
<?php $_smarty_tpl->tpl_vars['boucle'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['boucle']->step = 1;$_smarty_tpl->tpl_vars['boucle']->total = (int) ceil(($_smarty_tpl->tpl_vars['boucle']->step > 0 ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['level']+1 - (1) : 1-($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['level'])+1)/abs($_smarty_tpl->tpl_vars['boucle']->step));
if ($_smarty_tpl->tpl_vars['boucle']->total > 0) {
for ($_smarty_tpl->tpl_vars['boucle']->value = 1, $_smarty_tpl->tpl_vars['boucle']->iteration = 1;$_smarty_tpl->tpl_vars['boucle']->iteration <= $_smarty_tpl->tpl_vars['boucle']->total;$_smarty_tpl->tpl_vars['boucle']->value += $_smarty_tpl->tpl_vars['boucle']->step, $_smarty_tpl->tpl_vars['boucle']->iteration++) {
$_smarty_tpl->tpl_vars['boucle']->first = $_smarty_tpl->tpl_vars['boucle']->iteration == 1;$_smarty_tpl->tpl_vars['boucle']->last = $_smarty_tpl->tpl_vars['boucle']->iteration == $_smarty_tpl->tpl_vars['boucle']->total;?>
&nbsp;&nbsp;&nbsp;
<?php }} ?>
<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['groupe'];?>

</a>
</td>
<td class="center"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['nblogin'];?>
</td>
<td class="center">
<a href="index.php?module=groupChange&aclgroup_id=0&aclgroup_id_parent=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['aclgroup_id'];?>
">
<img src="display/images/droits/list-add.png" height="20">
</a>
</tr>
<?php endfor; endif; ?>
</tbody>
</table><?php }
}
?>