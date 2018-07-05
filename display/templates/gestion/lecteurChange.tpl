<h2>{t}Modification d'un lecteur{/t}</h2>

<a href="index.php?module=lecteurList">{t}Retour à la liste{/t}</a>
<div class="formSaisie">
<div>
<form method="post" action="index.php?module=lecteurWrite" onSubmit='return validerForm("nom:{$LANG["gestion"].59},login:{$LANG["gestion"].60}")'>
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<dl>
<dt>{t}Nom :{/t} <span class="red">*</span> </dt>
<dd>
<input id="nom" name="lecteur_nom" value="{$data.lecteur_nom}" >
</dd>
</dl>
<dl>
<dt>{t}Prénom :{/t} </dt>
<dd>
<input id="prenom" name="lecteur_prenom" value="{$data.lecteur_prenom}"  >
</dd>
</dl>
<dl>
<dt>{t}Login de connexion :{/t}<span class="red">*</span> </dt>
<dd>
<input id="login" name="login" value="{$data.login}"  >
</dd>
</dl>
<dl>
<dt>{t}Expérimentations autorisées :{/t}</dt>
<dd>
<table class="tablenoborder">
{section name=lst loop=$exps}
<tr>
<td>
<input type="checkbox" name="exp_id[]" value="{$exps[lst].exp_id}" {if $exps[lst].lecteur_id > 0}checked{/if}>
</td>
<td>{$exps[lst].exp_nom}</td>
</tr>
{/section}
</table>
</dd>
</dl>
<dl></dl>
<div class="formBouton">
<input type="submit" value="{t}Valider{/t}">
</div>
</form>
</div>

{if $data.lecteur_id>0&&$droits["admin"] == 1}
<div class="formBouton">
<form action="index.php" method="post" onSubmit='return confirmSuppression("{$LANG["message"].31}")'>
<input type="hidden" name="lecteur_id" value="{$data.lecteur_id}">
<input type="hidden" name="module" value="lecteurDelete">
<input type="submit" value="{t}Supprimer{/t}">
</form>
</div>
{/if}
</div>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>
