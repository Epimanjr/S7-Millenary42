<?php

/**
 * Classe de test pour l'entité TypeUtilisateur
 */
include_once '../Database.php';
include_once '../TypeUtilisateur.php';

// Création d'une typeutilisateur
echo "Création d'un type utilisateur ... ";
$typeutilisateur = new TypeUtilisateur();
$typeutilisateur->nom= "employe";
// Ajout dans la base
echo "OK<br/>Ajout du typeutilisateur dans la base ... ";
$typeutilisateur->insert();
echo "OK<br/>";

// Liste de toutes les typeutilisateurs
listerTout();

// Apport d'une modification
$typeutilisateur->nom="modif";
echo "Modification de la fin ! Mise à jour dans la base ... ";
$typeutilisateur->update();
echo "OK<br/>";

// Sélection de la typeutilisateur
$selectionTypeUtilisateur = TypeUtilisateur::findById($typeutilisateur->id_type_utilisateur);
$selectionTypeUtilisateur->afficher();

// Suppression de la typeutilisateur
echo "Suppression de la typeutilisateur de la base ... ";
$selectionTypeUtilisateur->delete();
echo "OK<br/>";

// Liste de toutes les typeutilisateurs
listerTout();

function listerTout() {
    // Liste de toutes les typeutilisateurs
    echo "Liste des typeutilisateurs disponibles dans la base : <br/>";
    $listeTypeUtilisateurs = TypeUtilisateur::findAll();
    foreach ($listeTypeUtilisateurs as $value) {
        $value->afficher();
    }
}
