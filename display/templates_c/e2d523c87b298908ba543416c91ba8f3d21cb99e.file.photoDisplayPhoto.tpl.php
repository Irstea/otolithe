<?php /* Smarty version Smarty-3.1.13, created on 2013-11-27 16:42:09
         compiled from "display/templates/gestion/photoDisplayPhoto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:182956498752949e19d04771-41623099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2d523c87b298908ba543416c91ba8f3d21cb99e' => 
    array (
      0 => 'display/templates/gestion/photoDisplayPhoto.tpl',
      1 => 1385566926,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182956498752949e19d04771-41623099',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52949e19d4dc92_59405569',
  'variables' => 
  array (
    'photo_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52949e19d4dc92_59405569')) {function content_52949e19d4dc92_59405569($_smarty_tpl) {?><a href=index.php?module=photoDisplay&photo_id=<?php echo $_smarty_tpl->tpl_vars['photo_id']->value;?>
>Retour</a>
<img src="index.php?module=photoGetPhoto&photo_id=<?php echo $_smarty_tpl->tpl_vars['photo_id']->value;?>
">Patientez pendant le chargement...</img><?php }} ?>