<script>
$(document).ready(function() {
	/*
	 * gestion des cookies pour conserver les valeurs sélectionnées
	 */
	var ck_resolution = Cookies.get('resolution');
	if (ck_resolution === undefined) {
		ck_resolution = 1;
	}
	$(".resolution").val(ck_resolution).change();
	$(".resolution").change( function() {
		Cookies.set('resolution', $(this).val(), { expires: 30,  secure: true });
	});
	var ck_fill = Cookies.get ('fillFactor');
	if (ck_fill === undefined) {
		ck_fill = 1;
	}
	$("#fill").val(ck_fill).change();
	$("#fill").change(function() {
		Cookies.set('fillFactor', $(this).val(), { expires: 30, secure: true });
	});
});
</script>

<h2>{t}Affichage d'une photo{/t}</h2>
<div class="col-sm-12">
<a href="index.php?module={$moduleListe}">{t}Retour à la liste{/t}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$piece.individu_id}">{t}Retour au détail du poisson{/t}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">{t}Retour au détail de la pièce{/t}</a>
</div>
<div class="col-lg-6 col-sm-12">
{include file="gestion/individuCartouche.tpl"}
{include file="gestion/pieceCartouche.tpl"}
</div>

{if $droits.gestion == 1}
<div class="col-sm-12">
<a href="index.php?module=photoChange&photo_id={$data.photo_id}&piece_id={$data.piece_id}">
{t}Modifier la photo...{/t}
</a>
</div>
{/if}
<div class="col-sm-12">
<div class="form-display col-sm-12 col-md-8">
<dl class="dl-horizontal">
<dt>{t}Nom de la photo :{/t} </dt>
<dd>{$data.photo_nom}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Description :{/t} </dt>
<dd>{$data.description}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Nom du fichier :{/t} </dt>
<dd>{$data.photo_filename}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Date de prise de vue :{/t} </dt>
<dd>{$data.photo_date}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Couleur :{/t} </dt>
<dd>
{if $data.color == "NB"}{t}Noir et blanc{/t}{else}{t}Couleur{/t}{/if}
</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Type de lumière :{/t} </dt>
<dd>{$data.lumieretype_libelle}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Grossissement :{/t} </dt>
<dd>{$data.grossissement}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Repère :{/t} </dt>
<dd>{$data.repere}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}URI :{/t} </dt>
<dd>{$data.uri}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Repère de mesure - longueur de référence :{/t} </dt>
<dd>{$data.long_reference}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Taille en pixels de la longueur de référence dans la photo :{/t} </dt>
<dd>{$data.long_ref_pixel}</dd>
</dl>
<dl class="dl-horizontal">
<dt>{t}Dimensions de la photo :{/t} </dt>
<dd>{$data.photo_width}x{$data.photo_height}</dd>
</dl>
</div>
<div class="col-md-4 col-sm-12">
<a href="index.php?module=photoDisplayPhoto&photo_id={$data.photo_id}" title="{t}Attention : le temps de chargement peut être (très) long, selon la taille originale de la photo !{/t}">
<!--  img src="{$photoPath}"-->
<img src="index.php?module=photoGetThumbnail&photo_id={$data.photo_id}">
</a>
</div>
</div>
{if $droits.lecture == 1}
<div class="col-sm-12">
<div class="col-sm-12 col-lg-8">
<div class="form-horizontal protoform">
<fieldset>
<legend>{t}Création d'une nouvelle lecture simple{/t}</legend>
<form name="lecture" action="index.php" method="get">
<input type="hidden" name="module" value="photolectureChange">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="photolecture_id" value="0">
{t}Résolution (approximative) de lecture :{/t} 
<select class="resolution" name="resolution">
<option  value="1">800x600</option>
<option  value="2">1024x768</option>
<option  value="3">1280x1024</option>
<option  value="4">1600x1300</option>
<option value="5">{t}format initial{/t}</option>
</select>
<input type="submit" value="{t}Réaliser une nouvelle lecture{/t}">
</form>
</fieldset>
</div>
</div>
</div>
{/if}
<div style="border-style:solid;border-width: 1px;padding:5px;">
<h3>{t}Consultations individuelles, globales, modifications avec visualisation des points déjà tracés{/t}
{if $ageDisplay != 1}
<a href="index.php?module=photoDisplay&photo_id={$data.photo_id}&ageDisplay=1">
{t}Afficher l'age calculé (nbre de points positionnés - 1) par chaque lecteur{/t}
</a>
{else}
<a href="index.php?module=photoDisplay&photo_id={$data.photo_id}&ageDisplay=0">
{t}Masquer l'age calculé (nbre de points positionnés - 1) par chaque lecteur{/t}
{/if}
</a>
</h3>
<form name="affichage" action="index.php" methode="get">
<input type="hidden" name="module" value="photolectureSwap">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<table>
<thead>
<tr>
{if $droits.lecture == 1}
<th>{t}Modification unique{/t}</th>
{/if}
<th>{t}Lecteur{/t}</th>
<th>{t}Date de lecture{/t}</th>
<th>{t}Résolution{/t}</th>
{if $ageDisplay == 1}
<th>{t}Age ou nb de segments positionnés (nb points - 1){/t}</th>
<th>{t}Strie finale{/t}</th>
<th>{t}Année de naissance estimée{/t}</th>
<th>{t}Fiabilité de la lecture{/t}</th>
{/if}
<th>{t}Longueur de référence mesurée{/t}</th>
<th>{t}Longueur totale lue{/t}</th>
<th>{t}Longueur réelle calculée{/t}</th>
<th>{t}Lecture consensuelle{/t}</th>
{if $droits.admin == 1}
<th>{t}Supprimer{/t}</th>
{/if}
<th>{t}Consulter...{/t}</th>
<th><div title="{t}Si coché, la lecture sélectionnée pourra être modifiée{/t}">{t}Lecture à modifier{/t}</div></th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$photolecture}
<tr>
{if $droits.lecture == 1}
<td>
<div class="center">
<a href="index.php?module=photolectureChange&photolecture_id={$photolecture[lst].photolecture_id}&photo_id={$data.photo_id}">
<img src="/display/images/edit.png" height="24" border="0">
</a>
</div>
</td>
{/if}
<td>
<a href="index.php?module=photolectureDisplay&photo_id={$data.photo_id}&photolecture_id={$photolecture[lst].photolecture_id}">
{$photolecture[lst].lecteur_prenom} {$photolecture[lst].lecteur_nom}
</a>
</td>
<td>
{$photolecture[lst].photolecture_date}
</td>
<td>
<div class="center">
{$photolecture[lst].photolecture_width}x{$photolecture[lst].photolecture_height}
</div>
</td>
{if $ageDisplay == 1}
<td>
<div class="center">
{$photolecture[lst].age}
</div>
</td>
<td class="center">
{$photolecture[lst].final_stripe_code}
</td>
<td class="center">
{$photolecture[lst].annee_naissance}
</td>
<td class="center">
{$photolecture[lst].read_fiability}
</td>
{/if}
<td>
{$photolecture[lst].long_ref_mesuree}
</td>
<td>
{$photolecture[lst].long_totale_lue}
</td>
<td>
{$photolecture[lst].long_totale_reel}
</td>
<td class="center">
{if $photolecture[lst].consensual_reading == 1}{$LANG["message"].15}{/if}
</td>
{if $droits.gestion == 1}
<td>
<div class="center">
<a href="index.php?module=photolectureDelete&photolecture_id={$photolecture[lst].photolecture_id}&photo_id={$data.photo_id}" onclick="return confirm('Confirmez-vous la suppression ?'); return false">
<img src="/display/images/delete.png" height="24" border="0">
</a>
</div>
</td>
{/if}
<td>
<div class="center">
<input type="checkbox" name="photolecture_id[]" value="{$photolecture[lst].photolecture_id}" checked>
</div>
</td>
<td>
<div class="center">
<input type="radio" name="photolecture_id_modif" value="{$photolecture[lst].photolecture_id}">
</div>
</td>
</div>
</tr>
{/section}
</tdata>
</table>
{t}Résolution (approximative) d'affichage :{/t}
<select class="resolution" name="resolution">
<option value="1">800x600</option>
<option value="2">1024x768</option>
<option value="3">1280x1024</option>
<option value="4">1600x1300</option>
<option value="5">{t}format initial{/t}</option>
</select>
{t}Facteur de transparence des cercles affichés :{/t}
<select id="fill" name="fill">
<option value="0">{t}Transparent{/t}</option>
<option value="0.1">{t}Légèrement ombré{/t}</option>
<option value="0.3">{t}Ombré{/t}</option>
<option value="0.5">{t}Semi-opaque{/t}</option>
<option value="1">{t}Opaque{/t}</option>
</select>
<br>
{t}Avec création d'une nouvelle lecture :{/t} 
<input type="checkbox" name="photolecture_id_modif" value="0">
<br>
<div style="text-align:center;">
<input type="submit" value="{t}Déclencher l'affichage des lectures sélectionnées, avec ou sans création/modification d'une lecture{/t}">
</div>
</form>
</div>