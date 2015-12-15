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
    private $id_adresse;
    private $id_type_utilisateur;

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
        $sql = "INSERT INTO Utilisateur (nom, prenom, email, telephone, etat, id_type_utilisateur, id_adresse) VALUES ('$this->nom', '$this->prenom', '$this->email', '$this->telephone', '$this->etat', $this->id_type_utilisateur, $this->id_adresse)";

        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "update Utilisateur set nom= '$this->nom', prenom= '$this->prenom', email= '$this->email', telephone= '$this->telephone', etat= '$this->etat', id_type_utilisateur=$this->id_type_utilisateur, id_adresse=$this->id_adresse where id_utilisateur= $this->id_utilisateur";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression de l'utilisateur dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_utilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Utilisateur where id_utilisateur=$this->id_utilisateur";
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
        $sql = "select * from Utilisateur where id_utilisateur=$id";
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
        $uti->id_type_utilisateur = $d['id_type_utilisateur'];
        $uti->id_adresse = $d['id_adresse'];
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
        $sql = "select * from Utilisateur";
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
            $uti->id_type_utilisateur = $d['id_type_utilisateur'];
            $uti->id_adresse = $d['id_adresse'];
            $res[] = $uti;
        }
        return $res;
    }

    /**
     * Affichage d'une utilisateur.
     */
    function afficher() {
        echo "Utilisateur n°$this->id_utilisateur , $this->nom , $this->prenom $this->email ; $this->telephone $this->etat ; $this->id_type_utilisateur $this->id_adresse<br/>";
    }

}
