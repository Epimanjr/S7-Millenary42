<?php

echo "Salut!<br>";

include_once "../Database.php";

$db = Database::getConnection();

//$db->exec("CREATE TABLE Test(numero NUMERIC(5),nom CHAR(20) NOT NULL,commentaire CHAR(255))");
//$db->exec("INSERT INTO Test VALUES(1,'Test1','Aurais-je enfin reussi ?')");
//$db->exec("INSERT INTO Test VALUES(2,'Test2','Il semble que oui...')");

try {

    $sql = 'SELECT * FROM Test';
    foreach ($db->query($sql) as $row) {
        print $row['numero'] . "\t";
        print $row['nom'] . "\t";
        print $row['commentaire'] . "\n";
    }
} catch (Exception $e) {
    $trace = $e->getTrace();
    echo "Erreur pendant findById: $trace";
}

echo "<br>coucou";

