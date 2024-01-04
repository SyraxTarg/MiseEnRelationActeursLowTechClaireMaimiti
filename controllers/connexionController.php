<?php

require './models/usersManager.php';

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "IL":
            $msg = "<p>Identifiant ou mot de passe incorrect.</p>";
            break;
        case "SI":
            $msg = "<p>L'inscription a été réussie, veuillez à présent vous connecter.</p>";
            break;
    }

}

// function connexion(){
if (isset($_POST['email']) && isset($_POST['password'])) {
    $usersManager = new usersManager();
    $user = $usersManager->getUniqueUserInfo($_POST['email'], $_POST['password']);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['idUser'] = $user['id'];
        unset($_POST['email']);
        unset($_POST['password']);

        grantPrivileges($user);

        header('Location: index.php?page=home');
    } else {
        header('Location: index.php?page=connexion&msg=IL');
        //IL : Invalid Login
    }
}
// }

function grantPrivileges($user)
{
    require_once 'models/adminsManager.php';
    $adminsManager = new adminsManager();
    $admin = $adminsManager->getUniqueAdmin($user['id']);

    require_once 'models/modérateursManager.php';
    $moderateursManager = new modérateursManager();
    $modo = $moderateursManager->getUniqueModo($user['id']);

    if ($admin)
        $_SESSION['privileges'] = "admin";
    elseif ($modo)
        $_SESSION['privileges'] = "modo";
    else
        $_SESSION['privileges'] = "particulier";
}

$template = './views/pages/connexion.php';