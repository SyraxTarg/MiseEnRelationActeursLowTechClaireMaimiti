<?php

$template = './views/pages/mur.php';

require_once('models/annoncesManager.php');

$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();

$annoncesPinned = $annoncesManager->getPinnedAnnonces();

$annoncesNonPinned = $annoncesManager->getNonPinnedAnnonces();

// if (isset($_POST['like'])) {
    
//     if ($_POST['like'] === 'like') {
//         $annoncesManager->leaveLike($_POST['annonce_id']);
//     } else {
//         $annoncesManager->removeLike($_POST['annonce_id']);
//     }
// } else {
//     echo "Erreur : Paramètres manquants dans la requête.";
// }



