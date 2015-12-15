<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controleur
 *
 * @author Guillaume
 */

include_once './controller/AppartementControleur.php';

class Controleur {
    
    private $ac;
    
    public function __construct() {
        $this->ac = new AppartementControleur();
    }

    private function afficheListeAppartement(){
        return $ac->displayList();
    }
    
    public function callAction($action) {
        
        $tabAction = array(
            'list' => 'afficheListeAppartement',
            'detail' => 'detailAction',
            'cat' => 'catAction',
            'title' => 'titreAction');

        //si le tableau des actions contient plus d'un élément
        if (count($action) == 2)
            $rep = $this->$tabAction[$action['a']]($action['id']);
        else
            $rep = $this->$tabAction[$action['a']]();

        return $rep;
    }

}
