<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 10:15:35
         compiled from "display/templates/gestion/pieceCartouche.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1050902370529466b7f04b66-72484772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b259bba99912c68384aa7fd172a2bbf5f30e18c' => 
    array (
      0 => 'display/templates/gestion/pieceCartouche.tpl',
      1 => 1385455345,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1050902370529466b7f04b66-72484772',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'piece' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529466b8002094_96020227',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529466b8002094_96020227')) {function content_529466b8002094_96020227($_smarty_tpl) {?><table class="tableaffichage">
<tr>
<td>
<?php echo $_smarty_tpl->tpl_vars['piece']->value['piecetype_libelle'];?>

<br>
<?php echo $_smarty_tpl->tpl_vars['piece']->value['piececode'];?>
 - <?php echo $_smarty_tpl->tpl_vars['piece']->value['traitementpiece_libelle'];?>

</td>
</tr>
</table><?php }} ?>