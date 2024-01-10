<?php

$template = './views/pages/postAnnonce.php';

require_once('models/annoncesManager.php');
require_once('models/rechercheManager.php');
require_once('models/avancéesManager.php');
require_once('models/disposManager.php');
require_once('models/usersManager.php');
require_once('models/particuliersManager.php');
require_once('models/modérateursManager.php');



$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();


$avanceesManager = new avancéesManager();
$avanceesManager->dbConnect();


$disposManager = new disposManager();
$disposManager->dbConnect();


$rechercheManager = new rechercheManager();
$rechercheManager->dbConnect();

$usersManager = new usersManager();
$users = $usersManager->getUsers();

$particuliersManager = new particuliersManager();
$particuliers = $particuliersManager->getParticuliers("desc");

$modérateursManager = new modérateursManager();
$modos = $modérateursManager->getModérateurs();




if (isset($_SESSION['username'])) {
    if (isset($_POST['postAnnonce'])) {
        $motsInterdits = [
            "trou du cul","sac à merde","sac à foutre","nique ta race","nique ta mère","ménage à trois","la putain de ta mère","grande folle","fils de pute","fille de pute","brouter le cresson","emmerdeuse","zizi","zigounette","turlute","troncher","trique","tringler","teuch","tanche","tapette","suce","salope","salaud","ramoner","pute","putain","pousse-crotte","pouffiasse","pisser","pipi","péter","pédé","pédale","palucher","negro","nègre","meuf","merdeux","merdeuse","MALPT","jouir","grogniasse","gouine","gerber","foutre","étron","enfoirée","enfoiré","enculeurs","enculeur","enculée","enculé","emmerdeur","emmerder","emmerdant","déconner","déconne","cul","cramouille","couilles","conne","connasse","connard","clitoris","clito","chiottes","chier","chiasse","caca","branleuse","branleur","branlette","branler","branlage","brackmard","bourrée","bourré","bordel","bloblos","bitte","bite","bigornette","merde"
        ];
        foreach ($motsInterdits as $motInterdit) {
            $pattern = "/\b" . preg_quote($motInterdit, '/') . "\b/ui";
            $replacement = str_repeat("*", mb_strlen($motInterdit));
    
            $_POST['description'] = preg_replace($pattern, $replacement, $_POST['description']);
            $_POST['titre'] = preg_replace($pattern, $replacement, $_POST['titre']);
        }
        $titreLength = strlen($_POST['titre']);
        $descriptionLength = strlen($_POST['description']);
        if($titreLength <= 50){
            $pinned = isset($_POST['pinned']);
            $imagePath = "null";
            if(isset($_FILES['file'])){
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));
                $extensions = ['jpg', 'png', 'jpeg'];
                $maxSize = 400000;
                if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName.".".$extension;
                    move_uploaded_file($tmpName, './upload/'.$file);
                    $imagePath = './upload/'.$file;
                }
            } 
            if($_SESSION['privileges'] == "modo" ){
                $annoncesManager->postAnnonce($pinned, $imagePath, $particuliers);
            } else{
                $annoncesManager->postAnnonce($pinned, $imagePath, $modos);
            }
            
            $lastAnnonce = $annoncesManager->getlastAnnonce();
            unset($_FILES['file']);
            if(isset($_POST['type'])){
                if ($_POST['type'] == 'Avancées') {
                    $avanceesManager->postAvancees($lastAnnonce[0]['id']);
                } else{
                    $rechercheManager->postRecherche($lastAnnonce[0]['id']);
                }
            }
            
            if ($_SESSION['privileges'] == "particulier") {
                $disposManager->postDispos($lastAnnonce[0]['id']);
            }
            header('Location: index.php?page=mur&p=1');
        } else{
            $alert = "<p class='errorPostAnnonce'>Votre titre ne doit pas dépasser les 50 caractères</p>";
        }
        
    }
}


