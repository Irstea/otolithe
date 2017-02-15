<h2>Liste des espèces</h2>


<table id="ptList" class="tableliste">
<thead>
<tr>
<th>Id</th>
<th>Nom latin</th>
<th>Nom français</th>
</tr>
</thead><tbody>
{section name=lst loop=$data}
<tr>
<td>
{$data[lst].espece_id}
</td>
<td>{$data[lst].nom_id}</td>
<td>{$data[lst].nom_fr}</td>
</tr>
{/section}
</tbody>
</table>
<script>
setDataTables("ptList",true, true, true, 50);
</script>