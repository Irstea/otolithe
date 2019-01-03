<?php

/**
 * Classe de description des modèles de métadonnées
 *
 */

class Metadatatype extends ObjetBDD
{
    public function __construct($bdd, $param = array())
    {
        $this->table = "metadatatype";
        $this->colonnes = array(
            "metadatatype_id" => array("type" => 1, "key" => 1, "requis" => 1, "defaultValue" => 0),
            "metadatatype_name" => array("requis" => 1),
            "metadatatype_comment" => array('type' => 0),
            "metadatatype_description" => array("type" => 0),
            "is_array" => array("type" => 0),
            "metadatatype_schema" => array("type" => 0)
        );
        parent::__construct($bdd, $param);
    }
}

?>
