<?php

$template = './views/pages/postAnnonce.php';

require_once('models/annoncesManager.php');
require_once('models/rechercheManager.php');
require_once('models/avancéesManager.php');
require_once('models/disposManager.php');



$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();


$avanceesManager = new avancéesManager();
$avanceesManager->dbConnect();


$disposManager = new disposManager();
$disposManager->dbConnect();


$rechercheManager = new rechercheManager();
$rechercheManager->dbConnect();




if (isset($_SESSION['username'])) {
    if (isset($_POST['postAnnonce'])) {
        $pinned = isset($_POST['pinned']);
        $annoncesManager->postAnnonce($pinned);
        $lastAnnonce = $annoncesManager->getlastAnnonce();
        

        if (isset($_POST['Avancées'])) {
            $avanceesManager->postAvancees($lastAnnonce[0]['id']);
        }
        if ($_SESSION['privileges'] == "particulier") {
            $disposManager->postDispos($lastAnnonce[0]['id']);
        }
        if (isset($_POST['Recherche'])) {
            $rechercheManager->postRecherche($lastAnnonce[0]['id']);
        }
    }
}
