<h2>{t}Modification d'un type de pièce{/t}</h2>

<a href="index.php?module=piecetypeList">{t}Retour à la liste{/t}</a>
<table class="tablesaisie">
<form method="post" action="index.php?module=piecetypeWrite">
<input type="hidden" name="action" value="M">
<input type="hidden" name="piecetype_id" value="{$data.piecetype_id}">
<tr>
<td class="libelleSaisie">{t}Nom du type de pièce :{/t}<span class="red">*</span></td>
<td class="datamodif">
<input id="piecetype_libelle" name="piecetype_libelle" value="{$data.piecetype_libelle}" required></td>
</tr>

<tr>
<td colspan="2"><div align="center">
<input type="submit" value="{t}Valider{/t}">
</form>
{if $data.piecetype_id>0}
<form action="index.php" method="post" onSubmit='return confirmSuppression()'>
<input type="hidden" name="piecetype_id" value="{$data.piecetype_id}">
<input type="hidden" name="module" value="piecetypeDelete">
<input type="submit" value="{t}Supprimer{/t}">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>