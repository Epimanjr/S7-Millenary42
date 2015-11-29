<?php

//TODO ici : classe appartement
class Appartement {

    // Tous les attributs de la classe appartement.

    /**
     * Identifiant de l'appartement.
     * @var type integer
     */
    private $id_appart;
    
    /**
     * Surface de l'appartement, en mètre carré.
     * @var type integer
     */
    private $surface;
    
    /**
     * Nombre de pièces.
     * @var type integer
     */
    private $nbPieces;
    
    /**
     * Montant du loyer, exprimé en €
     * @var type number
     */
    private $loyer;
    
    /**
     * Montant des charges, également exprimé en €
     * @var type number
     */
    private $charges;
    
    /**
     * Etat de l'appartement
     * @var type chaine
     */
    private $etat;
    
    /**
     * 
     * @var type boolean
     */
    private $forcerVisibiliteSite;
    
    /**
     * Présence ou non d'un videophone.
     * @var type boolean
     */
    private $videophone;
    
    /**
     * Présence ou non d'un interphone.
     * @var type boolean
     */
    private $interphone;
    
    /**
     * Présence ou non d'un digicole.
     * @var type boolean
     */
    private $digicode;
    
    /**
     * Présence ou non du câble.
     * @var type boolean
     */
    private $cable;
    
    /**
     * Présence ou non d'une antenne TV.
     * @var type boolean
     */
    private $antenneTV;
    
    /**
     * Présence ou non d'un espace vert.
     * @var type boolean
     */
    private $espaceVert;
    
    /**
     * Présence ou non d'un VMC
     * @var type boolean
     */
    private $VMC;
    
    /**
     * Présence ou non d'une piscine.
     * @var type boolean
     */
    private $piscine;
    
    /**
     * Présence ou non d'un parking collectif.
     * @var type boolean
     */
    private $parkingCollectif;
    
    /**
     * Présence ou non d'un jardin privé.
     * @var type boolean
     */
    private $jardinPrive;
    
    /**
     * Présence ou non d'un ascenseur.
     * @var type boolean
     */
    private $ascenseur;
    
    /**
     * Présence ou non d'une loge pour un gardien.
     * @var type boolean
     */
    private $logeGardien;
    
    /**
     * Présence ou non d'un vide ordure.
     * @var type boolean
     */
    private $videOrdure;
    
    /**
     * Double vitrage ? 
     * @var type boolean
     */
    private $doubleVitrage;
    
    /**
     * Appartement climatisé ?
     * @var type boolean
     */
    private $climatisation;
    
    /**
     * Eau chaude collective ?
     * @var type boolean
     */
    private $eauChaudeCollective;
    
    /**
     * Eau froide collective ?
     * @var type boolean
     */
    private $eauFroideCollective;
    
    /**
     * Complément d'eau chaude personnel ?
     * @var type boolean
     */
    private $cptEauChaude;
    
    /**
     * Complément d'eau froide personnel ?
     * @var type boolean
     */
    private $cptEauFroide;
    
    /**
     * L'appartement est-il chauffé ?
     * @var type boolean
     */
    private $chauffage;
    
    /**
     * Classe d'energie.
     * @var type char
     */
    private $classeEnergie;
    
    /**
     * L'appartement possède-t-il une cuisine équipée ?
     * @var type boolean
     */
    private $cuisineEquipee;
    
    /**
     *
     * @var type boolean
     */
    private $branchementMachineLaver;
    
    /**
     *
     * @var type boolean
     */
    private $evier;
    
    /**
     * Présence ou non d'une case.
     * @var type 
     */
    private $caves;
    
    /**
     * Présence ou non de balcons, et combien ?
     * @var type integer
     */
    private $balcons;
    
    /**
     * Combien de garages ?
     * @var type integer
     */
    private $garages;
    
    /**
     * Combien de terrasse ?
     * @var type integer
     */
    private $terrasses;
    
    /**
     *
     * @var type integer
     */
    private $chambreService;
    
