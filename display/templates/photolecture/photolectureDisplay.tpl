<style type="text/css">
@import "display/javascript/jquerysvg/jquery.svg.css";
{literal}
body > iframe { display: none; }
#container { {/literal} width: {$image_width}px; height: {$image_height}px; border: 0px ;{literal} }
{/literal}
</style>
<h2>{$LANG["gestion"].134}</h2>
<a href="index.php?module={$moduleListe}">{$LANG["gestion"].0}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$piece.individu_id}">{$LANG["gestion"].64}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$piece.piece_id}">{$LANG["gestion"].65}</a> >
<a href="index.php?module=photoDisplay&photo_id={$photo.photo_id}">{$LANG["gestion"].111}</a>
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
{$LANG["gestion"].135} : {$image_width}x{$image_height}
<div id="container">
<svg xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
	style="width:{$image_width}px;height:{$image_height}px">
<image x="0" y="0" width="{$image_width}" height="{$image_height}"
     xlink:href="index.php?module=photoGetPhoto&photo_id={$photo.photo_id}&sizeX={$image_width}&sizeY={$image_height}" /> 
{section name="lst" loop=$data}
{section name="lst1" loop=$data[lst].points}
{if $smarty.section.lst1.index == 0 }
{assign var = 'r' value = $data[lst].rayon_point_initial}
{else}
{assign var = 'r' value = '7'}
{/if}
<circle cx="{$data[lst].points[lst1].x}" cy="{$data[lst].points[lst1].y}" r="{$r}" style="stroke:{$data[lst].couleur}; fill:{$data[lst].couleur}; fill-opacity:{$fill}"/>
{/section}
{/section}
</svg>
</div>
<h3>{$LANG["gestion"].136}</h3>
{section name="lst" loop=$data}
<div style="background-color:{$data[lst].couleur};display:inline">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
&nbsp;
{$data[lst].lecteur_prenom} {$data[lst].lecteur_nom} - {$LANG["gestion"].151} {$data[lst].photolecture_date}
 - {$LANG["gestion"].86} : {$data[lst].photolecture_width}x{$data[lst].photolecture_height} - 
 {$LANG["gestion"].170} : {$data[lst].final_stripe_code} {$data[lst].final_stripe_value}
 - {$LANG["gestion"].172} : {$data[lst].read_fiability} 
{if $data[lst].consensual_reading == 1} - {$LANG["gestion"].173}{/if}
- {$LANG["gestion"].174} : {$data[lst].annee_naissance}
<br>
{/section}