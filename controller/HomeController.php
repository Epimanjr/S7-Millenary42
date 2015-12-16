<?php

include_once 'Controller.php';
include_once 'view/MainView.php';
include_once 'view/AppartementView.php';
include_once 'view/LoginView.php';
include_once 'model/Database.php';
include_once 'model/Appartement.php';

class HomeController extends Controller {

    public function __construct() {
        // Création du tableau d'association
        // (à un contenu du GET, on associe une fonction à exécuter)
        $this->tab_action = array(
            'default' => 'defaultAction',
            'home' => 'defaultAction',
            'login' => 'loginAction',
            'search' => 'searchAction',
        );
    }

    public function defaultAction() {
        // Création de la vue principale
        $MainView = new MainView();
        $title = '<span class="glyphicon glyphicon-home"></span> Parcourir les appartements';
        $nav = $MainView->displayNav($title, null, true);
        
        // Création de la vue des appartements
        $AppartementView = new AppartementView();
        $content = $AppartementView->generateListDisplay(Appartement::findAll());
        
        // Création de la vue globale
        $front = $MainView->displayFront($nav, $content);
        
        // Affichage final
        echo $front;
    }
    
    public function loginAction() {
        // Création de la vue principale
        $MainView = new MainView();
        $title = '<span class="glyphicon glyphicon-home"></span> Parcourir les appartements';
        $nav = $MainView->displayNav($title, null, true);
        
        // Création de la vue du login
        $LoginView = new LoginView();
        $content = $LoginView->displayContent();
        
        // Création de la vue globale
        $front = $MainView->displayFront($nav, $content);
        
        // Affichage final
        echo $front;
    }

    public function searchAction() {
        // Création de la vue principale
        $MainView = new MainView();
        $title = '<span class="glyphicon glyphicon-home"></span> Parcourir les appartements';
        $nav = $MainView->displayNav($title, null, true);
        
        // Création de la vue des résultats de la recherche
        /* TO DO (début d'idée ci-après)
        $criteres_recherche = array();
        if (isset($_GET["ville"])) {
            $criteres_recherche = array(
                                    ville => $_GET["ville"],
                                    surface => $_GET["surace"]
                                  );
        }
        $AppartementView = new AppartementView();
        $content = $AppartementView->generateListDisplay(Appartement::find("Requête SQL à écrire ici"));
        */
        
        // Création de la vue globale
        $front = $MainView->displayFront($nav, $content);
        
        // Affichage final
        echo $front;
    }

}
