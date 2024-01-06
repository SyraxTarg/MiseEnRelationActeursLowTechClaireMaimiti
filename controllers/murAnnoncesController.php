<?php


$idAnnonce = isset($_GET['id']) ? $_GET['id'] : null;

if ($idAnnonce) {
    header("Location: $_SERVER[PHP_SELF]?page=focusAnnonce&id=$idAnnonce");
    exit();
} else {

    $template = './views/pages/mur.php';

    require_once('models/annoncesManager.php');
    require_once('models/avancéesManager.php');
    require_once('models/disposManager.php');
    require_once('models/rechercheManager.php');

    $annoncesManager= new annoncesManager();
    $annoncesManager->dbConnect();

    $annoncesPinned = $annoncesManager->getPinnedAnnonces();

    $annoncesNonPinned = $annoncesManager->getNonPinnedAnnonces();





    $avanceesManager = new avancéesManager();
    $avanceesManager->dbConnect();

    $avancees = $avanceesManager->getAvancees();

    $disposManager = new disposManager();
    $disposManager->dbConnect();

    $dispos = $disposManager->getDispos();

    $rechercheManager = new rechercheManager();
    $rechercheManager->dbConnect();

    $recherches = $rechercheManager->getRecherche();



}