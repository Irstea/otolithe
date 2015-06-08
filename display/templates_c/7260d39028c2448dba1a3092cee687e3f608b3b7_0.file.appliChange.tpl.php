<?php /* Smarty version 3.1.24, created on 2015-06-08 12:28:33
         compiled from "display/templates/droits/appliChange.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:113130759355756e51766561_74056780%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7260d39028c2448dba1a3092cee687e3f608b3b7' => 
    array (
      0 => 'display/templates/droits/appliChange.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113130759355756e51766561_74056780',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756e5177b8c7_55469878',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756e5177b8c7_55469878')) {
function content_55756e5177b8c7_55469878 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '113130759355756e51766561_74056780';
?>
<h2>Modification d'une application (module de gestion des droits)</h2>

<a href="index.php?module=appliList">Retour à la liste des applications</a>
<div class="formSaisie">
<div>

<form id="appliForm" method="post" action="index.php?module=appliWrite">
<input type="hidden" name="aclappli_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
<dl>
<dt>Nom de l'application <span class="red">*</span> :</dt>
<dd><input name="appli" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['appli'];?>
" autofocus required></dd>
</dl>
<dl>
<dt>Description : </dt>
<dd><input name="applidetail" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['applidetail'];?>
"></dd>
</dl>
<dl></dl>
<div class="formBouton">
<input class="submit" type="submit" value="Enregistrer">
</div>
</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['data']->value['aclappli_id'] > 0) {?>
<div class="formBouton">
<form action="index.php" method="post" onSubmit='return confirmSuppression("Confirmez-vous la suppression ?")'>
<input type="hidden" name="aclappli_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['aclappli_id'];?>
">
<input type="hidden" name="module" value="appliDelete">
<input class="submit" type="submit" value="Supprimer">
</form>
</div>
<?php }?>
</div>

<span class="red">*</span><span class="messagebas">Champ obligatoire</span><?php }
}
?>