<?php

$template = './views/pages/focusAnnonce.php';

require_once('models/annoncesManager.php');
require_once('models/avancéesManager.php');
require_once('models/disposManager.php');
require_once('models/rechercheManager.php');

$annoncesManager = new annoncesManager();
$annoncesManager->dbConnect();


$avanceesManager = new avancéesManager();
$avanceesManager->dbConnect();

$avancees = $avanceesManager->getAvancees();

$disposManager = new disposManager();
$disposManager->dbConnect();

$dispos = $disposManager->getDispos();

$rechercheManager = new rechercheManager();
$rechercheManager->dbConnect();

$recherches = $rechercheManager->getRecherche();

   