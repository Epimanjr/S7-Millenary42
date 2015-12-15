<?php

class Location {

    /**
     * Identifiant de la location.
     * @var integer
     */
    private $id_location;
    private $debut;
    private $fin;
    private $payeParLocataire = 0;
    private $payeParAgence = 0;
    private $proprietairePaye = 0;
    // Clé étrangère
    private $id_appartement;
    private $id_utilisateur;

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
        $sql = "INSERT INTO Location(debut, fin, payeParLocataire, payeParAgence, proprietairePaye, id_appartement, id_utilisateur) VALUES('$this->debut', '$this->fin', $this->payeParLocataire, $this->payeParAgence, $this->proprietairePaye, $this->id_appartement, $this->id_utilisateur)";
        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "UPDATE Location SET debut='$this->debut', fin='$this->fin', payeParLocataire=$this->payeParLocataire, payeParAgence=$this->payeParAgence, proprietairePaye=$this->proprietairePaye, id_appartement=$this->id_appartement, id_utilisateur=$this->id_utilisateur WHERE id_location=$this->id_location";
        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "DELETE FROM Location where id_location=$this->id_location";
        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "select * from Location where id_location=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $loc = new Location();
        $loc->id_location = $d['id_location'];
        $loc->debut = $d['debut'];
        $loc->fin = $d['fin'];
        $loc->payeParLocataire = $d['payeParLocataire'];
        $loc->payeParAgence = $d['payeParAgence'];
        $loc->proprietairePaye = $d['proprietairePaye'];
        $loc->id_appartement = $d['id_appartement'];
        $loc->id_utilisateur = $d['id_utilisateur'];
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
        $sql = "select * from Location";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $loc = new Location();
            $loc->id_location = $d['id_location'];
            $loc->debut = $d['debut'];
            $loc->fin = $d['fin'];
            $loc->payeParLocataire = $d['payeParLocataire'];
            $loc->payeParAgence = $d['payeParAgence'];
            $loc->proprietairePaye = $d['proprietairePaye'];
            $loc->id_appartement = $d['id_appartement'];
            $loc->id_utilisateur = $d['id_utilisateur'];
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
        . "PropriétairePaie = $this->proprietairePaye"
        . "Id de l'appartement = $this->id_appartement"
        . "Id de l'utilisateur = $this->id_utilisateur <br/>";
    }

}
