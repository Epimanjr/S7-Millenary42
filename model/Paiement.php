<?php

class Paiement {

    /**
     * Identifiant de l'paiement.
     * @var integer
     */
    private $id_paiement;
    private $montant;
    private $date;
    private $mode;
    private $type;

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
     * Insertion d'une nouvelle paiement dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO paiement (montant, date, mode, type) VALUES (:montant, :date, :mode, :type)");
        $query->bindParam(':montant', $this->montant, PDO::PARAM_INT);
        $query->bindParam(':date', $this->date, PDO::PARAM_STR);
        $query->bindParam(':mode', $this->mode, PDO::PARAM_STR);
        $query->bindParam(':type', $this->type, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
        $this->id_paiement = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une paiement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_paiement)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update paiement set montant= ?, date= ?, mode= ?, type= ? where id_paiement=?");
        $query->bindParam(1, $this->montant, PDO::PARAM_INT);
        $query->bindParam(2, $this->date, PDO::PARAM_STR);
        $query->bindParam(3, $this->mode, PDO::PARAM_STR);
        $query->bindParam(4, $this->type, PDO::PARAM_STR);
        $query->bindParam(5, $this->id_paiement, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression de l'paiement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_paiement)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM paiement where id_paiement=?");
        $query->bindParam(1, $this->id_paiement, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une paiement avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from paiement where id_paiement=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $pai = new Paiement();
        $pai->id_paiement = $d['id_paiement'];
        $pai->montant = $d['montant'];
        $pai->date = $d['date'];
        $pai->mode = $d['mode'];
        $pai->type = $d['type'];
        return $pai;
    }

    /**
     * Permet de récupérer toutes les paiements.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les paiements */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from paiement");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $pai = new Paiement();
            $pai->id_paiement = $d['id_paiement'];
            $pai->montant = $d['montant'];
            $pai->date = $d['date'];
            $pai->mode = $d['mode'];
            $pai->type = $d['type'];
            $res[] = $pai;
        }
        return $res;
    }

    /**
     * Affichage d'une paiement.
     */
    function afficher() {
        echo "Paiement n°$this->id_paiement , $this->date $this->mode, $this->type ; <br/>";
    }

}
