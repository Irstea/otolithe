<h2>Liste des lecteurs potentiels</h2>
{if $droits["gestion"] == 1}
<a href="index.php?module=lecteurChange&lecteur_id=0">
Nouveau...
</a>
{/if}
<script>
setDataTables("lecteurListe");
</script>
<table id="lecteurListe" class="tableaffichage">
<thead>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Login de connexion</th>
</tr>
</thead><tdata>
{section name=lst loop=$data}
<tr>
<td>
{if $droits["gestion"] == 1}
<a href="index.php?module=lecteurChange&lecteur_id={$data[lst].lecteur_id}">
{/if}
{$data[lst].lecteur_nom}
{if $droits["gestion"] == 1}
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
