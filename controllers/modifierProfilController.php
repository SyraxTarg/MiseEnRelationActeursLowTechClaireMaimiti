<?php

require_once './models/usersManager.php';
require_once './models/adminsManager.php';

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
    }
}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $adminsManager = new adminsManager();
    $adminsManager->remove_user($_SESSION['idUser']);
    header("Location: index.php?page=deconnexion");
}

$usersManager = new usersManager();
$user = $usersManager->getUniqueUser($_SESSION['idUser']);
$template = './views/pages/modifierProfil.php';


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['reEnterPassword']) && isset($_POST['email']) && isset($_POST['activites']) && isset($_POST['bio'])) {
    $formValidity = checkFormValidity($_POST['username'], $_POST['password'], $_POST['reEnterPassword'], $_POST['email']);
    if (gettype($formValidity) == "string") {
        header("Location: index.php?page=modifierProfil&id=" . $_SESSION['idUser'] . "&msg=" . $formValidity);
    } else {
        $photoPath = $user['profile_picture'];
        if(isset($_FILES['photoProfil'])){
            $tmpName = $_FILES['photoProfil']['tmp_name'];
            $name = $_FILES['photoProfil']['name'];
            $size = $_FILES['photoProfil']['size'];
            $error = $_FILES['photoProfil']['error'];
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            $extensions = ['jpg', 'png', 'jpeg'];
            $maxSize = 400000;
            if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                $uniqueName = uniqid('', true);
                $file = $uniqueName.".".$extension;
                move_uploaded_file($tmpName, './upload/'.$file);
                $photoPath = './upload/'.$file;
            }
        } 
        //maj le user
        $usersManager = new usersManager();
        $usersManager->setUser($_SESSION['idUser'], $_POST['username'], $_POST['password'], $_POST['email'], $photoPath, $_POST['activites'], $_POST['bio']);
        $_SESSION['username'] = $_POST['username'];
        header("Location: index.php?page=profil&id=" . $_SESSION['idUser'] . "&msg=SM");
        //SI : Successful Modification
    }
}

function checkFormValidity($username, $password, $reEnterPassword, $email)
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

    //check email uniqueness
    $usersManager = new usersManager();
    $user = $usersManager->getUniqueUserInfo($_POST['email'], null);

    if ($user && $user['id'] != $_SESSION['idUser']) {
        return "EU";
        //EU : Email Uniqueness
    } else {
        return true;
    }
}

?>

<script>
    //appelé au click sur le bouton "Supprimer mon profil"
    function confirmDelete() {
        var confirmation = confirm("Êtes-vous sûr de vouloir supprimer votre profil ? Cette action est irréversible.");

        if (confirmation) {
            window.location.href = "index.php?page=modifierProfil&action=delete";
        }
    }
</script>