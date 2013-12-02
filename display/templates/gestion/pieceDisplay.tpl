<h2>Affichage d'une pièce</h2>
<a href="index.php?module={$moduleListe}">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">Retour au détail du poisson</a>
{include file="gestion/individuCartouche.tpl"}
<h3>Détail de la pièce</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Type de pièce :</td>
<td>{if $droits.gestion == 1}
<a href="index.php?module=pieceChange&piece_id={$data.piece_id}&individu_id={$data.individu_id}">
{/if}
{$data.piecetype_libelle}
{if $droits.gestion == 1}</a>{/if}
</td>
</tr>
<tr>
<td class="libelleSaisie">Code de la pièce :</td>
<td>{$data.piececode}</td>
</tr>
<tr>
<td class="libelleSaisie">Type de traitement :</td>
<td>{$data.traitementpiece_libelle}</td>
</tr>
</table>
<h3>Photos rattachées</h3>
{if $droits.gestion == 1}
<a href="index.php?module=photoChange&photo_id=0&piece_id={$data.piece_id}">Nouvelle photo</a>
{/if}
<table>
<thead>
<tr>
<th>Nom</th>
<th>Description</th>
<th>Date</th>
<th>Couleur ?</th>
<th>Dimensions</th>
<th>Miniature</th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$photo}
<tr>
<td>
<a href="index.php?module=photoDisplay&photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}">
{$photo[lst].photo_nom}
</a>
</td>
<td>{$photo[lst].description}</td>
<td>{$photo[lst].photo_date}</td>
<td>{$photo[lst].color}</td>
<td>{$photo[lst].photo_width}x{$photo[lst].photo_height}</td>
<td>
<a href="index.php?module=photoDisplayPhoto&photo_id={$photo[lst].photo_id}" title="Attention : le temps de chargement peut être long, selon la taille de la photo !">
<img src="index.php?module=photoGetThumbnail&photo_id={$photo[lst].photo_id}" width="200" border="0">
</a>
</td>
</tr>
{/section}
</tdata>
</table>
