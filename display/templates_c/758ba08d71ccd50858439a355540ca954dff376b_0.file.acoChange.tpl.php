<?php /* Smarty version 3.1.24, created on 2015-06-08 12:29:44
         compiled from "display/templates/droits/acoChange.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:56782187855756e98a75a74_03409859%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '758ba08d71ccd50858439a355540ca954dff376b' => 
    array (
      0 => 'display/templates/droits/acoChange.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56782187855756e98a75a74_03409859',
  'variables' => 
  array (
    'dataAppli' => 0,
    'data' => 0,
    'groupes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756e98ab5086_57911118',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756e98ab5086_57911118')) {
function content_55756e98ab5086_57911118 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '56782187855756e98a75a74_03409859';
?>
<h2>Modification du droit d'une application (module de gestion des droits)</h2>

<a href="index.php?module=appliList">Retour à la liste des applications</a>
&nbsp;<a href="index.php?module=appliDisplay&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['dataAppli']->value['aclappli_id'];?>
">
Retour à <?php echo $_smarty_tpl->tpl_vars['dataAppli']->value['appli'];?>
 (<?php echo $_smarty_tpl->tpl_vars['dataAppli']->value['applidetail'];?>
)
</a>
<div class="formSaisie">
<div>

<form id="acoForm" method="post" action="index.php?module=acoWrite">
<input type="hidden" name="aclaco_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclaco_id'];?>
">
<input type="hidden" name="aclappli_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
<div class="formBouton">
<input class="submit" type="submit" value="Enregistrer">
</div>
<dl>
<dt>Nom du droit utilisé dans l'application <span class="red">*</span> :</dt>
<dd><input name="aco" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aco'];?>
" autofocus required></dd>
</dl>
<dl>
<dt>Groupes disposant du droit :</dt>
<dd>
<table class="tablenoborder">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['name'] = 'lst';
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['groupes']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<?php $_smarty_tpl->tpl_vars['boucle'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['boucle']->step = 1;$_smarty_tpl->tpl_vars['boucle']->total = (int) ceil(($_smarty_tpl->tpl_vars['boucle']->step > 0 ? $_smarty_tpl->tpl_vars['groupes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['level']+1 - (1) : 1-($_smarty_tpl->tpl_vars['groupes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['level'])+1)/abs($_smarty_tpl->tpl_vars['boucle']->step));
if ($_smarty_tpl->tpl_vars['boucle']->total > 0) {
for ($_smarty_tpl->tpl_vars['boucle']->value = 1, $_smarty_tpl->tpl_vars['boucle']->iteration = 1;$_smarty_tpl->tpl_vars['boucle']->iteration <= $_smarty_tpl->tpl_vars['boucle']->total;$_smarty_tpl->tpl_vars['boucle']->value += $_smarty_tpl->tpl_vars['boucle']->step, $_smarty_tpl->tpl_vars['boucle']->iteration++) {
$_smarty_tpl->tpl_vars['boucle']->first = $_smarty_tpl->tpl_vars['boucle']->iteration == 1;$_smarty_tpl->tpl_vars['boucle']->last = $_smarty_tpl->tpl_vars['boucle']->iteration == $_smarty_tpl->tpl_vars['boucle']->total;?>
&nbsp;&nbsp;&nbsp;
<?php }} ?>
<?php echo $_smarty_tpl->tpl_vars['groupes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['groupe'];?>

</td>
<td>
<input type="checkbox" name="groupes[]" value="<?php echo $_smarty_tpl->tpl_vars['groupes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['aclgroup_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['groupes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['checked'] == 1) {?>checked<?php }?>>
</td>
</tr>
<?php endfor; endif; ?>
</table>
</dl>
<dl></dl>

<div class="formBouton">
<input class="submit" type="submit" value="Enregistrer">
</div>
</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['data']->value['aclaco_id'] > 0) {?>
<div class="formBouton">
<form action="index.php" method="post" onSubmit='return confirmSuppression("Confirmez-vous la suppression ?")'>
<input type="hidden" name="aclaco_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclaco_id'];?>
">
<input type="hidden" name="aclappli_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
<input type="hidden" name="module" value="acoDelete">
<input class="submit" type="submit" value="Supprimer">
</form>
</div>
<?php }?>
</div>

<span class="red">*</span><span class="messagebas">Champ obligatoire</span><?php }
}
?>