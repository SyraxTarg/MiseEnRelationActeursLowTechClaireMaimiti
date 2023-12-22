<?php

require './models/usersManager.php';

if(isset($_GET['msg']) && $_GET['msg'] == "IL"){
    $msg = "<p>Username ou mot de passe incorrect.</p>";
}

// function connexion(){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $usersManager = new usersManager();
        $user = $usersManager->getUniqueUser();

        if(gettype($user) == "string"){
            header('Location: index.php?page=connexion&msg=IL');
            //IL : Invalid Login
        }
        else{
            var_dump($user);
            $_SESSION['username'] = $user['username'];
            $_SESSION['idUser'] = $user['id'];
            unset($_POST['username']);
            unset($_POST['password']);
            
            grantPrivileges($user);

            header('Location: index.php?page=home');
        }
    }
// }

function grantPrivileges($user){
    require_once 'models/adminsManager.php';
    $adminsManager = new adminsManager();
    $admins = $adminsManager->getAdmins();

    require_once 'models/modérateursManager.php';
    $moderateursManager = new modérateursManager();
    $moderateurs = $moderateursManager->getModérateurs();

    if(!isset($_SESSION['privileges'])){
        $notGranted = true;
        foreach ($admins as $admin) {
            if($admin['id'] == $user['id']){
                $notGranted = false;
                $_SESSION['privileges'] = "admin";
            }
        }
        if($notGranted){
            foreach ($moderateurs as $modo) {
                if($modo['id'] == $user['id']){
                    $notGranted = false;
                    $_SESSION['privileges'] = "modo";
                }
            }
            if($notGranted){
                $_SESSION['privileges'] = "particulier";
            }
        }
    }
}

$template = './views/pages/connexion.php';