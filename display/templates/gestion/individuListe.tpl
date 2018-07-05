<script>
setDataTables("idListe",true , false, true, 100);
</script>
<h2>{t}Retour à la liste{/t}</h2>
<a href="index.php?module=individuChange&individu_id=0">{t}Code de l'individu{/t}</a>
{include file="gestion/individuSearch.tpl"}
{if $isSearch == 1}
{if $droits.gestion == 1}
<a href="index.php?module=individuChange&individu_id=0">{t}Nouveau poisson...{/t}</a>
{/if}
<table id="idListe" class="tableliste">
<thead>
<tr>
<th>{t}Code individu{/t}<br>{t}Tag{/t}</th>
<th>{t}Espèce{/t}</th>
<th>{t}Age{/t}</th>
<th>{t}Sexe{/t}</th>
<th>{t}Nbre de pièces{/t}</th>
<th>{t}Date de pêche{/t}</th>
<th>{t}Zone de pêche{/t}</th>
<th>{t}Expérimentation{/t}</th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$data}
<tr>
<td><a href="index.php?module=individuDisplay&individu_id={$data[lst].individu_id}">
{$data[lst].codeindividu}<br>{$data[lst].tag}
</a></td>
<td>{$data[lst].nom_id}</td>
<td><div class="center">{$data[lst].age}</div></td>
<td><div class="center">{$data[lst].sexe_libellecourt}</div></td>
<td><div class="center">{$data[lst].nbrepiece}</div></td>
<td>{$data[lst].peche_date}</td>
<td>{$data[lst].site}<br>{$data[lst].zonesite}</td>
<td>{$data[lst].exp_nom}</td>
</tr>
{/section}
</tdata>
</table>
{/if}
<br>
