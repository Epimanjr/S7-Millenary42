<?php

/**
 * Classe de test pour l'entité Document
 */
include_once '../Database.php';
include_once '../Document.php';

// Création d'un document
echo "Création d'un document ... ";
$document = new Document();
$document->debut = "2015-12-28";
$document->fin = "2015-12-29";
$document->id_appartement = 1;
// Ajout dans la base
echo "OK<br/>Ajout du document dans la base ... ";
$document->insert();
echo "OK<br/>";

// Liste de tous les documents
listerTout();

// Apport d'une modification
$document->fin = "2015-12-30";
echo "Modification de la fin ! Mise à jour dans la base ... ";
$document->update();
echo "OK<br/>";

// Sélection de l'appartement
$selectionDocument = Document::findById($document->id_document);
$selectionDocument->afficher();

// Suppression du document
echo "Suppression du document de la base ... ";
$selectionDocument->delete();
echo "OK<br/>";

// Liste de tous les documents
listerTout();

function listerTout() {
    // Liste de tous les documents
    echo "Liste des documents disponibles dans la base : <br/>";
    $listeDocuments = Document::findAll();
    foreach ($listeDocuments as $value) {
        $value->afficher();
    }
}
