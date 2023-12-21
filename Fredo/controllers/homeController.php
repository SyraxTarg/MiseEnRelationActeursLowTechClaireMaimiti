<?php

$template = './views/pages/home.php';

require_once('models/annoncesManager.php');

$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();


$annonces=$annoncesManager->getAnnonces();

