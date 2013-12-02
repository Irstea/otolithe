<h2>Affichage du détail d'un individu</h2>
<a href="index.php?module={$moduleListe}">Retour à la liste</a>
<table class="tablemulticolonne">
<tr>
<td>
<h3>Données générales</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Espèce :</td>
<td>{$data.nom_id}</td>
</tr>
<tr>
<td class="libelleSaisie">Sexe :</td>
<td>{$data.sexe_libelle}</td>
</tr>
<tr>
<td class="libelleSaisie">Code de l'individu :</td>
<td>{$data.codeindividu}</td>
</tr>
<tr>
<td class="libelleSaisie">Tag :</td>
<td>{$data.tag}</td>
</tr>
<tr>
<td class="libelleSaisie">Longueur :</td>
<td>{$data.longueur}</td>
</tr>
<tr>
<td class="libelleSaisie">Poids :</td>
<td>{$data.poids}</td>
</tr>
<tr>
<td class="libelleSaisie">Remarque :</td>
<td>{$data.remarque}</td>
</tr>
<tr>
<td class="libelleSaisie">Parasite :</td>
<td>{$data.parasite}</td>
</tr>
<tr>
<td class="libelleSaisie">Age :</td>
<td>{$data.age}</td>
</tr>
<tr>
<td class="libelleSaisie">Pectorale gauche :</td>
<td>{$data.pectorale_gauche}</td>
</tr>
<tr>
<td class="libelleSaisie">Diamètre oculaire - horizontal :</td>
<td>{$data.diam_occ_h}</td>
</tr>
<tr>
<td class="libelleSaisie">Diamètre oculaire - vertical :</td>
<td>{$data.diam_occ_v}</td>
</tr>
<tr>
<td class="libelleSaisie">Ht mm :</td>
<td>{$data.ht_mm}</td>
</tr>
<tr>
<td class="libelleSaisie">Épaisseur :</td>
<td>{$data.epaisseur}</td>
</tr>
<tr>
<td class="libelleSaisie">Circonférence :</td>
<td>{$data.circonference}</td>
</tr>
</table>
</td>

<td>
<h3>Pièces rattachées</h3>
<a href="index.php?module=pieceChange&piece_id=0&individu_id={$data.individu_id}">Nouvelle pièce</a>
<table class="tableaffichage">
<thead>
<tr>
<th>Type</th>
<th>Code</th>
<th>Traitement réalisé</th>
<th>Nbre photos rattachées</th>
</tr></thead>
<tdata>
{section name="lst" loop=$piece}
<tr>
<td><a href="index.php?module=pieceDisplay&piece_id={$piece[lst].piece_id}&individu_id={$data.individu_id}">
{$piece[lst].piecetype_libelle}
</a></td>
<td>{$piece[lst].code}</td>
<td>{$piece[lst].traitementpiece_libelle}</td>
<td><div class="center">{$piece[lst].nbphoto}</div></td>
</tr>
{/section}
</tdata>
</table>

<h3>Expérimentation(s)</h3>
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
<h3>Données concernant la pêche</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">Site :</td>
<td>{$peche.site}</td>
</tr>
<tr>
<td class="libelleSaisie">Zone précise :</td>
<td>{$peche.zonesite}</td>
</tr>
<tr>
<td class="libelleSaisie">Date de pêche :</td>
<td>{$peche.peche_date}</td>
</tr>
<tr>
<td class="libelleSaisie">Campagne :</td>
<td>{$peche.campagne}</td>
</tr>
<tr>
<td class="libelleSaisie">Engin :</td>
<td>{$peche.peche_engin}</td>
</tr>
<tr>
<td class="libelleSaisie">Pêcheur :</td>
<td>{$peche.personne}</td>
</tr>
<tr>
<td class="libelleSaisie">Opérateur :</td>
<td>{$peche.operateur}</td>
</tr>
</table>
</td>
<td>
<h3>Données physico-chimiques de la pêche</h3>
<table>
<thead>
<tr>
<th>Analyse</th>
<th>Valeur mesurée</th>
<th>Valeur mini</th>
<th>Valeur maxi</th>
</tr>
</thead>
<tdata>
<tr>
<td>Température</td>
<td>{$pc.temp}</td>
<td>{$pc.temp_min}</td>
<td>{$pc.temp_max}</td>
</tr>
<td>O2</td>
<td>{$pc.o2}</td>
<td>{$pc.o2_min}</td>
<td>{$pc.o2_max}</td>
</tr>
<td>pourcentage O2</td>
<td>{$pc.o2pourcent}</td>
<td>{$pc.o2pourcent_min}</td>
<td>{$pc.o2pourcent_max}</td>
</tr>
<td>Conductivité</td>
<td>{$pc.conductivite}</td>
<td>{$pc.conductivite_min}</td>
<td>{$pc.conductivite_max}</td>
</tr>
<td>Conductivité A</td>
<td>{$pc.conductivitea}</td>
<td>{$pc.conductivitea_min}</td>
<td>{$pc.conductivitea_max}</td>
</tr>
<td>Salinité</td>
<td>{$pc.salinite}</td>
<td>{$pc.salinite_min}</td>
<td>{$pc.salinite_max}</td>
</tr>
<td>pH</td>
<td>{$pc.ph}</td>
<td>{$pc.ph_min}</td>
<td>{$pc.ph_max}</td>
</tr>
</tdata>
</table>

</td>
</tr>
</table>