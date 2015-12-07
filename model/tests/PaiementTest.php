<?php

/**
 * Classe de test pour l'entité Paiement
 */
include_once '../Database.php';
include_once '../Paiement.php';

// Création d'un paiement
echo "Création d'une paiement ... ";
$paiement = new Paiement();
$paiement->mode = "carte bleue";
$paiement->type = "type1";
// Ajout dans la base
echo "OK<br/>Ajout de la paiement dans la base ... ";
$paiement->insert();
echo "OK<br/>";

// Liste de tous les paiements
listerTout();

// Apport d'une modification
$paiement->type = "TypePaiement";
echo "Modification de la durée ! Mise à jour dans la base ... ";
$paiement->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionPaiement = Paiement::findById($paiement->id_paiement);
$selectionPaiement->afficher();

// Suppression du paiement
echo "Suppression du paiement de la base ... ";
$selectionPaiement->delete();
echo "OK<br/>";

// Liste de tous les paiements
listerTout();

function listerTout() {
    // Liste de tous les paiements
    echo "Liste des paiements disponibles dans la base : <br/>";
    $listePaiements = Paiement::findAll();
    foreach ($listePaiements as $value) {
        $value->afficher();
    }
}
