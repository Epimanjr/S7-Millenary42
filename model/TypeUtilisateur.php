<?php

class TypeUtilisateur {

    /**
     * Identifiant du type utilisateur.
     * @var integer
     */
    private $id_type_typeutilisateur;
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
     * Insertion d'une nouvelle typeutilisateur dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO typeutilisateur (nom) VALUES (:nom)");
        $query->bindParam(':nom', $this->nom, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
        $this->id_type_typeutilisateur = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une typeutilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_type_typeutilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update typeutilisateur set nom= ? where id_type_typeutilisateur=?");
        $query->bindParam(1, $this->nom, PDO::PARAM_STR);
        $query->bindParam(2, $this->id_type_typeutilisateur, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression du type utilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_type_typeutilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM typeutilisateur where id_type_typeutilisateur=?");
        $query->bindParam(1, $this->id_type_typeutilisateur, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une typeutilisateur avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from typeutilisateur where id_type_typeutilisateur=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $tut = new TypeUtilisateur();
        $tut->id_type_typeutilisateur = $d['id_type_typeutilisateur'];
        $tut->nom = $d['nom'];
        return $tut;
    }

    /**
     * Permet de récupérer toutes les typeutilisateurs.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les typeutilisateurs */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from typeutilisateur");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $tut = new TypeUtilisateur();
            $tut->id_type_typeutilisateur = $d['id_type_typeutilisateur'];
            $tut->nom = $d['nom'];
            $res[] = $tut;
        }
        return $res;
    }

    /**
     * Affichage d'une typeutilisateur.
     */
    function afficher() {
        echo "TypeUtilisateur n°$this->id_type_typeutilisateur , $this->nom <br/>";
    }

}
