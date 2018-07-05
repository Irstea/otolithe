<h2>{t}Liste des espèces{/t}</h2>


<table id="ptList" class="tableliste">
<thead>
<tr>
<th>{t}Id{/t}</th>
<th>{t}Nom latin{/t}</th>
<th>{t}Nom français{/t}</th>
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