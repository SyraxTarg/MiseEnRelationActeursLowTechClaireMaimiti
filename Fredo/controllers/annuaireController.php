<?php

$template = './views/pages/annuaire.php';

require_once('models/particuliersManager.php');

$particuliersManager= new particuliersManager();
$particuliersManager->dbConnect();




$triValue = "DESC"; 

if (isset($_POST['tri_particuliers'])) {
    if ($_POST['triValue'] == "DESC") {
        $triValue = "ASC";
    } else {
        $triValue = "DESC";
    }
}


$particuliers = $particuliersManager->getParticuliers($triValue);

if(!empty($_POST['rechercher'])){
    $particuliers = $particuliersManager->rechercheParticuliers();
}