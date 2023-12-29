<?php

require './models/usersManager.php';

if(isset($_GET['id'])){
    $template = './views/pages/profil.php';

    $usersManager = new usersManager();
    $annoncesManager = new annoncesManager();
    $user = $usersManager->getUserWithId($_GET['id']);
    if($user){
        if($user['id'] == $_SESSION['idUser'])
            $currentUser = true;
        else
            $currentUser = false;

        $annonces = $annoncesManager->getAnnoncesUser($user['id']);
    }
    else{
        header("Location: index.php?page=connexion");
    }
}
else{
    header("Location: index.php?page=connexion");
}