<?php /* Smarty version Smarty-3.1.13, created on 2013-11-22 16:20:15
         compiled from "display/templates/gestion/pieceChange.tpl" */ ?>
<?php /*%%SmartyHeaderCode:394737156528f710d039ab7-55728402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79a1395761369095d50255e51c777214797cd211' => 
    array (
      0 => 'display/templates/gestion/pieceChange.tpl',
      1 => 1385133610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '394737156528f710d039ab7-55728402',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_528f710d0b3920_19028643',
  'variables' => 
  array (
    'data' => 0,
    'piecetype' => 0,
    'traitementpiece' => 0,
    'droits' => 0,
    'LANG' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528f710d0b3920_19028643')) {function content_528f710d0b3920_19028643($_smarty_tpl) {?><h2>Modification d'une pièce</h2>
<a href="index.php?module=individuList">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">Retour au détail du poisson</a>
<?php if ($_smarty_tpl->tpl_vars['data']->value['piece_id']>0){?>
> <a href="index.php?module=pieceDisplay&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">Retour au détail de la pièce</a>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("gestion/individuCartouche.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<table class="tablesaisie">
<form method="post" action="index.php?module=pieceWrite" onSubmit='return validerForm("dateExample:la date est obligatoire,comment:le commentaire est obligatoire")'>
<input type="hidden" name="piece_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">
<input type="hidden" name="individu_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">

<tr>
<td class="libelleSaisie">Type de pièce :</td>
<td class="datamodif">
<select name="piecetype_id">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['piecetype']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $_smarty_tpl->tpl_vars['piecetype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['piecetype_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['piecetype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['piecetype_id']==$_smarty_tpl->tpl_vars['data']->value['piecetype_id']){?>selected<?php }?>>
<?php echo $_smarty_tpl->tpl_vars['piecetype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['piecetype_libelle'];?>

</option>
<?php endfor; endif; ?>
</select>
</td>
</tr>

<tr>
<td class="libelleSaisie">Code de la pièce :</td>
<td>
<input id="piececode" name="piececode" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['piececode'];?>
" maxlengh="255" size="45">
</td>
</tr>

<tr>
<td class="libelleSaisie">Traitement effectué :</td>
<td class="datamodif">
<select name="traitementpiece_id">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['traitementpiece']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $_smarty_tpl->tpl_vars['traitementpiece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['traitementpiece_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['traitementpiece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['traitementpiece_id']==$_smarty_tpl->tpl_vars['data']->value['traitementpiece_id']){?>selected<?php }?>>
<?php echo $_smarty_tpl->tpl_vars['traitementpiece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['traitementpiece_libelle'];?>

</option>
<?php endfor; endif; ?>
</select>
</td>
</tr>

<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
<?php if ($_smarty_tpl->tpl_vars['data']->value['piece_id']>0&&$_smarty_tpl->tpl_vars['droits']->value["admin"]==1){?>
<form action="index.php" method="post" onSubmit='return confirmSuppression("<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][31];?>
")'>
<input type="hidden" name="piece_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">
<input type="hidden" name="individu_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">
<input type="hidden" name="module" value="pieceDelete">
<input type="submit" value="Supprimer">
</form>
<?php }?>
</div>
</td>
</tr>
</table>
<?php }} ?>