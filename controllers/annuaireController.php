<?php

$template = './views/pages/annuaire.php';

require_once('models/particuliersManager.php');

$particuliersManager= new particuliersManager();
$particuliersManager->dbConnect();

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "SD":
            $msg = "<p>L'utilisateur a été banni.</p>";
            break;
    }
}



if (!empty($_POST['rechercher'])) {
    $particuliers = $particuliersManager->rechercheParticuliers($_POST['recherche']);
} else {
    $triValue = "DESC";
    if (isset($_POST['tri_particuliers'])) {
        if ($_POST['tri_particuliers'] == "Z à A") {
            $triValue = "DESC";
        } else {
            $triValue = "ASC";
        }
    }

    $particuliers = $particuliersManager->getParticuliers($triValue);
}

