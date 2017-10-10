<?php

/**
 * Created : 17 août 2016
 * Creator : quinton
 * Encoding : UTF-8
 * Copyright 2016 - All rights reserved
 */
/**
 * Classes d'exception
 *
 * @author quinton
 *        
 */
class FichierException extends Exception
{
}
;

class HeaderException extends Exception
{
}
;

class ImportException extends Exception
{
}
;

/**
 * Classe realisant l'import
 *
 * @author quinton
 *        
 */
class Import
{

    private $separator = ",";

    private $utf8_encode = false;

    private $colonnes = array(
        "exp_id",
        "piecetype_id",
        "piececode",
        "espece_id",
        "codeindividu",
        "tag",
        "poids",
        "longueur",
        "site",
        "peche_code",
        "peche_remarque",
        "peche_code_id"
    );

    private $colnum = array(
        "poids",
        "longueur",
        "peche_code_id"
    );

    private $handle;

    private $fileColumn = array();

    public $nbTreated = 0;

    private $experimentation = array();

    private $piecetype = array();

    private $espece = array();

    private $individu, $piece, $ie, $peche;

    private $initIdentifiers = false;

    public $minuid, $maxuid;

    /**
     * Initialise la lecture du fichier, et lit la ligne d'entete
     *
     * @param string $filename
     * @param string $separator
     * @param string $utf8_encode
     * @throws HeaderException
     * @throws FichierException
     */
    function initFile($filename, $separator = ",", $utf8_encode = false)
    {
        if ($separator == "tab")
            $separator = "\t";
        $this->separator = $separator;
        $this->utf8_encode = $utf8_encode;
        /*
         * Ouverture du fichier
         */
        if ($this->handle = fopen($filename, 'r')) {
            /*
             * Lecture de la premiere ligne et affectation des colonnes
             */
            $data = $this->readLine();
            $range = 0;
            for ($range = 0; $range < count($data); $range ++) {
                $value = $data[$range];
                if (in_array($value, $this->colonnes)) {
                    $this->fileColumn[$range] = $value;
                } else
                    throw new HeaderException("Header column $range is not recognized ($value)");
            }
        } else {
            throw new FichierException("$filename not found or not readable");
        }
    }

    /**
     * Initialise les classes utilisees pour realiser les imports
     *
     * @param Individu $individu
     * @param Piece $piece
     */
    function initClasses(Individu $individu, Piece $piece, Individu_experimentation $ie, Peche $peche)
    {
        $this->individu = $individu;
        $this->piece = $piece;
        $this->ie = $ie;
        $this->peche = $peche;
    }

    /**
     * Lit une ligne dans le fichier
     *
     * @return array|NULL
     */
    function readLine()
    {
        if ($this->handle) {
            $data = fgetcsv($this->handle, 1000, $this->separator);
            if ($data !== false) {
                if ($this->utf8_encode) {
                    foreach ($data as $key => $value)
                        $data[$key] = utf8_encode($value);
                }
            }
            return $data;
        } else
            return null;
    }

    /**
     * Ferme le fichier
     */
    function fileClose()
    {
        if ($this->handle)
            fclose($this->handle);
    }

    /**
     * Lance l'import des lignes
     *
     * @throws ImportException
     */
    function importAll()
    {
        $date = date('d/m/Y H:i:s');
        $num = 1;
        $maxuid = 0;
        $minuid = 99999999;
        while (($data = $this->readLine()) !== false) {
            /*
             * Preparation du tableau
             */
            $values = $this->prepareLine($data);
            $num ++;
            /*
             * Controle de la ligne
             */
            $resControle = $this->controlLine($values);
            if ($resControle["code"] == false) {
                throw new ImportException("Line $num : " . $resControle["message"]);
            }
            /*
             * Lancement de l'ecriture des informations
             */
            $individu_id = 0;
            $di = $values;
            $di["individu_id"] = 0;
            $peche_id = 0;
            try {
                /*
                 * Traitement de la peche
                 */
                if (strlren($values["site"]) > 0 || strlen($values["peche_date"]) > 0 || strlen($values["peche_remarque"]) > 0) {
                    $peche_id = $this->peche->ecrire($values);
                    if ($peche_id > 0) {
                        $di["peche_id"] = $peche_id;
                    }
                }
                /*
                 * Traitement de l'individu
                 */
                $individu_id = $this->individu->ecrire($di);
                /*
                 * Rattachement a l'experimentation
                 */
                $data_ie = array(
                    "individu_id" => $individu_id,
                    "exp_id" => $values["exp_id"]
                );
                $this->ie->ecrire($data_ie);
                /*
                 * Rajout de la piece
                 */
                if ($values["piecetype_id"] > 0) {
                    $dp = $values;
                    $dp["individu_id"] = $individu_id;
                    $this->piece->ecrire($dp);
                }
            } catch (PDOException $pe) {
                throw new ImportException("Line $num : error when import container<br>" . $pe->getMessage());
            }
            /*
             * Mise a jour des bornes de l'uid
             */
            if ($individu_id < $minuid)
                $minuid = $individu_id;
            if ($individu_id > $maxuid)
                $maxuid = $individu_id;
            $this->nbTreated ++;
        }
        $this->minuid = $minuid;
        $this->maxuid = $maxuid;
    }

