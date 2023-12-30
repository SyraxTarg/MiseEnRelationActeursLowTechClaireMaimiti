<?php

require_once './models/usersManager.php';
require_once './models/modérateursManager.php';
require_once './models/adminsManager.php';

if (isset($_GET['id'])) {
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
        header("Location: index.php?page=connexion");
    }
} else {
    header("Location: index.php?page=connexion");
}



if (isset($_GET['action'])) {
    $adminsManager = new adminsManager();
    switch ($_GET['action']) {
        case "grant":
            $adminsManager->give_modo_rights($user['id']);
            header("Location: index.php?page=profil&id=" . $user['id']);
            break;
        case "remove":
            $adminsManager->remove_modo_rights($user['id']);
            header("Location: index.php?page=profil&id=" . $user['id']);
            break;
        case "ban":
            $adminsManager->remove_user($user['id']);
            header("Location: index.php?page=home&msg=SD");
            //SD : Successful Deletion
            break;
    }
}


function getPrivileges($id)
{
    $moderateursManager = new modérateursManager();
    $modo = $moderateursManager->getUniqueModo($id);

    if ($modo)
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