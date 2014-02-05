<table id="lectureSearch" class="tableaffichage">
<form method="GET" action="index.php">
<input type="hidden" name="module" value="{$modulePostSearch}">
<input type="hidden" name="isSearch" value="1">
<tr>
<td>
{$LANG["gestion"].50} :
<input name="codeindividu" value="{$lectureSearch.codeindividu}" maxlength="50" size="30" autofocus>
</td>
<td>
Expérimentation :
<select name="exp_id">
{section name="lst" loop=$experimentation}
<option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $lectureSearch.exp_id}selected{/if}>
{$experimentation[lst].exp_nom}
</option>
{/section}
</select>
</td>
</tr>
<tr>
<td>
{$LANG["gestion"].54} :
<select name="site">
<option value="">{$LANG["gestion"].55}</option>
{section name="lst" loop=$site}
<option value="{$site[lst].site}" {if $site[lst].site == $lectureSearch.site}selected{/if}>
{$site[lst].site}
</option>
{/section}
</select>
</td>
<td>
{$LANG["gestion"].56} :
 <select name="zonesite">
<option value="">{$LANG["gestion"].57}</option>
{section name="lst" loop=$zone}
<option value="{$zone[lst].zonesite}" {if $zone[lst].zonesite == $lectureSearch.zonesite}selected{/if}>
{$zone[lst].zonesite}
</option>
{/section}
</select>
</td>
</tr>
<tr>
<td>
Lecteur : 
<select name="lecteur_id">
<option value="">{$LANG["gestion"].109}</option>
{section name="lst" loop=$lecteur}
<option value="{$lecteur[lst].lecteur_id}" {if $lecteur[lst].lecteur_id == $lectureSearch.lecteur_id}selected{/if}>
{$lecteur[lst].lecteur_prenom} {$lecteur[lst].lecteur_nom}
</option>
{/section}
</select>
</td>
<td>
<div class="center">
<input type="submit" value="{$LANG["message"].21}...">
</div>
</td>
</tr>
</form>
</table>