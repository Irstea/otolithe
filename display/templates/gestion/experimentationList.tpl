<h2>Liste des expérimentations</h2>
{if $droits["admin"] == 1}
<a href="index.php?module=experimentationChange&exp_id=0">
Nouvelle experimentation...
</a>
{/if}

<table id="expList" class="tablelist">
<thead>
<tr>
<th>Id</th>
<th>Nom</th>
<th>Description</th>
<th>Date de début</th>
<th>Date de fin</th>
</tr>
</thead><tbody>
{section name=lst loop=$data}
<tr>
<td>
{if $droits["admin"] == 1}
<a href="index.php?module=experimentationChange&exp_id={$data[lst].exp_id}">
{$data[lst].exp_id}
</a>
{else}
{$data[lst].exp_id}
{/if}
</td>
<td>{$data[lst].exp_nom}</td>
<td>{$data[lst].exp_description}</td>
<td>{$data[lst].exp_debut}</td>
<td>{$data[lst].exp_fin}</td>
</tr>
{/section}
</tbody>
</table>
<script>
setDataTables("expList");
</script>