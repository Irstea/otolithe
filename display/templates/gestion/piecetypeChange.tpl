<h2>Modification d'un type de pièce</h2>

<a href="index.php?module=piecetypeList">Retour à la liste</a>
<table class="tablesaisie">
<form method="post" action="index.php?module=piecetypeWrite">
<input type="hidden" name="action" value="M">
<input type="hidden" name="piecetype_id" value="{$data.piecetype_id}">
<tr>
<td class="libelleSaisie">Nom du type de pièce <span class="red">*</span> :</td>
<td class="datamodif">
<input id="piecetype_libelle" name="piecetype_libelle" value="{$data.piecetype_libelle}" required></td>
</tr>

<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
{if $data.piecetype_id>0}
<form action="index.php" method="post" onSubmit='return confirmSuppression()'>
<input type="hidden" name="piecetype_id" value="{$data.piecetype_id}">
<input type="hidden" name="module" value="piecetypeDelete">
<input type="submit" value="Supprimer">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">Champ obligatoire</span>