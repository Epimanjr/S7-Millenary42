<?php

class Impaye {

    /**
     * Identifiant de l'impaye.
     * @var integer
     */
    private $id_impaye;
    private $montant;
    private $datelimite;
    private $id_utilisateur;
    private $id_location;

    /**
     * Construit un impaye.
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
     * Insertion d'une nouvelle impaye dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO impaye (montant, datelimite, id_utilisateur, id_location) VALUES (:montant, :datelimite, :id_utilisateur, :id_location)");
        $query->bindParam(':montant', $this->montant, PDO::PARAM_STR);
        $query->bindParam(':datelimite', $this->datelimite, PDO::PARAM_STR);
        $query->bindParam(':id_utilisateur', $this->id_utilisateur, PDO::PARAM_STR);
        $query->bindParam(':id_location', $this->id_location, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
        $this->id_impaye = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une impaye dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_impaye)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update impaye set montant= ?, datelimite= ?, id_utilisateur= ?, id_location= ?, etat= ?, type= ? where id_impaye=?");
        $query->bindParam(1, $this->montant, PDO::PARAM_STR);
        $query->bindParam(2, $this->datelimite, PDO::PARAM_STR);
        $query->bindParam(3, $this->id_utilisateur, PDO::PARAM_INT);
        $query->bindParam(4, $this->id_location, PDO::PARAM_INT);
        $query->bindParam(5, $this->id_impaye, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression de l'impaye dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_impaye)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM impaye where id_impaye=?");
        $query->bindParam(1, $this->id_impaye, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une impaye avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from impaye where id_impaye=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $imp = new Impaye();
        $imp->id_impaye = $d['id_impaye'];
        $imp->montant = $d['montant'];
        $imp->datelimite = $d['datelimite'];
        $imp->id_utilisateur = $d['id_utilisateur'];
        $imp->id_location = $d['id_location'];
        return $imp;
    }

    /**
     * Permet de récupérer toutes les impayes.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les impayes */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from impaye");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $imp = new Impaye();
            $imp->id_impaye = $d['id_impaye'];
            $imp->montant = $d['montant'];
            $imp->datelimite = $d['datelimite'];
            $imp->id_utilisateur = $d['id_utilisateur'];
            $imp->id_location = $d['id_location'];
            $res[] = $imp;
        }
        return $res;
    }

    /**
     * Affichage d'une impaye.
     */
    function afficher() {
        echo "Impaye n°$this->id_impaye , $this->datelimite $this->id_utilisateur, $this->type ; $this->id_location $this->etat <br/>";
    }

}
