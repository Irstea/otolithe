<?php
class Individu extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "individu";
        $this->id_auto = "1";
        $this->colonnes = array(
            "individu_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "espece_id" => array(
                "type" => 1
            ),
            "peche_id" => array(
                "type" => 1
            ),
            "sexe_id" => array(
                "type" => 1
            ),
            "codeindividu" => array(
                "longueur" => 100,
                "requis" => 1
            ),
            "tag" => array(
                "longueur" => 255
            ),
            "longueur" => array(
                "type" => 1
            ),
            "poids" => array(
                "type" => 1
            ),
            "remarque" => array(
                "longueur" => 255
            ),
            "parasite" => array(
                "longueur" => 255
            ),
            "age" => array(
                "type" => 1
            )
        );

        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }

    /**
     * Recherche les animaux selon les criteres de selection fournis
     *
     * @param array $data
     * @return array
     */
    function getListSearch($data)
    {
        $data = $this->encodeData($data);
        $sql = "select i.individu_id, i.codeindividu, i.tag, e.nom_id, count (pc.piece_id) as nbrepiece,
				s.sexe_libellecourt, p.peche_date, p.site, p.zonesite, ex.exp_nom, i.age
				from individu i
					left outer join espece e on (e.espece_id = i.espece_id)
					left outer join piece pc on (pc.individu_id = i.individu_id)
					left outer join individu_experimentation ie on (ie.individu_id = i.individu_id)
					left outer join experimentation ex on (ex.exp_id = ie.exp_id)
					left outer join peche p on (p.peche_id = i.peche_id)
					left outer join sexe s on (s.sexe_id = i.sexe_id) 	
						";
        /*
         * Preparation de la clause where
         */
        $where = "";
        $and = " and ";

        $where =" where ie.exp_id = " . $data["exp_id"];

        if (strlen($data["codeindividu"]) > 0) {
            $where .= $and ."(upper(i.codeindividu) like upper('%" . $data["codeindividu"] . "%')
					or upper(i.tag) like upper('%" . $data["codeindividu"] . "%')
							)";
        }
        if ($data["sexe"] > 0) {
            $where .= $and . "i.sexe_id = " . $data["sexe"];
        }
        if (strlen($data["site"]) > 0) {
            $where .= $and . "p.site = '" . $data["site"] . "'";
        }
        if (strlen($data["zone"]) > 0) {
            $where .= $and . "p.zonesite = '" . $data["zone"] . "'";
        }
        /**
         * Recherche des lectures non réalisées
         */
        if ($data["isNotRead"]==1 && $data["lecteur_id"]>0) {
            $where .= $and . " i.individu_id not in (
                select i2.individu_id
                from individu  i2
                join individu_experimentation ie2 on (i2.individu_id = ie2.individu_id)
                join piece pc2 on (i2.individu_id = pc2.individu_id)
                join photo ph on (ph.piece_id = pc2.piece_id)
                join photolecture phl on (phl.photo_id = ph.photo_id)
                where ie2.exp_id = ".$data["exp_id"] ."
                    and phl.lecteur_id = ".$data["lecteur_id"] ."
                )
            ";
        }
        /*
         * Preparation du group by
         */
        $group = " group by i.individu_id, i.codeindividu, e.nom_id, s.sexe_libellecourt, p.peche_date, p.site, p.zonesite, ex.exp_nom, i.tag";
        /*
         * Preparation de la clause de tri
         */
        $tri = " order by codeindividu";
        $listData = $this->getListeParam($sql . $where . $group . $tri);
        /*
         * Mise en forme des dates
         */
        foreach ($listData as $key => $value) {
            $listData[$key]["peche_date"] = $this->formatDateDBversLocal($value["peche_date"]);
        }
        return $listData;
    }

    /**
     * Retourne le detail d'un poisson
     *
     * @param int $id
     * @return array
     */
    function getDetail($id)
    {
        if ($id > 0 && is_numeric($id)) {
            $sql = "select individu_id, nom_id, peche_id, codeindividu, tag, longueur, poids, 
					remarque, parasite, age, sexe_libelle, peche_date
				from " . $this->table . " 
						left outer join sexe using (sexe_id)
						left outer join espece using (espece_id)
						left outer join peche using (peche_id)
						where individu_id = " . $id;
            $data = $this->lireParam($sql);
            /*
             * Mise en forme de la date de peche
             */

            if (strlen($data["peche_date"]) > 0) {
                $data["peche_date"] = $this->formatDateDBversLocal($data["peche_date"]);
            }
            return $data;
        }
    }

    /**
     * Reecriture de la fonction lire pour integrer l'espece
     * (non-PHPdoc)
     *
     * @see ObjetBDD::lire()
     */
    function lire($id)
    {
        if ($id >= 0 && is_numeric($id)) {
            $sql = "select individu_id, nom_id,
                    peche_id, espece_id, codeindividu, tag, longueur, poids,
					remarque, parasite, age, sexe_id
				from " . $this->table . "
						left outer join espece using (espece_id)
						where individu_id = " . $id;
            return $this->lireParam($sql);
        } else {
            return null;
        }
    }

    /**
     * Surcharge de la fonction ecrire pour enregistrer les experimentations
     * (non-PHPdoc)
     *
     * @see ObjetBDD::write()
     */
    function ecrire($data)
    {
        $id = parent::ecrire($data);
        if ($id > 0 && is_array($data["exp_id"])) {
            /*
             * Ecriture des experimentations
             */
            $this->ecrireTableNN("individu_experimentation", "individu_id", "exp_id", $id, $data["exp_id"]);
        }
        return $id;
    }

    function supprimer($id)
    {
        if ($id > 0 && is_numeric($id)) {
            /*
             * Recherche s'il existe des photos rattachees. Si oui, suppression refusee
             */
            $sql = "select count(*) as nb from individu
                    join piece using (individu_id)
                    join photo using (piece_id)
                    where individu_id = :individu_id
                    ";
            $aid = array(
                "individu_id" => $id
            );
            $res = $this->lireParamAsPrepared($sql, $aid);
            if ($res["nb"] > 0) {
                $this->addMessage(_("Des photos sont rattachées au poisson, sa suppression est impossible"));
                throw new ObjetBDDException(_("Des photos sont rattachées au poisson, sa suppression est impossible"));
            }
        }
        /*
         * Suppression des pieces rattachees
         */
        include_once 'modules/classes/piece.class.php';
        $piece = new Piece($this->connection, $this->paramori);       
        $piece->supprimerFromIndividu($id);
        /*
         * Suppression dans la table des experimentations
         */
        $sql = "delete from individu_experimentation where individu_id = :individu_id";
        $this->executeAsPrepared($sql, $aid, true);
        return parent::supprimer($id);
    }
}

