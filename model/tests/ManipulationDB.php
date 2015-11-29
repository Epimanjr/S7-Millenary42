<?php

echo "Salut!<br>";

include_once "../Database.php";

$db = Database::getConnection();

//$db->exec("CREATE TABLE Test(numero NUMERIC(5),nom CHAR(20) NOT NULL,commentaire CHAR(255))");
//$db->exec("INSERT INTO Test VALUES(1,'Test1','Aurais-je enfin reussi ?')");
//$db->exec("INSERT INTO Test VALUES(2,'Test2','Il semble que oui...')");
/*
$statement = $db->query("DROP TABLE Appartement");

print_r($statement::errorInfo());*/

$db->exec("CREATE TABLE appartement (idApp NUMERIC(5), surface NUMERIC(5) NOT NULL, nbPieces NUMERIC(5) NOT NULL, loyer NUMERIC(5) NOT NULL, charges NUMERIC(5) NOT NULL, etat CHAR(20) NOT NULL, forcerVisibiliteSite BIT, videophone BIT, interphone BIT, digicode BIT, cable BIT, antenneTV BIT, espaceVert BIT, VMC NUMERIC(5), piscine NUMERIC(5), parkingCollectif BIT, jardinPrive BIT, ascenseur BIT, logeGardien BIT, videOrdure BIT, doubleVitrage BIT, climatisation BIT, eauChaudeCollective BIT, eauFroideCollective BIT, cptEauChaude BIT, cptEauFroide BIT, chauffage CHAR(20), classeEnergie CHARACTER(1), cuisineEquipee BIT, branchmentMachineLaver BIT, evier NUMERIC(5), caves BIT, balcons NUMERIC(5), garages NUMERIC(5), terrasses NUMERIC(5), chambreService NUMERIC(5), parkingPrive BIT, greniers BIT, celliers BIT )");

$statement = $db->query("SELECT * FROM appartement");

print_r($statement->errorInfo());



//$statement2 = $db->query("CREATE TABLE appartementTest (id NUMERIC(5), surface NUMERIC(5) NOT NULL,nbPieces NUMERIC(5))");

//print_r($statement2->errorInfo());

//$statement = $db->query("CREATE TABLE appartement (id_appartement NUMERIC(5) PRIMARY KEY, surface NUMERIC(5) NOT NULL, nbPieces NUMERIC(5) NOT NULL, loyer NUMERIC(5) NOT NULL, charges NUMERIC(5) NOT NULL, etat CHAR(20) NOT NULL, forcerVisibiliteSite BIT, videophone BIT, interphone BIT, digicode BIT, cable BIT, antenneTV BIT, espaceVert BIT, VMC NUMERIC(5), piscine NUMERIC(5), parkingCollectif BIT, jardinPrive BIT, ascenseur BIT, logeGardien BIT, videOrdure BIT, doubleVitrage BIT, climatisation BIT, eauChaudeCollective BIT, eauFroideCollective BIT, cptEauChaude BIT, cptEauFroide BIT, chauffage CHAR(20), classeEnergie CHARACTER(1), cuisineEquipee BIT, branchmentMachineLaver BIT, evier NUMERIC(5), caves BIT, balcons NUMERIC(5), garages NUMERIC(5), terrasses NUMERIC(5), chambreService NUMERIC(5), parkingPrive BIT, greniers BIT, celliers BIT )");

//print_r($statement->errorInfo());

/*

$db->exec("INSERT INTO appartement VALUES(0,35,2,340,25,'loue')");

print_r($db->query("SELECT * FROM Test"));

try {

    $sql = 'SELECT * FROM Test';
    foreach ($db->query($sql) as $row) {
        print $row['numero'] . "\t";
        print $row['nom'] . "\t";
        print $row['commentaire'] . "\n";
    }
} catch (Exception $e) {
    $trace = $e->getTrace();
    echo "Erreur: $trace";
}

echo "<br>coucou<br>";

try {

    $sql = 'SELECT * FROM appartement';
    foreach ($db->query($sql) as $row) {
        echo "enfin";
        /*print $row['surface'] . "\t";
        print $row['nbPieces'] . "\t";
        print $row['etat'] . "\n";
    }
} catch (Exception $e) {
    $trace = $e->getTrace();
    echo "Erreur: $trace";
}

echo "<br>coucou";

*/