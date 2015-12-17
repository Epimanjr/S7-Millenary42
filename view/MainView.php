<?php

class MainView {
    public static function displayFront($nav,$content){
        return $nav.'       
            <div class="row">
                '
                    .$content.
                '
            </div>';
    }
    
    public static function displayNav($title1, $title2, $withConnectBtn){
        if(!isset($_SESSION['email'])) {
            $rep = '<nav class="navbar navbar-default navbar-fixed-top">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">
                                    <span class="logo-brand">42</span>
                                </a>
                            </div>

                            <ul class="nav navbar-nav">
                                <li class="active"><a href="./"> Appartements<span class="sr-only">(current)</span></a></li>

                            </ul>';
            if($withConnectBtn == true){
                $rep.= '<a class="btn btn-default navbar-btn navbar-right" href="./?a=login">Se connecter / S\'inscrire</a>';
            }
        } else {
            $rep = '<nav class="navbar navbar-default navbar-fixed-top">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">
                                    <span class="logo-brand">42</span>
                                </a>
                            </div>

                            <ul class="nav navbar-nav">
                                <li class="active"><a href="index.html"> Appartements<span class="sr-only">(current)</span></a></li>

                            </ul>

                             <ul class="nav navbar-nav navbar-right">
                                <li><a href="contact-form.html"><span class="glyphicon glyphicon-envelope"></span> Nous contacter</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$_SESSION['prenom'].' '.$_SESSION['nom'].' ('.$_SESSION['email'].')<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="account.html">Informations de compte</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="../visiteur/index.html"><strong>Se déconnecter</strong></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>';
        }
                
        $rep.='</div></nav>'.MainView::displayTitle($title1, $title2);
        return $rep;
    }
    
    public static function displayTitle($title1, $title2){
        $rep = '<div class="row"><div class="col-sm-12 page-title">';
        
        if($title2 == null){
            $rep.='<h2>'.$title1.'</h2>';
        } else {
            $rep.= '<div class="col-sm-6 ">
                        <h2>'.$title1.'</h2>

                    </div>
                    <div class="col-sm-6 ">
                        <h2>'.$title2.'</h2>

                    </div>';
        }
        
        $rep.='</div></div>';
        
        return $rep;
    }
}
?>