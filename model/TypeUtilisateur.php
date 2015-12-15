<?php

class TypeUtilisateur {

    /**
     * Identifiant du type utilisateur.
     * @var integer
     */
    private $id_type_utilisateur;
    private $nom;

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
     * Insertion d'une nouvelle TypeUtilisateur dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO TypeUtilisateur(nom) VALUES('$this->nom')";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_type_utilisateur = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une TypeUtilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_type_utilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "update TypeUtilisateur set nom='$this->nom' where id_type_utilisateur=$this->id_type_utilisateur";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression du type utilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_type_utilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM TypeUtilisateur where id_type_utilisateur=$this->id_type_utilisateur";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une TypeUtilisateur avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from TypeUtilisateur where id_type_utilisateur=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $tut = new TypeUtilisateur();
        $tut->id_type_utilisateur = $d['id_type_utilisateur'];
        $tut->nom = $d['nom'];
        return $tut;
    }

    /**
     * Permet de récupérer toutes les TypeUtilisateurs.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les TypeUtilisateurs */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Exécution de la requête */
        $query = $c->query("select * from TypeUtilisateur");
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $tut = new TypeUtilisateur();
            $tut->id_type_utilisateur = $d['id_type_utilisateur'];
            $tut->nom = $d['nom'];
            $res[] = $tut;
        }
        return $res;
    }

    /**
     * Affichage d'une TypeUtilisateur.
     */
    function afficher() {
        echo "TypeUtilisateur n°$this->id_type_utilisateur , $this->nom <br/>";
    }

}
