<?php

/**
 * Classe de test pour l'entité ArchivePaiement
 */
include_once '../Database.php';
include_once '../ArchivePaiement.php';

// Création d'un archivepaiement
echo "Création d'une archivepaiement ... ";
$archivepaiement = new ArchivePaiement();
$archivepaiement->montant=200;
$archivepaiement->date = "2015-11-26";
$archivepaiement->dateArchivage = "2015-12-16";
$archivepaiement->mode = "carte verte";
$archivepaiement->type = "type2";
$archivepaiement->id_utilisateur=46;
$archivepaiement->id_location=9;
// Ajout dans la base
echo "OK<br/>Ajout de la archivepaiement dans la base ... ";
$archivepaiement->insert();
echo "OK<br/>";

// Liste de tous les archivepaiements
listerTout();

// Apport d'une modification
$archivepaiement->montant=215;
echo "Modification du type ! Mise à jour dans la base ... ";
$archivepaiement->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionArchivePaiement = ArchivePaiement::findById($archivepaiement->id_archive_paiement);
$selectionArchivePaiement->afficher();

// Suppression du archivepaiement
echo "Suppression du archivepaiement de la base ... ";
$selectionArchivePaiement->delete();
echo "OK<br/>";

// Liste de tous les archivepaiements
listerTout();

function listerTout() {
    // Liste de tous les archivepaiements
    echo "Liste des archivepaiements disponibles dans la base : <br/>";
    $listeArchivePaiements = ArchivePaiement::findAll();
    foreach ($listeArchivePaiements as $value) {
        $value->afficher();
    }
}
