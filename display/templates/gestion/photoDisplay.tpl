<h2>{$LANG["gestion"].79}</h2>
<a href="index.php?module={$moduleListe}">{$LANG["gestion"].0}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$piece.individu_id}">{$LANG["gestion"].64}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">{$LANG["gestion"].65}</a>
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
{$LANG["gestion"].154}...
</a>
{/if}
<table class="tablemulticolonne">
<tr>
<td>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{$LANG["gestion"].66} : </td>
<td>
{$data.photo_nom}
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].67} : </td>
<td>{$data.description}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].69} : </td>
<td>{$data.photo_filename}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].70} : </td>
<td>{$data.photo_date}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].71} : </td>
<td>
{if $data.color == "NB"}{$LANG["gestion"].72}{else}{$LANG["gestion"].71}{/if}
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].73} : </td>
<td>{$data.lumieretype_libelle}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].74} : </td>
<td>{$data.grossissement}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].75} : </td>
<td>{$data.repere}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].80} : </td>
<td>{$data.uri}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].77} : </td>
<td>{$data.long_reference}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].168} : </td>
<td>{$data.long_ref_pixel}</td>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].78} : </td>
<td>{$data.photo_width}x{$data.photo_height}</td>
</tr>
</table>
</td>
<td>
<a href="index.php?module=photoDisplayPhoto&photo_id={$data.photo_id}" title="{$LANG["gestion"].81}">
<!--  img src="{$photoPath}"-->
<img src="index.php?module=photoGetThumbnail&photo_id={$data.photo_id}">
</a>
</td>
</tr>
</table>
{if $droits.lecture == 1}
<div style="border-style:solid;border-width: 1px;padding:5px;">
<h3>{$LANG["gestion"].163}</h3>
<form name="lecture" action="index.php" method="get">
<input type="hidden" name="module" value="photolectureChange">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="photolecture_id" value="0">
{$LANG["gestion"].82} : 
<select name="resolution">
<option value="1">800x600</option>
<option value="2">1024x768</option>
<option value="3">1280x1024</option>
</select>
<input type="submit" value="{$LANG["gestion"].83}">
</form>
</div>
<br>
{/if}
<div style="border-style:solid;border-width: 1px;padding:5px;">
<h3>{$LANG["gestion"].164}
{if $ageDisplay != 1}
<a href="index.php?module=photoDisplay&photo_id={$data.photo_id}&ageDisplay=1">
{$LANG["gestion"].88}
</a>
{else}
<a href="index.php?module=photoDisplay&photo_id={$data.photo_id}&ageDisplay=0">
{$LANG["gestion"].169}
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
<th>{$LANG["gestion"].155}</th>
{/if}
<th>{$LANG["gestion"].84}</th>
<th>{$LANG["gestion"].85}</th>
<th>{$LANG["gestion"].86}</th>
{if $ageDisplay == 1}
<th>{$LANG["gestion"].87}</th>
{/if}
<th>{$LANG["gestion"].89}<br>{$LANG["gestion"].90}</th>
<th>{$LANG["gestion"].91}</th>
<th>{$LANG["gestion"].92}<br>{$LANG["gestion"].93}</th>
{if $droits.admin == 1}
<th>{$LANG["message"].20}</th>
{/if}
<th>{$LANG["gestion"].156}...</th>
<th><div title="{$LANG["gestion"].167}">{$LANG["gestion"].165}</div></th>
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
{if $ageDisplay == 1}
<td>
<div class="center">
{$photolecture[lst].age}
</div>
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
{$LANG["gestion"].94} : 
<select name="resolution">
<option value="1">800x600</option>
<option value="2">1024x768</option>
<option value="3">1280x1024</option>
</select>
{$LANG["gestion"].157} :
<select name="fill">
<option value="0">{$LANG["gestion"].158}</option>
<option value="0.1">{$LANG["gestion"].159}</option>
<option value="0.3">{$LANG["gestion"].160}</option>
<option value="0.5">{$LANG["gestion"].161}</option>
<option value="1">{$LANG["gestion"].162}</option>
</select>
<br>
{$LANG["gestion"].166} : 
<input type="checkbox" name="photolecture_id_modif" value="0">
<br>
<div style="text-align:center;">
<input type="submit" value="{$LANG["gestion"].95}">
</div>
</form>
</div>