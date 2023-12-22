<?php

require './models/usersManager.php';

$usersManager = new usersManager();

$users = $usersManager->getUsers();
// var_dump($users);

if(isset($_GET['msg']) && $_GET['msg'] == "IL"){
    $msg = "<p>Username ou mot de passe incorrect</p>";
}

// function connexion(){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $check = false;
        foreach($users as $user){
            if($_POST['username'] == $user['username'] && $_POST['password'] == $user['password']){
                $check = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['idUser'] = $user['id'];
                unset($_POST['username']);
                unset($_POST['password']);
                
                grantPrivileges($user);
                
                header('Location: index.php?page=home');
                break;
            }
        }
        if(!$check){
            header('Location: index.php?page=connexion&msg=IL');
            //IL : Invalid Login
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
        // var_dump($user);
    }
}

$template = './views/pages/connexion.php';