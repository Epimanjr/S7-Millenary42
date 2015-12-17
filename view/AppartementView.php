<?php

/**
 * Description of AppartementView
 *
 * @author Guillaume
 */
class AppartementView {
    
    /**
     * Génère les filtres pour la liste d'appartements
     * @return string
     */
    public static function generateFilters(){
        return '  <div class="col-sm-1 filters" >

                            <form>

                                <div class="form-group">
                                    <label for="filter-town">Ville</label>
                                    <select id="filter-town" class="form-control">
                                        <option>Nancy</option>
                                        <option>Metz</option>
                                        <option>Strasbourg</option>
                                        <option>Bordeaux</option>
                                        <option>Lille</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="filter-surface">Surface</label>
                                    <select id="filter-surface" class="form-control">
                                        <option>< 30m²</option>
                                        <option>de 30m² à 70m²</option>
                                        <option>> 70m²</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="filter-rent">Loyer</label>
                                    <select id="filter-rent" class="form-control">
                                        <option>< 300$</option>
                                        <option>de 300$ à 500$</option>
                                        <option>de 500$ à 700$</option>
                                        <option>> 700$</option>
                                    </select>
                                </div>


                                <div class="checkbox" >
                                    <label>
                                        <input type="checkbox" id="filter-type-flat" value="option1"> Appartement
                                    </label>
                                </div>
                                <div class="checkbox" >
                                    <label>
                                        <input type="checkbox" id="filter-type-furniture" value="option2"> Meublé mixte
                                    </label>
                                </div>
                                <div class="checkbox" >
                                    <label>
                                        <input type="checkbox" id="filter-type-holidays" value="option3"> Meublé vacances
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Rechercher</button>
                            </form>
                        </div>';
    }
    
    /**
     * Génère l'affichage type 'liste' pour un appartement unique
     * @param type $appart
     */
    public static function generateUniqueListDispay($appart) {
        $rep = '<div class="col-sm-3">
                    <div class="thumbnail">
                        <div style="background-image: url(http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg)">

                        </div>
                    <img src="http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg" />
                                    <div class="caption">
                                        <h3>Appartement<br><small>'.$appart->id_adresse.'</small></h3>

                                        <h4>Caractéristiques</h4>
                                        <table class="table table-hover">
                                            <tr>
                                                <td>
                                                    Surface
                                                </td>
                                                <td>
                                                    '.$appart->surface.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Loyer
                                                </td>
                                                <td>
                                                    '.$appart->loyer.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Type
                                                </td>
                                                <td>
                                                    '.$appart->id_type_appart.'
                                                </td>
                                            </tr>
                                        </table>
                                        <p>
                                            <span class="pull-right"></span>
                                            <a href="./?a=displayApp&id_app=' . $appart->id_appart . '" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-list-alt"></span> Détails</a>';
        if(isset($_SESSION['email'])) {
            $option = Option::findByIdUtilisateurAndIdAppartement($_SESSION['id_utilisateur'], $appart->id_appart);
            if($option->id_option!="") {
                $rep .= '                   <a class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-check"></span> Option posée</a>';
            } else {
                $rep .= '                   <a href="./?a=poserOption&id_app=' . $appart->id_appart . '" class="btn btn-warning pull-right" role="button"><span class="glyphicon glyphicon-check"></span> Poser une option</a>';
            }
        }                                
        $rep .= '                       </p>
                                    </div>
                                </div>
                            </div> ';
        return $rep;
    }
    
    public static function generateUniqueLocation($location) {
        $appart = Appartement::findById($location->id_appartement);
        $rep = '<div class="col-sm-3">
                    <div class="thumbnail">
                        <div style="background-image: url(http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg)">

                        </div>
                    <img src="http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg" />
                                    <div class="caption">
                                        <h3>Appartement<br><small>'.$appart->id_adresse.'</small></h3>

                                        <h4>Caractéristiques</h4>
                                        <table class="table table-hover">
                                            <tr>
                                                <td>
                                                    Surface
                                                </td>
                                                <td>
                                                    '.$appart->surface.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Loyer
                                                </td>
                                                <td>
                                                    '.$appart->loyer.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Type
                                                </td>
                                                <td>
                                                    '.$appart->id_type_appart.'
                                                </td>
                                            </tr>
                                        </table>
                                        <p>
                                            <span class="pull-right"></span>
                                            <a href="./?a=displayApp&id_app=' . $appart->id_appart . '" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-list-alt"></span> Détails</a>';
        if(isset($_SESSION['email'])) {
            //$location = location::findByIdUtilisateurAndIdAppartement($_SESSION['id_utilisateur'], $appart->id_appart);
            if($location->id_location!="") {
                $rep .= '                   <a href="./?a=payerLoyer&id_location=' . $location->id_location . '&id_utilisateur=' . $location->id_utilisateur . '&loyer=' . $appart->loyer . '" class="btn btn-danger pull-right" role="button"><span class="glyphicon glyphicon-euro"></span> Payer mon loyer ('.$appart->loyer.'€)</a>';
            }
        }                                
        $rep .= '                       </p>
                                    </div>
                                </div>
                            </div> ';
        return $rep;
    }
    
