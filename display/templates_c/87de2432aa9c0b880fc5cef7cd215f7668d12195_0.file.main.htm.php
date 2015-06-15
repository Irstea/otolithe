<?php /* Smarty version 3.1.24, created on 2015-06-15 17:52:44
         compiled from "display/templates/main.htm" */ ?>
<?php
/*%%SmartyHeaderCode:791594419557ef4cc373911_30839002%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87de2432aa9c0b880fc5cef7cd215f7668d12195' => 
    array (
      0 => 'display/templates/main.htm',
      1 => 1434383557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '791594419557ef4cc373911_30839002',
  'variables' => 
  array (
    'LANG' => 0,
    'fds' => 0,
    'idFocus' => 0,
    'entete' => 0,
    'corps' => 0,
    'enpied' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_557ef4cc395777_12421542',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_557ef4cc395777_12421542')) {
function content_557ef4cc395777_12421542 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '791594419557ef4cc373911_30839002';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][1];?>
</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['fds']->value;?>
" type="text/css">
<link rel="icon" type="image/png" href="favicon.png" />
</head>
<?php if (strlen($_smarty_tpl->tpl_vars['idFocus']->value)) {?>
<body onload='document.getElementById("<?php echo $_smarty_tpl->tpl_vars['idFocus']->value;?>
").focus()'>
<?php } else { ?>
<body>
<?php }?>
<?php echo '<script'; ?>
 language="javascript" SRC="display/javascript/fonctions.js"><?php echo '</script'; ?>
>
<div id="superglobal">
<div id="global">
<?php echo $_smarty_tpl->getSubTemplate ("jquery.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['entete']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['corps']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

</div>
<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['enpied']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

</div>
</body>
</html><?php }
}
?>