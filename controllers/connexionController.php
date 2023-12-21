<?php

require './models/usersManager.php';

$usersManager = new usersManager();

$users = $usersManager->getUsers();

if(isset($_GET['msg']) && $_GET['msg'] == "IL"){
    $msg = "<p>Username ou mot de passe incorrect</p>";
}

// function connexion(){
    if(isset($_POST['username']) && isset($_POST['password'])){
        // global $users;
        $check = false;
        foreach($users as $user){
            if($_POST['username'] == $user['username'] && $_POST['password'] == $user['password']){
                // var_dump($user);
                $check = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['idUser'] = $user['id'];
                unset($_POST['username']);
                unset($_POST['password']);
                header('Location: index.php?page=home');
            }
        }
        if(!$check){
            header('Location: index.php?page=connexion&msg=IL');
            //IL : Invalid Login
        }
    }
// }

$template = './views/pages/connexion.php';