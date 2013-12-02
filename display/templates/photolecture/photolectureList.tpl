<h2>Consultation de la lecture de pièces</h2>
{include file="photolecture/lectureSearch.tpl"}
{if $isSearch == 1}
{if $droits.gestion == 1}
<a href="index.php?module=photolectureExport" title="Séparateur : tabulation, UTF-8, chiffres décimaux avec points">Exporter la liste au format CSV</a>
{/if}
<script>
setDataTables("idListe",true , false, true);
</script>
<table id="idListe" class="tableaffichage">
<thead>
<tr>
<th>Individu</th>
<th>Pièce<br>traitement</th>
<th>Photo<br>Couleur/NB</th>
<th>Résolution<br>de prise de vue</th>
<th>Date de<br>prise de vue</th>
<th>Longueur<br>de référence</th>
<th>Lecteur</th>
<th>Date de lecture</th>
<th>Résolution<br>de lecture</th>
<th>Longueur de<br>référence mesurée</th>
<th>Longueur réelle totale<br>de la mesure</th>
<th>Age</th>
</tr>
</thead>
<tdata>
{section name="lst" loop=$data}
<tr>
<td>
<a href="index.php?module=individuDisplay&individu_id={$data[lst].individu_id}">
{$data[lst].codeindividu}<br>{$data[lst].tag}
</a>
</td>
<td>
<a href="index.php?module=pieceDisplay&piece_id={$data[lst].piece_id}">
{$data[lst].piecetype_libelle}
</a>
<br>{$data[lst].traitementpiece_libelle}</td>
<td>
<a href="index.php?module=photoDisplay&photo_id={$data[lst].photo_id}">
{$data[lst].photo_nom}
</a>
<br>{$data[lst].color}</td>
<td><div class="center">{$data[lst].photo_width}x{$data[lst].photo_height}</div></td>
<td>{$data[lst].photo_date}</td>
<td><div class="center">{$data[lst].long_reference}</div></td>
<td>{$data[lst].lecteur_prenom} {$data[lst].lecteur_nom}</td>
<td>
<a href="index.php?module=photolectureDisplay&photolecture_id={$data[lst].photolecture_id}&photo_id={$data[lst].photo_id}">
{$data[lst].photolecture_date}
</a>
</td>
<td><div class="center">{$data[lst].photolecture_width}x{$data[lst].photolecture_height}</div></td>
<td>{$data[lst].long_ref_mesuree}</td>
<td>{$data[lst].long_totale_reel}</td>
<td><div class="center">{$data[lst].age}</div></td>
</tr>
{/section}
</tdata>
</table>

{/if}