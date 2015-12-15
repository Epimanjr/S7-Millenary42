<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Millenary 42</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lib/bootstrap-3.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="mockup/css/details_appart.css" />
        <link rel="stylesheet" href="mockup/css/nav.css" />
        <link rel="stylesheet" href="mockup/css/index.css" />
        <link rel="stylesheet" href="mockup/css/signin.css" />
    </head>
    <body>
        <div class="container-fluid">
        <?php
        include_once 'view/Main.php';
        include_once 'view/Connexion.php';
        include_once 'view/ListeAppartement.php';
        
        if(count($_GET) > 0){
            if($_GET['l'] == 'signin'){
                echo Main::displayFront(Main::displayNav('Se connecter', 'S\'inscrire',false),  Connexion::displayContent());
            }
        }
        else {
            echo Main::displayFront(Main::displayNav('<span class="glyphicon glyphicon-home"></span> Parcourir les appartements',null,true), ListeAppartement::displayContent());
        }
        ?>
        
        </div>
        <script src="lib/jquery-1.11.3.min.js"></script>
        <script src="lib/bootstrap-3.3/js/bootstrap.min.js"></script>
    </body>
</html>
