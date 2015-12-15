<?php

class Possession {

    /**
     * Identifiant de la possession.
     * @var integer
     */
    private $id_possession;
    private $debut;
    private $fin;
    // Clé étrangère
    private $id_utilisateur;
    private $id_appartement;

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
     * Insertion d'une nouvelle possession dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Possession(debut, fin, id_utilisateur, id_appartement) VALUES('$this->debut', '$this->fin', $this->id_utilisateur, $this->id_appartement)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_possession = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une location dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_possession)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "UPDATE Possession SET debut='$this->debut', fin='$this->fin', id_utilisateur=$this->id_utilisateur, id_appartement=$this->id_appartement WHERE id_possession=$this->id_possession";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression du type de la possession dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_possession)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Possession WHERE id_possession=$this->id_possession";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'une possession avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "SELECT * FROM Possession WHERE id_possession=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $pos = new Possession();
        $pos->id_possession = $d['id_possession'];
        $pos->debut = $d['debut'];
        $pos->fin = $d['fin'];
        $pos->id_utilisateur = $d['id_utilisateur'];
        $pos->id_appartement = $d['id_appartement'];
        return $pos;
    }

    /**
     * Permet de récupérer toutes les locations.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les locations */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Possession";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $pos = new Possession();
            $pos->id_possession = $d['id_possession'];
            $pos->debut = $d['debut'];
            $pos->fin = $d['fin'];
            $pos->id_utilisateur = $d['id_utilisateur'];
            $pos->id_appartement = $d['id_appartement'];
            $res[] = $pos;
        }
        return $res;
    }

    /**
     * Affichage d'une location.
     */
    function afficher() {
        echo "Possession n°$this->id_possession , du $this->debut au $this->fin "
        . "Id de l'utilisateur = $this->id_utilisateur"
        . "Id de l'appartement = $this->id_appartement <br/>";
    }

}
