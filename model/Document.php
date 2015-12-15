<?php

class Document {

    /**
     * Identifiant du document.
     * @var integer
     */
    private $id_document;
    private $type = "bail";
    private $debut;
    private $fin;
    // Clé étrangère
    /**
     * Identifiant de l'appartement.
     * @var integer
     */
    private $id_appartement;

    /**
     * Construit un document.
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
     * Insertion d'un nouveau document dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "INSERT INTO Document(type, debut, fin, id_appartement) VALUES('$this->type', '$this->debut', '$this->fin', $this->id_appartement)";
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_document = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour un document dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_document)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "UPDATE Document SET type='$this->type', debut='$this->debut', fin='$this->fin', id_appartement=$this->id_appartement WHERE id_document=$this->id_document";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression du document dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_document)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Document where id_document=$this->id_document";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'un document avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "SELECT * FROM Document WHERE id_document=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $docu = new Document();
        $docu->id_document = $d['id_document'];
        $docu->type = $d['type'];
        $docu->debut = $d['debut'];
        $docu->fin = $d['fin'];
        $docu->id_appartement = $d['id_appartement'];
        return $docu;
    }

    /**
     * Permet de récupérer tous les documents.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les paiements */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "SELECT * FROM Document";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $docu = new Document();
            $docu->id_document = $d['id_document'];
            $docu->type = $d['type'];
            $docu->debut = $d['debut'];
            $docu->fin = $d['fin'];
            $docu->id_appartement = $d['id_appartement'];
            $res[] = $docu;
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
            $docu = new Document();
            $docu->id_document = $d['id_document'];
            $docu->type = $d['type'];
            $docu->debut = $d['debut'];
            $docu->fin = $d['fin'];
            $docu->id_appartement = $d['id_appartement'];
            $res[] = $docu;
        }
        return $res;
    }

    /**
     * Affichage d'un docment
     */
    function afficher() {
        echo "Document n°$this->id_document , Type : $this->type, du $this->debut au $this->fin ; pour l'appartement n°$this->id_appartement<br/>";
    }

}
