<?php

//TODO ici : classe appartement
class Appartement {
    // Tous les attributs de la classe appartement.

    /**
     * Identifiant de l'appartement.
     * @var integer
     */
    private $id_appart;

    /**
     * Surface de l'appartement, en mètre carré.
     * @var integer
     */
    private $surface;

    /**
     * Nombre de pièces.
     * @var integer
     */
    private $nbPieces;

    /**
     * Montant du loyer, exprimé en €
     * @var number
     */
    private $loyer;

    /**
     * Montant des charges, également exprimé en €
     * @var number
     */
    private $charges;

    /**
     * Etat de l'appartement
     * @var chaine
     */
    private $etat;

    /**
     * 
     * @var boolean
     */
    private $forcerVisibiliteSite = 0;

    /**
     * Présence ou non d'un videophone.
     * @var boolean
     */
    private $videophone = 0;

    /**
     * Présence ou non d'un interphone.
     * @var boolean
     */
    private $interphone = 0;

    /**
     * Présence ou non d'un digicole.
     * @var boolean
     */
    private $digicode = 0;

    /**
     * Présence ou non du câble.
     * @var boolean
     */
    private $cable = 0;

    /**
     * Présence ou non d'une antenne TV.
     * @var boolean
     */
    private $antenneTV = 0;

    /**
     * Présence ou non d'un espace vert.
     * @var boolean
     */
    private $espaceVert = 0;

    /**
     * Présence ou non d'un VMC
     * @var integer
     */
    private $VMC = 0;

    /**
     * Présence ou non d'une piscine.
     * @var integer
     */
    private $piscine = 0;

    /**
     * Présence ou non d'un parking collectif.
     * @var boolean
     */
    private $parkingCollectif = 0;

    /**
     * Présence ou non d'un jardin privé.
     * @var boolean
     */
    private $jardinPrive = 0;

    /**
     * Présence ou non d'un ascenseur.
     * @var boolean
     */
    private $ascenseur = 0;

    /**
     * Présence ou non d'une loge pour un gardien.
     * @var boolean
     */
    private $logeGardien = 0;

    /**
     * Présence ou non d'un vide ordure.
     * @var boolean
     */
    private $videOrdure = 0;

    /**
     * Double vitrage ? 
     * @var boolean
     */
    private $doubleVitrage = 0;

    /**
     * Appartement climatisé ?
     * @var boolean
     */
    private $climatisation = 0;

    /**
     * Eau chaude collective ?
     * @var boolean
     */
    private $eauChaudeCollective = 0;

    /**
     * Eau froide collective ?
     * @var boolean
     */
    private $eauFroideCollective = 0;

    /**
     * Complément d'eau chaude personnel ?
     * @var boolean
     */
    private $cptEauChaude = 0;

    /**
     * Complément d'eau froide personnel ?
     * @var boolean
     */
    private $cptEauFroide = 0;

    /**
     * L'appartement est-il chauffé ?
     * @var String
     */
    private $chauffage = "Gaz";

    /**
     * Classe d'energie.
     * @var char
     */
    private $classeEnergie = 'A';

    /**
     * L'appartement possède-t-il une cuisine équipée ?
     * @var boolean
     */
    private $cuisineEquipee = 0;

    /**
     *
     * @var boolean
     */
    private $branchementMachineLaver = 0;

    /**
     *
     * @var integer
     */
    private $evier = 0;

    /**
     * Présence ou non d'une case.
     * @var boolean 
     */
    private $caves = 0;

    /**
     * Présence ou non de balcons, et combien ?
     * @var integer
     */
    private $balcons = 0;

    /**
     * Combien de garages ?
     * @var integer
     */
    private $garages = 0;

    /**
     * Combien de terrasse ?
     * @var integer
     */
    private $terrasses = 0;

    /**
     *
     * @var integer
     */
    private $chambreService = 0;

    /**
     * Combien de parking privé ? (0 si absent)
     * @var integer
     */
    private $parkingPrive = 0;

    /**
     * Présence d'un grenier accessible ?
     * @var boolean
     */
    private $greniers = 0;

    /**
     *
     * @var boolean
     */
    private $celliers = 0;
    // Clé étrangère
    private $id_type_appart;
    private $id_adresse;

