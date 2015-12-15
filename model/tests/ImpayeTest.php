<?php

/**
 * Classe de test pour l'entité Impaye
 */
include_once '../Database.php';
include_once '../Impaye.php';

// Création d'un impaye
echo "Création d'un impaye ... ";
$impaye = new Impaye();
$impaye->montant = 1000;
$impaye->dateLimite = "2015-12-26";
$impaye->id_utilisateur = 1;
$impaye->id_location = 1;
// Ajout dans la base
echo "OK<br/>Ajout de l'impaye dans la base ... ";
$impaye->insert();
echo "OK<br/>";

// Liste de tous les impayes
listerTout();

// Apport d'un modification
$impaye->montant = 2;
echo "Modification de la durée ! Mise à jour dans la base ... ";
$impaye->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionImpaye = Impaye::findById($impaye->id_impaye);
$selectionImpaye->afficher();

// Suppression du impaye
echo "Suppression de l'impaye de la base ... ";
$selectionImpaye->delete();
echo "OK<br/>";

// Liste de tous les impayes
listerTout();

function listerTout() {
    // Liste de tous les impayes
    echo "Liste des impayes disponibles dans la base : <br/>";
    $listeImpayes = Impaye::findAll();
    foreach ($listeImpayes as $value) {
        $value->afficher();
    }
}
