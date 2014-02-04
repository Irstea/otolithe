<h2>{$LANG["gestion"].101}</h2>
<a href="index.php?module={$moduleListe}">{$LANG["gestion"].0}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">{$LANG["gestion"].64}</a>
{include file="gestion/individuCartouche.tpl"}
<h3>{$LANG["gestion"].102}</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{$LANG["gestion"].98} :</td>
<td>{if $droits.gestion == 1}
<a href="index.php?module=pieceChange&piece_id={$data.piece_id}&individu_id={$data.individu_id}">
{/if}
{$data.piecetype_libelle}
{if $droits.gestion == 1}</a>{/if}
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].99} :</td>
<td>{$data.piececode}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].100} :</td>
<td>{$data.traitementpiece_libelle}</td>
</tr>
</table>
<h3>{$LANG["gestion"].103}</h3>
{if $droits.gestion == 1}
<a href="index.php?module=photoChange&photo_id=0&piece_id={$data.piece_id}">{$LANG["gestion"].104}</a>
{/if}
<table>
<thead>
<tr>
<th>{$LANG["gestion"].105}</th>
<th>{$LANG["gestion"].67}</th>
<th>{$LANG["gestion"].106}</th>
<th>{$LANG["gestion"].71} ?</th>
<th>{$LANG["gestion"].107}</th>
<th>{$LANG["gestion"].108}</th>
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
<a href="index.php?module=photoDisplay&photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}">
<img src="{$photo[lst].photoPath}" height="200" border="0">
</a>
</td>
</tr>
{/section}
</tdata>
</table>
