<?php

class Compte {

    /**
     * Identifiant de l'compte.
     * @var integer
     */
    private $id_compte;
    private $identifiant;
    private $motDePasse;
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
     * Insertion d'une nouvelle compte dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Compte (identifiant, motDePasse, id_utilisateur) VALUES ('$this->identifiant', '$this->motDePasse', $this->id_utilisateur)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_compte = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une compte dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_compte)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "update Compte set identifiant='$this->identifiant', motDePasse='$this->motDePasse' where id_compte=$this->id_compte";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression de l'compte dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_compte)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Compte where id_compte=$this->id_compte";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une compte avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Compte where id_compte=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $com = new Compte();
        $com->id_compte = $d['id_compte'];
        $com->identifiant = $d['identifiant'];
        $com->motDePasse = $d['motDePasse'];
        $com->id_utilisateur = $d['id_utilisateur'];
        return $com;
    }

    /**
     * Permet de récupérer toutes les comptes.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les comptes */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Compte";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $com = new Compte();
            $com->id_compte = $d['id_compte'];
            $com->identifiant = $d['identifiant'];
            $com->motDePasse = $d['motDePasse'];
            $com->id_utilisateur = $d['id_utilisateur'];
            $res[] = $com;
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
            $com = new Compte();
            $com->id_compte = $d['id_compte'];
            $com->identifiant = $d['identifiant'];
            $com->motDePasse = $d['motDePasse'];
            $com->id_utilisateur = $d['id_utilisateur'];
            $res[] = $com;
        }
        return $res;
    }
    
    /**
     * Affichage d'une compte.
     */
    function afficher() {
        echo "Compte n°$this->id_compte , $this->identifiant , $this->motDePasse ; $this->id_utilisateur <br/>";
    }

}
