<?php /* Smarty version 3.1.24, created on 2015-06-08 12:32:25
         compiled from "display/templates/droits/groupChange.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:91082243655756f39cb1e84_46052919%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c7cffa4c5375f257c046f8858a431d7ae0bd8a3' => 
    array (
      0 => 'display/templates/droits/groupChange.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91082243655756f39cb1e84_46052919',
  'variables' => 
  array (
    'data' => 0,
    'logins' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756f39ce5029_04565759',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756f39ce5029_04565759')) {
function content_55756f39ce5029_04565759 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '91082243655756f39cb1e84_46052919';
?>
<h2>Modification d'un groupe et rattachement des logins</h2>

<a href="index.php?module=groupList">Retour à la liste des groupes</a>
<div class="formSaisie">
<div>

<form id="groupForm" method="post" action="index.php?module=groupWrite">
<input type="hidden" name="aclgroup_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclgroup_id'];?>
">
<input type="hidden" name="aclgroup_id_parent" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclgroup_id_parent'];?>
">
<div class="formBouton">
<input class="submit" type="submit" value="Enregistrer">
</div>
<dl>
<dt>Nom du groupe <span class="red">*</span> :</dt>
<dd><input name="groupe" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['groupe'];?>
" autofocus required></dd>
</dl>
<dl>
<dt>Logins rattachés <span class="red">*</span> : </dt>
<dd>
<table class="tablenoborder">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['name'] = 'lst';
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['logins']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<tr><td>
<?php echo $_smarty_tpl->tpl_vars['logins']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['logindetail'];?>

</td>
<td>
<input type="checkbox" name="logins[]" value="<?php echo $_smarty_tpl->tpl_vars['logins']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['acllogin_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['logins']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['checked'] == 1) {?>checked<?php }?>>
</td>
</tr>
<?php endfor; endif; ?>
</table>
</dd>
</dl>
<dl></dl>
<div class="formBouton">
<input class="submit" type="submit" value="Enregistrer">
</div>
</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['data']->value['aclgroup_id'] > 0) {?>
<div class="formBouton">
<form action="index.php" method="post" onSubmit='return confirmSuppression("Confirmez-vous la suppression ?")'>
<input type="hidden" name="aclgroup_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclgroup_id'];?>
">
<input type="hidden" name="module" value="groupDelete">
<input class="submit" type="submit" value="Supprimer">
</form>
</div>
<?php }?>
</div>

<span class="red">*</span><span class="messagebas">Champ obligatoire</span><?php }
}
?>