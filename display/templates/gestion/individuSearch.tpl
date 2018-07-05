<script>
$(document).ready(function() {
$(".auto").change( function () {
	$("#searchBox").submit() ;
});
});
</script>

<table id="individuSearch" class="tableaffichage">
<form id="searchBox" method="GET" action="index.php">
<input type="hidden" name="module" value="{$modulePostSearch}">
<input type="hidden" name="isSearch" value="1">
<tr>
<td>
{t}Code ou TAG de l'individu :{/t}
<input name="codeindividu" value="{$individuSearch.codeindividu}" maxlength="50" size="30" autofocus>
{t}Sexe de l'animal :{/t}
<select class="auto" name="sexe">
<option value="">{t}Sélectionnez le sexe recherché{/t}</option>
{section name="lst" loop=$sexe}
<option value="{$sexe[lst].sexe_id}" {if $sexe[lst].sexe_id == $individuSearch.sexe}selected{/if}>
{$sexe[lst].sexe_libelle}
</option>
{/section}
</select>
<br>
{t}Expérimentation :{/t}
<select class="auto" name="exp_id">
{section name="lst" loop=$experimentation}
<option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $individuSearch.exp_id}selected{/if}>
{$experimentation[lst].exp_nom}
</option>
{/section}
</select>
<br>{t}Site de pêche :{/t}
<select class="auto" name="site">
<option value="">{t}Sélectionnez le site global de pêche{/t}</option>
{section name="lst" loop=$site}
<option value="{$site[lst].site}" {if $site[lst].site == $individuSearch.site}selected{/if}>
{$site[lst].site}
</option>
{/section}
</select>
{t}Zone précise de pêche :{/t}
 <select class="auto" name="zone">
<option value="">{t}Sélectionnez le site précis de pêche{/t}</option>
{section name="lst" loop=$zone}
<option value="{$zone[lst].zonesite}" {if $zone[lst].zonesite == $individuSearch.zone}selected{/if}>
{$zone[lst].zonesite}
</option>
{/section}
</select>
<div style="text-align:center;">
<input type="submit" name="{t}Rechercher...{/t}">
</div>
</td>
</tr>
</form>
</table>