<?php

include_once '../model/Database.php';
include_once '../model/Compte.php';
include_once '../model/Utilisateur.php';
include_once '../model/Adresse.php';

// Si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    // Déconnexion de l'utlisateur
    unset($_SESSION['email'], $_SESSION['nom']);
}

// Première étape : Création de l'adresse
$adresse = new Adresse();
$adresse->numRue = $_POST['numerorue'];
$adresse->rue = $_POST['nomrue'];
$adresse->codePostal = $_POST['codepostal'];
$adresse->ville = $_POST['ville'];
$adresse->insert();

// Deuxième étape : Création de l'utilisateur
$utilisateur = new Utilisateur();
$utilisateur->nom= $_POST['nom'];
$utilisateur->prenom= $_POST['prenom'];
$utilisateur->email= $_POST['email'];
$utilisateur->telephone= $_POST['tel'];
$utilisateur->id_type_utilisateur= 15;
$utilisateur->id_adresse= $adresse->id_adresse;
$utilisateur->insert();

// Troisième étape : Création du compte
$compte = new Compte();
$compte->identifiant = $utilisateur->email;
$compte->motDePasse = $_POST['pass'];
$compte->id_utilisateur = $utilisateur->id_utilisateur;
$compte->insert();

// Redirection vers la page d'accueil
echo 'Inscription réalisee avec succes ! <a href="../index.php?a=login"> Retour LOGIN</a>';
//header("Location: ../index.php?a=login");
