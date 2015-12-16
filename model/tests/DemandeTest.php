<?php

/**
 * Classe de test pour l'entité Demande
 */
include_once '../Database.php';
include_once '../Demande.php';

// Création d'un demande
echo "Création d'une demande ... ";
$demande = new Demande();
$demande->type = "Document";
$demande->contenu = "contenu";
$demande->id_utilisateur = 46;
// Ajout dans la base
echo "OK<br/>Ajout de la demande dans la base ... ";
$demande->insert();
echo "OK<br/>";

// Liste de tous les demandes
listerTout();

// Apport d'une modification
$demande->type = "titi";
echo "Modification de la durée ! Mise à jour dans la base ... ";
$demande->update();
echo "OK<br/>";

// Sélection de la demande
$selectionDemande = Demande::findByIdDemande($demande->id_demande);
$selectionDemande->afficher();

// Suppression du demande
echo "Suppression de la demande de la base ... ";
$selectionDemande->delete();
echo "OK<br/>";

// Liste de tous les demandes
listerTout();

function listerTout() {
    // Liste de tous les demandes
    echo "Liste des demandes disponibles dans la base : <br/>";
    $listeDemandes = Demande::findAll();
    foreach ($listeDemandes as $value) {
        $value->afficher();
    }
}