    public static function generateUniquePossession($possession) {
        $appart = Appartement::findById($possession->id_appartement);
        $rep = '<div class="col-sm-3">
                    <div class="thumbnail">
                        <div style="background-image: url(http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg)">

                        </div>
                    <img src="http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg" />
                                    <div class="caption">
                                        <h3>Appartement<br><small>'.$appart->id_adresse.'</small></h3>

                                        <h4>Caractéristiques</h4>
                                        <table class="table table-hover">
                                            <tr>
                                                <td>
                                                    Surface
                                                </td>
                                                <td>
                                                    '.$appart->surface.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Loyer
                                                </td>
                                                <td>
                                                    '.$appart->loyer.'
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Type
                                                </td>
                                                <td>
                                                    '.$appart->id_type_appart.'
                                                </td>
                                            </tr>
                                        </table>
                                        <p>
                                            <span class="pull-right"></span>
                                            <a href="./?a=displayApp&id_app=' . $appart->id_appart . '" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-list-alt"></span> Détails</a>';
        if(isset($_SESSION['email'])) {
            //$location = location::findByIdUtilisateurAndIdAppartement($_SESSION['id_utilisateur'], $appart->id_appart);
            if($possession->id_possession!="") {
                $rep .= '                   <a class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-check"></span> Appartement loué</a>';
            }
        }                                
        $rep .= '                       </p>
                                    </div>
                                </div>
                            </div> ';
        return $rep;
    }
    
    /**
     * Génère l'affichage type 'liste' pour tous les appartements d'une liste
     * @param type $list
     */
    public static function generateListDisplay($list){
        $filters = AppartementView::generateFilters();
        
        $rep = '<div class="col-sm-12 page-content"><div class="col-sm-12">';
        $rep .= $filters;
        $rep .= '<div class="col-sm-10 col-sm-offset-2">';
        
        foreach ($list as $flat) {
            $rep .= AppartementView::generateUniqueListDispay($flat);
        }
        
        $rep .= '</div></div>';
        
        return $rep;
    }
    
    public static function generateMesLocations($list){

        $rep = '<div class="col-sm-12 page-content"><div class="col-sm-12">';
        //$rep .= $filters;
        $rep .= '<div class="col-sm-12">';
        
        foreach ($list as $flat) {
            $rep .= AppartementView::generateUniqueLocation($flat);
        }
        
        $rep .= '</div></div>';
        
        return $rep;
    }
    
    public static function generateMesPossessions($list){

        $rep = '<div class="col-sm-12 page-content"><div class="col-sm-12">';
        //$rep .= $filters;
        $rep .= '<div class="col-sm-12">';
        
        foreach ($list as $flat) {
            $rep .= AppartementView::generateUniquePossession($flat);
        }
        
        $rep .= '</div></div>';
        
        return $rep;
    }
    
    /**
     * Affiche le détail d'un appartement
     * @param type $appart
     * @return string
     */
    public static function generateDetailDisplay($appart) {
        $rep = "";
        
        /*
         * TO DO
         * Remplacer le contenu d'exemple par les valeurs dans $appart (et sur la base)
         * Par exemple, surface et loyer sont déjà faits ! Il suffit de s'en inspirer ;)
         */
        
        $rep .= '<div class="col-sm-12 page-content">

                    <div class="col-sm-5" style="position: fixed;">
                        <img class="appart-photo" src="http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg"  />
                        <h4><strong>Adresse : </strong></h4>
                        <p>
                            quartier Faubourg des trois maisons<br>
                            42 rue générique, 54000 Nancy<br>
                            3ème étage, appartement 14
                        </p>
                        <p>
                            <strong>Type</strong> : Meublé vacances
                        </p>
                    </div>
                    <div class="col-sm-offset-5 col-sm-7">

                        <table class="table">
                            <tr>
                                <td>Surface</td>
                                <td>' . $appart->surface . ' m²</td>
                            </tr>
                            <tr>
                                <td>Nombre de pièces</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Loyer</td>
                                <td>' . $appart-> loyer . ' €</td>
                            </tr>
                            <tr>
                                <td>Charges</td>
                                <td>Comprises</td>
                            </tr>
                            <tr>
                                <td>Etat</td>
                                <td> ??</td>
                            </tr> 
                            <tr>
                                <td>Vidéophone</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Interphone</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Digicode</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Cable</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Antenne TV</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Espace Vert</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>VMC</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Piscine</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Parking Collectif</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Jardin Privé</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Ascenceur</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Loge Gardien</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Vide Ordure</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Double Vitrage</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Climatisation</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Eau chaude collective</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Eau froide collective</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Complément eau chaude</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Complément eau froide</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Chauffage</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Classe Energie</td>
                                <td>B</td>
                            </tr>
                            <tr>
                                <td>Cuisine Equipée</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Branchement machine à laver</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Evier</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Caves</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Balcon</td>
                                <td><span class="label label-success">Oui</span></td>
                            </tr>
                            <tr>
                                <td>Garages</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Terrasses</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Chambre de service</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Parking privé</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Greniers</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                            <tr>
                                <td>Celliers</td>
                                <td><span class="label label-danger">Non</span></td>
                            </tr>
                        </table>
                    </div>

                </div>';
        
        return $rep;
    }
    
    
    

}
