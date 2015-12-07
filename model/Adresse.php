<?php

class Adresse {

    /**
     * Identifiant de l'adresse.
     * @var integer
     */
    private $id_adresse;
    private $quartier = "";
    private $numRue;
    private $rue;
    private $codePostal;
    private $ville;
    private $batiment = "";
    private $etage = 0;
    private $porte = 0;
    // Clé étrangère
    private $id_agence;

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
     * Insertion d'une nouvelle adresse dans la base de données.
     */
    public function insert() {
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("INSERT INTO adresse (quartier, numRue, rue, codePostal, ville, batiment, etage, porte, id_agence) VALUES (:quartier, :numRue, :rue, :codePostal, :ville, :batiment, :etage, :porte, :id_agence)");
        $query->bindParam(':quartier', $this->quartier, PDO::PARAM_STR);
        $query->bindParam(':numRue', $this->numRue, PDO::PARAM_INT);
        $query->bindParam(':rue', $this->rue, PDO::PARAM_STR);
        $query->bindParam(':codePostal', $this->codePostal, PDO::PARAM_INT);
        $query->bindParam(':ville', $this->ville, PDO::PARAM_STR);
        $query->bindParam(':batiment', $this->batiment, PDO::PARAM_STR);
        $query->bindParam(':etage', $this->etage, PDO::PARAM_STR);
        $query->bindParam(':porte', $this->porte, PDO::PARAM_STR);
        $query->bindParam(':id_agence', $this->id_agence, PDO::PARAM_INT);

        /* Exécution de la requête */
        $query->execute();
        $this->id_adresse = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour une adresse dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_adresse)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("update adresse set quartier= ?, numRue= ?, rue= ?, codePostal= ?, ville= ?, batiment= ?, etage= ?, porte= ?, id_agence= ? where id_adresse=?");
        $query->bindParam(1, $this->quartier, PDO::PARAM_STR);
        $query->bindParam(2, $this->numRue, PDO::PARAM_STR);
        $query->bindParam(3, $this->rue, PDO::PARAM_STR);
        $query->bindParam(4, $this->codePostal, PDO::PARAM_STR);
        $query->bindParam(5, $this->ville, PDO::PARAM_STR);
        $query->bindParam(6, $this->batiment, PDO::PARAM_STR);
        $query->bindParam(7, $this->etage, PDO::PARAM_STR);
        $query->bindParam(8, $this->porte, PDO::PARAM_STR);
        $query->bindParam(9, $this->id_agence, PDO::PARAM_INT);
        $query->bindParam(10, $this->id_adresse, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Suppression de l'adresse dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_adresse)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("DELETE FROM adresse where id_adresse=?");
        $query->bindParam(1, $this->id_adresse, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
    }

    /**
     * Recherche d'une adresse avec son ID
     * 
     * @param integer $id
     * @return \Location
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from adresse where id_adresse=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $adr = new Adresse();
        $adr->id_adresse = $d['id_adresse'];
        $adr->quartier = $d['quartier'];
        $adr->numRue = $d['numRue'];
        $adr->rue = $d['rue'];
        $adr->codePostal = $d['codePostal'];
        $adr->ville = $d['ville'];
        $adr->batiment = $d['batiment'];
        $adr->etage = $d['etage'];
        $adr->porte = $d['porte'];
        $adr->id_agence = $d['id_agence'];
        return $adr;
    }

    /**
     * Permet de récupérer toutes les adresses.
     * 
     * @return 
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker toutes les adresses */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from adresse");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $adr = new Adresse();
            $adr->id_adresse = $d['id_adresse'];
            $adr->quartier = $d['quartier'];
            $adr->numRue = $d['numRue'];
            $adr->rue = $d['rue'];
            $adr->codePostal = $d['codePostal'];
            $adr->ville = $d['ville'];
            $adr->batiment = $d['batiment'];
            $adr->etage = $d['etage'];
            $adr->porte = $d['porte'];
            $adr->id_agence = $d['id_agence'];
            $res[] = $adr;
        }
        return $res;
    }

    /**
     * Affichage d'une adresse.
     */
    function afficher() {
        echo "Adresse n°$this->id_adresse , $this->numRue $this->rue, $this->batiment - $this->etage - $this->porte ; $this->codePostal $this->ville ; agence n°$this->id_agence <br/>";
    }

}
