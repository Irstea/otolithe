<h2>Modification d'un lecteur</h2>

<a href="index.php?module=lecteurList">{$LANG["gestion"].0}</a>
<table class="tablesaisie">
<form method="post" action="index.php?module=lecteurWrite" onSubmit='return validerForm("nom:{$LANG["gestion"].59},login:{$LANG["gestion"].60}")'>
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<tr>
<td class="libelleSaisie">{$LANG["login"].9} <span class="red">*</span> :</td>
<td class="datamodif">
<input id="nom" name="lecteur_nom" value="{$data.lecteur_nom}" maxlengh="50" size="45"></td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["login"].10} :</td>
<td class="datamodif">
<input id="prenom" name="lecteur_prenom" value="{$data.lecteur_prenom}" maxlengh="50" size="45"></td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].58} <span class="red">*</span> :</td>
<td class="datamodif">
<input id="login" name="login" value="{$data.login}" maxlengh="100" size="45"></td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="{$LANG["message"].19}">
</form>
{if $data.lecteur_id>0&&$droits["admin"] == 1}
<form action="index.php" method="post" onSubmit='return confirmSuppression("{$LANG["message"].31}")'>
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<input type="hidden" name="module" value="lecteurDelete">
<input type="submit" value="{$LANG["message"].20}">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">{$LANG["message"].30}</span>