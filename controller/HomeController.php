<?php

include_once 'Controller.php';
include_once 'view/MainView.php';
include_once 'view/AppartementView.php';
include_once 'view/LoginView.php';
include_once 'model/Database.php';
include_once 'model/Appartement.php';
include_once 'model/Option.php';
include_once 'model/Location.php';
include_once 'model/Paiement.php';
include_once 'model/Possession.php';

class HomeController extends Controller {

    private $MainView;
    private $nav;
    private $content;
    private $front;

    public function __construct() {
        // Création du tableau d'association
        // (à un contenu du GET, on associe une fonction à exécuter)
        $this->tab_action = array(
            'default' => 'defaultAction',
            'home' => 'defaultAction',
            'login' => 'loginAction',
            'search' => 'searchAction',
            'displayApp' => 'displayAppAction',
            'poserOption' => 'poserOptionAction',
            'displayUti' => 'displayUtiAction',
            'contactAgence' => 'contactAgenceAction',
            'displayLoc' => 'displayLocAction',
            'payerLoyer' => 'payerLoyerAction',
            'displayPos' => 'displayPosAction'
        );
    }

    public function begin() {
        $this->MainView = new MainView();
        $title = '<span class="glyphicon glyphicon-home"></span> Parcourir les appartements';
        $this->nav = $this->MainView->displayNav($title, null, true);
    }

    public function beginCustom($title1, $title2, $withconnection) {
        $this->MainView = new MainView();
        $this->nav = $this->MainView->displayNav($title1, $title2, $withconnection);
    }

    public function end() {
        $this->front = $this->MainView->displayFront($this->nav, $this->content);
        echo $this->front;
    }

    public function payerLoyerAction() {
        $paiement = new Paiement();
        $paiement->montant = $_GET['loyer'];
        $paiement->date = "2015-12-17";
        $paiement->mode = "enLigne";
        $paiement->type = "locataireVersAgence";
        $paiement->id_utilisateur = $_GET['id_utilisateur'];
        $paiement->id_location = $_GET['id_location'];
        $paiement->insert();
        // Redirection vers la page d'accueil
        header("Location: index.php?a=displayLoc");
    }

    public function displayLocAction() {
        // Création de la vue principale
        $this->beginCustom('<span class="glyphicon glyphicon-home"></span> Mes locations', null, true);

        // Création de la vue des appartements
        $AppartementView = new AppartementView();
        $locations = Location::findByIdUtilisateur($_SESSION['id_utilisateur']);
        $this->content = $AppartementView->generateMesLocations($locations);

        // Création et affichage de la vue globale
        $this->end();
    }

    public function displayPosAction() {
        // Création de la vue principale
        $this->beginCustom('<span class="glyphicon glyphicon-home"></span> Mes appartements', null, true);

        // Création de la vue des appartements
        $AppartementView = new AppartementView();
        $possessions = Possession::findByIdUtilisateur($_SESSION['id_utilisateur']);
        $this->content = $AppartementView->generateMesPossessions($possessions);

        // Création et affichage de la vue globale
        $this->end();
    }

    public function contactAgenceAction() {
        // Création de la vue principale
        $this->begin();

        // Création de la vue du login
        $LoginView = new LoginView();
        $this->content = $this->MainView->displayFormContactAgence();

        // Création et affichage de la vue globale
        $this->end();
    }

    public function displayUtiAction() {
        // Création de la vue principale
        $this->begin();

        // Création de la vue du login
        $LoginView = new LoginView();
        $this->content = $LoginView->displayUtilisateur();

        // Création et affichage de la vue globale
        $this->end();
    }

    public function poserOptionAction() {
        $option = new Option();
        $option->date = "2015-12-16";
        $option->etat = "enattente";
        $option->id_utilisateur = $_SESSION['id_utilisateur'];
        $option->id_appartement = $_GET['id_app'];
        $option->insert();
        // Redirection vers la page d'accueil
        header("Location: index.php?a=home");
    }

    public function defaultAction() {
        // Création de la vue principale
        $this->begin();

        // Création de la vue des appartements
        $AppartementView = new AppartementView();
        $this->content = $AppartementView->generateListDisplay(Appartement::findAll());

        // Création et affichage de la vue globale
        $this->end();
    }

    public function loginAction() {
        // Création de la vue principale
        $this->begin();

        // Création de la vue du login
        $LoginView = new LoginView();
        $this->content = $LoginView->displayContent();

        // Création et affichage de la vue globale
        $this->end();
    }

    public function searchAction() {
        // Création de la vue principale
        $this->begin();

        // Création de la vue des résultats de la recherche
        $ville = $_GET["ville"];
        $surface = $_GET["surface"];
        $loyer = $_GET["loyer"];
        
        $AppartementView = new AppartementView();
        $sql = "SELECT * FROM Appartement INNER JOIN Adresse ON Appartement.id_adresse=Adresse.id_adresse ";
        /*WHERE ville='" . $ville . "' AND surface " . $surface . " AND loyer" . $loyer;*/
        $clauseWhere = FALSE;
        $tout = "indifférent";
        // Clause WHERE pour la ville
        if($ville != $tout) {
            $sql .= " WHERE ville='$ville' ";
            $clauseWhere = TRUE;
        }
        if($surface != $tout) {
            if($clauseWhere) {
                $sql .= " AND surface $surface ";
            } else {
                $sql .= " WHERE surface $surface ";
            }
        }
        if($loyer != $tout) {
            if($clauseWhere) {
                $sql .= " AND loyer $loyer ";
            } else {
                $sql .= " WHERE loyer $loyer ";
            }
        }
        $this->content = $AppartementView->generateListDisplay(Appartement::find($sql));

        // Création et affichage de la vue globale
        $this->end();
    }

    public function displayAppAction() {
        // Création de la vue principale
        $this->begin();

        if (isset($_GET["id_app"])) {
            // Création de la vue détaillée de l'appartement
            $id_app = $_GET["id_app"];
            $AppartementView = new AppartementView();
            $this->content = $AppartementView->generateDetailDisplay(Appartement::findById($id_app));
        }

        // Création et affichage de la vue globale
        $this->end();
    }

}
