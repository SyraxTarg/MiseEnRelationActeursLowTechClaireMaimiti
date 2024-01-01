<?php

$template = './views/pages/postAnnonce.php';

require_once('models/annoncesManager.php');
require_once('models/rechercheManager.php');
require_once('models/avancéesManager.php');
require_once('models/disposManager.php');



$annoncesManager= new annoncesManager();
$annoncesManager->dbConnect();


$avanceesManager = new avancéesManager();
$avanceesManager->dbConnect();


$disposManager = new disposManager();
$disposManager->dbConnect();


$rechercheManager = new rechercheManager();
$rechercheManager->dbConnect();




if (isset($_SESSION['username'])) {
    if (isset($_POST['postAnnonce'])) {
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
        $annoncesManager->postAnnonce($pinned, $imagePath);
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
    }
}
