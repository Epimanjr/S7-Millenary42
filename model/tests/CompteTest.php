<?php

/**
 * Classe de test pour l'entité Compte
 */
include_once '../Database.php';
include_once '../Compte.php';

// Création d'un compte
echo "Création d'un compte ... ";
$compte = new Compte();
$compte->identifiant = "Tixinoo";
$compte->motDePasse = "motDePasse12";
$compte->id_utilisateur = 43;
// Ajout dans la base
echo "OK<br/>Ajout du compte dans la base ... ";
$compte->insert();
echo "OK<br/>";

// Liste de tous les comptes
listerTout();

// Apport d'un modification
$compte->motDePasse = "motDePasse34";
echo "Modification de la durée ! Mise à jour dans la base ... ";
$compte->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionCompte = Compte::findById($compte->id_compte);
$selectionCompte->afficher();

// Suppression du compte
echo "Suppression du compte de la base ... ";
$selectionCompte->delete();
echo "OK<br/>";

// Liste de tous les comptes
listerTout();

function listerTout() {
    // Liste de tous les comptes
    echo "Liste des comptes disponibles dans la base : <br/>";
    $listeComptes = Compte::findAll();
    foreach ($listeComptes as $value) {
        $value->afficher();
    }
}
