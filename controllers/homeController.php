<?php

if(isset($_SESSION['idUser'])){
    $connecte = true;
    require_once 'models/usersManager.php';
    $usersManager = new usersManager();
    $currentUser = $usersManager->getCurrentUser()[0];
}
else{
    $connecte = false;
}

$template = './views/pages/home.php';

require_once('models/annoncesManager.php');

$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();


$annonces=$annoncesManager->getAnnonces();

