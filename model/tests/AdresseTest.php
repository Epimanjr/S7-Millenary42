<?php

/**
 * Classe de test pour l'entité Adresse
 */
include_once '../Database.php';
include_once '../Adresse.php';

// Création d'une adresse
echo "Création d'une adresse ... ";
$adresse = new Adresse();
$adresse->numRue = 8;
$adresse->rue = "Auguste Renoir";
$adresse->codePostal = 57400;
$adresse->ville = "Sarrebourg";
// Ajout dans la base
echo "OK<br/>Ajout de l'adresse dans la base ... ";
$adresse->insert();
echo "OK<br/>";

// Liste de toutes les adresses
listerTout();

// Apport d'une modification
$adresse->rue="Paul Gauguin";
echo "Modification de la rue ! Mise à jour dans la base ... ";
$adresse->update();
echo "OK<br/>";

// Sélection de l'adresse
$selectionAdresse = Adresse::findById($adresse->id_adresse);
$selectionAdresse->afficher();

// Suppression de l'adresse
echo "Suppression de l'adresse de la base ... ";
$selectionAdresse->delete();
echo "OK<br/>";

// Liste de toutes les adresses
listerTout();

function listerTout() {
    // Liste de toutes les adresses
    echo "Liste des adresses disponibles dans la base : <br/>";
    $listeAdresses = Adresse::findAll();
    foreach ($listeAdresses as $value) {
        $value->afficher();
    }
}
