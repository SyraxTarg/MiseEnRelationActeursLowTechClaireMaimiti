<?php

require_once './models/usersManager.php';
require_once './models/modérateursManager.php';
require_once './models/adminsManager.php';

if (isset($_GET['id'])) {
    //vérifier que l'id ne contient que des chiffres
    if(preg_match('/^[0-9]+$/', $_GET['id'])) {
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
            $user = $usersManager->getUserWithId(5);
        }
    }
    else{
        header("Location: index.php?page=home");
    }
} else {
    header("Location: index.php?page=home");
}



if (isset($_GET['action'])) {
    $adminsManager = new adminsManager();
    if(isset($_SESSION['privileges']) && $_SESSION['privileges'] == "admin"){
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
                header("Location: index.php?page=home&msg=SD");
                //SD : Successful Deletion
                break;
            default:
                header("Location: index.php?page=profil&id=" . $user['id']);
                break;
        }
    }
}


function getPrivileges($id)
{
    $adminsManager = new adminsManager();
    $admin = $adminsManager->getUniqueAdmin($id);
    $moderateursManager = new modérateursManager();
    $modo = $moderateursManager->getUniqueModo($id);

    if($admin)
        return "admin";
    elseif ($modo)
        return "modo";
    else
        return "particulier";
}

?>

<script>
    //appelé au click sur le bouton "Ban"
    function confirmDelete(userId) {
        var confirmation = confirm("Êtes-vous sûr de vouloir bannir cet utilisateur ? Il ne sera pas prévenu.");

        if (confirmation) {
            window.location.href = "index.php?page=profil&id=" + userId + "&action=ban";
        }
    }
</script>