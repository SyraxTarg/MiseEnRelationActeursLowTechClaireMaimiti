<?php


$idAnnonce = isset($_GET['id']) ? $_GET['id'] : null;
require_once('./models/annoncesManager.php');
$annoncesManager = new annoncesManager();

if ($idAnnonce) {
    $annoncesManager->supprimerAnnonce($idAnnonce);
    header('Location: index.php?page=mur');

}
    header("Location: $_SERVER[PHP_SELF]?page=focusAnnonce&id=$idAnnonce");
    exit();

