<?php

class Option {

    /**
     * Identifiant de l'option.
     * @var integer
     */
    private $id_option;
    private $date;
    private $etat;
    // Clé étrangère
    /**
     * Identifiant de l'utilisateur.
     * @var integer
     */
    private $id_utilisateur;

    /**
     * Identifiant de l'appartement.
     * @var integer 
     */
    private $id_appartement;

    /**
     * Construit une option.
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
     * Insertion d'une nouvelle option dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO option (date, etat, id_utilisateur, id_appartement) VALUES (:date, :etat, :id_utilisateur, :id_appartement)");
        $query->bindParam(':date', $this->debut, PDO::PARAM_STR);
        $query->bindParam(':etat', $this->fin, PDO::PARAM_STR);
        $query->bindParam(':id_utilisateur', $this->id_utilisateur, PDO::PARAM_INT);
        $query->bindParam(':id_appartement', $this->id_appartement, PDO::PARAM_INT);

        /* Exécution de la requête */
        $query->execute();
        $this->id_option = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une option dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_option)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update document set date= ?, etat= ?, id_utilisateur=?, id_appartement=? where id_option=?");
        $query->bindParam(1, $this->date, PDO::PARAM_STR);
        $query->bindParam(2, $this->etat, PDO::PARAM_STR);
        $query->bindParam(3, $this->id_utilisateur, PDO::PARAM_INT);
        $query->bindParam(4, $this->id_appartement, PDO::PARAM_INT);
        $query->bindParam(5, $this->id_option, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression d'une option dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_option)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM option where id_option=?");
        $query->bindParam(1, $this->id_option, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une option avec ID option
     * 
     * @param integer $id
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from option where id_option=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $opt = new Option();
        $opt->id_option = $d['id_option'];
        $opt->id_utilisateur = $d['id_utilisateur'];
        $opt->id_appartement = $d['id_appartement'];
        $opt->date = $d['date'];
        $opt->etat = $d['etat'];
        return $opt;
    }
    
    /**
     * Recherche d'une option avec ID utilisateur
     * 
     * @param integer $id
     * @return \Option
     */
    public static function findByIdUtilisateur($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from option where id_utilisateur=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $opt = new Option();
        $opt->id_option = $d['id_option'];
        $opt->id_utilisateur = $d['id_utilisateur'];
        $opt->id_appartement = $d['id_appartement'];
        $opt->date = $d['date'];
        $opt->etat = $d['etat'];
        return $opt;
    }

    /**
     * Recherche d'une option avec ID appartement
     * 
     * @param integer $id
     * @return \Option
     */
    public static function findByIdAppartement($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from option where id_appartement=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $opt = new Option();
        $opt->id_option = $d['id_option'];
        $opt->id_utilisateur = $d['id_utilisateur'];
        $opt->id_appartement = $d['id_appartement'];
        $opt->date = $d['date'];
        $opt->etat = $d['etat'];
        return $opt;
    }

    /**
     * Permet de récupérer toutes les options.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les options */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from option");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $opt = new Option();
            $opt->id_option = $d['id_option'];
            $opt->id_utilisateur = $d['id_utilisateur'];
            $opt->id_appartement = $d['id_appartement'];
            $opt->date = $d['date'];
            $opt->etat = $d['etat'];
            $res[] = $opt;
        }
        return $res;
    }

    /**
     * Affichage d'une option
     */
    function afficher() {
        echo "Option n°$this->id_option pour utilisateur n°$this->id_utilisateur , Appartement n°$this->id_appartement, le $this->date (état : $this->etat) ; <br/>";
    }

}
