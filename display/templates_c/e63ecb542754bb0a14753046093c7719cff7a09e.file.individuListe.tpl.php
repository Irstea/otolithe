<?php /* Smarty version Smarty-3.1.13, created on 2013-11-22 12:02:53
         compiled from "display/templates/gestion/individuListe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:813277549528f2f885e5ed4-04912398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e63ecb542754bb0a14753046093c7719cff7a09e' => 
    array (
      0 => 'display/templates/gestion/individuListe.tpl',
      1 => 1385118167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '813277549528f2f885e5ed4-04912398',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_528f2f88670308_44061953',
  'variables' => 
  array (
    'LANG' => 0,
    'isSearch' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528f2f88670308_44061953')) {function content_528f2f88670308_44061953($_smarty_tpl) {?><script>
setDataTables("idListe",true , false, true);
</script>
<h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['gestion'][0];?>
</h2>
<a href="index.php?module=individuChange&individu_id=0"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['gestion'][7];?>
</a>
<?php echo $_smarty_tpl->getSubTemplate ("gestion/individuSearch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['isSearch']->value==1){?>
<table id="idListe" class="tableaffichage">
<thead>
<tr>
<th>Code individu<br>TAG</th>
<th>Espèce</th>
<th>Age</th>
<th>Sexe</th>
<th>Nbre de<br>pièces</th>
<th>Date de pêche</th>
<th>Zone de pêche</th>
<th>Expérimentation</th>
</tr>
</thead>
<tdata>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total']);
?>
<tr>
<td><a href="index.php?module=individuDisplay&individu_id=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['individu_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['codeindividu'];?>
<br><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['tag'];?>

</a></td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['nom_id'];?>
</td>
<td><div class="center"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['age'];?>
</div></td>
<td><div class="center"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['sexe_libellecourt'];?>
</div></td>
<td><div class="center"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['nbrepiece'];?>
</div></td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['peche_date'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['site'];?>
<br><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['zonesite'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['exp_nom'];?>
</td>
</tr>
<?php endfor; endif; ?>
</tdata>
</table>
<?php }?><?php }} ?>