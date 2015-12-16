<?php

class Demande {

    /**
     * Identifiant de la demande.
     * @var integer
     */
    private $id_demande;
    private $id_utilisateur;
    private $type;
    private $contenu;

    /**
     * Construit une demande.
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
     * Insertion d'une nouvelle demande dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Demande (type, contenu, id_utilisateur) VALUES ('$this->type', '$this->contenu', $this->id_utilisateur)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_demande = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une demande dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_demande) || !isset($this->id_utilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "update Demande set type='$this->type', contenu='$this->contenu' where id_demande=$this->id_demande and id_utilisateur=$this->id_utilisateur";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression d'une demande dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_demande)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Demande where id_demande=$this->id_demande";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une demande avec ID demande
     * 
     * @param integer $id
     * @return \Demande
     */
    public static function findByIdDemande($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Demande where id_demande=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $dem = new Demande();
        $dem->id_demande = $d['id_demande'];
        $dem->id_utilisateur = $d['id_utilisateur'];
        $dem->type = $d['type'];
        $dem->contenu = $d['contenu'];
        return $dem;
    }
    
    /**
     * Recherche d'une demande avec ID utilisateur
     * 
     * @param integer $id
     * @return \Demande
     */
    public static function findByIdUtilisateur($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Demande where id_utilisateur=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $dem = new Demande();
        $dem->id_demande = $d['id_demande'];
        $dem->id_utilisateur = $d['id_utilisateur'];
        $dem->type = $d['type'];
        $dem->contenu = $d['contenu'];
        return $dem;
    }

    /**
     * Permet de récupérer toutes les demandes.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les demandes */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Demande";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $dem = new Demande();
            $dem->id_demande = $d['id_demande'];
            $dem->id_utilisateur = $d['id_utilisateur'];
            $dem->type = $d['type'];
            $dem->contenu = $d['contenu'];
            $res[] = $dem;
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
            $dem = new Demande();
            $dem->id_demande = $d['id_demande'];
            $dem->id_utilisateur = $d['id_utilisateur'];
            $dem->type = $d['type'];
            $dem->contenu = $d['contenu'];
            $res[] = $dem;
        }
        return $res;
    }
    
    /**
     * Affichage d'une demande
     */
    function afficher() {
        echo "Demande n°$this->id_demande , Utilisateur n°$this->id_utilisateur, type: $this->type (contenu : $this->contenu) ; <br/>";
    }

}
