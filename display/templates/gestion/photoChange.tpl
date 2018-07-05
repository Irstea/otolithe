<script type="text/javascript" src="/display/javascript/calendar/calendar.js"></script>
<script type="text/javascript" src="/display/javascript/calendar/lang/calendar-fr.js"></script>
<script type="text/javascript" src="/display/javascript/calendar/calendar-setup.js"></script>
<style type="text/css">@import url(display/javascript/calendar/aqua/theme.css);</style>

<h2>{t}Modification d'une photo{/t}</h2>
<a href="index.php?module={$moduleListe}">{t}Retour à la liste{/t}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$individu.individu_id}">{t}Retour au détail du poisson{/t}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">{t}Retour au détail de la pièce{/t}</a>
<table class="tablemulticolonne">
<tr>
<td>
{include file="gestion/individuCartouche.tpl"}
</td>
<td>
{include file="gestion/pieceCartouche.tpl"}
</td>
</tr>
</table>
<form method="post" action="index.php" enctype="multipart/form-data" onSubmit='return validerForm("dateExample:la date est obligatoire,comment:le commentaire est obligatoire")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photoWrite">
<table class="tablesaisie">
<tr>
<td class="libelleSaisie">{t}Nom de la photo :{/t} </td>
<td>
<input name="photo_nom" value="{$data.photo_nom}" maxlength="255" size="50">
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Description :{/t} </td>
<td>
<input name="description" value="{$data.description}" maxlength="255" size="50">
</td>
</tr>
<tr>
		<td class="libelleSaisie">{t}Fichier JPG contenant la photo :{/t} </td>
		<td>
			<input type="hidden" name="MAX_FILE_SIZE" value="50000000">
			<input type="file" name="photoload" accept="image/jpeg" size="50">
		</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Nom du fichier :{/t} </td>
<td>
<input name="photo_filename" value="{$data.photo_filename}" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Date de prise de vue :{/t} </td>
<td>
<input class="date" name="photo_date" id="photo_date" value="{$data.photo_date}" maxlength="10" size="10">
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Couleur :{/t} </td>
<td>
<input type="radio" name="color" value="NB" {if $data.color == "NB"}checked{/if}>{t}Noir et blanc{/t}
<br>
<input type="radio" name="color" value="C" {if $data.color == "C"}checked{/if}>{t}Couleur{/t}
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Type de lumière :{/t} </td>
<td>
<select name="lumieretype_id">
{section name="lst" loop=$lumieretype}
<option value="{$lumieretype[lst].lumieretype_id}" {if $data.lumieretype_id == $lumieretype[lst].lumieretype_id}selected{/if}>
{$lumieretype[lst].lumieretype_libelle}
</option>
{/section}
</select>
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Grossissement :{/t} </td>
<td>
<input name="grossissement" value="{$data.grossissement}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Repère :{/t} </td>
<td>
<input name="repere" value="{$data.repere}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Adresse de stockage (fichiers dans arborescence) :{/t} </td>
<td>
<input name="URI" value="{$data.URI}" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Repère de mesure - longueur de référence :{/t} </td>
<td>
<input name="long_reference" value="{$data.long_reference}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Taille en pixels de la longueur de référence dans la photo :{/t} </td>
<td>
<input name="long_ref_pixel" value="{$data.long_ref_pixel}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{t}Dimensions de la photo :{/t} </td>
<td>
<input name="photo_width" value="{$data.photo_width}" readonly>x 
<input name="photo_height" value="{$data.photo_height}" readonly>
</td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="{t}Valider{/t}">
</form>
{if $data.photo_id>0 }
<form action="index.php" method="post" onSubmit='return confirmSuppression("{$LANG.message.31}")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photoDelete">
<input type="submit" value="{t}Supprimer{/t}">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">{t}Champ obligatoire{/t}</span>
