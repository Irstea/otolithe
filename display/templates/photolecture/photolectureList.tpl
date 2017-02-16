<h2>{$LANG["gestion"].137}</h2>
{include file="photolecture/lectureSearch.tpl"}
{if $isSearch == 1}
{if $droits.gestion == 1}
<a href="index.php?module=photolectureExport" title="{$LANG["gestion"].152}">{$LANG["gestion"].153}</a>
{/if}
<script>
setDataTables("idListe",true , false, true, 100);
</script>
<table id="idListe" class="tableliste">
<thead>
<tr>
<th>{$LANG["gestion"].138}</th>
<th>{$LANG["gestion"].139}<br>{$LANG["gestion"].140}</th>
<th>{$LANG["gestion"].141}<br>{$LANG["gestion"].142}</th>
<th>{$LANG["gestion"].144}</th>
<th>{$LANG["gestion"].145}</th>
<th>{$LANG["gestion"].146}</th>
<th>{$LANG["gestion"].147}</th>
<th>{$LANG["gestion"].148}</th>
<th>{$LANG["gestion"].143}</th>
<th>{$LANG["gestion"].149}</th>
<th>{$LANG["gestion"].150}</th>
<th>{$LANG["gestion"].12}</th>
{if $droits.gestion == 1}
<th class="center">
<img src="display/images/delete.png" height="25">
</th>
{/if}
</tr>
</thead>
<tdata>
{section name="lst" loop=$data}
<tr>
<td>
<a href="index.php?module=individuDisplay&individu_id={$data[lst].individu_id}">
{$data[lst].codeindividu}<br>{$data[lst].tag}
</a>
</td>
<td>
<a href="index.php?module=pieceDisplay&piece_id={$data[lst].piece_id}">
{$data[lst].piecetype_libelle}
</a>
<br>{$data[lst].traitementpiece_libelle}</td>
<td>
<a href="index.php?module=photoDisplay&photo_id={$data[lst].photo_id}">
{$data[lst].photo_nom}
</a>
<br>{$data[lst].color}</td>
<td><div class="center">{$data[lst].photo_width}x{$data[lst].photo_height}</div></td>
<td>{$data[lst].photo_date}</td>
<td><div class="center">{$data[lst].long_reference}</div></td>
<td>{$data[lst].lecteur_prenom} {$data[lst].lecteur_nom}</td>
<td>
<a href="index.php?module=photolectureDisplay&photolecture_id={$data[lst].photolecture_id}&photo_id={$data[lst].photo_id}">
{$data[lst].photolecture_date}
</a>
</td>
<td><div class="center">{$data[lst].photolecture_width}x{$data[lst].photolecture_height}</div></td>
<td>{$data[lst].long_ref_mesuree}</td>
<td>{$data[lst].long_totale_reel}</td>
<td><div class="center">{$data[lst].age}</div></td>
{if $droits.gestion == 1}
<td class="center">
<a href="index.php?module=photolectureDelete&photolecture_id={$data[lst].photolecture_id}">
<img src="display/images/delete.png" height="25">
</a>
</td>
{/if}
</tr>
{/section}
</tdata>
</table>

{/if}
<br>
