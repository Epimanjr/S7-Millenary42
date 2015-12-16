<?php

/**
 * Classe de test pour l'entité Agence
 */
include_once '../Database.php';
include_once '../Agence.php';

// Création d'un agence
echo "Création d'un agence ... ";
$agence = new Agence();
$agence->nom = "Millenary 42";
$agence->email = "contact@m42.com";
$agence->telephone = "0659854102";
$agence->id_adresse = 12;
// Ajout dans la base
echo "OK<br/>Ajout de l'agence dans la base ... ";
$agence->insert();
echo "OK<br/>";

// Liste de tous les agences
listerTout();

// Apport d'un modification
$agence->nom = "M42";
echo "Modification de la durée ! Mise à jour dans la base ... ";
$agence->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionAgence = Agence::findById($agence->id_agence);
$selectionAgence->afficher();

// Suppression du agence
echo "Suppression de l'agence de la base ... ";
$selectionAgence->delete();
echo "OK<br/>";

// Liste de tous les agences
listerTout();

function listerTout() {
    // Liste de tous les agences
    echo "Liste des agences disponibles dans la base : <br/>";
    $listeAgences = Agence::findAll();
    foreach ($listeAgences as $value) {
        $value->afficher();
    }
}
