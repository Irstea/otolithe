<?php /* Smarty version Smarty-3.1.13, created on 2013-11-27 17:39:11
         compiled from "display/templates/photolecture/photolectureChange.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2270748585295fe66a5f539-48562481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da598b80f124f4f05370b85f94da9e462282b1e7' => 
    array (
      0 => 'display/templates/photolecture/photolectureChange.tpl',
      1 => 1385570348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2270748585295fe66a5f539-48562481',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5295fe66b219c2_67082544',
  'variables' => 
  array (
    'data' => 0,
    'photo' => 0,
    'image_width' => 0,
    'image_height' => 0,
    'coef_correcteur' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5295fe66b219c2_67082544')) {function content_5295fe66b219c2_67082544($_smarty_tpl) {?><script type="text/javascript" src="display/javascript/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<script type="text/javascript" src="display/javascript/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
<script type="text/javascript" src="display/javascript/jquerysvg/jquery.svg.js"></script>

<style type="text/css">
@import "display/javascript/jquerysvg/jquery.svg.css";

body > iframe { display: none; }

</style>

<script>

var compteur=0;
var numPointLigne = 1;
var pointLigneX;
var pointLigneY;
var pointLigne2X;
var pointLigne2Y;

$(function(){
	var image_witdh = $('#image_width').val();
	var image_height = $('#image_height').val();
	$('#container')
	.css({"width":image_width+"px","height":image_height+"px","border":"0px"}) 
	.svg({onLoad: drawIntro})
	
});
function drawIntro(svg) {
	var image_width = $('#image_width').val();
	var image_height = $('#image_height').val();
	var photo_id = $('#photo_id').val();
	var lien = "index.php?module=photoGetPhoto&photo_id="+photo_id+"&sizeX="+image_width+"&sizeY="+image_height;
	var myImage = svg.image(0, 0, image_width, image_height, lien);
	$(myImage).click(function(e){
		   //var parentOffset = $(this).parent().offset(); 
		   //or $(this).offset(); if you really just want the current element's offset
		   var parentOffset = $(this).offset();
		   var relX = e.pageX - parentOffset.left;
		   var relY = e.pageY - parentOffset.top;
		   var svg = $('#container').svg('get');
		   setCircle(svg, relX, relY);
		});
	};

function setCircle(svg, x, y) {
	var ident = "circle"+compteur;
	var valeurCompteur = compteur; 
	compteur++;
	var myCircle = svg.group();
	var X = Math.floor(x);
	var Y = Math.floor(y);
	var modeLecture = $('#modeLecture').val();
	if (modeLecture == 2) {
		var couleur = 'green';
	} else if (modeLecture == 3){
		/*
		 * Traitement du trace de la ligne
		 */
		var couleur = 'blue';
	} else {
		var couleur = 'red';
	};
		svg.circle(myCircle, X, Y, 7, {
		id: ident, stroke: couleur, fill: 'rgba(0,0,0,0.3)'}	);
		svg.line(myCircle, X, Y - 7, X, Y + 7, {stroke: couleur, strokeWidth: 1});
		svg.line(myCircle, X - 7, Y, X + 7, Y, {stroke: couleur, strokeWidth: 1});
	;
	if (modeLecture != 3) {
	/*
	 * Ajout des coordonnees dans un champ input
	 */
	 var ligneDebut = '<tr id="ligne'+valeurCompteur+'"><td>'+valeurCompteur+'</td>';
	var pointX = '<td><input type="text" size="10" name="pointx' + valeurCompteur + '" id="pointx'+ valeurCompteur +'" value="'+ X +'" ></td>';
	var pointY = '<td><input type="text" size="10" name="pointy' + valeurCompteur + '" id="pointy'+ valeurCompteur +'" value="'+ Y +'" ></td>';
	var rang = '<td><input type="text" size="10" name="rang'+valeurCompteur+'" id="rang'+valeurCompteur+'" value="'+ valeurCompteur * 10 +'" ></td>';
	var pointReference ="<td></td>";
	if (modeLecture == 2) {
		pointReference = '<td><input type="text" size="10" name=pointRef'+valeurCompteur+'" id=pointRef'+valeurCompteur+'" value="1" ></td>';
	};
	var ligneFin = "</tr>";
	 $('#tableData').append(ligneDebut + pointX + pointY + rang + pointReference + ligneFin);
	} else {
	/*
	 * Traitement du trace de la ligne
	 */
	if (numPointLigne == 1) {
		var monPointLigne = 1;
		pointLigneX = X;
		pointLigneY = Y;		
	} else if (numPointLigne == 2){
		var monPointLigne = 2;
		pointLigne2X = X;
		pointLigne2Y = Y;
		svg.line(pointLigneX, pointLigneY, X, Y, {
			"id":"ligne",stroke:couleur, strokeWidth: 1});
	}
	numPointLigne ++;
	}
	/*
	 * Generation des evenements dans l'objet
	 */
	$(myCircle)
	.hover(function() {
		$(this).css("cursor","pointer");
	})
	 /*
  	 * Supprime le point 
  	 */
	.mousedown(function(event) {
    if(event.which==1)
    {
        if($(event.currentTarget).data('oneclck')==1)
        {
			if (modeLecture != 3) {
        	$("#pointx"+valeurCompteur).remove();
       		$("#pointy"+valeurCompteur).remove();
       		$("#ligne"+valeurCompteur).remove();
        	$(this).remove();
		} else {
			// traitement de la suppression de la ligne
			var ligne = $('#ligne');
			ligne.remove();
			numPointLigne -- ;
			if (numPointLigne < 1) numPointLigne = 1;
			$(this).remove();
		};
            return false;
        }
        else
        {
            $(this).data('oneclck', 1);
            setTimeout(function(){
                $(event.currentTarget).data('oneclck', 0);
            }, 300);
        }
    }
})
	
};

