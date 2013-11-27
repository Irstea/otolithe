<h2>Affichage d'une photo</h2>
<a href="index.php?module=individuList">Retour à la liste</a> > 
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
<table>
<thead>
<tr>
<th>Lecteur</th>
<th>Date de lecture</th>
<th>Age (nb de points<br>positionnés)</th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$photolecture}
<tr>
<td>
<a href="index.php?module=photolectureChange&photo_id={$data.photo_id}&photolecture_id={$photolecture[lst].photolecture_id}">
{$photolecture[lst].prenom} {$photolecture[lst].nom}
</a>
</td>
</tr>
<tr>
<td>
{$photolecture[lst].photolecture_date}
</td>
</tr>
<tr>
<td>
{$photolecture[lst].age}
</td>
</tr>
{/section}
</tdata>
</table>