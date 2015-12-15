<?php

class Impaye {

    /**
     * Identifiant de l'impaye.
     * @var integer
     */
    private $id_impaye;
    private $montant;
    private $dateLimite;
    private $id_utilisateur;
    private $id_location;

    /**
     * Construit un impaye.
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
     * Insertion d'une nouvelle impaye dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Impaye(montant, dateLimite, id_utilisateur, id_location) VALUES($this->montant, '$this->dateLimite', $this->id_utilisateur, $this->id_location)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_impaye = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une impaye dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_impaye)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "UPDATE Impaye SET montant=$this->montant, dateLimite='$this->dateLimite', id_utilisateur=$this->id_utilisateur, id_location=$this->id_location WHERE id_impaye=$this->id_impaye";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression de l'impaye dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_impaye)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Impaye WHERE id_impaye=$this->id_impaye";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une impaye avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "SELECT * FROM Impaye WHERE id_impaye=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $imp = new Impaye();
        $imp->id_impaye = $d['id_impaye'];
        $imp->montant = $d['montant'];
        $imp->dateLimite = $d['dateLimite'];
        $imp->id_utilisateur = $d['id_utilisateur'];
        $imp->id_location = $d['id_location'];
        return $imp;
    }

    /**
     * Permet de récupérer toutes les impayes.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les impayes */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "SELECT * FROM Impaye";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $imp = new Impaye();
            $imp->id_impaye = $d['id_impaye'];
            $imp->montant = $d['montant'];
            $imp->dateLimite = $d['dateLimite'];
            $imp->id_utilisateur = $d['id_utilisateur'];
            $imp->id_location = $d['id_location'];
            $res[] = $imp;
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
            $imp = new Impaye();
            $imp->id_impaye = $d['id_impaye'];
            $imp->montant = $d['montant'];
            $imp->dateLimite = $d['dateLimite'];
            $imp->id_utilisateur = $d['id_utilisateur'];
            $imp->id_location = $d['id_location'];
            $res[] = $imp;
        }
        return $res;
    }

    /**
     * Affichage d'une impaye.
     */
    function afficher() {
        echo "Impaye n°$this->id_impaye , montant=$this->montant, $this->datelimite $this->id_utilisateur, location n$this->id_location <br/>";
    }

}
