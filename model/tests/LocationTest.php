<?php

/**
 * Classe de test pour l'entité Location
 */
include_once '../Database.php';
include_once '../Location.php';

// Création d'une location
echo "Création d'une location ... ";
$location = new Location();
$location->debut="28/12/2015";
$location->fin="29/12/2015";
$location->id_appart=1;
// Ajout dans la base
echo "OK<br/>Ajout de la location dans la base ... ";
$location->insert();
echo "OK<br/>";

// Liste de toutes les locations
listerTout();

// Apport d'une modification
$location->fin="30/12/2015";
echo "Modification de la fin ! Mise à jour dans la base ... ";
$location->update();
echo "OK<br/>";

// Sélection de la location
$selectionLocation = Location::findById($location->id_location);
$selectionLocation->afficher();

// Suppression de la location
echo "Suppression de la location de la base ... ";
$selectionLocation->delete();
echo "OK<br/>";

// Liste de toutes les locations
listerTout();

function listerTout() {
    // Liste de toutes les locations
    echo "Liste des locations disponibles dans la base : <br/>";
    $listeLocations = Location::findAll();
    foreach ($listeLocations as $value) {
        $value->afficher();
    }
}
