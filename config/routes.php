<?php

const AVAILABLE_ROUTES = [
    'home' => '../controllers/homeController.php',
    'annuaire' => '../controllers/annuaireController.php',
    'connexion' => '../controllers/connexionController.php',
    'inscription' => '../controllers/inscriptionController.php',
    'deconnexion' => '../controllers/deconnexionController.php',
    'profil' => '../controllers/profilController.php',
    'modifierProfil' => '../controllers/modifierProfilController.php',
    'mur' => '../controllers/murAnnoncesController.php',
    'focusAnnonce' => '../controllers/focusAnnonceController.php',
    'postAnnonce' => '../controllers/postAnnonceController.php'
  ];
  
  const DEFAULT_ROUTE = AVAILABLE_ROUTES['home'];