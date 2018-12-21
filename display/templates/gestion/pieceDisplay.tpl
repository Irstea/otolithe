<h2>{t}Affichage d'une pièce{/t}</h2>
<a href="index.php?module={$moduleListe}">
<img src="display/images/list.png" height="25">
{t}Retour à la liste{/t}
</a>
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">
<img src="display/images/fish.png" height="25">
{t}Retour au poisson{/t}
</a>
<div class="row">
<div class="col-md-6">
{include file="gestion/individuCartouche.tpl"}
</div>
</div>
<div class="row">
<fieldset class="col-md-6">
<legend>{t}Détail de la pièce{/t}</legend>
{if $droits.gestion == 1}
<a href="index.php?module=pieceChange&piece_id={$data.piece_id}&individu_id={$data.individu_id}">
<img src="display/images/edit.png" height="25">{t}Modifier...{/t}
</a>
{/if}
<div class="form-display">
<dl class="dl-horizontal">
<dt>{t}Type de pièce :{/t}</dt>
<dd>
{$data.piecetype_libelle}
</dd>
</dl>

<dl class="dl-horizontal">
<dt>{t}Code de la pièce :{/t}</dt>
<dd>{$data.piececode}</dd>
</dl>

<dl class="dl-horizontal">
<dt>{t}Traitement effectué :{/t}</dt>
<dd>{$data.traitementpiece_libelle}</dd>
</dl>
</div>
</fieldset>
</div>

<div class="row">
<fieldset class="col-md-6">
<legend>{t}Photos rattachées{/t}</legend>
{if $droits.gestion == 1}
<a href="index.php?module=photoChange&photo_id=0&piece_id={$data.piece_id}">
<img src="display/images/camera.png" height="25">
{t}Nouvelle photo{/t}
</a>
{/if}
<table class="table table-bordered table-hover">
<thead>
<tr>
{if $droits.gestion == 1}
<th class="center"><img src="display/images/edit.png"></th>
{/if}
<th>{t}Nom{/t}</th>
<th>{t}Description{/t}</th>
<th>{t}Date{/t}</th>
<th>{t}Couleur ?{/t}</th>
<th>{t}Dimensions{/t}</th>
<th>{t}Miniature{/t}</th>
</tr>
</thead>
<tbody>
{section name="lst" loop=$photo}
<tr>
{if $droits.gestion == 1}
<td class="center" title="{t}Modifier...{/t}">
<a href="index.php?module=photoChange&photo_id={$photo[lst].photo_id}&piece_id={$data.piece_id}"> 
<img src="display/images/edit.png">
</a>
</td>
{/if}
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
</tbody>
</table>
</fieldset>
</div>
<div class="col-md-6">
<fieldset>
<legend>{t}Liste des métadonnées rattachées{/t}</legend>
{if $droits.gestion == 1}
<a href="index.php?module=piecemetadataChange&piece_id={$data.piece_id}&piecemetadata_id=0">
<img src="display/images/metadata.png" height="25">
{t}Nouveau...{/t}
</a>
{/if}
<table class="table datatable table-bordered table-hover" data-order='[[1,"desc"]]''>
<thead>
<tr>
<th>
{t}Type{/t}
</th>
<th>
{t}Date{/t}
</th>
<th>{t}Commentaire{/t}</th>
</thead>
<tbody>
{foreach $metadatas as $metadata}
    <tr>
    <td>
    {if $droits.gestion == 1}
        <a href="index.php?module=piecemetadataChange&piece_id={$data.piece_id}&piecemetadata_id={$metadata.piecemetadata_id}">
        {$metadata.metadatatype_name}
        </a>
    {else}
        {$metadata.metadatatype_name}
    {/if}
   </td>
    <td>{$metadata.piecemetadata_date}</td>
    <td>{$metadata.piecemetadata_comment}</td>
    </tr>
{/foreach}
</tbody>
</table>
</fieldset>
</div>
</div>
