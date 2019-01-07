<?php

/**
 * Code execute systematiquement a chaque appel, apres demarrage de la session
 * Utilise notamment pour recuperer les instances de classes stockees en 
 * variables de session
 */

/*
 * Initialisation des classes contenant les parametres de recherche
 */
if (!isset($_SESSION["searchIndividu"])) {
	$searchIndividu = new SearchIndividu();
	$_SESSION["searchIndividu"] = $searchIndividu;
} else {
	$searchIndividu = $_SESSION["searchIndividu"];
}
if (!isset($_SESSION["searchLecture"])) {
	$searchLecture = new SearchLecture();
	$_SESSION["searchLecture"] = $searchLecture;
} else {
	$searchLecture = $_SESSION["searchLecture"];
}

/*
 * Initialisations des traducteurs d'identifiants
 */
$traducteurs = array(
	"it_individu" => "individu_id",
	"it_experimentation" => "exp_id",
	"it_piece" => "piece_id",
	"it_peche" => "peche_id",
	"it_photo" => "photo_id",
	"it_photolecture" => "photolecture_id",
	"it_piecemetadata" => "piecemetadata_id"
);
foreach ($traducteurs as $key => $value) {
	if (!isset($_SESSION[$key])) {
		$_SESSION[$key] = new TranslateId($value);
	}
}
?>