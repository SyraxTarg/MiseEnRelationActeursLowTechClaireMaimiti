<?php

require './models/usersManager.php';

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "NP":
            $msg = "<p>Les mots de passe ne correspondent pas.</p>";
            break;
        case "IU":
            $msg = "<p>Le nom d'utilisateur ne doit pas contenir de caractères spéciaux.</p>";
            break;
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
        case "IA":
            $msg = "<p>Les activités ne peuvent pas contenir de caractère spécial.</p>";
            break;
    }
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['reEnterPassword']) && isset($_POST['email'])) {
    if (isset($_POST['autresActivites'])) {
        $formValidity = checkFormValidity($_POST['username'], $_POST['password'], $_POST['reEnterPassword'], $_POST['email'], $_POST['autresActivites']);
    } else {
        $formValidity = checkFormValidity($_POST['username'], $_POST['password'], $_POST['reEnterPassword'], $_POST['email']);
    }

    if (gettype($formValidity) == "string") {
        header("Location: index.php?page=inscription&msg=" . $formValidity);
    } else {
        if (isset($_POST['activites'])) {
            $activites = $_POST['activites'];
        } else {
            $activites = [];
        }
        if (isset($_POST['autresActivites'])) {
            foreach ($_POST['autresActivites'] as $act) {
                if ($act) {
                    array_push($activites, $act);
                }
            }
        }
        $activites = implode(";", $activites);

        saveUser($_POST['username'], $_POST['password'], $_POST['email'], $activites);
    }
}

function checkFormValidity($username, $password, $reEnterPassword, $email, $autresActivites = null)
{

    //check correspondance entre les 2 champs password
    if ($password != $reEnterPassword) {
        return "NP";
        //NP : Not Matching Passwords
    }

    //check username validity
    $pattern = '/[!@#$%^&*(),.?":{}|<>]/';
    if (preg_match($pattern, $username, $matches)) {
        return "IU";
        //IE : Invalid Username
    }

    //check password validity
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/";
    if (!preg_match($pattern, $password, $matches)) {
        if (strlen($password) < 8) {
            return "PS";
            //PS : Password Short
        } else {
            return "IP";
            //IP : Invalid Password
        }
    }

    //check email validity
    $pattern = "/^([^@\s<&>]+)@(?:([-a-z0-9]+)\.)+([a-z]{2,})$/iD";
    if (!preg_match($pattern, $email, $matches)) {
        return "IE";
        //IE : Invalid Email
    }

    //check activity validity
    if ($autresActivites) {
        foreach ($autresActivites as $act) {
            if (!checkActivityValidity($act)) {
                return "IA";
                //IA : Invalid Activity
            }
        }
    }


    //check email uniqueness
    $usersManager = new usersManager();
    $user = $usersManager->getUniqueUserInfo($_POST['email'], null);

    if ($user) {
        return "EU";
        //EU : Email Uniqueness
    } else {
        return true;
    }
}

function saveUser($username, $password, $email, $activites)
{
    $usersManager = new usersManager();
    $usersManager->addUser($username, $password, $email, './public/images/defaultPfp.png', $activites);
    header("Location: index.php?page=connexion&msg=SI");
    //SI : Successful Inscription
}

function checkActivityValidity($activite)
{
    if ($activite) {
        //vérifie si la chaine ne contient pas que des espaces
        if (preg_match('/\S/', $activite)) {
            if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $activite, $matches)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return true;
    }
}

$template = './views/pages/inscription.php';