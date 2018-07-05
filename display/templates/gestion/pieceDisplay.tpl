<h2>Affichage d'une pièce</h2>
<a href="index.php?module={$moduleListe}">{t}Retour à la liste{/t}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">{t}Retour au détail du poisson{/t}</a>
{include file="gestion/individuCartouche.tpl"}
<h3>{t}Détail de la pièce{/t}</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{t}Type de pièce :{/t}</td>
<td>{if $droits.gestion == 1}
<a href="index.php?module=pieceChange&piece_id={$data.piece_id}&individu_id={$data.individu_id}">
{/if}
{$data.piecetype_libelle}
{if $droits.gestion == 1}</a>{/if}
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Code de la pièce :{/t}</td>
<td>{$data.piececode}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Traitement effectué :{/t}</td>
<td>{$data.traitementpiece_libelle}</td>
</tr>
</table>
<h3>{t}Photos rattachées{/t}</h3>
{if $droits.gestion == 1}
<a href="index.php?module=photoChange&photo_id=0&piece_id={$data.piece_id}">Nouvelle photo</a>
{/if}
<table>
<thead>
<tr>
<th>{t}Nom{/t}</th>
<th>{t}Description{/t}</th>
<th>{t}Date{/t}</th>
<th>{t}Couleur ?{/t}</th>
<th>{t}Dimensions{/t}</th>
<th>{t}Miniature{/t}</th>
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
<td class="center">{$photo[lst].color}</td>
<td>{$photo[lst].photo_width}x{$photo[lst].photo_height}</td>
<td>
<a href="index.php?module=photoDisplay&photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}">
<img src="index.php?module=photoGetThumbnail&photo_id={$photo[lst].photo_id}" height="200" border="0">
</a>
</td>
</tr>
{/section}
</tdata>
</table>
