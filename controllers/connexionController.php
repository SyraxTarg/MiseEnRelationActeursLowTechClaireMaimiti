<?php

require './models/usersManager.php';

if(isset($_GET['msg']) && $_GET['msg'] == "IL"){
    $msg = "<p>Username ou mot de passe incorrect.</p>";
}

// function connexion(){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $usersManager = new usersManager();
        $user = $usersManager->getUniqueUser($_POST['username'], $_POST['password']);

        if($user){
            $_SESSION['username'] = $user['username'];
            $_SESSION['idUser'] = $user['id'];
            unset($_POST['username']);
            unset($_POST['password']);
            
            grantPrivileges($user);

            header('Location: index.php?page=home');
        }
        else{
            header('Location: index.php?page=connexion&msg=IL');
            //IL : Invalid Login
        }
    }
// }

function grantPrivileges($user){
    require_once 'models/adminsManager.php';
    $adminsManager = new adminsManager();
    $admin = $adminsManager->getUniqueAdmin($user['id']);

    require_once 'models/modérateursManager.php';
    $moderateursManager = new modérateursManager();
    $modo = $moderateursManager->getUniqueModo($user['id']);

    if($admin)
        $_SESSION['privileges'] = "admin";
    elseif($modo)
        $_SESSION['privileges'] = "modo";
    else
        $_SESSION['privileges'] = "particulier";
}

$template = './views/pages/connexion.php';