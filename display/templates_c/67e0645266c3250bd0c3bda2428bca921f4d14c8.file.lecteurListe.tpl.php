<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 15:33:38
         compiled from "display/templates/gestion/lecteurListe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3716881265294b03421f794-13938494%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67e0645266c3250bd0c3bda2428bca921f4d14c8' => 
    array (
      0 => 'display/templates/gestion/lecteurListe.tpl',
      1 => 1385476412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3716881265294b03421f794-13938494',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5294b03433c530_27102342',
  'variables' => 
  array (
    'droits' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5294b03433c530_27102342')) {function content_5294b03433c530_27102342($_smarty_tpl) {?><h2>Liste des lecteurs potentiels</h2>
<?php if ($_smarty_tpl->tpl_vars['droits']->value["gestion"]==1){?>
<a href="index.php?module=lecteurChange&lecteur_id=0">
Nouveau...
</a>
<?php }?>
<script>
setDataTables("lecteurListe");
</script>
<table id="lecteurListe" class="tableaffichage">
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Login de connexion</th>
</tr>
</thead><tdata>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['lst']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['name'] = 'lst';
$_smarty_tpl->tpl_vars['smarty']->value['section']['lst']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($_smarty_tpl->tpl_vars['droits']->value["gestion"]==1){?>
<a href="index.php?module=lecteurChange&lecteur_id=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['lecteur_id'];?>
">
<?php }?>
<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['lecteur_nom'];?>

<?php if ($_smarty_tpl->tpl_vars['droits']->value["gestion"]==1){?>
</a>
<?php }?>
</td>
<td>
<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['lecteur_prenom'];?>

</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['login'];?>
</td>
</tr>
<?php endfor; endif; ?>
</tdata>
</table>
<?php }} ?>