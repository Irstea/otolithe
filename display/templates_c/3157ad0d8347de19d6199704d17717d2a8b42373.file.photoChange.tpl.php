<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 13:57:31
         compiled from "display/templates/gestion/photoChange.tpl" */ ?>
<?php /*%%SmartyHeaderCode:355686448529466b7c30269-96800580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3157ad0d8347de19d6199704d17717d2a8b42373' => 
    array (
      0 => 'display/templates/gestion/photoChange.tpl',
      1 => 1385470646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '355686448529466b7c30269-96800580',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529466b7ef91b2_39451569',
  'variables' => 
  array (
    'individu' => 0,
    'data' => 0,
    'lumieretype' => 0,
    'droits' => 0,
    'LANG' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529466b7ef91b2_39451569')) {function content_529466b7ef91b2_39451569($_smarty_tpl) {?><script type="text/javascript" src="display/javascript/calendar/calendar.js"></script>
<script type="text/javascript" src="display/javascript/calendar/lang/calendar-fr.js"></script>
<script type="text/javascript" src="display/javascript/calendar/calendar-setup.js"></script>
<style type="text/css">@import url(display/javascript/calendar/aqua/theme.css);</style>

<h2>Modification d'une photo</h2>
<a href="index.php?module=individuList">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id=<?php echo $_smarty_tpl->tpl_vars['individu']->value['individu_id'];?>
">Retour au détail du poisson</a> > 
<a href="index.php?module=pieceDisplay&piece_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">Retour au détail de la pièce</a>
<?php echo $_smarty_tpl->getSubTemplate ("gestion/individuCartouche.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("gestion/pieceCartouche.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<form method="post" action="index.php" enctype="multipart/form-data" onSubmit='return validerForm("dateExample:la date est obligatoire,comment:le commentaire est obligatoire")'>
<input type="hidden" name="piece_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">
<input type="hidden" name="photo_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
">
<input type="hidden" name="module" value="photoWrite">
<table class="tablesaisie">
<tr>
<td class="libelleSaisie">Nom de la photo : </td>
<td>
<input name="photo_nom" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_nom'];?>
" maxlength="255" size="50">
</td>
</tr>
<tr>
<td class="libelleSaisie">Description : </td>
<td>
<input name="description" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
" maxlength="255" size="50">
</td>
</tr>
<tr>
		<td class="libelleSaisie">Fichier JPG contenant la photo : </td>
		<td>
			<input type="hidden" name="MAX_FILE_SIZE" value="50000000">
			<input type="file" name="photoload" accept="image/jpeg" size="50">
		</td>
</tr>
<tr>
<td class="libelleSaisie">Nom du fichier : </td>
<td>
<input name="photo_filename" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_filename'];?>
" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">Date de prise de vue : </td>
<td>
<input name="photo_date" id="photo_date" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_date'];?>
" maxlength="10" size="10">
<img id='button1' src='display/javascript/calendar/images/calendar.png' class='calendrier' alt='Calendrier' title='Calendrier'>
<script type='text/javascript'>calendarini("photo_date","button1")</script>
</td>
</tr>
<tr>
<td class="libelleSaisie">Couleur : </td>
<td>
<input type="radio" name="color" value="NB" <?php if ($_smarty_tpl->tpl_vars['data']->value['color']=="NB"){?>checked<?php }?>>Noir et blanc
<br>
<input type="radio" name="color" value="C" <?php if ($_smarty_tpl->tpl_vars['data']->value['color']=="C"){?>checked<?php }?>>Couleur
</td>
</tr>
<tr>
<td class="libelleSaisie">Type de lumière : </td>
<td>
<select name="lumieretype_id">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['lumieretype']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $_smarty_tpl->tpl_vars['lumieretype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['lumieretype_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['lumieretype_id']==$_smarty_tpl->tpl_vars['lumieretype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['lumieretype_id']){?>selected<?php }?>>
<?php echo $_smarty_tpl->tpl_vars['lumieretype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['lumieretype_libelle'];?>

</option>
<?php endfor; endif; ?>
</select>
</td>
</tr>
<tr>
<td class="libelleSaisie">Grossissement : </td>
<td>
<input name="grossissement" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['grossissement'];?>
" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">Repère : </td>
<td>
<input name="repere" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['repere'];?>
" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">Adresse de stockage (fichiers dans arborescence) : </td>
<td>
<input name="URI" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['URI'];?>
" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">Repère de mesure - longueur de référence : </td>
<td>
<input name="long_reference" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['long_reference'];?>
" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">Dimensions de la photo : </td>
<td>
<input name="photo_width" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_width'];?>
" readonly>x 
<input name="photo_height" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_height'];?>
" readonly>
</td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
<?php if ($_smarty_tpl->tpl_vars['data']->value['photo_id']>0&&$_smarty_tpl->tpl_vars['droits']->value["admin"]==1){?>
<form action="index.php" method="post" onSubmit='return confirmSuppression("<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][31];?>
")'>
<input type="hidden" name="piece_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['piece_id'];?>
">
<input type="hidden" name="photo_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
">
<input type="hidden" name="module" value="photoDelete">
<input type="submit" value="Supprimer">
</form>
<?php }?>
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">Champ obligatoire</span><?php }} ?>