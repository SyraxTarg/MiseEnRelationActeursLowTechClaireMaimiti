<?php

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "PS":
            $msg = "<p>Le mot de passe doit faire au moins 8 caractères.</p>";
            break;
        case "IP":
            $msg = "<p>Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.</p>";
            break;
        case "IE":
            $msg = "<p>L'email que vous avez entré ne respecte pas la forme d'un email.</p>";
            break;
        case "EU":
            $msg = "<p>L'email que vous avez entré est déjà utilisé par un autre utilisateur.</p>";
            break;
    }
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
    $formValidity = checkFormValidity($_POST['password'], $_POST['email']);
    if(gettype($formValidity) == "string"){
        header("Location: index.php?page=inscription&msg=" . $formValidity);
    }
    else{
        //enregistrer le user
        header("Location: index.php?page=connexion");
    }
}

function checkFormValidity($password, $email){

    //check password validity
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/";
    if(!preg_match($pattern, $password, $matches)) {
        if(strlen($password) < 8){
            return "PS";
            //PS : Password Short
        }
        else{
            return "IP";
            //IP : Invalid Password
        }
    }

    //check email validity
    $pattern = "/^([^@\s<&>]+)@(?:([-a-z0-9]+)\.)+([a-z]{2,})$/iD";
    if(!preg_match($pattern, $email, $matches)) {
        return "IE";
        //IE : Invalid Email
    }

    //check email uniqueness
    require './models/usersManager.php';
    $usersManager = new usersManager();
    $user = $usersManager->getUniqueUserWithEmail($_POST['email']);

    if($user){
        return "EU";
        //EU : Email Uniqueness
    }
    else{
        return true;
    }
}


$template = './views/pages/inscription.php';