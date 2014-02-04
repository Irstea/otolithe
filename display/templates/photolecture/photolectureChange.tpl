<script type="text/javascript" src="display/javascript/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<script type="text/javascript" src="display/javascript/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
<script type="text/javascript" src="display/javascript/jquerysvg/jquery.svg.js"></script>

<style type="text/css">
@import "display/javascript/jquerysvg/jquery.svg.css";
{literal}
body > iframe { display: none; }
{/literal}
</style>

<script>
{literal}
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
	//var lien = "index.php?module=photoGetPhoto&photo_id="+photo_id+"&sizeX="+image_width+"&sizeY="+image_height;
	{/literal}
	var lien = "{$photo.photoPath}";
	{literal}
	var myImage = svg.image(0, 0, image_width, image_height, lien);
	$(myImage).click(function(e){
		   //var parentOffset = $(this).parent().offset(); 
		   //or $(this).offset(); if you really just want the current element's offset
		   var parentOffset = $(this).offset();
		   var relX = e.pageX - parentOffset.left;
		   var relY = e.pageY - parentOffset.top;
		   var svg = $('#container').svg('get');
		   setCircle(svg, relX, relY, 0);
		});
	/*
     * Generation des points existants (mode modification)
     */
	{/literal}
{if $data.photolecture_id > 0}
$("#modeLecture").val(1);
{section name="lst" loop=$data.points}
{if $smarty.section.lst.index == 0 }
var rayon_initial = 1;
{else}
var rayon_initial = 0;
{/if}
setCircle(svg,{$data.points[lst].x},{$data.points[lst].y},rayon_initial);
{/section}
$("#modeLecture").val(2);
{section name="lst" loop=$data.points_ref_lecture}
setCircle(svg,{$data.points_ref_lecture[lst].x},{$data.points_ref_lecture[lst].y},0);
{/section}
$("#modeLecture").val(1);
{/if}
	{literal}
	};

function setCircle(svg, x, y, rayon_initial) {
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
		if (modeLecture == 0 || rayon_initial == 1) {
			var rayon = $("#rayon_cercle").val();
		} else {
			var rayon = 7;
		}
		svg.circle(myCircle, X, Y, rayon, {
		id: ident, stroke: couleur, fill: 'rgba(0,0,0,0)'});
		svg.line(myCircle, X, Y - 7, X, Y + 7, {stroke: couleur, strokeWidth: 1});
		svg.line(myCircle, X - 7, Y, X + 7, Y, {stroke: couleur, strokeWidth: 1});
		svg.text(myCircle, X + 20, Y + 20, valeurCompteur+"", { 'text-anchor':'middle', 'fill':couleur, 'pointer-events': 'none'});
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
		pointReference = '<td><input type="text" size="10" name="pointRef'+valeurCompteur+'" id="pointRef'+valeurCompteur+'" value="1" ></td>';
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
		$(this).css({"cursor":"pointer"});
	})
/*	.mouseenter(function() {
		$("#text"+valeurCompteur).attr("disable","false");
	})
	.mouseleave(function() {
		$("#text"+valeurCompteur).attr("disable","true");
	})*/
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
{/literal}
</script>
<h2>{$LANG["gestion"].110}</h2>
<a href="index.php?module={$moduleListe}" onclick="return confirm('{$LANG["message"][33]}')">{$LANG["gestion"].0}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$piece.individu_id}" onclick="return confirm('{$LANG["message"][33]}')">{$LANG["gestion"].64}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$piece.piece_id}" onclick="return confirm('{$LANG["message"][33]}')">{$LANG["gestion"].65}</a> >
<a href="index.php?module=photoDisplay&photo_id={$data.photo_id}" onclick="return confirm('{$LANG["message"][33]}')">{$LANG["gestion"].111}</a>
<table class="tablemulticolonne">
<tr>
<td>
{include file="gestion/individuCartouche.tpl"}
</td>
<td>
{include file="gestion/pieceCartouche.tpl"}
</td>
</tr>
</table>
<form name="myForm" id="myForm" action="index.php" method="POST">
{$LANG["gestion"].112} : 
<input type="submit" value="{$LANG["message"].19}">
<div id="container">
</div>
{$LANG["gestion"].113} :
<select id="modeLecture">
<option value="0">{$LANG["gestion"].114}</option>
<option value="1">{$LANG["gestion"].115}</option>
<option value="2">{$LANG["gestion"].116}</option>
<option value="3">{$LANG["gestion"].117}</option>
</select>
<input type="hidden" name="photo_id" id="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photolectureWrite"}>
<input type="hidden" name="lecteur_id" id="lecteur_id" value="{$data.lecteur_id}">
<input type="hidden" name="photolecture_date" value="{$data.photolecture_date}">
<input type="hidden" name="photolecture_id" value="{$data.photolecture_id}">
{$LANG["gestion"].118} : 
<input name="photo_width" id="photo_width" value="{$photo.photo_width}" readonly>x
<input name="photo_height" id="photo_height" value="{$photo.photo_height}" readonly>
<br>{$LANG["gestion"].119} :
<input name="photolecture_width" id="image_width" value="{$image_width}" readonly>x
<input name="photolecture_height" id="image_height" value="{$image_height}" readonly>
<br>{$LANG["gestion"].120} : 
<input name="coef_correcteur" id="coef_correcteur" value="{$coef_correcteur}" readonly>
<br>{$LANG["gestion"].121} : 
<input id="rayon_cercle" name="rayon_point_initial" value="{$data.rayon_point_initial}">
<br>{$LANG["gestion"].122} ? 
<input type="radio" name="calculAuto" value="1" checked>{$LANG["message"]["yes"]}
<input type="radio" name="calculAuto" value="0" >{$LANG["message"]["no"]}

<h3>{$LANG["gestion"].123}</h3>
<table id="tableData">
<tr>
<td colspan='5'>
{$LANG["gestion"].112} : 
<input type="submit" value="{$LANG["message"].19}">
</td>
</tr>
<tr>
<th>{$LANG["gestion"].124}</th>
<th>X</th>
<th>Y</th>
<th>{$LANG["gestion"].125}<br>{$LANG["gestion"].126}</th>
<th>{$LANG["gestion"].127}<br>{$LANG["gestion"].128}<br>{$LANG["gestion"].129}</th>
</tr>
</table>
</form>
{$LANG["gestion"].130}.
<br>
{$LANG["gestion"].131}.
<br>
{$LANG["gestion"].132}
<br>
{$LANG["gestion"].133}