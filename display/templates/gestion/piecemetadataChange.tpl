<script>
    $(document).ready(function() {
        
        $('#piecemetadataForm').submit(function(event) {
            if($("#action").val()=="Write"){
            	var error = false;
            	var metadatatype_id = $("#metadatatype_id").val();
            	if (metadatatype_id) {
            		if (metadatatype_id.length == 0 ) {
            			error = true;
            		} 
            	} else {
            		error = true;
            	}
            	
        
                $('#metadata').alpaca().refreshValidationState(true);
                if($('#metadata').alpaca().isValid(true)){
                	var value = $('#metadata').alpaca().getValue();
                	 // met les metadata en JSON dans le champ (name="metadata") qui sera sauvegardé en base
                	 $("#metadataField").val(JSON.stringify(value));
                	 console.log($("#metadataField").val());
                } else {
                   	error = true;
                }
                if (error) {
                	event.preventDefault();
                }
            }
    	});
    });
</script>
<h2>{t}Métadonnées associées à la pièce{/t}</h2>
{include file="gestion/pieceCartouche.tpl"}
<div class="row">
    <fieldset class="col-md-6">
        <legend>{t}Données générales{/t}</legend>
        <form class="form-horizontal protoform" id="piecemetadataForm" method="post" action="index.php" >
            <input type="hidden" name="piecemetadata_id" value="{$data.piecemetadata_id}">
            <input type="hidden" name="moduleBase" value="sample">
            <input type="hidden" id="action" name="action" value="Write">
            <input type="hidden" name="piece_id" value="{$data.piece_id}">
            <input type="hidden" name="metadata" id="metadataField" value="{$data.metadata}">
            <div class="form-group center">
                <button type="submit" class="btn btn-primary button-valid">{t}Valider{/t}</button>
                {if $data.piecemetadata_id > 0 }
                    <button class="btn btn-danger button-delete">{t}Supprimer{/t}</button>
                {/if}
             </div>
            <div class="form-group">
                <label for="piecemetadata_date"  class="datepicker control-label col-md-4">{t}Date d'acquisition des données :{/t}</label>
                <div class="col-md-8">
                    <input id="piecemetadata_date" class="form-control" name="piecemetadata_date" value="{$data.piecemetadata_date}">
                </div>
            </div>
          <div class="form-group">
                <label for="piecemetadataComment"  class="control-label col-md-4">{t}Commentaire :{/t}</label>
                <div class="col-md-8">
                    <textarea id="piecemetadataComment" type="text" class="form-control" name="piecemetadata_comment">{$data.piecemetadata_comment}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="metadatatypeId" class="control-label col-md-4">{t}Modèle de métadonnées à utiliser :{/t}</label>
                <div class="col-md-8">
                    <select id="metadatatypeId" name="metadatatype_id" class="form-control">
                        {foreach $metadatatypes as $mt}
                            <option value="{$mt.metadatatype_id}" {if $data.metadatatype_id == $mt.metadatatype_id}selected{/if}>
                                {$mt.metadatatype_name}
                            </option>
                        {/foreach}
                    </select>
                </div>

            </div>
            
        </form>
    </fieldset>
</div>