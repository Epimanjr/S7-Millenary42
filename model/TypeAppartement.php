<?php

class TypeAppartement {

    /**
     * Identifiant du type de l'appartement.
     * @var integer
     */
    private $id_type_appart;

    /**
     *
     * @var string
     */
    private $nom;

    /**
     *
     * @var type ?
     */
    private $duree;

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
     * Insertion d'un nouvel appartement dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO type_appartement (nom, duree) VALUES (:nom, :duree)");
        $query->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $query->bindParam(':duree', $this->duree, PDO::PARAM_STR);

        /* Exécution de la requête */
        $query->execute();
        $this->id_appart = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour un type d'appartement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_type_appart)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update type_appartement set nom= ?, duree= ? where id_type_appart=?");
        $query->bindParam(1, $this->nom, PDO::PARAM_STR);
        $query->bindParam(2, $this->duree, PDO::PARAM_STR);
        $query->bindParam(3, $this->id_type_appart, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }
    /**
     * Suppression du type d'appartement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_type_appart)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM type_appartement where id_type_appart=?");
        $query->bindParam(1, $this->id_type_appart, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }
}
