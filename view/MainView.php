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
                                <li class="active"><a href="./"> Appartements<span class="sr-only">(current)</span></a></li>

                            </ul>

                             <ul class="nav navbar-nav navbar-right">
                                <li><a href="./?a=contactAgence"><span class="glyphicon glyphicon-envelope"></span> Nous contacter</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$_SESSION['prenom'].' '.$_SESSION['nom'].' ('.$_SESSION['email'].')<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./?a=displayUti">Informations de compte</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="./?a=login""><strong>Se déconnecter</strong></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>';
        }
                
        $rep.='</div></nav>'.MainView::displayTitle($title1, $title2);
        return $rep;
    }
    
    public static function displayFormContactAgence() {
        return '<div class="row">
                    <div class="col-sm-12 page-title">
                        <h2><span class="glyphicon glyphicon-envelope"></span> Nous contacter</h2>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12 page-content">

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="contact-objet">Objet</label>
                                <div class="col-sm-7">
                                    <input id="contact-object" type="text" class="form-control" placeholder="Objet">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="contact-message">Message</label>
                                <div class="col-sm-7">
                                    <textarea id="contact-message" class="form-control" rows="5" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-offset-2 col-sm-9">
                                <a class="btn btn-default pull-right"><span class="glyphicon glyphicon-send"></span> Envoyer</a>
                            </div>
                        </form>


                    </div>
                </div>';
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