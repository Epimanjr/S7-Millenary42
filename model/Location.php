<?php

class Location {

    /**
     * Identifiant de la location.
     * @var integer
     */
    private $id_location;
    private $debut;
    private $fin;
    private $payeParLocataire;
    private $payeParAgence;
    private $proprietairePaye;

    /**
     * Construit un type d'appartement.
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

    /**
     * Insertion d'une nouvelle location dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO location (debut, fin, payeParLocataire, payeParAgence, proprietairePaye) VALUES (:debut, :fin, :payeParLocataire, :payeParAgence, :proprietairePaye)");
        $query->bindParam(':debut', $this->debut, PDO::PARAM_STR);
        $query->bindParam(':fin', $this->fin, PDO::PARAM_STR);
        $query->bindParam(':payeParLocataire', $this->payeParLocataire, PDO::PARAM_STR);
        $query->bindParam(':payeParAgence', $this->payeParAgence, PDO::PARAM_STR);
        $query->bindParam(':proprietairePaye', $this->proprietairePaye, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
        $this->id_location = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une location dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_location)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update location set debut= ?, fin= ?, payeParLocataire= ?, payeParAgence= ?, proprietairePaye = ? where id_location=?");
        $query->bindParam(1, $this->debut, PDO::PARAM_STR);
        $query->bindParam(2, $this->fin, PDO::PARAM_STR);
        $query->bindParam(3, $this->payeParLocataire, PDO::PARAM_STR);
        $query->bindParam(4, $this->payeParAgence, PDO::PARAM_STR);
        $query->bindParam(5, $this->proprietairePaye, PDO::PARAM_STR);
        $query->bindParam(6, $this->id_location, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression du type de la location dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_location)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM location where id_location=?");
        $query->bindParam(1, $this->id_location, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une location avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from location where id_location=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $loc = new Location();
        $loc->user_id = $d['id_location'];
        $loc->debut = $d['debut'];
        $loc->fin = $d['fin'];
        $loc->payeParLocataire = $d['payeParLocataire'];
        $loc->payeParAgence = $d['payeParAgence'];
        $loc->proprietairePaye = $d['proprietairePaye'];
        return $loc;
    }

    /**
     * Permet de récupérer toutes les locations.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les locations */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from location");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $loc = new Location();
            $loc->user_id = $d['id_location'];
            $loc->debut = $d['debut'];
            $loc->fin = $d['fin'];
            $loc->payeParLocataire = $d['payeParLocataire'];
            $loc->payeParAgence = $d['payeParAgence'];
            $loc->proprietairePaye = $d['proprietairePaye'];
            $res[] = $loc;
        }
        return $res;
    }

    /**
     * Affichage d'une location.
     */
    function afficher() {
        echo "Location n°$this->id_location , du $this->debut au $this->fin <br/>"
        . "PayeParLocataire = $this->payeParLocataire"
        . "PayeParAgence = $this->payeParAgence"
        . "PropriétairePaie = $this->proprietairePaye";
    }

}
