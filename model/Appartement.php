<?php

echo "Salut!<br>";

include_once "Database.php";

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

//TODO ici : classe appartement
class Appartement {

    // Tous les attributs de la classe appartement.

    private $surface;
    private $nbPieces;
    private $loyer;
    private $charges;
    private $etat;
    private $forcerVisibiliteSite;
    private $videoPhone;
    private $interPhone;
    private $digicode;
    private $cable;
    private $antenneTV;
    private $espaceVert;
    private $VMC;
    private $piscine;
    private $parkingCollectif;
    private $jardinPrive;
    private $ascenseur;
    private $logeGardien;
    private $videOrdure;
    private $doubleVitrage;
    private $climatisation;
    private $eauChaudeCollective;
    private $eauFroideCollective;
    private $cptEauChaude;
    private $cptEauFroide;
    private $chauffage;
    private $classeEnergie;
    private $cuisineEquipee;
    private $branchementMachineLaver;
    private $evier;
    private $caves;
    private $balcons;
    private $garages;
    private $terrasses;
    private $chambreService;
    private $parkingPrive;
    private $greniers;
    private $celliers;

    /**
     * Construit un appartement.
     */
    public function __construct() {
        
    }

    /**
     * GETTER MAGIQUE 
     * 
     * @param type $attr_name
     * @return type
     */
    public function __get($attr_name) {
        if (property_exists(__CLASS__, $attr_name)) {
            return $this->$attr_name;
        }
    }

    /**
     * SETTER MAGIQUE
     * 
     * @param type $attr_name
     * @param type $attr_val
     */
    public function __set($attr_name, $attr_val) {
        if (property_exists(__CLASS__, $attr_name)) {
            $this->$attr_name = $attr_val;
        }
        //$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
    }

}
