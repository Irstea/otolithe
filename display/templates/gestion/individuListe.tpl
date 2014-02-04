<script>
setDataTables("idListe",true , false, true);
</script>
<h2>{$LANG.gestion.0}</h2>
<a href="index.php?module=individuChange&individu_id=0">{$LANG.gestion.7}</a>
{include file="gestion/individuSearch.tpl"}
{if $isSearch == 1}
<table id="idListe" class="tableaffichage">
<thead>
<tr>
<th>{$LANG["gestion"].45}<br>{$LANG["gestion"].2}</th>
<th>{$LANG["gestion"].5}</th>
<th>{$LANG["gestion"].12}</th>
<th>{$LANG["gestion"].6}</th>
<th>{$LANG["gestion"].46}<br>{$LANG["gestion"].47}</th>
<th>{$LANG["gestion"].29}</th>
<th>{$LANG["gestion"].48}</th>
<th>{$LANG["gestion"].49}</th>
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