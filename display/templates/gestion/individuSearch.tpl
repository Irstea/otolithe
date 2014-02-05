<table id="individuSearch" class="tableaffichage">
<form method="GET" action="index.php">
<input type="hidden" name="module" value="{$modulePostSearch}">
<input type="hidden" name="isSearch" value="1">
<tr>
<td>
{$LANG["gestion"].50} :
<input name="codeindividu" value="{$individuSearch.codeindividu}" maxlength="50" size="30" autofocus>
{$LANG["gestion"].51} :
<select name="sexe">
<option value="">{$LANG["gestion"].52}</option>
{section name="lst" loop=$sexe}
<option value="{$sexe[lst].sexe_id}" {if $sexe[lst].sexe_id == $individuSearch.sexe}selected{/if}>
{$sexe[lst].sexe_libelle}
</option>
{/section}
</select>
<br>
Expérimentation :
<select name="exp_id">
{section name="lst" loop=$experimentation}
<option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $individuSearch.exp_id}selected{/if}>
{$experimentation[lst].exp_nom}
</option>
{/section}
</select>
<br>{$LANG["gestion"].54} :
<select name="site">
<option value="">{$LANG["gestion"].55}</option>
{section name="lst" loop=$site}
<option value="{$site[lst].site}" {if $site[lst].site == $individuSearch.site}selected{/if}>
{$site[lst].site}
</option>
{/section}
</select>
{$LANG["gestion"].56} :
 <select name="zone">
<option value="">{$LANG["gestion"].57}</option>
{section name="lst" loop=$zone}
<option value="{$zone[lst].zonesite}" {if $zone[lst].zonesite == $individuSearch.zone}selected{/if}>
{$zone[lst].zonesite}
</option>
{/section}
</select>
<div style="text-align:center;">
<input type="submit" name="{$LANG["message"].21}...">
</div>
</td>
</tr>
</form>
</table>