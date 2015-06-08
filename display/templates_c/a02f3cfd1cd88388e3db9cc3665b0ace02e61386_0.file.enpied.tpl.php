<?php /* Smarty version 3.1.24, created on 2015-06-08 10:19:17
         compiled from "display/templates/enpied.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:118472962355755005c42e14_04450229%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a02f3cfd1cd88388e3db9cc3665b0ace02e61386' => 
    array (
      0 => 'display/templates/enpied.tpl',
      1 => 1433749336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118472962355755005c42e14_04450229',
  'variables' => 
  array (
    'LANG' => 0,
    'melappli' => 0,
    'developpementMode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55755005c4f1c0_64364906',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55755005c4f1c0_64364906')) {
function content_55755005c4f1c0_64364906 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '118472962355755005c42e14_04450229';
?>
<div id="footer">
<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][23];?>

<br>
<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][24];?>

<br>
<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][25];?>
 
<a href="https://forge.irstea.fr/projects/otolithe/issues/new"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][36];?>
</a>
<?php echo $_smarty_tpl->tpl_vars['LANG']->value['message']['ou'];?>

<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['melappli']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['message'][37];?>
</a>

<?php if (strlen($_smarty_tpl->tpl_vars['developpementMode']->value) > 1) {?>
<br>
<div class="red"><?php echo $_smarty_tpl->tpl_vars['developpementMode']->value;?>
</div>
<?php }?>
</div>
<?php }
}
?>