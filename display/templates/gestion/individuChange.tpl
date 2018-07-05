<script>
$(document).ready(function() {
$("#recherche").keyup(function() {
	/*
	* Traitement de la recherche d'une espèce/type
	*/
	var texte = $(this).val();
	if (texte.length > 2) {
		/*
		* declenchement de la recherche
		*/
		var url = "index.php?module=especeSearchAjax";
		$.getJSON ( url, { "libelle": texte } , function( data ) {
			var options = '';
			 for (var i = 0; i < data.length; i++) {
			        options += '<option value="' + data[i].id + '">' + data[i].val + '</option>';
			      };
			$("#espece_id").html(options);
		} ) ;
	};
} );
});

</script>

<h2>{t}Modification d'un poisson{/t}</h2>

<a href="index.php?module={$moduleListe}">{t}Retour à la liste{/t}</a>
{if $data.individu_id > 0}
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">Retour
	au poisson</a>
{/if}
<div class="formSaisie">
		<div>

			<form method="post" action="index.php">
				<input type="hidden" name="module" value="individuWrite">
				<input type="hidden" name="individu_id" value="{$data.individu_id}">
				<input type="hidden" name="peche_id" value="{$data.peche_id}">
			<fieldset>
			<legend>{t}Expérimentations{/t}</legend>
			<dl><dt>{t}Liste des expérimentations de rattachement :{/t}<span class="red">*</span></dt>
			<dd>
			<table class="tablenoborder">
			{section name=lst loop=$experimentations}
			<tr>
			<td><input type="checkbox" name="exp_id[]" value="{$experimentations[lst].exp_id}" {if $experimentations[lst].individu_id > 0}checked{/if}></td>
			<td>{$experimentations[lst].exp_nom}</td>
			</tr>
			{/section}
			</table>
			</dd>
			</dl>
			</fieldset>
					<fieldset>
		<legend>{t}Individu{/t}</legend>
				<dl>
					<dt>
						{t}{Espèce :{/t}<span class="red">*</span> :
					</dt>
					<dd><input class="text10" id="recherche" autocomplete="off" autofocus placeholder="espèce à chercher" title="Tapez au moins 3 caractères...">
						<select id="espece_id" name="espece_id">						
						<option value="{$data.espece_id}">{$data.nom_id}</option>
						</select>
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Sexe :{/t}
					</dt>
					<dd>
						<select name="sexe_id">
						<option value="" {if $data.sexe_id == ""}selected{/if}>Sélectionnez...</option>
						{section name=lst loop=$sexes}
						<option value="{$sexes[lst].sexe_id}" {if $sexes[lst].sexe_id} = $data.sexe_id}selected{/if}>
						{$sexes[lst].sexe_libelle}
						</option>
						{/section}
						</select>
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Code de l'individu :{/t}
					</dt>
					<dd>
						<input name="codeindividu" value="{$data.codeindividu}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Tag :{/t}
					</dt>
					<dd>
						<input name="tag" value="{$data.tag}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Longueur :{/t}
					</dt>
					<dd>
						<input name="longueur" class="taux" value="{$data.longueur}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Poids :{/t}
					</dt>
					<dd>
						<input name="poids" class="taux" value="{$data.poids}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Remarque :{/t}
					</dt>
					<dd>
						<input name="remarque" value="{$data.remarque}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Parasite :{/t}
					</dt>
					<dd>
						<input name="parasite" value="{$data.parasite}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Age :{/t}
					</dt>
					<dd>
						<input name="age" class="nombre" value="{$data.age}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Pectorale gauche :{/t}
					</dt>
					<dd>
						<input name="pectorale_gauche" value="{$data.pectorale_gauche}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Diamètre occulaire - horizontal :{/t}
					</dt>
					<dd>
						<input name="diam_occ_h" class="taux" value="{$data.diam_occ_h}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Diamètre occulaire - vertical :{/t}
					</dt>
					<dd>
						<input name="diam_occ_v" class="taux" value="{$data.diam_occ_v}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Ht mm :{/t}
					</dt>
					<dd>
						<input name="ht_mm"  class="nombre" value="{$dataht_mm}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Épaisseur :{/t}
					</dt>
					<dd>
						<input name="epaisseur" class="taux" value="{$data.epaisseur}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Circonférence :{/t}
					</dt>
					<dd>
						<input name="circonference" class="taux" value="{$data.circonference}">
					</dd>
				</dl>
				</fieldset>
				<fieldset>
				<legend>{t}Données concernant la pêche{/t}</legend>
				<dl>
					<dt>
						{t}Site :{/t}
					</dt>
					<dd>
						<input name="site" value="{$peche.site}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Zone précise :{/t}
					</dt>
					<dd>
						<input name="zonesite" value="{$peche.zonesite}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Date de pêche :{/t}
					</dt>
					<dd>
						<input name="peche_date" class="date" value="{$peche.peche_date}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Campagne :{/t}
					</dt>
					<dd>
						<input name="campagne" value="{$peche.campagne}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Engin :{/t}
					</dt>
					<dd>
						<input name="peche_engin" value="{$peche.peche_engin}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Pêcheur :{/t}
					</dt>
					<dd>
						<input name="personne" value="{$peche.personne}">
					</dd>
				</dl>
				<dl>
					<dt>
						{t}Opérateur :{/t}
					</dt>
					<dd>
						<input name="operateur" value="{$peche.operateur}">
					</dd>
				</dl>
				
				</fieldset>
				<dl></dl>
				<div class="formBouton">
					<input class="submit" type="submit" value="{t}Valider{/t}">
				</div>
			</form>
		</div>
</div>

<span class="red">*</span>
<span class="messagebas">{t}Champ obligatoire{/t}</span>
