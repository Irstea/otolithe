<h2>Import d'individus dans la base de données</h2>
Pour importer des individus dans la base, préparez un fichier CSV avec les informations 
suivantes :
<ul>
<li><b>exp_id</b> : code de l'expérimentation (obligatoire)</li>
<li><b>espece_id</b> : code de l'espèce (obligatoire)</li>
<li><b>codeindividu</b> : identifiant du poisson ou hptag</li>
<li><b>tag</b> : N° de l'étiquette posée sur le poisson (le codeindividu ou le tag sont obligatoires)</li>
<li><b>longueur</b> : longueur du poisson</li>
<li><b>poids</b> : poids du poisson</li>
<li><b>remarque</b> : remarques concernant le poisson</li>
<li><b>piecetype_id</b> : code du type de pièce calcifiée à analyser</li>
<li><b>piececode</b> : si le type de pièce est indiqué, vous pouvez renseigner un code spécifique attaché à la pièce</li>
<li><b>peche_date</b> : date de la pêche</li>
<li><b>peche_code_id</b> : identifiant de l'enregistrement de la pêche dans la base de données d'origine</li>
<li><b>site</b> : site de la pêche</li>
<li><b>peche_remarque</b> : remarques liées à la pêche</li>
</ul>
<form class="protoform" id="controlForm" method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="module" value="importControl">
<table class="tablesaisie">
<tr>
<td class="libelleSaisie">Nom du fichier à importer (CSV)<span class="red">*</span> :</td>
<td class="datamodif">
<input type="file" name="upfile" required>
</td>
</tr>
<tr>
<td class="libelleSaisie">Séparateur utilisé :</td>
<td class="datamodif">
<select id="separator" name="separator">
<option value="," {if $separator == ","}selected{/if}>Virgule</option>
<option value=";" {if $separator == ";"}selected{/if}>Point-virgule</option>
<option value="tab" {if $separator == "tab"}selected{/if}>Tabulation</option>
</select>
</td>
</tr>
<tr>
<td  class="libelleSaisie">Encodage du fichier :</td>
<td class="datamodif">
<select id="utf8_encode" name="utf8_encode">
<option value="0" {if $utf8_encode == 0}selected{/if}>UTF-8</option>
<option value="1" {if $utf8_encode == 1}selected{/if}>ISO-8859-x</option>
</select>
</td>
</tr>
<tr>
<td colspan="2">
<div align="center">
      <button type="submit">Lancer les contrôles</button>
      </div>
</td>
</tr>
</table>
</form>


<span class="red">*</span><span class="messagebas">{$LANG["message"].30}</span>

<!-- Affichage des erreurs decouvertes -->
{if $erreur == 1}
<div class="row col-md-12">
<table id="containerList" class="table table-bordered table-hover datatable " >
<thead>
<tr>
<th>N° de ligne</th>
<th>Anomalie(s) détectée(s)</th>
</tr>
</thead>
<tbody>
{section name=lst loop=$erreurs}
<tr>
<td class="center">{$erreurs[lst].line}</td>
<td>{$erreurs[lst].message}</td>
</tr>
{/section}
</tbody>
</table>
</div>
{/if}

<!-- Lancement de l'import -->
{if $controleOk == 1}

<form class="protoform" id="importForm" method="post" action="index.php">
<input type="hidden" name="module" value="importImport">
Contrôles OK. Vous pouvez réaliser l'import du fichier {$filename} : 
<button type="submit" class="btn btn-danger">Déclencher l'import</button>
</form>
{/if}