/**
 * ORM de gestion de la table experimentation
 *
 * @author quinton
 *        
 */
class Experimentation extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "experimentation";
        $this->id_auto = "1";
        $this->colonnes = array(
            "exp_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "exp_nom" => array(
                "longueur" => 100
            ),
            "exp_description" => array(
                "longueur" => 255
            ),
            "exp_debut" => array(
                "type" => 2,
                "defaultValue" => "getDebutAnnee"
            ),
            "exp_fin" => array(
                "type" => 2,
                "defaultValue" => "getFinAnnee"
            )
        );

        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }

    /**
     * Ajout de la mise a jour de la liste des lecteurs
     *
     * {@inheritdoc}
     * @see ObjetBDD::ecrire()
     */
    function ecrire($data)
    {
        $id = parent::ecrire($data);
        if ($id > 0) {
            $this->ecrireTableNN("lecteur_experimentation", "exp_id", "lecteur_id", $id, $data["lecteur_id"]);
        }
        return $id;
    }

    /**
     * Reecriture de l'affichage de la liste
     * (non-PHPdoc)
     *
     * @see ObjetBDD::getListe()
     */
    function getListe()
    {
        $sql = "select * from " . $this->table . " order by exp_fin desc, exp_nom";
        return $this->getListeParam($sql);
    }

    /**
     * Fonction permettant de calculer la date de debut d'annee
     *
     * @return string
     */
    function getDebutAnnee()
    {
        $data = date("Y") . "-01-01";
        return $this->formatDateDBversLocal($data);
    }

    /**
     * Fonction permettant de calculer la date de fin d'annee
     *
     * @return string
     */
    function getFinAnnee()
    {
        $data = date("Y") . "-12-31";
        return $this->formatDateDBversLocal($data);
    }

    /**
     * Retourne la liste de toutes les experimentations, avec le lecteur associe
     * (saisie des experimentations autorisees)
     *
     * @param int $lecteur_id
     * @return array
     */
    function getAllListFromLecteur($lecteur_id)
    {
        if ($lecteur_id >= 0) {
            $sql = "select e.exp_id, exp_nom, lecteur_id
					from experimentation e
					left outer join lecteur_experimentation l 
					on (e.exp_id = l.exp_id and l.lecteur_id = " . $lecteur_id . ")
					order by exp_nom";
            return $this->getListeParam($sql);
        }
    }

    /**
     * Retourne la liste de toutes les experimentations, pour saisie par individu
     *
     * @param int $individu_id
     * @return array
     */
    function getAllListFromIndividu($individu_id)
    {
        if ($individu_id > 0) {
            $sql = "select e.exp_id, exp_nom, individu_id
					from experimentation e
					left outer join individu_experimentation ie 
					on (e.exp_id = ie.exp_id and ie.individu_id = :individu_id)
                    order by exp_nom";
                    $data = $this->getListeParamAsPrepared(
                        $sql, 
                        array("individu_id"=>$individu_id)
                    );
        } else {
            $sql = "select e.exp_id, exp_nom
            from experimentation e
            order by exp_nom";
            $data = $this->getListeParam($sql);

        }
            return $data;
        
    }

    /**
     * Retourne les lecteurs associes a une experimentation
     *
     * @param int $exp_id
     * @return array|string[]|array[]|string|boolean
     */
    function getReaders($exp_id)
    {
        $sql = "select l.lecteur_id, login, lecteur_nom, lecteur_prenom, 
                case when exp_id is not null then 1 else 0 end as is_reader
                from lecteur l
                left outer join lecteur_experimentation le on (l.lecteur_id = le.lecteur_id and exp_id = :exp_id)
               order by lecteur_nom, lecteur_prenom
	           ";
        return $this->getListeParamAsPrepared($sql, array(
            "exp_id" => $exp_id
        ));
    }

    /**
     * Retourne la liste des experimentations autorisees pour un lecteur
     *
     * @param int $lecteur_id
     * @return array|NULL
     */
    function getExpAutorisees($lecteur_id)
    {
        if ($lecteur_id >= 0) {
            $sql = "select e.exp_id, e.exp_nom
					from experimentation e
					join lecteur_experimentation using (exp_id)
					where lecteur_id = " . $lecteur_id . "
					order by e.exp_nom";
            return $this->getListeParam($sql);
        } else {
            return null;
        }
    }
}

