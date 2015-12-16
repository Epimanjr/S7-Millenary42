<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appartement
 *
 * @author Guillaume
 */
include_once './model/Appartement.php';
include_once './view/AppartementVue.php';

class AppartementControleur {
    
    public function __construct() {
        
    }
    
    /**
     * Affiche la liste des appartements, sans filtres
     * @param type $tab
     * @return type
     */
    public function displayList(){
        $list = array();
        foreach(Appartement::findAll() as $flat){
            $appart = new Appartement();
            //ajouter attributs
            
            $list[] = $appart;
        }
        
        $rep = AppartementVue::generateListDisplay($list);
        
        return $rep;
    }
    
    /**
     * Affiche un appartement en détails
     * @param type $id
     */
    public function displatFlat($id){
        
    }
}
