<?php

require_once './models/usersManager.php';
require_once './models/modérateursManager.php';
$moderateursManager = new modérateursManager();

if (isset($_GET['id'])) {
    $template = './views/pages/profil.php';

    $usersManager = new usersManager();
    $annoncesManager = new annoncesManager();
    $user = $usersManager->getUserWithId($_GET['id']);
    if ($user) {
        if ($user['id'] == $_SESSION['idUser'])
            $currentUser = true;
        else
            $currentUser = false;

        if (!$currentUser)
            $userPrivileges = getPrivileges($user['id']);

        $annonces = $annoncesManager->getAnnoncesUser($user['id']);
    } else {
        header("Location: index.php?page=connexion");
    }
} else {
    header("Location: index.php?page=connexion");
}



if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "grant":
            $moderateursManager->grantModoPrivileges($user['id']);
            header("Location: index.php?page=profil&id=" . $user['id']);
            break;
        case "remove":
            $moderateursManager->removeModoPrivileges($user['id']);
            header("Location: index.php?page=profil&id=" . $user['id']);
            break;
    }
}


function getPrivileges($id)
{
    $moderateursManager = new modérateursManager();
    $modo = $moderateursManager->getUniqueModo($id);

    if ($modo)
        return "modo";
    else
        return "particulier";
}