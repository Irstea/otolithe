<h2>Modification d'un lecteur</h2>

<a href="index.php?module=lecteurList">Retour à la liste</a>
<table class="tablesaisie">
<form method="post" action="index.php?module=lecteurWrite" onSubmit='return validerForm("nom:le nom est obligatoire,login:le login est obligatoire")'>
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<tr>
<td class="libelleSaisie">Nom <span class="red">*</span> :</td>
<td class="datamodif">
<input id="nom" name="lecteur_nom" value="{$data.lecteur_nom}" maxlengh="50" size="45"></td>
</tr>
<tr>
<td class="libelleSaisie">Prénom :</td>
<td class="datamodif">
<input id="prenom" name="lecteur_prenom" value="{$data.lecteur_prenom}" maxlengh="50" size="45"></td>
</tr>
<tr>
<td class="libelleSaisie">Login de connexion <span class="red">*</span> :</td>
<td class="datamodif">
<input id="login" name="login" value="{$data.login}" maxlengh="100" size="45"></td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
{if $data.lecteur_id>0&&$droits["admin"] == 1}
<form action="index.php" method="post" onSubmit='return confirmSuppression("Confirmez-vous la suppression de la fiche ?")'>
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<input type="hidden" name="module" value="lecteurDelete">
<input type="submit" value="Supprimer">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">Champ obligatoire</span>