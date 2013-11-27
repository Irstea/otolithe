<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 10:08:50
         compiled from "display/templates/example/exampleChange.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96393534952946522616071-80474073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0402921a59f8ca322515e4db854c1e51db169bcb' => 
    array (
      0 => 'display/templates/example/exampleChange.tpl',
      1 => 1383051106,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96393534952946522616071-80474073',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'droits' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52946522756342_77638018',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52946522756342_77638018')) {function content_52946522756342_77638018($_smarty_tpl) {?><h2>Modification EXEMPLE</h2>

<a href="index.php?module=exampleList">Retour à la liste</a>
<?php if ($_smarty_tpl->tpl_vars['data']->value['idExample']>0){?>
<a href="index.php?module=exampleDisplay&idExample=<?php echo $_smarty_tpl->tpl_vars['data']->value['idExample'];?>
">Retour au détail</a>
<?php }?>
<table class="tablesaisie">
<script type="text/javascript" src="display/javascript/calendar/calendar.js"></script>
<script type="text/javascript" src="display/javascript/calendar/lang/calendar-fr.js"></script>
<script type="text/javascript" src="display/javascript/calendar/calendar-setup.js"></script>
<style type="text/css">@import url(display/javascript/calendar/aqua/theme.css);</style>
<form method="post" action="index.php?module=exampleWrite" onSubmit='return validerForm("dateExample:la date est obligatoire,comment:le commentaire est obligatoire")'>
<input type="hidden" name="action" value="M">
<input type="hidden" name="idExample" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['idExample'];?>
">
<input type="hidden" name="idParent" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['idParent'];?>
">
<tr>
<td class="libelleSaisie">Date <span class="red">*</span> :</td>
<td class="datamodif">
<input id="dateExample" name="dateExample" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['dateExample'];?>
" maxlengh="10" size="10">
<img id='button1' src='display/javascript/calendar/images/calendar.png' class='calendrier' alt='Calendrier' title='Calendrier'>
<script type='text/javascript'>calendarini("dateExample","button1")</script>
</td>
</tr>
<tr>
<td class="libelleSaisie">Commentaire <span class="red">*</span> :</td>
<td class="datamodif">
<input id="comment" name="comment" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['comment'];?>
" maxlengh="255" size="45"></td>
</tr>

<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
<?php if ($_smarty_tpl->tpl_vars['data']->value['idExample']>0&&$_smarty_tpl->tpl_vars['droits']->value["admin"]==1){?>
<form action="index.php" method="post" onSubmit='return confirmSuppression()'>
<input type="hidden" name="idExample" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['idExample'];?>
">
<input type="hidden" name="idParent" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['idParent'];?>
">
<input type="hidden" name="module" value="exampleDelete">
<input type="submit" value="Supprimer">
</form>
<?php }?>
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">Champ obligatoire</span><?php }} ?>