<script>
$(document).ready(function() {
$(".auto").change( function () {
	$("#searchBox").submit() ;
});
});
</script>
<table id="lectureSearch" class="tableaffichage">
<form id="searchBox" method="GET" action="index.php">
<input type="hidden" name="module" value="{$modulePostSearch}">
<input type="hidden" name="isSearch" value="1">
<tr>
<td>
{t}Code ou TAG de l'individu :{/t}
<input name="codeindividu" value="{$lectureSearch.codeindividu}" maxlength="50" size="30" autofocus>
</td>
<td>
{t}Expérimentation :{/t}
<select class="auto" name="exp_id">
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
{t}Site de pêche :{/t}
<select class="auto" name="site">
<option value="">{t}Sélectionnez le site global de pêche{/t}</option>
{section name="lst" loop=$site}
<option value="{$site[lst].site}" {if $site[lst].site == $lectureSearch.site}selected{/if}>
{$site[lst].site}
</option>
{/section}
</select>
</td>
<td>
{t}Zone précise de pêche :{/t}
 <select class="auto" name="zonesite">
<option value="">{t}Sélectionnez le site précis de pêche{/t}</option>
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
{t}Lecteur :{/t} 
<select class="auto" name="lecteur_id">
<option value="">{t}Sélectionnez le lecteur{/t}</option>
{section name="lst" loop=$lecteur}
<option value="{$lecteur[lst].lecteur_id}" {if $lecteur[lst].lecteur_id == $lectureSearch.lecteur_id}selected{/if}>
{$lecteur[lst].lecteur_prenom} {$lecteur[lst].lecteur_nom}
</option>
{/section}
</select>
</td>
<td>
<div class="center">
<input type="submit" value="{t}Rechercher...{/t}">
</div>
</td>
</tr>
</form>
</table>