<?php /* Smarty version 3.1.24, created on 2015-06-08 12:28:29
         compiled from "display/templates/droits/appliDisplay.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:153745492555756e4da07890_07449915%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0c3844c0d8550a5d21595a6beaf707167d4eacf' => 
    array (
      0 => 'display/templates/droits/appliDisplay.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153745492555756e4da07890_07449915',
  'variables' => 
  array (
    'data' => 0,
    'dataAco' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756e4da27e74_41711761',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756e4da27e74_41711761')) {
function content_55756e4da27e74_41711761 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '153745492555756e4da07890_07449915';
?>
<a href="index.php?module=appliList">Retour à la liste des applications</a>
<h2>Liste des droits disponibles pour l'application 
<a href="index.php?module=appliChange&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['data']->value['appli'];?>
 (<?php echo $_smarty_tpl->tpl_vars['data']->value['applidetail'];?>
)
</a>
</h2>
<a href="index.php?module=acoChange&aclaco_id=0&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
Nouveau droit...
</a>
<table id="acoliste" class="tableliste">
<thead>
<tr>
<th>Nom du droit d'accès</th>
</tr>
</thead>
<tbody>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['name'] = 'lst';
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAco']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<a href="index.php?module=acoChange&aclaco_id=<?php echo $_smarty_tpl->tpl_vars['dataAco']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['aclaco_id'];?>
&aclappli_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['dataAco']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['aco'];?>

</a>
</td>
</tr>
<?php endfor; endif; ?>
</tbody>
</table><?php }
}
?>