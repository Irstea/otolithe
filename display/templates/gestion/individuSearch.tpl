<table id="individuSearch" class="tableaffichage">
<form method="GET" action="index.php">
<input type="hidden" name="module" value="{$modulePostSearch}">
<input type="hidden" name="isSearch" value="1">
<tr>
<td>
Code ou TAG de l'individu :
<input name="codeindividu" value="{$individuSearch.codeindividu}" maxlength="50" size="30" autofocus>
Sexe de l'animal :
<select name="sexe">
<option value="">Sélectionnez le sexe recherché</option>
{section name="lst" loop=$sexe}
<option value="{$sexe[lst].sexe_id}" {if $sexe[lst].sexe_id == $individuSearch.sexe}selected{/if}>
{$sexe[lst].sexe_libelle}
</option>
{/section}
</select>
<br>
Expérimentation :
<select name="exp_id">
<option value="">Sélectionnez l'expérimentation concernée</option>
{section name="lst" loop=$experimentation}
<option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $individuSearch.exp_id}selected{/if}>
{$experimentation[lst].exp_nom}
</option>
{/section}
</select>
<br>Site de pêche :
<select name="site">
<option value="">Sélectionnez le site global de pêche</option>
{section name="lst" loop=$site}
<option value="{$site[lst].site}" {if $site[lst].site == $individuSearch.site}selected{/if}>
{$site[lst].site}
</option>
{/section}
</select>
Zone précise de pêche :
 <select name="zone">
<option value="">Sélectionnez le site précis de pêche</option>
{section name="lst" loop=$zone}
<option value="{$zone[lst].zonesite}" {if $zone[lst].zonesite == $individuSearch.zone}selected{/if}>
{$zone[lst].zonesite}
</option>
{/section}
</select>
<div style="text-align:center;">
<input type="submit" name="Rechercher...">
</div>
</td>
</tr>
</form>
</table>