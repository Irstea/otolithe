<?php /* Smarty version 3.1.24, created on 2015-06-08 12:15:47
         compiled from "display/templates/main.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:196268279955756b53aa05d1_78361361%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '683372c7fe562a62c547214af1715b829493c6d7' => 
    array (
      0 => 'display/templates/main.tpl',
      1 => 1433749336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196268279955756b53aa05d1_78361361',
  'variables' => 
  array (
    'melappli' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55756b53ab47b6_88517112',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55756b53ab47b6_88517112')) {
function content_55756b53ab47b6_88517112 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '196268279955756b53aa05d1_78361361';
?>
<h2>Bienvenue dans l'application de lecture des otolithes et pièces affiliées !</h2>
<div style="text-align:left;">
<img src="favicon.png" border="0">
</div>
Le module d'affichage des photos et de positionnement des points ne fonctionne qu'avec les versions récentes des navigateurs.
<br>
En particulier, Internet Explorer 8 (présent dans Windows XP) n'est pas compatible avec le format SVG utilisé.
<br>
Le logiciel a été testé avec succès dans :
<ul>
<li>Firefox 25.0.1</li>
<li>Google Chrome 31.0</li>
</ul>
Il devrait fonctionner avec :
<ul>
<li>Internet Explorer à partir de la version 9 (dans Windows 7)</li>
<li>Firefox à partir de la version 4</li>
<li>Toutes les versions de Chrome</li>
<li>Safari à partir de la version 5.1</li>
<li>Opera à partir de la version 17</li>

</ul>
Pour toute demande d'évolution, ou pour signaler une anomalie : 
<br>
Pour les personnels IRSTEA : déclarez un ticket dans <a href="https://forge.irstea.fr/projects/otolithe/issues/new"> la forge IRSTEA</a>
<br>Pour les autres personnes : envoyez une demande par courriel à l'adresse <?php echo $_smarty_tpl->tpl_vars['melappli']->value;?>


<?php }
}
?>