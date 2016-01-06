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


if (isset($_POST['email'], $_POST['motDePasse'])) {
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    //$motDePasse = md5($_POST['motDePasse']);

    // On récupère le compte
    $compte = Compte::findByIdentifant($email);
    $compte->afficher();
    
    // On récupère l'utilisateur
    $utilisateur = Utilisateur::findById($compte->id_utilisateur);

    if($utilisateur->etat != "inactif") {
        // Si le mot de passe indiqué est le bon
        if (($motDePasse) == $compte->motDePasse) {
            // On enregistre en tant que variables de sessions, son nom d'utilisateur et son id
            $_SESSION['email'] = $email;
            $_SESSION['id_utilisateur'] = $utilisateur->id_utilisateur;
            $_SESSION['nom'] = $utilisateur->nom;
            $_SESSION['prenom'] = $utilisateur->prenom;
            $_SESSION['telephone'] = $utilisateur->telephone;
            if($utilisateur->id_type_utilisateur==12) {
                $_SESSION['employe'] = 1;
            } else {
                $_SESSION['employe'] = 0;
            }
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Utilisateur inactif";
    }
}

// Redirection vers la page d'accueil
header("Location: ../index.php?a=home");
