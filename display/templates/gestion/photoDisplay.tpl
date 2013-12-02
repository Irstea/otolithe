<h2>Affichage d'une photo</h2>
<a href="index.php?module={$moduleListe}">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id={$piece.individu_id}">Retour au détail du poisson</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">Retour au détail de la pièce</a>
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
{if $droits.gestion == 1}
<a href="index.php?module=photoChange&photo_id={$data.photo_id}&piece_id={$data.piece_id}">
Modifier la photo...
</a>
{/if}
<table class="tablemulticolonne">
<tr>
<td>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Nom de la photo : </td>
<td>
{$data.photo_nom}
</td>
</tr>
<tr>
<td class="libelleSaisie">Description : </td>
<td>{$data.description}</td>
</tr>
<tr>
<td class="libelleSaisie">Nom du fichier : </td>
<td>{$data.photo_filename}</td>
</tr>
<tr>
<td class="libelleSaisie">Date de prise de vue : </td>
<td>{$data.photo_date}</td>
</tr>
<tr>
<td class="libelleSaisie">Couleur : </td>
<td>
{if $data.color == "NB"}Noir et blanc{else}Couleur{/if}
</td>
</tr>
<tr>
<td class="libelleSaisie">Type de lumière : </td>
<td>{$data.lumieretype_libelle}</td>
</tr>
<tr>
<td class="libelleSaisie">Grossissement : </td>
<td>{$data.grossissement}</td>
</tr>
<tr>
<td class="libelleSaisie">Repère : </td>
<td>{$data.repere}</td>
</tr>
<tr>
<td class="libelleSaisie">URI : </td>
<td>{$data.uri}</td>
</tr>
<tr>
<td class="libelleSaisie">Longueur de la référence : </td>
<td>{$data.long_reference}</td>
</tr>
<tr>
<td class="libelleSaisie">Taille de la photo : </td>
<td>{$data.photo_width}x{$data.photo_height}</td>
</tr>
</table>
</td>
<td>
<a href="index.php?module=photoDisplayPhoto&photo_id={$data.photo_id}" title="Attention : le temps de chargement peut être (très) long, selon la taille originale de la photo !">
<img src="index.php?module=photoGetThumbnail&photo_id={$data.photo_id}">
</a>
</td>
</tr>
</table>
{if $droits.lecture == 1}
<form name="lecture" action="index.php" method="get">
<input type="hidden" name="module" value="photolectureChange">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="photolecture_id" value="0">
Résolution (approximative) de lecture : 
<select name="resolution">
<option value="1">800x600</option>
<option value="2">1024x768</option>
<option value="3">1280x1024</option>
</select>
<input type="submit" value="Réaliser une nouvelle lecture">
</form>
{/if}
<form name="affichage" action="index.php" methode="get">
<input type="hidden" name="module" value="photolectureDisplay">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<table>
<thead>
<tr>
{if $droits.lecture == 1}
<th>Modif</th>
{/if}
<th>Lecteur</th>
<th>Date de lecture</th>
<th>Résolution</th>
<th>Age (nb de points<br>positionnés)</th>
<th>Longueur de<br>référence mesurée</th>
<th>Longueur totale lue</th>
<th>Longueur réelle<br>calculée</th>
{if $droits.admin == 1}
<th>Supprimer</th>
{/if}
<th>Consulter...</th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$photolecture}
<tr>
{if $droits.lecture == 1}
<td>
<div class="center">
<a href="index.php?module=photolectureChange&photolecture_id={$photolecture[lst].photolecture_id}&photo_id={$data.photo_id}">
<img src="display/images/edit.png" height="24" border="0">
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
<td>
<div class="center">
{$photolecture[lst].age}
</div>
</td>
<td>
{$photolecture[lst].long_ref_mesuree}
</td>
<td>
{$photolecture[lst].long_totale_lue}
</td>
<td>
{$photolecture[lst].long_totale_reel}
</td>
{if $droits.admin == 1}
<td>
<div class="center">
<a href="index.php?module=photolectureDelete&photolecture_id={$photolecture[lst].photolecture_id}&photo_id={$data.photo_id}" onclick="return confirm('Confirmez-vous la suppression ?'); return false">
<img src="display/images/delete.png" height="24" border="0">
</a>
</div>
</td>
{/if}
<td>
<div class="center">
<input type="checkbox" name="photolecture_id[]" value="{$photolecture[lst].photolecture_id}" checked>
</div>
</td>
</tr>
{/section}
</tdata>
</table>
Résolution (approximative) d'affichage : 
<select name="resolution">
<option value="1">800x600</option>
<option value="2">1024x768</option>
<option value="3">1280x1024</option>
</select>
<input type="submit" value="Déclencher l'affichage des lectures sélectionnées">
</form>