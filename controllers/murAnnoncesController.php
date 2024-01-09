<?php


$idAnnonce = isset($_GET['id']) ? $_GET['id'] : null;
$filtre = isset($_GET['filtreType']) ? $_GET['filtreType'] : null;

if ($idAnnonce) {
    header("Location: $_SERVER[PHP_SELF]?page=focusAnnonce&id=$idAnnonce");
    exit();
} else {

    $template = './views/pages/mur.php';

    require_once('models/annoncesManager.php');
    require_once('models/avancéesManager.php');
    require_once('models/disposManager.php');
    require_once('models/rechercheManager.php');

    $annoncesManager= new annoncesManager();
    $annoncesManager->dbConnect();

    $annoncesPinned = $annoncesManager->getPinnedAnnonces();

    $annoncesNonPinned = $annoncesManager->getNonPinnedAnnonces();





    $avanceesManager = new avancéesManager();
    $avanceesManager->dbConnect();

    $avancees = $avanceesManager->getAvancees();

    $disposManager = new disposManager();
    $disposManager->dbConnect();

    $dispos = $disposManager->getDispos();

    $rechercheManager = new rechercheManager();
    $rechercheManager->dbConnect();

    $recherches = $rechercheManager->getRecherche();

    $annonces = array_merge($annoncesPinned, $annoncesNonPinned);
    if(isset($_SESSION['username']) && !isset($_SESSION['filtre'])){
        $_SESSION['filtre'] = "";
    }
    if(isset($_POST['filtrer'])){
        if($_POST['typeFiltre'] == "Avancees" || $_SESSION['filtre'] == "Avancees"){
            $_SESSION['filtre'] = "Avancees";
            $annonces = $avancees;
        }
        if($_POST['typeFiltre'] == "Dispos" || $_SESSION['filtre'] == "Dispos"){
            $_SESSION['filtre'] = "Dispos";
            $annonces = $dispos;
        }
        if($_POST['typeFiltre'] == "Recherche"  || $_SESSION['filtre'] == "Recherche"){
            $_SESSION['filtre'] = "Recherche";
            $annonces = $recherches;
        }
        if($_POST['typeFiltre'] == ""   || $_SESSION['filtre'] == ""){
            $annonces = array_merge($annoncesPinned, $annoncesNonPinned);
        }
    }
    $offsets=[0,0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250, 260, 270, 280, 290, 300, 310, 320, 330, 340, 350, 360, 370, 380, 390, 400, 410, 420, 430, 440, 450, 460, 470, 480, 490, 500];


    if(isset($_GET['p'])){
        $annoncesPaginees = $annoncesManager->getTenPinnedAnnonces($offsets[$_GET['p']]);
        if(isset($_POST['filtrer'])){
            if($_POST['typeFiltre'] != ""){
                $annoncesPaginees = $annoncesManager->rechercheAnnoncesByType($offsets[$_GET['p']]);
            } else{
                $annoncesPaginees = $annoncesManager->getTenPinnedAnnonces($offsets[$_GET['p']]);
            }
            
        }
    }
}