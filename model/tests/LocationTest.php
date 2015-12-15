<?php

/**
 * Classe de test pour l'entité Location
 */
include_once '../Database.php';
include_once '../Location.php';

// Création d'une location
echo "Création d'une location ... ";
$location = new Location();
$location->debut="2015-12-28";
$location->fin="2015-12-29";
$location->id_appartement=1;
$location->id_utilisateur=1;
// Ajout dans la base
echo "OK<br/>Ajout de la location dans la base ... ";
$location->insert();
echo "OK<br/>";

// Liste de toutes les locations
listerTout();

// Apport d'une modification
$location->fin="2015-12-30";
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
