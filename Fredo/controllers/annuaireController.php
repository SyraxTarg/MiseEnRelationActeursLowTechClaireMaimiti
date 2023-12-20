<?php

$template = './views/pages/annuaire.php';

require_once('models/particuliersManager.php');

$particuliersManager= new particuliersManager();
$particuliersManager->dbConnect();


// if(isset($_POST['tri_particuliers'])){
//     if($triValue =="DESC"){
//         $triValue = "ASC";
//         echo $triValue;
//         $particuliers=$particuliersManager->getParticuliers($triValue);
        
//     } else{
//         $triValue = "DESC";
//         $particuliers=$particuliersManager->getParticuliers($triValue);
//     }
// }else {
//     $triValue = "DESC";
//     $particuliers=$particuliersManager->getParticuliers($triValue);

// }

$triValue = "DESC"; // Valeur par défaut

if (isset($_POST['tri_particuliers'])) {
    if ($_POST['triValue'] == "DESC") {
        $triValue = "ASC";
    } else {
        $triValue = "DESC";
    }
}


// Obtient les particuliers en utilisant la valeur actuelle de tri
$particuliers = $particuliersManager->getParticuliers($triValue);