</script>
<div id="container">
</div>
Type de lecture pour le prochain point :
<select id="modeLecture">
<option value="1">Lecture des points</option>
<option value="2">Mesure de la longueur de référence</option>
<option value="3">Tracé d'une ligne sur la photo (aide à la mesure)</option>
</select>
<form name="myForm" id="myForm" action="index.php" method="POST">
<input type="hidden" name="photo_id" id="photo_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['photo_id'];?>
">
<input type="hidden" name="module" value="photolectureWrite"}
<input type="hidden" name="lecteur_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['lecteur_id'];?>
">
Taille originale de la photo : 
<input name="photo_width" id="photo_width" value="<?php echo $_smarty_tpl->tpl_vars['photo']->value['photo_width'];?>
" readonly>x
<input name="photo_height" id="photo_height" value="<?php echo $_smarty_tpl->tpl_vars['photo']->value['photo_height'];?>
" readonly>
<br>Taille de lecture de la photo :
<input name="image_width" id="image_width" value="<?php echo $_smarty_tpl->tpl_vars['image_width']->value;?>
" readonly>x
<input name="image_height" id="image_height" value="<?php echo $_smarty_tpl->tpl_vars['image_height']->value;?>
" readonly>
<br>Coefficient de correction de la taille : 
<input name="coef_correcteur" id="coef_correcteur" value="<?php echo $_smarty_tpl->tpl_vars['coef_correcteur']->value;?>
" readonly>
<h3>Points sélectionnés</h3>
<table id="tableData">
<tr>
<td colspan='5'>
Enregistrez les points positionnés : 
<input type="submit">
</td>
</tr>
<tr>
<th>N°</th>
<th>X</th>
<th>Y</th>
<th>Ordre de<br>lecture</th>
<th>Point de mesure<br>de la longueur<br>de référence</th>
</tr>
</table>
</form>
Pour supprimer un point, réalisez un double-clic sur celui-ci.
<br>
Vous pouvez modifier manuellement l'ordre de lecture d'un point, si nécessaire.
<br>
Pour tracer une ligne, positionnez le premier point, puis le second. Pour supprimer la ligne, supprimez d'abord le second point, avant de toucher au premier point.<?php }} ?>