<?php

class Agence {

    /**
     * Identifiant de l'agence.
     * @var integer
     */
    private $id_agence;
    private $nom;
    private $email;
    private $telephone;
    private $id_adresse;

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
     * Insertion d'une nouvelle agence dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Agence (nom, email, telephone, id_adresse) VALUES ('$this->nom', '$this->email', '$this->telephone', $this->id_adresse)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_agence = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une agence dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_agence)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "update Agence set nom= '$this->nom', email= '$this->email', telephone= '$this->telephone', id_adresse=$this->id_adresse where id_agence= $this->id_agence";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression de l'agence dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_agence)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Agence where id_agence= $this->id_agence";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une agence avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Agence where id_agence=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $age = new Agence();
        $age->id_agence = $d['id_agence'];
        $age->nom = $d['nom'];
        $age->email = $d['email'];
        $age->telephone = $d['telephone'];
        $age->id_adresse = $d['id_adresse'];
        return $age;
    }

    /**
     * Permet de récupérer toutes les agences.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les agences */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Agence";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $age = new Agence();
            $age->id_agence = $d['id_agence'];
            $age->nom = $d['nom'];
            $age->email = $d['email'];
            $age->telephone = $d['telephone'];
            $age->id_adresse = $d['id_adresse'];
            $res[] = $age;
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
            $age = new Agence();
            $age->id_agence = $d['id_agence'];
            $age->nom = $d['nom'];
            $age->email = $d['email'];
            $age->telephone = $d['telephone'];
            $age->id_adresse = $d['id_adresse'];
            $res[] = $age;
        }
        return $res;
    }

    /**
     * Affichage d'une agence.
     */
    function afficher() {
        echo "Agence n°$this->id_agence , $this->email ; $this->telephone ; $this->id_adresse <br/>";
    }

}
