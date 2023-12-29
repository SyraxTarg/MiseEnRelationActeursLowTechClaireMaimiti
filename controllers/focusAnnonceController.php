<?php

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
        "con",
        "conasse",
        "merde",
        "salaud"
    ];
    
    foreach ($motsInterdits as $motInterdit) {
        $pattern = "/\b" . preg_quote($motInterdit, '/') . "\b/i";
        $_POST['description'] = preg_replace($pattern, str_repeat("*", mb_strlen($motInterdit)), $_POST['description']);
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



