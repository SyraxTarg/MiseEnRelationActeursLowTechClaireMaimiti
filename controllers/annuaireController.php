<?php

$template = './views/pages/annuaire.php';

require_once('models/particuliersManager.php');

$particuliersManager= new particuliersManager();
$particuliersManager->dbConnect();


if (!empty($_POST['rechercher'])) {
    $particuliers = $particuliersManager->rechercheParticuliers($_POST['recherche']);
} else {
    $triValue = "DESC";
    if (isset($_POST['tri_particuliers'])) {
        if ($_POST['tri_particuliers'] == "DESC") {
            $triValue = "ASC";
        } else {
            $triValue = "DESC";
        }
    }

    $particuliers = $particuliersManager->getParticuliers($triValue);
}

