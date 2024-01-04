<?php

$template = './views/pages/annuaire.php';

require_once('models/particuliersManager.php');
require_once('models/modérateursManager.php');

$particuliersManager= new particuliersManager();
$particuliersManager->dbConnect();

$modérateursManager = new modérateursManager();
$modérateursManager->dbConnect();

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "SD":
            $msg = "<p>L'utilisateur a été banni.</p>";
            break;
    }
}



$particuliers = $particuliersManager->getParticuliers("DESC");
$modos = $modérateursManager->getModérateurs();