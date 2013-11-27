<?php /* Smarty version Smarty-3.1.13, created on 2013-11-22 16:20:15
         compiled from "display/templates/gestion/individuCartouche.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1981901073528f753ed9b221-33482762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be4b30656bad657c862a7b6320248b18e136931e' => 
    array (
      0 => 'display/templates/gestion/individuCartouche.tpl',
      1 => 1385133588,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1981901073528f753ed9b221-33482762',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_528f753eda6e93_60123459',
  'variables' => 
  array (
    'individu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528f753eda6e93_60123459')) {function content_528f753eda6e93_60123459($_smarty_tpl) {?><table class="tableaffichage">
<tr>
<td>
<?php echo $_smarty_tpl->tpl_vars['individu']->value['nom_id'];?>
 - <?php echo $_smarty_tpl->tpl_vars['individu']->value['sexe_libelle'];?>

<br>
Code : <?php echo $_smarty_tpl->tpl_vars['individu']->value['codeindividu'];?>
 - Tag : <?php echo $_smarty_tpl->tpl_vars['individu']->value['tag'];?>
</td>
</tr>
</table><?php }} ?>