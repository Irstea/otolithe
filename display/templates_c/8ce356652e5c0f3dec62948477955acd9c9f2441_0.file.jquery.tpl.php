<?php /* Smarty version 3.1.24, created on 2015-06-08 10:19:17
         compiled from "display/templates/jquery.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:79077454955755005c2e232_95715166%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ce356652e5c0f3dec62948477955acd9c9f2441' => 
    array (
      0 => 'display/templates/jquery.tpl',
      1 => 1433500931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79077454955755005c2e232_95715166',
  'variables' => 
  array (
    'LANG' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55755005c35558_87375689',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55755005c35558_87375689')) {
function content_55755005c35558_87375689 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '79077454955755005c2e232_95715166';
?>
<!-- script type="text/javascript" charset="utf-8" src="display/javascript/DataTables-1.9.4/media/js/jquery.js"><?php echo '</script'; ?>
-->
<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="display/javascript/jquery-1.11.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="display/javascript/jquery-ui-1.10.4.custom.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="display/javascript//DataTables-1.9.4/media/js/jquery.dataTables.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="display/javascript/DataTables-1.9.4/extras/TableTools/media/js/TableTools.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="display/javascript/DataTables-1.9.4/extras/TableTools/media/js/ZeroClipboard.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="display/javascript/carhartl-jquery-cookie-3caf209/jquery.cookie.js"><?php echo '</script'; ?>
>
<style type="text/css" > 
@import "display/CSS/TableTools.css";
@import "display/CSS/dataTables.css";
@import "display/CSS/jquery-ui-1.10.4.custom.css";
</style>
<!--  Definition des balises titre et du datepicker par defaut -->
<?php echo '<script'; ?>
>
$(document).ready(function() {
	$('.taux,nombre').attr('title','<?php echo $_smarty_tpl->tpl_vars['LANG']->value[$_smarty_tpl->getVariable('smarty')->value['section']['message']['index']][34];?>
');
	<!--$('.taux').attr('placeholder', '100, 95.5...');-->
	$(".date").datepicker( { dateFormat: "dd/mm/yy" } );
	$('.taux').attr( {
		'pattern': '[0-9]+(\.[0-9]+)?',
		'maxlength' : "10"
	} );
	$('.nombre').attr( {
		'pattern': '[0-9]+',
		'maxlength' : "10"
	}
	);
	$('.timepicker').attr('pattern', '[0-9][0-9]\:[0-9][0-9]\:[0-9][0-9]');
} ) ;
<?php echo '</script'; ?>
><?php }
}
?>