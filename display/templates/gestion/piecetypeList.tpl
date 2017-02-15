<h2>Liste des types de pièces</h2>
{if $droits["admin"] == 1}
<a href="index.php?module=piecetypeChange&piecetype_id=0">
Nouveau type de pièce...
</a>
{/if}

<table id="ptList" class="tablelist">
<thead>
<tr>
<th>Id</th>
<th>Nom</th>
</tr>
</thead><tbody>
{section name=lst loop=$data}
<tr>
<td>
{if $droits["admin"] == 1}
<a href="index.php?module=piecetypeChange&piecetype_id={$data[lst].piecetype_id}">
{$data[lst].piecetype_id}
</a>
{else}
{$data[lst].piecetype_id}
{/if}
</td>
<td>{$data[lst].piecetype_libelle}</td>
</tr>
{/section}
</tbody>
</table>
