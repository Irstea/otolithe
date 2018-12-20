<?php
/**
 * Classe ORM de la table Piecemetadata
 */
class Piecemetadata extends ObjetBDD
{
    /**
     * Constructeur
     *
     * @param pdo $bdd
     * @param array $param
     */
    public function __construct($bdd, $param = array())
    {
        $this->table = "piecemetadata";
        $this->colonnes = array(
            "metadatapiece_id" => array("type" => 1, "key" => 1, "requis" => 1, "defaultValue" => 0),
            "piece_id" => array("type" => 1, "parentAttrib" => 1, "requis" => 1),
            "metadata_id" => array("type" => 1, "requis" => 1),
            "metadata" => array("type" => 0),
            "piecemetadata_date" => array("type" => 2),
            "piecemetadata_comment" => array("type" => 0)
        );
        parent::__construct($bdd, $param);
    }
}