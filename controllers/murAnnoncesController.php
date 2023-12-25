<?php

$template = './views/pages/mur.php';

require_once('models/annoncesManager.php');

$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();

$annoncesPinned = $annoncesManager->getPinnedAnnonces();

$annoncesNonPinned = $annoncesManager->getNonPinnedAnnonces();