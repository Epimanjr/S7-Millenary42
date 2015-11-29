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
        $query = $c->prepare("INSERT INTO agence (nom, email, telephone) VALUES (:nom, :email, :telephone)");
        $query->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':telephone', $this->telephone, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
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
        $query = $c->prepare("update agence set nom= ?, email= ?, telephone= ? where id_agence=?");
        $query->bindParam(1, $this->nom, PDO::PARAM_STR);
        $query->bindParam(2, $this->email, PDO::PARAM_STR);
        $query->bindParam(3, $this->telephone, PDO::PARAM_STR);
        $query->bindParam(4, $this->id_agence, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
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
        $query = $c->prepare("DELETE FROM agence where id_agence=?");
        $query->bindParam(1, $this->id_agence, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
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
        $query = $c->prepare("select * from agence where id_agence=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $uti = new Agence();
        $uti->id_agence = $d['id_agence'];
        $uti->nom = $d['nom'];
        $uti->email = $d['email'];
        $uti->telephone = $d['telephone'];
        return $uti;
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
        $query = $c->prepare("select * from agence");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $uti = new Agence();
            $uti->id_agence = $d['id_agence'];
            $uti->nom = $d['nom'];
            $uti->email = $d['email'];
            $uti->telephone = $d['telephone'];
            $res[] = $uti;
        }
        return $res;
    }

    /**
     * Affichage d'une agence.
     */
    function afficher() {
        echo "Agence n°$this->id_agence , $this->email ; $this->telephone <br/>";
    }

}
