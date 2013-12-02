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
?>