<?php

class Option {

    /**
     * Identifiant de la demande.
     * @var integer
     */
    private $id_demande;

    /**
     * Identifiant de l'utilisateur.
     * @var integer 
     */
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
        $query = $c->prepare("INSERT INTO demande (id_demande, id_utilisateur, type, contenu) VALUES (:id_demande, :id_utilisateur, :type, :contenu)");
        $query->bindParam(':id_demande', $this->id_demande, PDO::PARAM_INT);
        $query->bindParam(':id_utilisateur', $this->id_utilisateur, PDO::PARAM_INT);
        $query->bindParam(':type', $this->type, PDO::PARAM_STR);
        $query->bindParam(':contenu', $this->contenu, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
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
        $query = $c->prepare("update document set type= ?, contenu= ? where id_demande=? and id_utilisateur=?");
        $query->bindParam(1, $this->type, PDO::PARAM_STR);
        $query->bindParam(2, $this->contenu, PDO::PARAM_STR);
        $query->bindParam(3, $this->id_demande, PDO::PARAM_INT);
        $query->bindParam(4, $this->id_utilisateur, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression d'une demande dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_demande) || !isset($this->id_utilisateur)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM demande where id_utlisateur=? and id_apparteent=?");
        $query->bindParam(1, $this->id_demande, PDO::PARAM_INT);
        $query->bindParam(2, $this->id_utilisateur, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une demande avec ID utilisateur
     * 
     * @param integer $id
     * @return \Option
     */
    public static function findByIdUtilisateur($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from demande where id_demande=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $dem = new Option();
        $dem->id_demande = $d['id_demande'];
        $dem->id_utilisateur = $d['id_utilisateur'];
        $dem->type = $d['type'];
        $dem->contenu = $d['contenu'];
        return $dem;
    }

    /**
     * Recherche d'une demande avec ID appartement
     * 
     * @param integer $id
     * @return \Option
     */
    public static function findByIdAppartement($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from demande where id_utilisateur=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $dem = new Option();
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
        $query = $c->prepare("select * from demande");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $dem = new Option();
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
        echo "Demande pour utilisateur n°$this->id_demande , Appartement n°$this->id_utilisateur, type: $this->type (contenu : $this->contenu) ; <br/>";
    }

}
