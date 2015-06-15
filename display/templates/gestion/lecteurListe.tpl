<h2>{$LANG["gestion"].61}</h2>
{if $droits["gestionCompte"] == 1}
<a href="index.php?module=lecteurChange&lecteur_id=0">
{$LANG["gestion"].62}...
</a>
{/if}
<script>
setDataTables("lecteurListe");
</script>
<table id="lecteurListe" class="tableaffichage">
<thead>
<tr>
<th>{$LANG["login"].9}</th>
<th>{$LANG["login"].10}</th>
<th>{$LANG["gestion"].58}</th>
</tr>
</thead><tdata>
{section name=lst loop=$data}
<tr>
<td>
{if $droits["gestionCompte"] == 1}
<a href="index.php?module=lecteurChange&lecteur_id={$data[lst].lecteur_id}">
{/if}
{$data[lst].lecteur_nom}
{if $droits["gestionCompte"] == 1}
</a>
{/if}
</td>
<td>
{$data[lst].lecteur_prenom}
</td>
<td>{$data[lst].login}</td>
</tr>
{/section}
</tdata>
</table>
