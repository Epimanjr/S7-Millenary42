<?php

class Paiement {

    /**
     * Identifiant de paiement.
     * @var integer
     */
    private $id_paiement;
    private $montant;
    private $date;
    private $mode;
    private $type;
    // Clé étrangère
    private $id_utilisateur;
    private $id_location;

    /**
     * Construit un paiement.
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
     * Insertion d'un nouveau paiement dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Paiement(montant, date, mode, type, id_utilisateur, id_location) VALUES($this->montant, '$this->date', '$this->mode', '$this->type', $this->id_utilisateur, $this->id_location)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_paiement = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une paiement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_paiement)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "UPDATE Paiement SET montant=$this->montant, date='$this->date', mode='$this->mode', type='$this->type', id_utilisateur=$this->id_utilisateur, id_location=$this->id_location WHERE id_paiement=$this->id_paiement";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression de paiement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_paiement)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Paiement where id_paiement=$this->id_paiement";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une paiement avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Paiement where id_paiement=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $pai = new Paiement();
        $pai->id_paiement = $d['id_paiement'];
        $pai->montant = $d['montant'];
        $pai->date = $d['date'];
        $pai->mode = $d['mode'];
        $pai->type = $d['type'];
        $pai->id_utilisateur = $d['id_utilisateur'];
        $pai->id_location = $d['id_location'];
        return $pai;
    }

    /**
     * Permet de récupérer toutes les paiements.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les paiements */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "SELECT * FROM Paiement";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $pai = new Paiement();
            $pai->id_paiement = $d['id_paiement'];
            $pai->montant = $d['montant'];
            $pai->date = $d['date'];
            $pai->mode = $d['mode'];
            $pai->type = $d['type'];
            $pai->id_utilisateur = $d['id_utilisateur'];
            $pai->id_location = $d['id_location'];
            $res[] = $pai;
        }
        return $res;
    }

    public static function find($sql) {
        $res = array();
        // Connexion à la base
        $c = Database::getConnection();
        // Exécution requête
        $query = $c->query($sql);
        // Parcours
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $pai = new Paiement();
            $pai->id_paiement = $d['id_paiement'];
            $pai->montant = $d['montant'];
            $pai->date = $d['date'];
            $pai->mode = $d['mode'];
            $pai->type = $d['type'];
            $pai->id_utilisateur = $d['id_utilisateur'];
            $pai->id_location = $d['id_location'];
            $res[] = $pai;
        }
        return $res;
    }

    /**
     * Affichage d'une paiement.
     */
    function afficher() {
        echo "Paiement n°$this->id_paiement , $this->date $this->mode, $this->type ; <br/>";
    }

}
