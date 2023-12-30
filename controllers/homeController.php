<?php

if (isset($_SESSION['idUser'])) {
    $connecte = true;
    require_once 'models/usersManager.php';
    $usersManager = new usersManager();
    $currentUser = $usersManager->getCurrentUser();
} else {
    $connecte = false;
}

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "SD":
            $msg = "<p>L'utilisateur a bien été banni.</p>";
            break;
    }
}

$template = './views/pages/home.php';

require_once('models/annoncesManager.php');

$annoncesManager = new annoncesManager();
$annoncesManager->dbConnect();


$annonces = $annoncesManager->getAnnonces();

