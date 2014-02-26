<h2>{$LANG["gestion"].3}</h2>
<a href="index.php?module={$moduleListe}">{$LANG["gestion"].0}</a>
<table class="tablemulticolonne">
<tr>
<td>
<h3>{$LANG["gestion"].4}</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{$LANG["gestion"].5} :</td>
<td>{$data.nom_id}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].6} :</td>
<td>{$data.sexe_libelle}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].7} :</td>
<td>{$data.codeindividu}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].2} :</td>
<td>{$data.tag}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].8} :</td>
<td>{$data.longueur}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].9} :</td>
<td>{$data.poids}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].10} :</td>
<td>{$data.remarque}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].11} :</td>
<td>{$data.parasite}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].12} :</td>
<td>{$data.age}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].13} :</td>
<td>{$data.pectorale_gauche}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].14} - {$LANG["gestion"].15} :</td>
<td>{$data.diam_occ_h}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].14} - {$LANG["gestion"].16} :</td>
<td>{$data.diam_occ_v}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].17} :</td>
<td>{$data.ht_mm}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].18} :</td>
<td>{$data.epaisseur}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].19} :</td>
<td>{$data.circonference}</td>
</tr>
</table>
</td>

<td>
<h3>{$LANG["gestion"].20}</h3>
<a href="index.php?module=pieceChange&piece_id=0&individu_id={$data.individu_id}">{$LANG["gestion"].21}</a>
<table class="tableaffichage">
<thead>
<tr>
<th>{$LANG["gestion"].22}</th>
<th>{$LANG["gestion"].1}</th>
<th>{$LANG["gestion"].23}</th>
<th>{$LANG["gestion"].24}</th>
</tr></thead>
<tdata>
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
</tdata>
</table>

<h3>{$LANG["gestion"].25}</h3>
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
<h3>{$LANG["gestion"].26}</h3>
<table class="tableaffichage">
<tr>
<td class="libelleSaisie">{$LANG["gestion"].27} :</td>
<td>{$peche.site}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].28} :</td>
<td>{$peche.zonesite}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].29} :</td>
<td>{$peche.peche_date}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].30} :</td>
<td>{$peche.campagne}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].31} :</td>
<td>{$peche.peche_engin}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].32} :</td>
<td>{$peche.personne}</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].33} :</td>
<td>{$peche.operateur}</td>
</tr>
</table>
</td>
<td>
<h3>{$LANG["gestion"].34}</h3>
<table>
<thead>
<tr>
<th>{$LANG["gestion"].35}</th>
<th>{$LANG["gestion"].36}</th>
<th>{$LANG["gestion"].37}</th>
<th>{$LANG["gestion"].38}</th>
</tr>
</thead>
<tdata>
<tr>
<td>{$LANG["gestion"].39}</td>
<td>{$pc.temp}</td>
<td>{$pc.temp_min}</td>
<td>{$pc.temp_max}</td>
</tr>
<td>{$LANG["gestion"].40}</td>
<td>{$pc.o2}</td>
<td>{$pc.o2_min}</td>
<td>{$pc.o2_max}</td>
</tr>
<td>{$LANG["gestion"].41}</td>
<td>{$pc.o2pourcent}</td>
<td>{$pc.o2pourcent_min}</td>
<td>{$pc.o2pourcent_max}</td>
</tr>
<td>{$LANG["gestion"].42}</td>
<td>{$pc.conductivite}</td>
<td>{$pc.conductivite_min}</td>
<td>{$pc.conductivite_max}</td>
</tr>
<td>{$LANG["gestion"].42} A</td>
<td>{$pc.conductivitea}</td>
<td>{$pc.conductivitea_min}</td>
<td>{$pc.conductivitea_max}</td>
</tr>
<td>{$LANG["gestion"].43}</td>
<td>{$pc.salinite}</td>
<td>{$pc.salinite_min}</td>
<td>{$pc.salinite_max}</td>
</tr>
<td>{$LANG["gestion"].44}</td>
<td>{$pc.ph}</td>
<td>{$pc.ph_min}</td>
<td>{$pc.ph_max}</td>
</tr>
</tdata>
</table>

</td>
</tr>
</table>