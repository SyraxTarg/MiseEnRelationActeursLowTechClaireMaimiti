<?php

$template = './views/pages/annuaire.php';

require_once('models/particuliersManager.php');

$particuliersManager= new particuliersManager();
$particuliersManager->dbConnect();



if(!empty($_GET['tri_particuliers'])){
    if($triValue ==='DESC'){
        $triValue = "ASC";
        $particuliers=$particuliersManager->getParticuliers($triValue);
    } else{
        $triValue = "DESC";
        $particuliers=$particuliersManager->getParticuliers($triValue);
    }

}else {
    $triValue = "DESC";
    $particuliers=$particuliersManager->getParticuliers($triValue);
}

