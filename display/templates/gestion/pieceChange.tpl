<h2>Modification d'une pièce</h2>
<a href="index.php?module={$moduleListe}">Retour à la liste</a> > 
<a href="index.php?module=individuDisplay&individu_id={$data.individu_id}">Retour au détail du poisson</a>
{if $data.piece_id > 0}
> <a href="index.php?module=pieceDisplay&piece_id={$data.piece_id}">Retour au détail de la pièce</a>
{/if}
{include file="gestion/individuCartouche.tpl"}
<table class="tablesaisie">
<form method="post" action="index.php?module=pieceWrite" onSubmit='return validerForm("dateExample:la date est obligatoire,comment:le commentaire est obligatoire")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="individu_id" value="{$data.individu_id}">

<tr>
<td class="libelleSaisie">Type de pièce :</td>
<td class="datamodif">
<select name="piecetype_id">
{section name="lst" loop=$piecetype}
<option value="{$piecetype[lst].piecetype_id}" {if $piecetype[lst].piecetype_id == $data.piecetype_id}selected{/if}>
{$piecetype[lst].piecetype_libelle}
</option>
{/section}
</select>
</td>
</tr>

<tr>
<td class="libelleSaisie">Code de la pièce :</td>
<td>
<input id="piececode" name="piececode" value="{$data.piececode}" maxlengh="255" size="45">
</td>
</tr>

<tr>
<td class="libelleSaisie">Traitement effectué :</td>
<td class="datamodif">
<select name="traitementpiece_id">
{section name="lst" loop=$traitementpiece}
<option value="{$traitementpiece[lst].traitementpiece_id}" {if $traitementpiece[lst].traitementpiece_id == $data.traitementpiece_id}selected{/if}>
{$traitementpiece[lst].traitementpiece_libelle}
</option>
{/section}
</select>
</td>
</tr>

<tr>
<td colspan="2"><div align="center">
<input type="submit" value="Enregistrer">
</form>
{if $data.piece_id>0&&$droits["admin"] == 1}
<form action="index.php" method="post" onSubmit='return confirmSuppression("{$LANG.message.31}")'>
<input type="hidden" name="piece_id" value="{$data.piece_id}">
<input type="hidden" name="individu_id" value="{$data.individu_id}">
<input type="hidden" name="module" value="pieceDelete">
<input type="submit" value="Supprimer">
</form>
{/if}
</div>
</td>
</tr>
</table>
