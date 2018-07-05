<table class="tableaffichage">
<tr>
<td>
{$individu.nom_id} - {$individu.sexe_libelle}
<br>
{t}Code :{/t} {$individu.codeindividu} - {t}Tag} :{/t} {$individu.tag}
{if strlen($individu.peche_date) > 0} - {t}Date de pêche :{/t} {$individu.peche_date}{/if}
</td>
</tr>
</table>