    /**
     * Construit un appartement.
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
        $sql = "INSERT INTO Appartement (surface, nbPieces, loyer, charges, etat, forcerVisibiliteSite, videophone, interphone, digicode, cable, antenneTV, espaceVert, VMC, piscine, parkingCollectif, jardinPrive, ascenseur, logeGardien, videOrdure, doubleVitrage, climatisation, eauChaudeCollective, eauFroideCollective, cptEauChaude, cptEauFroide, chauffage, classeEnergie, cuisineEquipee, branchementMachineLaver, evier, caves, balcons, garages, terrasses, chambreService, parkingPrive, greniers, celliers, id_type_appart, id_adresse) VALUES ($this->surface, $this->nbPieces, $this->loyer, $this->charges, \"$this->etat\", $this->forcerVisibiliteSite, $this->videophone, $this->interphone, $this->digicode, $this->cable, $this->antenneTV, $this->espaceVert, $this->VMC, $this->piscine, $this->parkingCollectif, $this->jardinPrive, $this->ascenseur, $this->logeGardien, $this->videOrdure, $this->doubleVitrage, $this->climatisation, $this->eauChaudeCollective, $this->eauFroideCollective, $this->cptEauChaude, $this->cptEauFroide, \"$this->chauffage\", \"$this->classeEnergie\", $this->cuisineEquipee, $this->branchementMachineLaver, $this->evier, $this->caves, $this->balcons, $this->garages, $this->terrasses, $this->chambreService, $this->parkingPrive, $this->greniers, $this->celliers, $this->id_type_appart, $this->id_adresse)";
        echo $sql;
        /* Exécution de la requête */
        $c->query($sql);
        $this->id_appart = $c->lastInsertId();
    }

    /**
     * Permet de mettre à jour un appartement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function update() {
        /* On test si l'ID est défini, sinon on ne peut pas faire la mise à jour */
        if (!isset($this->id_appart)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "UPDATE Appartement SET surface= $this->surface, nbPieces= $this->nbPieces, loyer= $this->loyer, charges= $this->charges, etat= '$this->etat', forcerVisibiliteSite= $this->forcerVisibiliteSite, videophone= $this->videophone, interphone= $this->interphone, digicode= $this->digicode, cable= $this->cable, antenneTV= $this->antenneTV, espaceVert= $this->espaceVert, VMC= $this->VMC, piscine= $this->piscine, parkingCollectif= $this->parkingCollectif, jardinPrive= $this->jardinPrive, ascenseur= $this->ascenseur, logeGardien= $this->logeGardien, videOrdure= $this->videOrdure, doubleVitrage= $this->doubleVitrage, climatisation= $this->climatisation, eauChaudeCollective= $this->eauChaudeCollective, eauFroideCollective= $this->eauFroideCollective, cptEauChaude= $this->cptEauChaude, cptEauFroide= $this->cptEauFroide, chauffage= '$this->chauffage', classeEnergie= '$this->classeEnergie', cuisineEquipee= $this->cuisineEquipee, branchementMachineLaver= $this->branchementMachineLaver, evier= $this->evier, caves= $this->caves, balcons= $this->balcons, garages= $this->garages, terrasses= $this->terrasses, chambreService= $this->chambreService, parkingPrive= $this->parkingPrive, greniers= $this->greniers, celliers= $this->celliers, id_type_appart=$this->id_type_appart, id_adresse=$this->id_adresse WHERE id_appartement=$this->id_appart";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Suppression de l'appartement dans la base de données.
     * 
     * @return type
     * @throws Exception
     */
    public function delete() {
        /* On vérifie si l'id est renseigné, sinon on ne peut pas supprimer */
        if (!isset($this->id_appart)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
        }
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "DELETE FROM Appartement WHERE id_appartement=$this->id_appart";
        /* Exécution de la requête */
        $c->query($sql);
    }

    /**
     * Recherche d'un utilisateur avec son ID
     * 
     * @param type $id
     * @return \Users
     */
    public static function findById($id) {
        /* Connexion à la base de données */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $sql = "select * from Appartement where id_appartement=$id";
        /* Exécution de la requête */
        $query = $c->query($sql);
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $appart = new Appartement();
        $appart->id_appart = $d['id_appartement'];
        $appart->surface = $d['surface'];
        $appart->nbPieces = $d['nbPieces'];
        $appart->loyer = $d['loyer'];
        $appart->charges = $d['charges'];
        $appart->etat = $d['etat'];
        $appart->forcerVisibiliteSite = $d['forcerVisibiliteSite'];
        $appart->videophone = $d['videophone'];
        $appart->interphone = $d['interphone'];
        $appart->digicode = $d['digicode'];
        $appart->cable = $d['cable'];
        $appart->antenneTV = $d['antenneTV'];
        $appart->espaceVert = $d['espaceVert'];
        $appart->VMC = $d['VMC'];
        $appart->piscine = $d['piscine'];
        $appart->parkingCollectif = $d['parkingCollectif'];
        $appart->jardinPrive = $d['jardinPrive'];
        $appart->ascenseur = $d['ascenseur'];
        $appart->logeGardien = $d['logeGardien'];
        $appart->videOrdure = $d['videOrdure'];
        $appart->doubleVitrage = $d['doubleVitrage'];
        $appart->climatisation = $d['climatisation'];
        $appart->eauChaudeCollective = $d['eauChaudeCollective'];
        $appart->eauFroideCollective = $d['eauFroideCollective'];
        $appart->cptEauChaude = $d['cptEauChaude'];
        $appart->cptEauFroide = $d['cptEauFroide'];
        $appart->chauffage = $d['chauffage'];
        $appart->classeEnergie = $d['classeEnergie'];
        $appart->cuisineEquipee = $d['cuisineEquipee'];
        $appart->branchementMachineLaver = $d['branchementMachineLaver'];
        $appart->evier = $d['evier'];
        $appart->caves = $d['caves'];
        $appart->balcons = $d['balcons'];
        $appart->garages = $d['garages'];
        $appart->terrasses = $d['terrasses'];
        $appart->chambreService = $d['chambreService'];
        $appart->parkingPrive = $d['parkingPrive'];
        $appart->greniers = $d['greniers'];
        $appart->celliers = $d['celliers'];
         $appart->id_adresse = $d['id_adresse'];
            $appart->id_type_appart = $d['id_type_appart'];
        return $appart;
    }

    /**
     * Permet de récupérer tous les utilisateurs
     * 
     * @return \Users
     */
    public static function findAll() {
        /* Création d'un tableau dans lequel on va stocker tous les utilisateurs */
        $res = array();
        /* Connexion à la base */
        $c = Database::getConnection();
        /* Préparation de la requête */
        $query = $c->prepare("select * from Appartement");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $appart = new Appartement();
            $appart->id_appart = $d['id_appartement'];
            $appart->surface = $d['surface'];
            $appart->nbPieces = $d['nbPieces'];
            $appart->loyer = $d['loyer'];
            $appart->charges = $d['charges'];
            $appart->etat = $d['etat'];
            $appart->forcerVisibiliteSite = $d['forcerVisibiliteSite'];
            $appart->videophone = $d['videophone'];
            $appart->interphone = $d['interphone'];
            $appart->digicode = $d['digicode'];
            $appart->cable = $d['cable'];
            $appart->antenneTV = $d['antenneTV'];
            $appart->espaceVert = $d['espaceVert'];
            $appart->VMC = $d['VMC'];
            $appart->piscine = $d['piscine'];
            $appart->parkingCollectif = $d['parkingCollectif'];
            $appart->jardinPrive = $d['jardinPrive'];
            $appart->ascenseur = $d['ascenseur'];
            $appart->logeGardien = $d['logeGardien'];
            $appart->videOrdure = $d['videOrdure'];
            $appart->doubleVitrage = $d['doubleVitrage'];
            $appart->climatisation = $d['climatisation'];
            $appart->eauChaudeCollective = $d['eauChaudeCollective'];
            $appart->eauFroideCollective = $d['eauFroideCollective'];
            $appart->cptEauChaude = $d['cptEauChaude'];
            $appart->cptEauFroide = $d['cptEauFroide'];
            $appart->chauffage = $d['chauffage'];
            $appart->classeEnergie = $d['classeEnergie'];
            $appart->cuisineEquipee = $d['cuisineEquipee'];
            $appart->branchementMachineLaver = $d['branchementMachineLaver'];
            $appart->evier = $d['evier'];
            $appart->caves = $d['caves'];
            $appart->balcons = $d['balcons'];
            $appart->garages = $d['garages'];
            $appart->terrasses = $d['terrasses'];
            $appart->chambreService = $d['chambreService'];
            $appart->parkingPrive = $d['parkingPrive'];
            $appart->greniers = $d['greniers'];
            $appart->celliers = $d['celliers'];
            $appart->id_adresse = $d['id_adresse'];
            $appart->id_type_appart = $d['id_type_appart'];
            $res[] = $appart;
        }
        return $res;
    }

    /**
     * Affichage d'un appartement.
     */
    function afficher() {
        echo "ID appartement : $this->id_appart <br/>"
        . "Surface : $this->surface "
        . "Nombre pièces : $this->nbPieces "
        . "Loyer : $this->loyer "
        . "Charges : $this->charges "
        . "Etat : $this->etat"
        . "Forcer visibilité : $this->forcerVisibiliteSite"
        . "Videophone : $this->videophone "
        . "Interphone : $this->interphone"
        . "Digicode : $this->digicode "
        . "Cable : $this->cable "
        . "AntenneTV : $this->antenneTV "
        . "Espace Vert : $this->espaceVert "
        . "VMC : $this->VMC"
        . "Piscine : $this->piscine "
        . "Parking Collectif : $this->parkingCollectif "
        . "Jardin privé : $this->jardinPrive"
        . "Ascenseur : $this->ascenseur "
        . "Loge gardien : $this->logeGardien "
        . "Vide Ordure : $this->videOrdure "
        . "Double vitrage : $this->doubleVitrage "
        . "Climatisation : $this->climatisation"
        . "Eau Chaude Collective : $this->eauChaudeCollective "
        . "Eau Froide Collective : $this->eauFroideCollective "
        . "Complément eau chaude : $this->cptEauChaude "
        . "Complément eau froide : $this->cptEauFroide "
        . "Chauffage : $this->chauffage "
        . "Classe Energie : $this->classeEnergie"
        . "Cuisine équipée : $this->cuisineEquipee "
        . "Branchement machines : $this->branchementMachineLaver"
        . "Evier : $this->evier "
        . "Caves : $this->caves "
        . "Balcons : $this->balcons "
        . "Garages : $this->garages "
        . "Terrasses : $this->terrasses "
        . "Chambre service : $this->chambreService "
        . "Parking privé : $this->parkingPrive "
        . "Greniers : $this->greniers "
        . "Celliers : $this->celliers "
        . "Id Type Appartement : $this->id_type_appart "
        . "Id Adresse : $this->id_adresse <br/>";
    }

}
