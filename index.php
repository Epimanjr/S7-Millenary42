<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="M1 MIAGE - Groupe A" />
        <link rel="icon" href="images/favicon.ico">
        <title>Millenary 42</title>
        <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0, charset=utf-8">
        <link rel="stylesheet" href="lib/bootstrap-3.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="mockup/css/details_appart.css" />
        <link rel="stylesheet" href="mockup/css/nav.css" />
        <link rel="stylesheet" href="mockup/css/index.css" />
        <link rel="stylesheet" href="mockup/css/signin.css" />
    </head>
    <body>
        <div class="container-fluid">
            
            <?php
            include_once 'controller/HomeController.php';

            // Ce sera utile quand on arrivera à la partie inscription/connexion
            session_start();

            // Création du contrôleur principal
            $HomeController = new HomeController();

            // Si une action est définie dans l'URL grâce à un GET
            if (isset($_GET['a'])) {
                $HomeController->callAction($_GET);
            } else {
                $HomeController->callAction("default");
            }
            ?>

        </div>
        <script src="lib/jquery-1.11.3.min.js"></script>
        <script src="lib/bootstrap-3.3/js/bootstrap.min.js"></script>
    </body>
</html>