<?php

require_once './models/usersManager.php';
require_once './models/modérateursManager.php';
require_once './models/adminsManager.php';

if (isset($_GET['id'])) {
    if (isset($_GET['msg'])) {
        switch ($_GET['msg']) {
            case "SM":
                if (isset($_SESSION['idUser']) && $_GET['id'] == $_SESSION['idUser'])
                    $msg = "<p>Le profil a bien été mis à jour.</p>";
                break;
        }
    }
    //vérifier que l'id ne contient que des chiffres
    if (preg_match('/^[0-9]+$/', $_GET['id'])) {
        $template = './views/pages/profil.php';

        $usersManager = new usersManager();
        $annoncesManager = new annoncesManager();
        $user = $usersManager->getUniqueUser($_GET['id']);
        $activites = explode(";", $user['activites']);
        if ($user) {
            if (isset($_SESSION['idUser']) && $user['id'] == $_SESSION['idUser'])
                $currentUser = true;
            else
                $currentUser = false;

            if (!$currentUser)
                $userPrivileges = getPrivileges($user['id']);

            $annonces = $annoncesManager->getAnnoncesUser($user['id']);
        } else {
            $user = $usersManager->getUniqueUser(5);
        }
    } else {
        header("Location: index.php?page=home");
    }
} else {
    header("Location: index.php?page=home");
}



if (isset($_GET['action'])) {
    $adminsManager = new adminsManager();
    if (isset($_SESSION['privileges']) && $_SESSION['privileges'] == "Administrateur") {
        switch ($_GET['action']) {
            case "grantModo":
                $adminsManager->give_modo_rights($user['id']);
                header("Location: index.php?page=profil&id=" . $user['id']);
                break;
            case "removeModo":
                $adminsManager->remove_modo_rights($user['id']);
                header("Location: index.php?page=profil&id=" . $user['id']);
                break;
            case "grantAdmin":
                $adminsManager->give_admin_rights($user['id']);
                header("Location: index.php?page=profil&id=" . $user['id']);
                break;
            case "ban":
                $adminsManager->remove_user($user['id']);
                header("Location: index.php?page=annuaire&msg=SD");
                //SD : Successful Deletion
                break;
            case "disconnect":
                unset($_SESSION['idUser']);
                unset($_SESSION['username']);
                unset($_SESSION['email']);
                unset($_SESSION['privileges']);

                header('Location: index.php?page=home');
                break;
            default:
                header("Location: index.php?page=profil&id=" . $user['id']);
                break;
        }
    } else {
        if ($_GET['action'] == "disconnect") {
            unset($_SESSION['idUser']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['privileges']);

            header('Location: index.php?page=home');
        }
    }
}


function getPrivileges($id)
{
    $adminsManager = new adminsManager();
    $admin = $adminsManager->getUniqueAdmin($id);
    $moderateursManager = new modérateursManager();
    $modo = $moderateursManager->getUniqueModo($id);

    if ($admin)
        return "Administrateur";
    elseif ($modo)
        return "Modérateur";
    else
        return "Particulier";
}

?>

<script>
    //appelé au click sur le bouton "Ban" ou "Nommer admin"
    function confirmDelete(userId, msg, action) {
        var confirmation = confirm(msg);

        if (confirmation) {
            switch (action) {
                case "ban":
                    window.location.href = "index.php?page=profil&id=" + userId + "&action=ban";
                    break;
                case "grantAdmin":
                    window.location.href = "index.php?page=profil&id=" + userId + "&action=grantAdmin";
                    break;
                default:
                    break;
            }
        }
    }
</script>