<script type="text/javascript" src="/display/javascript/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/display/javascript/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
<script type="text/javascript" src="/display/javascript/jquerysvg/jquery.svg.js"></script>

<style type="text/css">
@import "/display/javascript/jquerysvg/jquery.svg.css";
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
	var r = 0;
	var cx = 0;
	var cy = 0;
	var couleur = "";
	var fillOpacity = 0;
	{/literal}
	var lien = "index.php?module=photoGetPhoto&photo_id={$photo.photo_id}&sizeX={$image_width}&sizeY={$image_height}";
	{literal}
	var myImage = svg.group();
	svg.image(myImage, 0, 0, image_width, image_height, lien);
	//var myImage = svg.image(0, 0, image_width, image_height, "");
	{/literal}
	{section name="lst" loop=$mesurePrec}
	{section name="lst1" loop=$mesurePrec[lst].points}
{if $smarty.section.lst1.index == 0 }
{assign var = 'r' value = $mesurePrec[lst].rayon_point_initial}
{else}
{assign var = 'r' value = '7'}
{/if}
cx = '{$mesurePrec[lst].points[lst1].x}';
cy = '{$mesurePrec[lst].points[lst1].y}';
r = '{$r}';
couleur = '{$mesurePrec[lst].couleur}';
fillOpacity = '{$fill}';
{literal}
svg.circle (myImage, cx, cy, r, {'stroke':couleur, 'fill':couleur, 'fill-opacity': fillOpacity});
{/literal}
{/section}
{/section}
	
{literal}	
$("#resetCompteur").click(function() { 
	console.log("reinitialisation du compteur");
	compteur = 0;
});
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
       		if ((valeurCompteur + 1) == compteur) {
       			compteur --;
       		}
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
<h2>{t}Mesure d'un otolithe ou d'une pièce calcifiée{/t}</h2>
<a href="index.php?module={$moduleListe}" onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour à la liste{/t}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$piece.individu_id}" onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour au détail du poisson{/t}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$piece.piece_id}" onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour au détail de la pièce{/t}</a> >
<a href="index.php?module=photoDisplay&photo_id={$data.photo_id}" onclick="return confirm('{t}Les modifications apportées dans cette page vont être perdues. Confirmez-vous cette opération ?{/t}')">{t}Retour à la photo{/t}</a>
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
{t}Enregistrez les points positionnés :{/t} 
<input type="submit" value="Valider">
{t}Si tous les points ont été supprimés, vous pouvez :{/t} 
<input type="button" id="resetCompteur" value="{t}Réinitialiser le compteur{/t}" title="{t}Uniquement si tous les points ont été supprimés{/t}">
<div id="container">
</div>
{t}Type de lecture pour le prochain point :{/t}
<select id="modeLecture">
<option value="0">{t}Point initial avec cercle élargi{/t}</option>
<option value="1">{t}Lecture des points{/t}</option>
<option value="2">{t}Mesure de la longueur de référence{/t}</option>
<option value="3">{t}Tracé d'une ligne sur la photo (aide à la mesure){/t}</option>
</select>
<input type="hidden" name="photo_id" id="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photolectureWrite"}>
<input type="hidden" name="lecteur_id" id="lecteur_id" value="{$data.lecteur_id}">
<input type="hidden" name="photolecture_date" value="{$data.photolecture_date}">
<input type="hidden" name="photolecture_id" value="{$data.photolecture_id}">
{t}Taille originale de la photo :{/t} 
<input name="photo_width" id="photo_width" value="{$photo.photo_width}" readonly>x
<input name="photo_height" id="photo_height" value="{$photo.photo_height}" readonly>
<br>{t}Taille de lecture de la photo :{/t}
<input name="photolecture_width" id="image_width" value="{$image_width}" readonly>x
<input name="photolecture_height" id="image_height" value="{$image_height}" readonly>
<br>{t}Coefficient de correction de la taille :{/t} 
<input name="coef_correcteur" id="coef_correcteur" value="{$coef_correcteur}" readonly>
<br>{t}Rayon (en pixels) du cercle élargi :{/t}
<input id="rayon_cercle" name="rayon_point_initial" value="{$data.rayon_point_initial}">
<br>{t}Recalcul automatique de l'ordre des points ?{/t} 
<input type="radio" name="calculAuto" value="1" checked>{t}oui{/t}
<input type="radio" name="calculAuto" value="0" >{t}non{/t}
<br>{t}Nature de la strie finale :{/t} 
<select name="final_stripe_id">
<option value="" {if $data.final_stripe_id == ""}selected{/if}></option>
{section name=lst loop=$finalStripe}
<option value="{$finalStripe[lst].final_stripe_id}" {if $finalStripe[lst].final_stripe_id == $data.final_stripe_id}selected{/if}>
{$finalStripe[lst].final_stripe_code} {$finalStripe[lst].final_stripe_libelle}
</option>
{/section}
</select>
<br>
{t}Fiabilité de la lecture :{/t} 
<select name="read_fiability">
<option value="" {if $data.read_fiability == ""}selected{/if}></option>
<option value="0" {if $data.read_fiability == "0"}selected{/if}>0</option>
<option value="0.5" {if $data.read_fiability == "0.5"}selected{/if}>0.5</option>
<option value="1" {if $data.read_fiability == "1"}selected{/if}>1</option>
</select>
<br>
{t}Lecture consensuelle :{/t}
<input type="radio" value="1" name="consensual_reading" {if $data.consensual_reading == 1}checked{/if}>{t}oui{/t}
<input type="radio" value="0" name="consensual_reading" {if $data.consensual_reading != 1}checked{/if}>{t}non{/t}
<br>{t}Année de naissance estimée :{/t}
<input class="nombre" name="annee_naissance" value="{$data.annee_naissance}">

<h3>{t}Points sélectionnés{/t}</h3>
<table id="tableData">
<tr>
<td colspan='5'>
{t}Enregistrez les points positionnés :{/t} 
<input type="submit" value="{t}Valider{/t}">
</td>
</tr>
<tr>
<th>{t}N°{/t}</th>
<th>X</th>
<th>Y</th>
<th>{t}Ordre de lecture{/t}</th>
<th>{t}Point de mesure de la longueur de référence{/t}</th>
</tr>
</table>
</form>
{t}Pour supprimer un point, réalisez un double-clic sur celui-ci.{/t}
<br>
{t}Vous pouvez modifier manuellement l'ordre de lecture d'un point, si nécessaire.{/t}
<br>
{t}Pour tracer une ligne, positionnez le premier point, puis le second. Pour supprimer la ligne, supprimez d'abord le second point, avant de toucher au premier point.{/t}
<br>
{t}Le recalcul automatique de l'ordre des points ne fonctionne que si le premier point (origine) est saisi en premier (valeur "ordre de lecture" la plus faible de la série).{/t}
<h3>{t}Légende{/t}</h3>
{section name="lst" loop=$mesurePrec}
<div style="background-color:{$mesurePrec[lst].couleur};display:inline">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
&nbsp;
{$mesurePrec[lst].lecteur_prenom} {$mesurePrec[lst].lecteur_nom} - {t}lecture du{/t} {$mesurePrec[lst].photolecture_date}
 - {t}Résolution{/t} : {$mesurePrec[lst].photolecture_width}x{$mesurePrec[lst].photolecture_height}
<br>
{/section}
