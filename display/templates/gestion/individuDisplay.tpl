<h2>{t}Affichage du détail d'un individu{/t}</h2>
<a href="index.php?module={$moduleListe}">{t}Retour à la liste{/t}</a>

<table class="tablemulticolonne">
<tr>
<td>
<h3>{t}Données générales{/t}</h3>
{if $droits.gestion == 1}
<a href="index.php?module=individuChange&individu_id={$data.individu_id}">{t}Modifier...{/t}</a>
{/if}
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{t}Espèce :{/t}</td>
<td>{$data.nom_id}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Sexe :{/t}</td>
<td>{$data.sexe_libelle}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Code de l'individu :{/t}</td>
<td>{$data.codeindividu}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Tag :{/t}</td>
<td>{$data.tag}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Longueur :{/t}</td>
<td>{$data.longueur}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Poids :{/t}</td>
<td>{$data.poids}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Remarque :{/t}</td>
<td>{$data.remarque}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Parasite :{/t}</td>
<td>{$data.parasite}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Age :{/t}</td>
<td>{$data.age}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Pectorale gauche :{/t}</td>
<td>{$data.pectorale_gauche}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Diamètre oculaire - horizontal :{/t}</td>
<td>{$data.diam_occ_h}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Diamètre oculaire - vertical :{/t}</td>
<td>{$data.diam_occ_v}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Ht mm :{/t}</td>
<td>{$data.ht_mm}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Épaisseur :{/t}</td>
<td>{$data.epaisseur}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Circonférence :{/t}</td>
<td>{$data.circonference}</td>
</tr>
</table>
</td>

<td>
<h3>{t}Pièces rattachées{/t}</h3>
{if $droits.gestion == 1}
<a href="index.php?module=pieceChange&piece_id=0&individu_id={$data.individu_id}">{t}Nouvelle pièce{/t}</a>
{/if}
<table class="tableaffichage">
<thead>
<tr>
<th>{t}Type{/t}</th>
<th>{t}Code{/t}</th>
<th>{t}Traitement réalisé{/t}</th>
<th>{t}Nbre photos rattachées{/t}</th>
</tr></thead>
<tbody>
{section name="lst" loop=$piece}
<tr>
<td><a href="index.php?module=pieceDisplay&piece_id={$piece[lst].piece_id}&individu_id={$data.individu_id}">
{$piece[lst].piecetype_libelle}
</a></td>
<td>{$piece[lst].piececode}</td>
<td>{$piece[lst].traitementpiece_libelle}</td>
<td><div class="center">{$piece[lst].nbphoto}</div></td>
</tr>
{/section}
</tbody>
</table>

<h3>{t}Expérimentation(s){/t}</h3>
<table>
{section name="lst" loop=$experimentation}
<tr>
<td>{$experimentation[lst].exp_nom}</td>
</tr>
{/section}
</table>
</td>
</tr>

<tr>
<td>
<h3>{t}Données concernant la pêche{/t}</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{t}Site :{/t}</td>
<td>{$peche.site}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Zone précise :{/t}</td>
<td>{$peche.zonesite}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Date de pêche :{/t}</td>
<td>{$peche.peche_date}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Campagne :{/t}</td>
<td>{$peche.campagne}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Engin :{/t}</td>
<td>{$peche.peche_engin}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Pêcheur :{/t}</td>
<td>{$peche.personne}</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Opérateur :{/t}</td>
<td>{$peche.operateur}</td>
</tr>
</table>
</td>
<td>
<h3>{t}Données physico-chimiques de la pêche{/t}</h3>
<table>
<thead>
<tr>
<th>{t}Analyse{/t}</th>
<th>{t}Valeur mesurée{/t}</th>
<th>{t}Valeur mini{/t}</th>
<th>{t}Valeur maxi{/t}</th>
</tr>
</thead>
<tdata>
<tr>
<td>{t}Température{/t}</td>
<td>{$pc.temp}</td>
<td>{$pc.temp_min}</td>
<td>{$pc.temp_max}</td>
</tr>
<td>{t}O2{/t}</td>
<td>{$pc.o2}</td>
<td>{$pc.o2_min}</td>
<td>{$pc.o2_max}</td>
</tr>
<td>{t}pourcentage O2{/t}</td>
<td>{$pc.o2pourcent}</td>
<td>{$pc.o2pourcent_min}</td>
<td>{$pc.o2pourcent_max}</td>
</tr>
<td>{t}Conductivité{/t}</td>
<td>{$pc.conductivite}</td>
<td>{$pc.conductivite_min}</td>
<td>{$pc.conductivite_max}</td>
</tr>
<td>{t}Conductitivé A{/t}</td>
<td>{$pc.conductivitea}</td>
<td>{$pc.conductivitea_min}</td>
<td>{$pc.conductivitea_max}</td>
</tr>
<td>{t}Salinité{/t}</td>
<td>{$pc.salinite}</td>
<td>{$pc.salinite_min}</td>
<td>{$pc.salinite_max}</td>
</tr>
<td>{t}pH{/t}</td>
<td>{$pc.ph}</td>
<td>{$pc.ph_min}</td>
<td>{$pc.ph_max}</td>
</tr>
</tdata>
</table>

</td>
</tr>
</table>