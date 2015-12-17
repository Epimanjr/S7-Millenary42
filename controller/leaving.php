<?php

include_once '../model/Database.php';
include_once '../model/Compte.php';
include_once '../model/Utilisateur.php';

session_start();

// Si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    // Déconnexion de l'utlisateur
    unset($_SESSION['email'], $_SESSION['nom']);
}

// Redirection vers la page d'accueil
header("Location: ../index.php?a=home");
