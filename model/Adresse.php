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
        $sql = "INSERT INTO Adresse(quartier, numRue, rue, codePostal, ville, batiment, etage, porte) VALUES('$this->quartier', $this->numRue, '$this->rue', $this->codePostal, '$this->ville', '$this->batiment', $this->etage, $this->porte)";
        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "UPDATE Adresse SET quartier='$this->quartier', numRue=$this->numRue, rue='$this->rue', codePostal=$this->codePostal, ville='$this->ville', batiment='$this->batiment', etage=$this->etage, porte=$this->porte WHERE id_adresse=$this->id_adresse";
        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "DELETE FROM Adresse WHERE id_adresse=$this->id_adresse";
        /* Exécution de la requête */
        $c->query($sql);
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
        $sql = "SELECT * FROM Adresse WHERE id_adresse=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
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
        $query = $c->prepare("SELECT * from Adresse");
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
            $res[] = $adr;
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
            $res[] = $adr;
        }
        return $res;
    }

    /**
     * Affichage d'une adresse.
     */
    function afficher() {
        echo "Adresse n°$this->id_adresse , $this->numRue $this->rue, $this->batiment - $this->etage - $this->porte ; $this->codePostal $this->ville <br/>";
    }

}
