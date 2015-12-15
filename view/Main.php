<?php
class Main{
    public static function displayFront($nav,$content){
        return $nav.'       
            <div class="row">
                '
                    .$content.
                '
            </div>';
    }
    
    public static function displayNav($title1, $title2, $withConnectBtn){
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
            $rep.= '<a class="btn btn-default navbar-btn navbar-right" href="./?a=signin">Se connecter</a>';
        }
                
        $rep.='</div></nav>'.Main::displayTitle($title1, $title2);
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