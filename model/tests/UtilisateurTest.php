<?php

/**
 * Classe de test pour l'entité Utilisateur
 */
include_once '../Database.php';
include_once '../Utilisateur.php';

// Création d'une utilisateur
echo "Création d'un utilisateur ... ";
$utilisateur = new Utilisateur();
$utilisateur->nom= "nono";
$utilisateur->prenom= "antoine";
$utilisateur->id_type_utilisateur= 13;
$utilisateur->id_adresse= 10;
// Ajout dans la base
echo "OK<br/>Ajout du utilisateur dans la base ... ";
$utilisateur->insert();
echo "OK<br/>";

// Liste de toutes les utilisateurs
listerTout();

// Apport d'une modification
$utilisateur->nom="nini";
echo "Modification de la fin ! Mise à jour dans la base ... ";
$utilisateur->update();
echo "OK<br/>";

// Sélection de la utilisateur
$selectionUtilisateur = Utilisateur::findById($utilisateur->id_utilisateur);
$selectionUtilisateur->afficher();

// Suppression de la utilisateur
echo "Suppression de la utilisateur de la base ... ";
$selectionUtilisateur->delete();
echo "OK<br/>";

// Liste de toutes les utilisateurs
listerTout();

function listerTout() {
    // Liste de toutes les utilisateurs
    echo "Liste des utilisateurs disponibles dans la base : <br/>";
    $listeUtilisateurs = Utilisateur::findAll();
    foreach ($listeUtilisateurs as $value) {
        $value->afficher();
    }
}
