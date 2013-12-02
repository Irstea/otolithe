<script type="text/javascript" src="display/javascript/calendar/calendar.js"></script>
<script type="text/javascript" src="display/javascript/calendar/lang/calendar-fr.js"></script>
<script type="text/javascript" src="display/javascript/calendar/calendar-setup.js"></script>
<style type="text/css">@import url(display/javascript/calendar/aqua/theme.css);</style>

<h2>Modification d'une photo</h2>
<a href="index.php?module={$moduleListe}">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id={$individu.individu_id}">Retour au détail du poisson</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">Retour au détail de la pièce</a>
{include file="gestion/individuCartouche.tpl"}
{include file="gestion/pieceCartouche.tpl"}

<form method="post" action="index.php" enctype="multipart/form-data" onSubmit='return validerForm("dateExample:la date est obligatoire,comment:le commentaire est obligatoire")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photoWrite">
<table class="tablesaisie">
<tr>
<td class="libelleSaisie">Nom de la photo : </td>
<td>
<input name="photo_nom" value="{$data.photo_nom}" maxlength="255" size="50">
</td>
</tr>
<tr>
<td class="libelleSaisie">Description : </td>
<td>
<input name="description" value="{$data.description}" maxlength="255" size="50">
</td>
</tr>
<tr>
		<td class="libelleSaisie">Fichier JPG contenant la photo : </td>
		<td>
			<input type="hidden" name="MAX_FILE_SIZE" value="50000000">
			<input type="file" name="photoload" accept="image/jpeg" size="50">
		</td>
</tr>
<tr>
<td class="libelleSaisie">Nom du fichier : </td>
<td>
<input name="photo_filename" value="{$data.photo_filename}" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">Date de prise de vue : </td>
<td>
<input name="photo_date" id="photo_date" value="{$data.photo_date}" maxlength="10" size="10">
<img id='button1' src='display/javascript/calendar/images/calendar.png' class='calendrier' alt='Calendrier' title='Calendrier'>
<script type='text/javascript'>calendarini("photo_date","button1")</script>
</td>
</tr>
<tr>
<td class="libelleSaisie">Couleur : </td>
<td>
<input type="radio" name="color" value="NB" {if $data.color == "NB"}checked{/if}>Noir et blanc
<br>
<input type="radio" name="color" value="C" {if $data.color == "C"}checked{/if}>Couleur
</td>
</tr>
<tr>
<td class="libelleSaisie">Type de lumière : </td>
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
<td class="libelleSaisie">Grossissement : </td>
<td>
<input name="grossissement" value="{$data.grossissement}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">Repère : </td>
<td>
<input name="repere" value="{$data.repere}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">Adresse de stockage (fichiers dans arborescence) : </td>
<td>
<input name="URI" value="{$data.URI}" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">Repère de mesure - longueur de référence : </td>
<td>
<input name="long_reference" value="{$data.long_reference}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">Dimensions de la photo : </td>
<td>
<input name="photo_width" value="{$data.photo_width}" readonly>x 
<input name="photo_height" value="{$data.photo_height}" readonly>
</td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
{if $data.photo_id>0 && $droits["admin"] == 1}
<form action="index.php" method="post" onSubmit='return confirmSuppression("{$LANG.message.31}")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photoDelete">
<input type="submit" value="Supprimer">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">Champ obligatoire</span>