<?php

class Utilisateur {

    /**
     * Identifiant de l'utilisateur.
     * @var integer
     */
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $etat;
    private $type;

    /**
     * Construit un utilisateur.
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
     * Insertion d'une nouvelle utilisateur dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO utilisateur (nom, prenom, email, telephone, etat, type) VALUES (:nom, :prenom, :email, :telephone, :etat, :type)");
        $query->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':telephone', $this->telephone, PDO::PARAM_STR);
        $query->bindParam(':etat', $this->etat, PDO::PARAM_STR);
        $query->bindParam(':type', $this->type, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
        $this->id_utilisateur = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une utilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_utilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "update utilisateur set nom= '$this->nom', prenom= '$this->prenom', email= '$this->email', telephone= '$this->telephone', etat= '$this->etat', type= '$this->type' where id_utilisateur= '$this->id_utilisateur'";
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
     * Recherche d'une utilisateur avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from utilisateur where id_utilisateur=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $uti = new Utilisateur();
        $uti->id_utilisateur = $d['id_utilisateur'];
        $uti->nom = $d['nom'];
        $uti->prenom = $d['prenom'];
        $uti->email = $d['email'];
        $uti->telephone = $d['telephone'];
        $uti->etat = $d['etat'];
        $uti->type = $d['type'];
        return $uti;
    }

    /**
     * Permet de récupérer toutes les utilisateurs.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les utilisateurs */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from utilisateur";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $uti = new Utilisateur();
            $uti->id_utilisateur = $d['id_utilisateur'];
            $uti->nom = $d['nom'];
            $uti->prenom = $d['prenom'];
            $uti->email = $d['email'];
            $uti->telephone = $d['telephone'];
            $uti->etat = $d['etat'];
            $uti->type = $d['type'];
            $res[] = $uti;
        }
        return $res;
    }

    /**
     * Affichage d'une utilisateur.
     */
    function afficher() {
        echo "Utilisateur n°$this->id_utilisateur , $this->prenom $this->email, $this->type ; $this->telephone $this->etat <br/>";
    }

}