/**
 * ORM de gestion de la table individu_experimentation
 *
 * @author quinton
 *        
 */
class Individu_experimentation extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "individu_experimentation";
        $this->id_auto = "0";
        $this->colonnes = array(
            "individu_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "parentAttrib" => 1
            ),
            "exp_id" => array(
                "type" => 1,
                "requis" => 1,
                "key" => 1
            )
        );
        $param["fullDescription"] = 1;
        $param["id_auto"] = 0;
        parent::__construct($bdd, $param);
    }

    /**
     * Retourne la liste des experimentations rattachees a un individu
     *
     * @param int $individu_id
     * @return array
     */
    function getListeFromIndividu($individu_id)
    {
        if ($individu_id > 0) {
            $sql = "select * from " . $this->table . "
				inner join experimentation using (exp_id)
				where individu_id = " . $individu_id;
            return $this->getListeParam($sql);
        } else {
            return null;
        }
    }
}

/**
 * ORM de gestion de la table sexe
 *
 * @author quinton
 *        
 */
class Sexe extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "sexe";
        $this->id_auto = "0";
        $this->colonnes = array(
            "sexe_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1,
                "defaultValue" => 0
            ),
            "sexe_libelle" => array(
                "longueur" => 255,
                "requis" => 1
            ),
            "sexe_libellecourt" => array(
                "longueur" => 255,
                "requis" => 1
            )
        );
        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }
}

/**
 * ORM de gestion de la table espece
 *
 * @author quinton
 *        
 */
class Espece extends ObjetBDD
{

    public function __construct($p_connection, $param = array())
    {
        $this->table = "espece";
        $this->id_auto = 1;
        $this->colonnes = array(
            "espece_id" => array(
                "type" => 1,
                "requis" => 1,
                "key" => 1,
                "defaultValue" => 0
            ),
            "nom_id" => array(
                "type" => 0,
                "requis" => 1
            ),
            "nom_fr" => array(
                "type" => 0
            )
        );
        $param["fullDescription"] = 1;
        parent::__construct($p_connection, $param);
    }

    /**
     * recherche une espece par rapport a son nom latin ou vernaculaire
     * Retourne le resultat au format JSON, pour utilisation en ajax
     *
     * @param string $nom
     * @return array
     */
    function getEspeceJSON($nom)
    {
        if (strlen($nom) > 2) {
            $nom = $this->encodeData($nom);
            $sql = "select espece_id as id, nom_id ||' - ' || nom_fr as val 
				from " . $this->table . "
				where upper(nom_id) like upper('%" . $nom . "%')
						or upper(nom_fr) like upper ('%" . $nom . "%')
				order by nom_id";
            return $this->getListeParam($sql);
        }
    }
}

/**
 * ORM de la table naturetraitement
 *
 * @author quinton
 *        
 */
class Naturetraitement extends ObjetBdd
{

    function __construct($bdd, $param = array())
    {
        $this->param = $param;
        $this->table = "naturetraitement";
        $this->id_auto = 1;
        $this->colonnes = array(
            "naturetraitement_id" => array(
                "type" => 1,
                "key" => 1,
                "requis" => 1
            ),
            "naturetraitement_libelle" => array(
                "longueur" => 255,
                "requis" => 1
            )
        );
        $param["fullDescription"] = 1;
        parent::__construct($bdd, $param);
    }
}

?>