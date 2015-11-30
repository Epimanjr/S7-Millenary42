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
    private $forcerVisibiliteSite = false;

    /**
     * Présence ou non d'un videophone.
     * @var boolean
     */
    private $videophone = false;

    /**
     * Présence ou non d'un interphone.
     * @var boolean
     */
    private $interphone = false;

    /**
     * Présence ou non d'un digicole.
     * @var boolean
     */
    private $digicode = false;

    /**
     * Présence ou non du câble.
     * @var boolean
     */
    private $cable = false;

    /**
     * Présence ou non d'une antenne TV.
     * @var boolean
     */
    private $antenneTV = false;

    /**
     * Présence ou non d'un espace vert.
     * @var boolean
     */
    private $espaceVert = false;

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
    private $parkingCollectif = false;

    /**
     * Présence ou non d'un jardin privé.
     * @var boolean
     */
    private $jardinPrive = false;

    /**
     * Présence ou non d'un ascenseur.
     * @var boolean
     */
    private $ascenseur = false;

    /**
     * Présence ou non d'une loge pour un gardien.
     * @var boolean
     */
    private $logeGardien = false;

    /**
     * Présence ou non d'un vide ordure.
     * @var boolean
     */
    private $videOrdure = false;

    /**
     * Double vitrage ? 
     * @var boolean
     */
    private $doubleVitrage = false;

    /**
     * Appartement climatisé ?
     * @var boolean
     */
    private $climatisation = false;

    /**
     * Eau chaude collective ?
     * @var boolean
     */
    private $eauChaudeCollective = false;

    /**
     * Eau froide collective ?
     * @var boolean
     */
    private $eauFroideCollective = false;

    /**
     * Complément d'eau chaude personnel ?
     * @var boolean
     */
    private $cptEauChaude = false;

    /**
     * Complément d'eau froide personnel ?
     * @var boolean
     */
    private $cptEauFroide = false;

    /**
     * L'appartement est-il chauffé ?
     * @var String
     */
    private $chauffage;

    /**
     * Classe d'energie.
     * @var char
     */
    private $classeEnergie = false;

    /**
     * L'appartement possède-t-il une cuisine équipée ?
     * @var boolean
     */
    private $cuisineEquipee = false;

    /**
     *
     * @var boolean
     */
    private $branchementMachineLaver = false;

    /**
     *
     * @var integer
     */
    private $evier = 0;

    /**
     * Présence ou non d'une case.
     * @var boolean 
     */
    private $caves = false;

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
    private $greniers = false;

    /**
     *
     * @var boolean
     */
    private $celliers = false;

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
        $query = $c->prepare("INSERT INTO appartement (surface, nbPieces, loyer, charges, etat, forcerVisibiliteSite, videophone, interphone, digicode, cable, antenneTV, espaceVert, VMC, piscine, parkingCollectif, jardinPrive, ascenseur, logeGardien, videOrdure, doubleVitrage, climatisation, eauChaudeCollective, eauFroideCollective, cptEauChaude, cptEauFroide, chauffage, classeEnergie, cuisineEquipee, branchementMachineLaver, evier, caves, balcons, garages, terrasses, chambreService, parkingPrive, greniers, celliers) VALUES (:surface, :nbPieces, :loyer, :charges, :etat, :forcerVisibiliteSite, :videophone, :interphone, :digicode, :cable, :antenneTV, :espaceVert, :VMC, :piscine, :parkingCollectif, :jardinPrive, :ascenseur, :logeGardien, :videOrdure, :doubleVitrage, :climatisation, :eauChaudeCollective, :eauFroideCollective, :cptEauChaude, :cptEauFroide, :chauffage, :classeEnergie, :cuisineEquipee, :branchementMachineLaver, :evier, :caves, :balcons, :garages, :terrasses, :chambreService, :parkingPrive, :greniers, :celliers)");
        $query->bindParam(':surface', $this->surface, PDO::PARAM_INT);
        $query->bindParam(':nbPieces', $this->nbPieces, PDO::PARAM_INT);
        $query->bindParam(':loyer', $this->loyer, PDO::PARAM_LOB);
        $query->bindParam(':charges', $this->charges, PDO::PARAM_LOB);
        $query->bindParam(':etat', $this->etat, PDO::PARAM_STR);
        $query->bindParam(':forcerVisibiliteSite', $this->forcerVisibiliteSite, PDO::PARAM_BOOL);
        $query->bindParam(':videophone', $this->videophone, PDO::PARAM_BOOL);
        $query->bindParam(':interphone', $this->interphone, PDO::PARAM_BOOL);
        $query->bindParam(':digicode', $this->digicode, PDO::PARAM_BOOL);
        $query->bindParam(':antenneTV', $this->antenneTV, PDO::PARAM_BOOL);
        $query->bindParam(':espaceVert', $this->espaceVert, PDO::PARAM_BOOL);
        $query->bindParam(':VMC', $this->VMC, PDO::PARAM_INT);
        $query->bindParam(':piscine', $this->piscine, PDO::PARAM_INT);
        $query->bindParam(':parkingCollectif', $this->parkingCollectif, PDO::PARAM_BOOL);
        $query->bindParam(':jardinPrive', $this->jardinPrive, PDO::PARAM_BOOL);
        $query->bindParam(':ascenseur', $this->ascenseur, PDO::PARAM_BOOL);
        $query->bindParam(':logeGardien', $this->logeGardien, PDO::PARAM_BOOL);
        $query->bindParam(':videOrdure', $this->videOrdure, PDO::PARAM_BOOL);
        $query->bindParam(':doubleVitrage', $this->doubleVitrage, PDO::PARAM_BOOL);
        $query->bindParam(':climatisation', $this->climatisation, PDO::PARAM_BOOL);
        $query->bindParam(':eauChaudeCollective', $this->eauChaudeCollective, PDO::PARAM_BOOL);
        $query->bindParam(':eauFroideCollective', $this->eauFroideCollective, PDO::PARAM_BOOL);
        $query->bindParam(':cptEauChaude', $this->cptEauChaude, PDO::PARAM_BOOL);
        $query->bindParam(':cptEauFroide', $this->cptEauFroide, PDO::PARAM_BOOL);
        $query->bindParam(':chauffage', $this->chauffage, PDO::PARAM_STR);
        $query->bindParam(':classeEnergie', $this->classeEnergie, PDO::PARAM_STR);
        $query->bindParam(':cuisineEquipee', $this->cuisineEquipee, PDO::PARAM_BOOL);
        $query->bindParam(':branchementMachineLaver', $this->branchementMachineLaver, PDO::PARAM_BOOL);
        $query->bindParam(':evier', $this->evier, PDO::PARAM_INT);
        $query->bindParam(':caves', $this->caves, PDO::PARAM_BOOL);
        $query->bindParam(':balcons', $this->balcons, PDO::PARAM_INT);
        $query->bindParam(':garages', $this->garages, PDO::PARAM_INT);
        $query->bindParam(':terrasses', $this->terrasses, PDO::PARAM_INT);
        $query->bindParam(':chambreService', $this->chambreService, PDO::PARAM_INT);
        $query->bindParam(':parkingPrive', $this->parkingPrive, PDO::PARAM_BOOL);
        $query->bindParam(':greniers', $this->greniers, PDO::PARAM_BOOL);
        $query->bindParam(':celliers', $this->celliers, PDO::PARAM_BOOL);
        /* Exécution de la requête */
        $query->execute();
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
        $query = $c->prepare("update appartement set surface= ?, nbPieces= ?, loyer= ?, charges= ?, etat= ?, forcerVisibiliteSite= ?, videophone= ?, interphone= ?, digicode= ?, cable= ?, antenneTV= ?, espaceVert= ?, VMC= ?, piscine= ?, parkingCollectif= ?, jardinPrive= ?, ascenseur= ?, logeGardien= ?, videOrdure= ?, doubleVitrage= ?, climatisation= ?, eauChaudeCollective= ?, eauFroideCollective= ?, cptEauChaude= ?, cptEauFroide= ?, chauffage= ?, classeEnergie= ?, cuisineEquipee= ?, branchementMachineLaver= ?, evier= ?, caves= ?, balcons= ?, garages= ?, terrasses= ?, chambreService= ?, parkingPrive= ?, greniers= ?, celliers= ? where id_appart=?");
        $query->bindParam(1, $this->surface, PDO::PARAM_INT);
        $query->bindParam(2, $this->nbPieces, PDO::PARAM_INT);
        $query->bindParam(3, $this->loyer, PDO::PARAM_LOB);
        $query->bindParam(4, $this->charges, PDO::PARAM_LOB);
        $query->bindParam(5, $this->etat, PDO::PARAM_STR);
        $query->bindParam(6, $this->forcerVisibiliteSite, PDO::PARAM_BOOL);
        $query->bindParam(7, $this->videophone, PDO::PARAM_BOOL);
        $query->bindParam(8, $this->interphone, PDO::PARAM_BOOL);
        $query->bindParam(9, $this->digicode, PDO::PARAM_BOOL);
        $query->bindParam(10, $this->antenneTV, PDO::PARAM_BOOL);
        $query->bindParam(11, $this->espaceVert, PDO::PARAM_BOOL);
        $query->bindParam(12, $this->VMC, PDO::PARAM_INT);
        $query->bindParam(13, $this->piscine, PDO::PARAM_INT);
        $query->bindParam(14, $this->parkingCollectif, PDO::PARAM_BOOL);
        $query->bindParam(15, $this->jardinPrive, PDO::PARAM_BOOL);
        $query->bindParam(16, $this->ascenseur, PDO::PARAM_BOOL);
        $query->bindParam(17, $this->logeGardien, PDO::PARAM_BOOL);
        $query->bindParam(18, $this->videOrdure, PDO::PARAM_BOOL);
        $query->bindParam(19, $this->doubleVitrage, PDO::PARAM_BOOL);
        $query->bindParam(20, $this->climatisation, PDO::PARAM_BOOL);
        $query->bindParam(21, $this->eauChaudeCollective, PDO::PARAM_BOOL);
        $query->bindParam(22, $this->eauFroideCollective, PDO::PARAM_BOOL);
        $query->bindParam(23, $this->cptEauChaude, PDO::PARAM_BOOL);
        $query->bindParam(24, $this->cptEauFroide, PDO::PARAM_BOOL);
        $query->bindParam(25, $this->chauffage, PDO::PARAM_STR);
        $query->bindParam(26, $this->classeEnergie, PDO::PARAM_STR);
        $query->bindParam(27, $this->cuisineEquipee, PDO::PARAM_BOOL);
        $query->bindParam(28, $this->branchementMachineLaver, PDO::PARAM_BOOL);
        $query->bindParam(29, $this->evier, PDO::PARAM_INT);
        $query->bindParam(30, $this->caves, PDO::PARAM_BOOL);
        $query->bindParam(31, $this->balcons, PDO::PARAM_INT);
        $query->bindParam(32, $this->garages, PDO::PARAM_INT);
        $query->bindParam(33, $this->terrasses, PDO::PARAM_INT);
        $query->bindParam(34, $this->chambreService, PDO::PARAM_INT);
        $query->bindParam(35, $this->parkingPrive, PDO::PARAM_BOOL);
        $query->bindParam(36, $this->greniers, PDO::PARAM_BOOL);
        $query->bindParam(37, $this->celliers, PDO::PARAM_BOOL);
        $query->bindParam(38, $this->id_appart, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
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
        $query = $c->prepare("DELETE FROM appartement where id_appart=?");
        $query->bindParam(1, $this->id_appart, PDO::PARAM_INT);
        /* Exécution de la requête */
        return $query->execute();
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
        $query = $c->prepare("select * from appartement where id_appart=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        /* Exécution de la requête */
        $query->execute();
        /* Récupération du résultat */
        $d = $query->fetch(PDO::FETCH_BOTH);
        /* Création d'un Objet */
        $appart = new Appartement();
        $appart->id_appart = $d['id_appart'];
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
        $query = $c->prepare("select * from appartement");
        /* Exécution de la requête */
        $query->execute();
        /* Parcours du résultat */
        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $appart = new Appartement();
            $appart->id_appart = $d['id_appart'];
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
            $res[] = $appart;
        }
        return $res;
    }

    /**
     * Affichage d'un appartement.
     */
    function afficher() {
        echo "ID appartement : $this->id_appart"
        . "Surface : $this->surface <br/>"
        . "Nombre pièces : $this->nbPieces <br/>"
        . "Loyer : $this->loyer <br/>"
        . "Charges : $this->charges <br/>"
        . "Etat : $this->etat <br/>"
        . "Forcer visibilité : $this->forcerVisibiliteSite <br/>"
        . "Videophone : $this->videophone <br/>"
        . "Interphone : $this->interphone <br/>"
        . "Digicode : $this->digicode <br/>"
        . "Cable : $this->cable <br/>"
        . "AntenneTV : $this->antenneTV <br/>"
        . "Espace Vert : $this->espaceVert <br/>"
        . "VMC : $this->VMC <br/>"
        . "Piscine : $this->piscine <br/>"
        . "Parking Collectif : $this->parkingCollectif <br/>"
        . "Jardin privé : $this->jardinPrive <br/>"
        . "Ascenseur : $this->ascenseur <br/>"
        . "Loge gardien : $this->logeGardien <br/>"
        . "Vide Ordure : $this->videOrdure <br/>"
        . "Double vitrage : $this->doubleVitrage <br/>"
        . "Climatisation : $this->climatisation <br/>"
        . "Eau Chaude Collective : $this->eauChaudeCollective <br/>"
        . "Eau Froide Collective : $this->eauFroideCollective <br/>"
        . "Complément eau chaude : $this->cptEauChaude <br/>"
        . "Complément eau froide : $this->cptEauFroide <br/>"
        . "Chauffage : $this->chauffage <br/>"
        . "Classe Energie : $this->classeEnergie <br/>"
        . "Cuisine équipée : $this->cuisineEquipee <br/>"
        . "Branchement machines : $this->branchementMachineLaver <br/>"
        . "Evier : $this->evier <br/>"
        . "Caves : $this->caves <br/>"
        . "Balcons : $this->balcons <br/>"
        . "Garages : $this->garages <br/>"
        . "Terrasses : $this->terrasses <br/>"
        . "Chambre service : $this->chambreService <br/>"
        . "Parking privé : $this->parkingPrive <br/>"
        . "Greniers : $this->greniers <br/>"
        . "Celliers : $this->celliers <br/>";
    }

}
