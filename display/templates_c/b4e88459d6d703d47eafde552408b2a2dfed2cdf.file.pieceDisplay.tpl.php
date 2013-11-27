<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 14:11:14
         compiled from "display/templates/gestion/pieceDisplay.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108001725528f711f2b9b49-17700635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4e88459d6d703d47eafde552408b2a2dfed2cdf' => 
    array (
      0 => 'display/templates/gestion/pieceDisplay.tpl',
      1 => 1385471433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108001725528f711f2b9b49-17700635',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_528f711f31d2b1_82569499',
  'variables' => 
  array (
    'data' => 0,
    'droits' => 0,
    'photo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528f711f31d2b1_82569499')) {function content_528f711f31d2b1_82569499($_smarty_tpl) {?><h2>Affichage d'une pièce</h2>
<a href="index.php?module=individuList">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">Retour au détail du poisson</a>
<?php echo $_smarty_tpl->getSubTemplate ("gestion/individuCartouche.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<h3>Détail de la pièce</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Type de pièce :</td>
<td><?php if ($_smarty_tpl->tpl_vars['droits']->value['gestion']==1){?>
<a href="index.php?module=pieceChange&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
&individu_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">
<?php }?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['piecetype_libelle'];?>

<?php if ($_smarty_tpl->tpl_vars['droits']->value['gestion']==1){?></a><?php }?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Code de la pièce :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['piececode'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Type de traitement :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['traitementpiece_libelle'];?>
</td>
</tr>
</table>
<h3>Photos rattachées</h3>
<?php if ($_smarty_tpl->tpl_vars['droits']->value['gestion']==1){?>
<a href="index.php?module=photoChange&photo_id=0&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">Nouvelle photo</a>
<?php }?>
<table>
<thead>
<tr>
<th>Nom</th>
<th>Description</th>
<th>Date</th>
<th>Couleur ?</th>
<th>Dimensions</th>
<th>Miniature</th>
</tr>
</thead>
<tdata>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['photo']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<td>
<a href="index.php?module=photoDisplay&photo_id=<?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_id'];?>
&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_nom'];?>

</a>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['description'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_date'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['color'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_width'];?>
x<?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_height'];?>
</td>
<td>
<a href="index.php?module=photoDisplayPhoto&photo_id=<?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_id'];?>
" title="Attention : le temps de chargement peut être long, selon la taille de la photo !">
<img src="index.php?module=photoGetThumbnail&photo_id=<?php echo $_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photo_id'];?>
" width="200" border="0">
</a>
</td>
</tr>
<?php endfor; endif; ?>
</tdata>
</table>
<?php }} ?>