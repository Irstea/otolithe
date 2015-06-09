<script type="text/javascript" src="display/javascript/calendar/calendar.js"></script>
<script type="text/javascript" src="display/javascript/calendar/lang/calendar-fr.js"></script>
<script type="text/javascript" src="display/javascript/calendar/calendar-setup.js"></script>
<style type="text/css">@import url(display/javascript/calendar/aqua/theme.css);</style>

<h2>{$LANG["gestion"].63}</h2>
<a href="index.php?module={$moduleListe}">{$LANG["gestion"].0}</a> > 
<a href="index.php?module=individuDisplay&individu_id={$individu.individu_id}">{$LANG["gestion"].64}</a> > 
<a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">{$LANG["gestion"].65}</a>
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
<td class="libelleSaisie">{$LANG["gestion"].66} : </td>
<td>
<input name="photo_nom" value="{$data.photo_nom}" maxlength="255" size="50">
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].67} : </td>
<td>
<input name="description" value="{$data.description}" maxlength="255" size="50">
</td>
</tr>
<tr>
		<td class="libelleSaisie">{$LANG["gestion"].68} : </td>
		<td>
			<input type="hidden" name="MAX_FILE_SIZE" value="50000000">
			<input type="file" name="photoload" accept="image/jpeg" size="50">
		</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].69} : </td>
<td>
<input name="photo_filename" value="{$data.photo_filename}" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].70} : </td>
<td>
<input class="date" name="photo_date" id="photo_date" value="{$data.photo_date}" maxlength="10" size="10">
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].71} : </td>
<td>
<input type="radio" name="color" value="NB" {if $data.color == "NB"}checked{/if}>{$LANG["gestion"].72}
<br>
<input type="radio" name="color" value="C" {if $data.color == "C"}checked{/if}>{$LANG["gestion"].71}
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].73} : </td>
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
<td class="libelleSaisie">{$LANG["gestion"].74} : </td>
<td>
<input name="grossissement" value="{$data.grossissement}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].75} : </td>
<td>
<input name="repere" value="{$data.repere}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].76} : </td>
<td>
<input name="URI" value="{$data.URI}" maxlength="255" size="50" readonly>
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].77} : </td>
<td>
<input name="long_reference" value="{$data.long_reference}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].168} : </td>
<td>
<input name="long_ref_pixel" value="{$data.long_ref_pixel}" maxlength="20" size="20">
</td>
</tr>
<tr>
<td class="libelleSaisie">{$LANG["gestion"].78} : </td>
<td>
<input name="photo_width" value="{$data.photo_width}" readonly>x 
<input name="photo_height" value="{$data.photo_height}" readonly>
</td>
</tr>
<tr>
<td colspan="2"><div align="center">
<input type="submit" value="{$LANG["message"].19}">
</form>
{if $data.photo_id>0 && $droits["admin"] == 1}
<form action="index.php" method="post" onSubmit='return confirmSuppression("{$LANG.message.31}")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="photo_id" value="{$data.photo_id}">
<input type="hidden" name="module" value="photoDelete">
<input type="submit" value="{$LANG["message"].20}">
</form>
{/if}
</div>
</td>
</tr>
</table>
<span class="red">*</span><span class="messagebas">{$LANG["message"].30}</span>