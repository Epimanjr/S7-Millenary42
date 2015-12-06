<?php

/**
 * Classe de test pour l'entité TypeAppartement
 */
include_once '../Database.php';
include_once '../TypeAppartement.php';

// Création d'un type d'appartement
echo "Création d'un type d'appartement ... ";
$typeAppart = new TypeAppartement();
$typeAppart->nom = "Type1";
$typeAppart->duree = 1;
// Ajout dans la base
echo "OK<br/>Ajout du type d'appartement dans la base ... ";
$typeAppart->insert();
echo "OK<br/>";

// Liste de tous les types d'appartements
listerTout();

// Apport d'une modification
$appart->duree = 2;
echo "Modification de la durée ! Mise à jour dans la base ... ";
$appart->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionTypeAppart = TypeAppartement::findById($typeAppart->id);
$selectionTypeAppart->afficher();

// Suppression du type d'appartement
echo "Suppression du type d'appartement de la base ... ";
$selectionTypeAppart->delete();
echo "OK<br/>";

// Liste de tous les types d'appartements
listerTout();

function listerTout() {
    // Liste de tous les types d'appartements
    echo "Liste des types d'appartements disponibles dans la base : <br/>";
    $listeTypeAppartements = TypeAppartement::findAll();
    foreach ($listeTypeAppartements as $value) {
        $value->afficher();
    }
}
