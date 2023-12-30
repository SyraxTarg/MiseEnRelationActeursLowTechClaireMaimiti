<?php

if(isset($_SESSION['privileges'])){
    if($_SESSION['privileges'] != 'admin'){
        $template = './views/pages/focusAnnonce.php';

require_once('models/annoncesManager.php');
require_once('models/avancéesManager.php');
require_once('models/disposManager.php');
require_once('models/rechercheManager.php');

$annoncesManager = new annoncesManager();
$annoncesManager->dbConnect();


$avanceesManager = new avancéesManager();
$avanceesManager->dbConnect();

$avancees = $avanceesManager->getAvancees();

$disposManager = new disposManager();
$disposManager->dbConnect();

$dispos = $disposManager->getDispos();

$rechercheManager = new rechercheManager();
$rechercheManager->dbConnect();

$recherches = $rechercheManager->getRecherche();



$annonceId = isset($_GET['id']) ? $_GET['id'] : null;
$annonce = $annoncesManager->getSingleAnnonce($annonceId);

$etatBoutonKey = 'etat_bouton_' . $annonceId;
$etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

if (isset($_POST['posterComm'])) {
    $motsInterdits = [
        "trou du cul","sac à merde","sac à foutre","nique ta race","nique ta mère","ménage à trois","la putain de ta mère","grande folle","fils de pute","fille de pute","brouter le cresson","emmerdeuse","zizi","zigounette","turlute","troncher","trique","tringler","teuch","tanche","tapette","suce","salope","salaud","ramoner","pute","putain","pousse-crotte","pouffiasse","pisser","pipi","péter","pédé","pédale","palucher","negro","nègre","meuf","merdeux","merdeuse","MALPT","jouir","grogniasse","gouine","gerber","foutre","étron","enfoirée","enfoiré","enculeurs","enculeur","enculée","enculé","emmerdeur","emmerder","emmerdant","déconner","déconne","cul","cramouille","couilles","conne","connasse","connard","clitoris","clito","chiottes","chier","chiasse","caca","branleuse","branleur","branlette","branler","branlage","brackmard","bourrée","bourré","bordel","bloblos","bitte","bite","bigornette","merde"
    ];
    
    foreach ($motsInterdits as $motInterdit) {
        $pattern = "/\b" . preg_quote($motInterdit, '/') . "\b/i";
        $replacement = str_repeat("*", mb_strlen($motInterdit));

        $_POST['description'] = preg_replace($pattern, $replacement, $_POST['description']);
    }

    $annoncesManager->postCommentaire($annonceId);
    header("Refresh:0");
}



if (isset($_POST['like'])) {
    $etatBouton = ($etatBouton == 0) ? 1 : 0;

    $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

    $annonce['nb_likes'] = $annoncesManager->getLikesCount($annonceId);

    $_SESSION[$etatBoutonKey] = $etatBouton;
}

    }
}