    /**
     * Reecrit une ligne, en placant les bonnes valeurs en fonction de l'entete
     *
     * @param array $data
     * @return array[]
     */
    function prepareLine($data)
    {
        $nb = count($data);
        $values = array();
        for ($i = 0; $i < $nb; $i ++)
            $values[$this->fileColumn[$i]] = $data[$i];
        return $values;
    }

    /**
     * Initialise les tableaux pour traiter les controles
     *
     * @param array $experimentation
     * @param array $piecetype
     * @param array $espece
     */
    function initControl($experimentation, $piecetype, $espece)
    {
        $this->experimentation = $experimentation;
        $this->piecetype = $piecetype;
        $this->espece = $espece;
    }

    /**
     * Declenche le controle pour toutes les lignes
     *
     * @return array[]["line"=>int, "message"=>string]
     */
    function controlAll()
    {
        $num = 1;
        $retour = array();
        while (($data = $this->readLine()) !== false) {
            $values = $this->prepareLine($data);
            $num ++;
            $controle = $this->controlLine($values);
            if ($controle["code"] == false) {
                $retour[] = array(
                    "line" => $num,
                    "message" => $controle["message"]
                );
            }
        }
        return $retour;
    }

    /**
     * Controle une ligne
     *
     * @param array $data
     * @return array ["code"=>boolean,"message"=>string]
     */
    function controlLine($data)
    {
        $retour = array(
            "code" => true,
            "message" => ""
        );
        $emptyLine = true;
        /*
         * Verification que le codeindividu ou le tag sont renseignes
         */
        if (strlen($data["codeindividu"]) == 0 && strlen($data["tag"]) == 0) {
            $retour["code"] = false;
            $retour["message"] .= "Aucun code (codeindividu ou tag) n'a été indiqué. ";
        }
        /*
         * Verification de l'experimentation
         */
        $ok = false;
        foreach ($this->experimentation as $value) {
            if ($data["exp_id"] == $value["exp_id"]) {
                $ok = true;
                break;
            }
        }
        if ($ok == false) {
            $retour["code"] = false;
            $retour["message"] .= "Le numéro de l'expérimentation est manquant, inconnu ou non autorisé. ";
        }
        /*
         * Verification de l'espece
         */
        $ok = false;
        foreach ($this->espece as $value) {
            if ($data["espece_id"] == $value["espece_id"]) {
                $ok = true;
                break;
            }
        }
        if ($ok == false) {
            $retour["code"] = false;
            $retour["message"] .= "Le numéro d'espèce est manquant ou non connu. ";
        }
        /*
         * Verification que le type de la piece soit renseigne si le code de
         * la piece est renseigne
         */
        if (strlen($data["piececode"]) > 0 && strlen($data["piecetype_id"]) == 0) {
            $retour["code"] = false;
            $retour["message"] .= "La pièce dispose d'un code, mais son type n'a pas été indiqué. ";
        }
        /*
         * Verification du type de la piece
         */
        $ok = false;
        if ($data["piecetype_id"] > 0) {
            foreach ($this->piecetype as $value) {
                if ($data["piecetype_id"] == $value["piecetype_id"]) {
                    $ok = true;
                    break;
                }
            }
            if ($ok == false) {
                $retour["code"] = false;
                $retour["message"] .= "Le statut de l'échantillon n'est pas connu. ";
            }
        }
        
        /*
         * Verification des champs numeriques
         */
        foreach ($this->colnum as $key) {
            if (strlen($data[$key]) > 0) {
                if (! is_numeric($data[$key])) {
                    $retour["code"] = false;
                    $retour["message"] .= "Le champ $key n'est pas numérique. ";
                }
            }
        }
        return $retour;
    }
}
?>