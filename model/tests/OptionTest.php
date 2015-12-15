<?php

/**
 * Classe de test pour l'entité Option
 */
include_once '../Database.php';
include_once '../Option.php';

// Création d'une option
echo "Création d'une option ... ";
$option = new Option();
$option->date = "2015-12-28";
$option->etat = "En cours";
$option->id_utilisateur = 1;
$option->id_appartement = 1;
// Ajout dans la base
echo "OK<br/>Ajout de la option dans la base ... ";
$option->insert();
echo "OK<br/>";

// Liste de toutes les options
listerTout();

// Apport d'une modification
$option->etat = "Rejetee";
echo "Modification de l'état ! Mise à jour dans la base ... ";
$option->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionOption = Option::findById($option->id_option);
$selectionOption->afficher();

// Suppression du option
echo "Suppression de l'option de la base ... ";
$selectionOption->delete();
echo "OK<br/>";

// Liste de toutes les options
listerTout();

function listerTout() {
    // Liste de toutes les options
    echo "Liste des options disponibles dans la base : <br/>";
    $listeOptions = Option::findAll();
    foreach ($listeOptions as $value) {
        $value->afficher();
    }
}
