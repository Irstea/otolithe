<?php /* Smarty version Smarty-3.1.13, created on 2013-11-27 16:41:35
         compiled from "display/templates/gestion/photoDisplay.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135756753952947686a9b1c1-63743020%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13d472c40fc836eeccaf796cde2d8addfa476865' => 
    array (
      0 => 'display/templates/gestion/photoDisplay.tpl',
      1 => 1385566888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135756753952947686a9b1c1-63743020',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52947686c85883_93090614',
  'variables' => 
  array (
    'piece' => 0,
    'data' => 0,
    'droits' => 0,
    'photolecture' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52947686c85883_93090614')) {function content_52947686c85883_93090614($_smarty_tpl) {?><h2>Affichage d'une photo</h2>
<a href="index.php?module=individuList">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id=<?php echo $_smarty_tpl->tpl_vars['piece']->value['individu_id'];?>
">Retour au détail du poisson</a> > 
<a href="index.php?module=pieceDisplay&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">Retour au détail de la pièce</a>
<table class="tablemulticolonne">
<tr>
<td>
<?php echo $_smarty_tpl->getSubTemplate ("gestion/individuCartouche.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</td>
<td>
<?php echo $_smarty_tpl->getSubTemplate ("gestion/pieceCartouche.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</td>
</tr>
</table>
<?php if ($_smarty_tpl->tpl_vars['droits']->value['gestion']==1){?>
<a href="index.php?module=photoChange&photo_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">
Modifier la photo...
</a>
<?php }?>
<table class="tablemulticolonne">
<tr>
<td>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Nom de la photo : </td>
<td>
<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_nom'];?>

</td>
</tr>
<tr>
<td class="libelleSaisie">Description : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Nom du fichier : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['photo_filename'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Date de prise de vue : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['photo_date'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Couleur : </td>
<td>
<?php if ($_smarty_tpl->tpl_vars['data']->value['color']=="NB"){?>Noir et blanc<?php }else{ ?>Couleur<?php }?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Type de lumière : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['lumieretype_libelle'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Grossissement : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['grossissement'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Repère : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['repere'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">URI : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['uri'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Longueur de la référence : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['long_reference'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Taille de la photo : </td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['photo_width'];?>
x<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_height'];?>
</td>
</tr>
</table>
</td>
<td>
<a href="index.php?module=photoDisplayPhoto&photo_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
" title="Attention : le temps de chargement peut être (très) long, selon la taille originale de la photo !">
<img src="index.php?module=photoGetThumbnail&photo_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
">
</a>
</td>
</tr>
</table>
<?php if ($_smarty_tpl->tpl_vars['droits']->value['lecture']==1){?>
<form name="lecture" action="index.php" method="get">
<input type="hidden" name="module" value="photolectureChange">
<input type="hidden" name="photo_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
">
<input type="hidden" name="photolecture_id" value="0">
Résolution (approximative) de lecture : 
<select name="resolution">
<option value="1">800x600</option>
<option value="2">1024x768</option>
<option value="3">1280x1024</option>
</select>
<input type="submit" value="Réaliser une nouvelle lecture">
</form>
<?php }?>
<table>
<thead>
<tr>
<th>Lecteur</th>
<th>Date de lecture</th>
<th>Age (nb de points<br>positionnés)</th>
</tr>
</thead>
<tdata>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['photolecture']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<a href="index.php?module=photolectureChange&photo_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
&photolecture_id=<?php echo $_smarty_tpl->tpl_vars['photolecture']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photolecture_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['photolecture']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['prenom'];?>
 <?php echo $_smarty_tpl->tpl_vars['photolecture']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['nom'];?>

</a>
</td>
</tr>
<tr>
<td>
<?php echo $_smarty_tpl->tpl_vars['photolecture']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['photolecture_date'];?>

</td>
</tr>
<tr>
<td>
<?php echo $_smarty_tpl->tpl_vars['photolecture']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['age'];?>

</td>
</tr>
<?php endfor; endif; ?>
</tdata>
</table><?php }} ?>