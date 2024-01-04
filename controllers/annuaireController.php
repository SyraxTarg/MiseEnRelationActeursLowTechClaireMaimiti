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



$particuliers = $particuliersManager->getParticuliers("DESC");