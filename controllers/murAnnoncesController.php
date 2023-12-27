<?php

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



function getAnnonceType($annonceId, $avancees, $dispos, $recherches){
    foreach($avancees as $avancee){
        if($avancee['id_annonce'] === $annonceId){
            echo "<p class ='annonceType'>Avancée</p>";
        }
    }
    foreach($dispos as $dispo){
        if($dispo['id_annonce'] === $annonceId){
            echo "<p class ='annonceType'>Disponibilité</p>";
        }
    }
    foreach($recherches as $recherche){
        if($recherche['id_annonce'] === $annonceId){
            echo "<p class ='annonceType'>Recherche</p>";
        }
    }
}