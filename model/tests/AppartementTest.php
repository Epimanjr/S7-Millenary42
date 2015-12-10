<?php

/**
 * Classe de test pour l'entité Appartement
 */
include_once '../Database.php';
include_once '../Appartement.php';

// Création d'un appartement
echo "Création d'un appartement ... ";
$appart = new Appartement();
$appart->surface = 130;
$appart->nbPieces = 4;
$appart->loyer = 550;
$appart->charges = 80;
$appart->etat = "Bon etat";
$appart->id_type_appart = 19;
$appart->id_adresse = 4;
// Ajout dans la base
echo "OK<br/>Ajout de l'appartement dans la base ... ";
$appart->insert();
echo "OK<br/>";

// Liste de tous les appartements
listerTout();

// Apport d'une modification
$appart->loyer = 650;
echo "Augmentation du loyer ! Mise a jour dans la base ... ";
$appart->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionAppart = Appartement::findById($appart->id_appart);
$selectionAppart->afficher();

// Suppression de l'appartement
echo "Suppression de l'appartement de la base ... ";
$selectionAppart->delete();
echo "OK<br/>";

// Liste de tous les appartements
listerTout();

function listerTout() {
// Liste de tous les appartements
    echo "Liste des appartements disponibles dans la base : <br/>";
    $ListeAppartements = Appartement::findAll();
    foreach ($ListeAppartements as $value) {
        $value->afficher();
    }
}
