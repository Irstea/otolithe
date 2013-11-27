<?php /* Smarty version Smarty-3.1.13, created on 2013-11-26 16:00:35
         compiled from "display/templates/gestion/individuDisplay.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2060771112528f5ea3c7ff25-52870209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e71a60b3b2a6a9c3bee3eecbb6c77a543995ba81' => 
    array (
      0 => 'display/templates/gestion/individuDisplay.tpl',
      1 => 1385478033,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2060771112528f5ea3c7ff25-52870209',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_528f5ea3d30917_89065358',
  'variables' => 
  array (
    'data' => 0,
    'piece' => 0,
    'experimentation' => 0,
    'peche' => 0,
    'pc' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_528f5ea3d30917_89065358')) {function content_528f5ea3d30917_89065358($_smarty_tpl) {?><h2>Affichage du détail d'un individu</h2>
<a href="index.php?module=individuList">Retour à la liste</a>
<table class="tablemulticolonne">
<tr>
<td>
<h3>Données générales</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Espèce :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['nom_id'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Sexe :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['sexe_libelle'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Code de l'individu :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['codeindividu'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Tag :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['tag'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Longueur :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['longueur'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Poids :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['poids'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Remarque :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['remarque'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Parasite :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['parasite'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Age :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['age'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Pectorale gauche :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['pectorale_gauche'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Diamètre oculaire - horizontal :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['diam_occ_h'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Diamètre oculaire - vertical :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['diam_occ_v'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Ht mm :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['ht_mm'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Épaisseur :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['epaisseur'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Circonférence :</td>
<td><?php echo $_smarty_tpl->tpl_vars['data']->value['circonference'];?>
</td>
</tr>
</table>
</td>

<td>
<h3>Pièces rattachées</h3>
<a href="index.php?module=pieceChange&piece_id=0&individu_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">Nouvelle pièce</a>
<table class="tableaffichage">
<thead>
<tr>
<th>Type</th>
<th>Code</th>
<th>Traitement réalisé</th>
<th>Nbre photos rattachées</th>
</tr></thead>
<tdata>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['piece']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total']);
?>
<tr>
<td><a href="index.php?module=pieceDisplay&piece_id=<?php echo $_smarty_tpl->tpl_vars['piece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['piece_id'];?>
&individu_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['individu_id'];?>
">
<?php echo $_smarty_tpl->tpl_vars['piece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['piecetype_libelle'];?>

</a></td>
<td><?php echo $_smarty_tpl->tpl_vars['piece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['code'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['piece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['traitementpiece_libelle'];?>
</td>
<td><div class="center"><?php echo $_smarty_tpl->tpl_vars['piece']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['nbphoto'];?>
</div></td>
</tr>
<?php endfor; endif; ?>
</tdata>
</table>

<h3>Expérimentation(s)</h3>
<table>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['name'] = "lst";
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['experimentation']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["lst"]['total']);
?>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['experimentation']->value[$_smarty_tpl->getVariable('smarty')->value['section']['lst']['index']]['exp_nom'];?>
</td>
</tr>
<?php endfor; endif; ?>
</table>
</td>
</tr>

<tr>
<td>
<h3>Données concernant la pêche</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Site :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['site'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Zone précise :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['zonesite'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Date de pêche :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['peche_date'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Campagne :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['campagne'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Engin :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['peche_engin'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Pêcheur :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['personne'];?>
</td>
</tr>
<tr>
<td class="libelleSaisie">Opérateur :</td>
<td><?php echo $_smarty_tpl->tpl_vars['peche']->value['operateur'];?>
</td>
</tr>
</table>
</td>
<td>
<h3>Données physico-chimiques de la pêche</h3>
<table>
<thead>
<tr>
<th>Analyse</th>
<th>Valeur mesurée</th>
<th>Valeur mini</th>
<th>Valeur maxi</th>
</tr>
</thead>
<tdata>
<tr>
<td>Température</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['temp'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['temp_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['temp_max'];?>
</td>
</tr>
<td>O2</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['o2'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['o2_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['o2_max'];?>
</td>
</tr>
<td>pourcentage O2</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['o2pourcent'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['o2pourcent_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['o2pourcent_max'];?>
</td>
</tr>
<td>Conductivité</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['conductivite'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['conductivite_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['conductivite_max'];?>
</td>
</tr>
<td>Conductivité A</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['conductivitea'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['conductivitea_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['conductivitea_max'];?>
</td>
</tr>
<td>Salinité</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['salinite'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['salinite_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['salinite_max'];?>
</td>
</tr>
<td>pH</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['ph'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['ph_min'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['pc']->value['ph_max'];?>
</td>
</tr>
</tdata>
</table>

</td>
</tr>
</table><?php }} ?>