<?php

class Compte {

    /**
     * Identifiant de l'compte.
     * @var integer
     */
    private $id_compte;
    private $identifiant;
    private $mdp;

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
        $query = $c->prepare("INSERT INTO compte (identifiant, mdp, telephone) VALUES (:identifiant, :mdp)");
        $query->bindParam(':identifiant', $this->identifiant, PDO::PARAM_STR);
        $query->bindParam(':mdp', $this->mdp, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
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
        $query = $c->prepare("update compte set identifiant= ?, mdp= ? where id_compte=?");
        $query->bindParam(1, $this->identifiant, PDO::PARAM_STR);
        $query->bindParam(2, $this->mdp, PDO::PARAM_STR);
        $query->bindParam(3, $this->id_compte, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
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
        $query = $c->prepare("DELETE FROM compte where id_compte=?");
        $query->bindParam(1, $this->id_compte, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
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
        $query = $c->prepare("select * from compte where id_compte=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $com = new Compte();
        $com->id_compte = $d['id_compte'];
        $com->identifiant = $d['identifiant'];
        $com->mdp = $d['mdp'];
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
        $query = $c->prepare("select * from compte");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $com = new Compte();
            $com->id_compte = $d['id_compte'];
            $com->identifiant = $d['identifiant'];
            $com->mdp = $d['mdp'];
            $res[] = $com;
        }
        return $res;
    }

    /**
     * Affichage d'une compte.
     */
    function afficher() {
        echo "Compte n°$this->id_compte , $this->mdp ; <br/>";
    }

}