    /**
     * Combien de parking privé ? (0 si absent)
     * @var type integer
     */
    private $parkingPrive;
    
    /**
     * Présence d'un grenier accessible ?
     * @var type boolean
     */
    private $greniers;
    
    /**
     *
     * @var type boolean
     */
    private $celliers;

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
        $query->bindParam(':nbPieces', $this->nbPieces, PDO::PARAM_STR);
        $query->bindParam(':loyer', $this->loyer, PDO::PARAM_STR);
        $query->bindParam(':charges', $this->charges, PDO::PARAM_STR);
        $query->bindParam(':etat', $this->etat, PDO::PARAM_STR);
        $query->bindParam(':forcerVisibiliteSite', $this->forcerVisibiliteSite, PDO::PARAM_STR);
        $query->bindParam(':videophone', $this->videophone, PDO::PARAM_STR);
        $query->bindParam(':interphone', $this->interphone, PDO::PARAM_STR);
        $query->bindParam(':digicode', $this->digicode, PDO::PARAM_STR);
        $query->bindParam(':antenneTV', $this->antenneTV, PDO::PARAM_STR);
        $query->bindParam(':espaceVert', $this->espaceVert, PDO::PARAM_STR);
        $query->bindParam(':VMC', $this->VMC, PDO::PARAM_STR);
        $query->bindParam(':piscine', $this->piscine, PDO::PARAM_STR);
        $query->bindParam(':parkingCollectif', $this->parkingCollectif, PDO::PARAM_STR);
        $query->bindParam(':jardinPrive', $this->jardinPrive, PDO::PARAM_STR);
        $query->bindParam(':ascenseur', $this->ascenseur, PDO::PARAM_STR);
        $query->bindParam(':logeGardien', $this->logeGardien, PDO::PARAM_STR);
        $query->bindParam(':videOrdure', $this->videOrdure, PDO::PARAM_STR);
        $query->bindParam(':doubleVitrage', $this->doubleVitrage, PDO::PARAM_STR);
        $query->bindParam(':climatisation', $this->climatisation, PDO::PARAM_STR);
        $query->bindParam(':eauChaudeCollective', $this->eauChaudeCollective, PDO::PARAM_STR);
        $query->bindParam(':eauFroideCollective', $this->eauFroideCollective, PDO::PARAM_STR);
        $query->bindParam(':cptEauChaude', $this->cptEauChaude, PDO::PARAM_STR);
        $query->bindParam(':cptEauFroide', $this->cptEauFroide, PDO::PARAM_STR);
        $query->bindParam(':chauffage', $this->chauffage, PDO::PARAM_STR);
        $query->bindParam(':classeEnergie', $this->classeEnergie, PDO::PARAM_STR);
        $query->bindParam(':cuisineEquipee', $this->cuisineEquipee, PDO::PARAM_STR);
        $query->bindParam(':branchementMachineLaver', $this->branchementMachineLaver, PDO::PARAM_STR);
        $query->bindParam(':evier', $this->evier, PDO::PARAM_STR);
        $query->bindParam(':caves', $this->caves, PDO::PARAM_STR);
        $query->bindParam(':balcons', $this->balcons, PDO::PARAM_STR);
        $query->bindParam(':garages', $this->garages, PDO::PARAM_STR);
        $query->bindParam(':terrasses', $this->terrasses, PDO::PARAM_STR);
        $query->bindParam(':chambreService', $this->chambreService, PDO::PARAM_STR);
        $query->bindParam(':parkingPrive', $this->parkingPrive, PDO::PARAM_STR);
        $query->bindParam(':greniers', $this->greniers, PDO::PARAM_STR);
        $query->bindParam(':celliers', $this->celliers, PDO::PARAM_STR);
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
        $query->bindParam(1, $this->nom, PDO::PARAM_STR);
        $query->bindParam(2, $this->duree, PDO::PARAM_STR);
        $query->bindParam(3, $this->id_appart, PDO::PARAM_INT);
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
}
