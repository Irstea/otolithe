<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 15:37:08
         compiled from "display/templates/gestion/lecteurChange.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5264781705294b0a694c643-55717209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac549640b4e46d845c835b86cb7ed793ebd36c8c' => 
    array (
      0 => 'display/templates/gestion/lecteurChange.tpl',
      1 => 1385476624,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5264781705294b0a694c643-55717209',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5294b0a6a182d1_14949851',
  'variables' => 
  array (
    'data' => 0,
    'droits' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5294b0a6a182d1_14949851')) {function content_5294b0a6a182d1_14949851($_smarty_tpl) {?><h2>Modification d'un lecteur</h2>

<a href="index.php?module=lecteurList">Retour à la liste</a>
<table class="tablesaisie">
<form method="post" action="index.php?module=lecteurWrite" onSubmit='return validerForm("nom:le nom est obligatoire,login:le login est obligatoire")'>
<input type="hidden" name="lecteur_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['lecteur_id'];?>
">
<tr>
<td class="libelleSaisie">Nom <span class="red">*</span> :</td>
<td class="datamodif">
<input id="nom" name="lecteur_nom" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['lecteur_nom'];?>
" maxlengh="50" size="45"></td>
</tr>
<tr>
<td class="libelleSaisie">Prénom :</td>
<td class="datamodif">
<input id="prenom" name="lecteur_prenom" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['lecteur_prenom'];?>
" maxlengh="50" size="45"></td>
</tr>
<tr>
<td class="libelleSaisie">Login de connexion <span class="red">*</span> :</td>
<td class="datamodif">
<input id="login" name="login" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['login'];?>
" maxlengh="100" size="45"></td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
<?php if ($_smarty_tpl->tpl_vars['data']->value['lecteur_id']>0&&$_smarty_tpl->tpl_vars['droits']->value["admin"]==1){?>
<form action="index.php" method="post" onSubmit='return confirmSuppression("Confirmez-vous la suppression de la fiche ?")'>
<input type="hidden" name="lecteur_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['lecteur_id'];?>
">
<input type="hidden" name="module" value="lecteurDelete">
<input type="submit" value="Supprimer">
</form>
<?php }?>
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">Champ obligatoire</span><?php }} ?>