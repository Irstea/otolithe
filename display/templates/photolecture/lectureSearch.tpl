<script>
$(document).ready(function() {
$(".auto").change( function () {
	$("#searchBox").submit() ;
});
});
</script>
<div class="col-sm-12 col-md-8 ">
<form id="searchBox" method="GET" action="index.php" class="form-horizontal protoform">
<input type="hidden" name="module" value="{$modulePostSearch}">
<input type="hidden" name="isSearch" value="1">

<div class="form-group">
<label for="codeindividu" class="control-label col-sm-2">
{t}Code ou TAG de l'individu :{/t}
</label>
<div class="col-sm-4">
<input name="codeindividu" id="codeindividu" value="{$lectureSearch.codeindividu}" class="form-control" autofocus>
</div>

<label for="exp_id" class="control-label col-sm-2">
{t}Expérimentation :{/t}
</label>
<div class="col-sm-4">
<select class="auto form-control" id="exp_id" name="exp_id">
{section name="lst" loop=$experimentation}
<option value="{$experimentation[lst].exp_id}" {if $experimentation[lst].exp_id == $lectureSearch.exp_id}selected{/if}>
{$experimentation[lst].exp_nom}
</option>
{/section}
</select>
</td>
</div>
</div>

<div class="form-group">
<label for="site" class="control-label col-sm-2">
{t}Site de pêche :{/t}
</label>
<div class="col-sm-4">
<select class="auto form-control combobox" id="site" name="site">
<option value="">{t}Sélectionnez le site global de pêche{/t}</option>
{section name="lst" loop=$site}
<option value="{$site[lst].site}" {if $site[lst].site == $lectureSearch.site}selected{/if}>
{$site[lst].site}
</option>
{/section}
</select>
</div>

<label for="zonesite" class="control-label col-sm-2">
{t}Zone précise de pêche :{/t}
</label>
<div class="col-sm-4">
 <select class="auto form-control combobox" name="zonesite">
<option value="">{t}Sélectionnez le site précis de pêche{/t}</option>
{section name="lst" loop=$zone}
<option value="{$zone[lst].zonesite}" {if $zone[lst].zonesite == $lectureSearch.zonesite}selected{/if}>
{$zone[lst].zonesite}
</option>
{/section}
</select>
</div>
</div>

<div class="form-group">
<label for="lecteur_id" class="control-label col-sm-2">
{t}Lecteur :{/t} 
</label>
<div class="col-sm-4">
<select class="auto form-control" id="lecteur_id" name="lecteur_id">
<option value="">{t}Sélectionnez le lecteur{/t}</option>
{section name="lst" loop=$lecteur}
<option value="{$lecteur[lst].lecteur_id}" {if $lecteur[lst].lecteur_id == $lectureSearch.lecteur_id}selected{/if}>
{$lecteur[lst].lecteur_prenom} {$lecteur[lst].lecteur_nom}
</option>
{/section}
</select>
</div>
<div class="center col-sm-6">
<button class="btn btn-success" type="submit">{t}Rechercher...{/t}</button> 
</div>
</div>
</form>
</div>
