<?php

/**
 * Classe de test pour l'entité Possession
 */
include_once '../Database.php';
include_once '../Possession.php';

// Création d'une possession
echo "Création d'une possession ... ";
$possession = new Possession();
$possession->debut="2015-12-28";
$possession->fin="2015-12-29";
$possession->id_utilisateur=1;
$possession->id_appartement=1;
// Ajout dans la base
echo "OK<br/>Ajout de la possession dans la base ... ";
$possession->insert();
echo "OK<br/>";

// Liste de toutes les possessions
listerTout();

// Apport d'une modification
$possession->fin="2015-12-30";
echo "Modification de la fin ! Mise à jour dans la base ... ";
$possession->update();
echo "OK<br/>";

// Sélection de la possession
$selectionPossession = Possession::findById($possession->id_possession);
$selectionPossession->afficher();

// Suppression de la possession
echo "Suppression de la possession de la base ... ";
$selectionPossession->delete();
echo "OK<br/>";

// Liste de toutes les possessions
listerTout();

function listerTout() {
    // Liste de toutes les possessions
    echo "Liste des possessions disponibles dans la base : <br/>";
    $listePossessions = Possession::findAll();
    foreach ($listePossessions as $value) {
        $value->afficher();
    }
}
