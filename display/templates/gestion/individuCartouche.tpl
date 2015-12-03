<table class="tableaffichage">
<tr>
<td>
{$individu.nom_id} - {$individu.sexe_libelle}
<br>
{$LANG["gestion"].1} : {$individu.codeindividu} - {$LANG["gestion"].2} : {$individu.tag}
{if strlen($individu.peche_date) > 0} - {$LANG["gestion"].29} : {$individu.peche_date}{/if}
</td>
</tr>
</table>