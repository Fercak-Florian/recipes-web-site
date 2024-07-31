<?php
    session_start(); // permet l'accès aux variables de $_SESSION
    require_once(__DIR__ . '/functions.php');
   
    // Détruire la session en cours
    session_unset();
    session_destroy(); 
    
    redirectToUrl('index.php'); // Redirection  de l'utilisateur vers la page d'accueil
?>
