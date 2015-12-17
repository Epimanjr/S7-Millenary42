<?php

include_once 'model/TypeAppartement.php';
include_once 'model/Adresse.php';

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
        $villeGet = "indifférent";
        $surfaceGet = "indifférent";
        $loyerGet = "indifférent";
        if(isset($_GET['ville'])) {
            $villeGet = $_GET["ville"];
            $surfaceGet = $_GET["surface"];
            $loyerGet = $_GET["loyer"];
        }
        
        $res= '  <div class="col-sm-1 filters" >

                            <form method="GET" action="./index.php">
                                <input name="a" type=hidden value="search"/>
                                <div class="form-group">
                                    <label for="filter-town">Ville</label>
                                    <select name="ville" id="filter-town" class="form-control">';
        $villes = Adresse::findVilles();
        $res .= '<option>indifférent</option>';
        foreach ($villes as $ville) {
            if($ville==$villeGet) {
                $res .= '<option selected>' . $ville . '</option>';
            } else {
                $res .= '<option>' . $ville . '</option>';
            }
            
        }                                
                                        $res .= '
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="filter-surface">Surface (m²)</label>
                                    <select name="surface" id="filter-surface" class="form-control">';
                                        $surfaces = AppartementView::generateFiltersSurface();
                                        foreach ($surfaces as $s) {
                                            if($s==$surfaceGet) {
                                                $res .= '<option selected>' . $s . '</option>';
                                            } else {
                                                $res .= '<option>' . $s . '</option>';
                                            }
                                        }
                                    $res .= '</select>
                                </div>
                                <div class="form-group">
                                    <label for="filter-rent">Loyer (€)</label>
                                    <select name="loyer" id="filter-rent" class="form-control">';
                                        $rents = AppartementView::generateFiltersRent();
                                            foreach ($rents as $r) {
                                                if($r==$loyerGet) {
                                                    $res .= '<option selected>' . $r . '</option>';
                                                } else {
                                                    $res .= '<option>' . $r . '</option>';
                                                }
                                            }
                                    $res .= '</select>
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
        return $res;
    }
    
    public static function generateFiltersRent() {
        $array = array();
        $array[] = "indifférent";
        $array[] = "< 300";
        $array[] = "< 500";
        $array[] = "< 1000";
        $array[] = "< 2000";
        $array[] = "> 2000";
        return $array;
    }
    
    public static function generateFiltersSurface() {
        $array = array();
        $array[] = "indifférent";
        $array[] = "< 40";
        $array[] = "< 80";
        $array[] = "< 120";
        $array[] = "< 160";
        $array[] = "< 200";
        $array[] = "> 200";
        return $array;
    }
    
    /**
     * Génère l'affichage type 'liste' pour un appartement unique
     * @param type $appart
     */
    public static function generateUniqueListDispay($appart) {
        $adresse = Adresse::findById($appart->id_adresse);
        $rep = '<div class="col-sm-3">
                    <div class="thumbnail">
                        <div style="background-image: url(http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg)">

                        </div>
                    <img src="http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg" />
                                    <div class="caption">
                                        <h3>Appartement<br><small>Quartier '. $adresse->quartier . ' ' . $adresse->ville . ' (' . $adresse->codePostal .')</small></h3>

                                        <h4>Caractéristiques</h4>
                                        <table class="table table-hover">
                                            <tr>
                                                <td>
                                                    Surface
                                                </td>
                                                <td>
                                                    '.$appart->surface.' m²
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Loyer
                                                </td>
                                                <td>
                                                    '.$appart->loyer.' €
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Type
                                                </td>
                                                <td>
                                                    '. TypeAppartement::findById($appart->id_type_appart)->nom .'
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
    
    public static function bitToOuiNon($bit) {
        if($bit==1) {
            return '<span class="label label-success">Oui</span>';
        } else {
            return '<span class="label label-danger">Non</span>';
        }
    }
    
    /**
     * Affiche le détail d'un appartement
     * @param type $appart
     * @return string
     */
    public static function generateDetailDisplay($appart) {
        
        /*
         * TO DO
         * Remplacer le contenu d'exemple par les valeurs dans $appart (et sur la base)
         * Par exemple, surface et loyer sont déjà faits ! Il suffit de s'en inspirer ;)
         */
        
        $adresse = Adresse::findById($appart->id_adresse);
        $rep = '<div class="col-sm-12 page-content">

                    <div class="col-sm-5" style="position: fixed;">
                        <img class="appart-photo" src="http://www.yooko.fr/wp-content/uploads/2013/07/appartement-W-par-Regis-Botta-7.jpg"  />
                        <h4><strong>Adresse : </strong></h4>
                        <p>
                            '. $adresse->numRue . ' ' . $adresse->rue . '<br>' . $adresse->codePostal . ' ' . $adresse->ville .'
                        </p>
                        <p>
                            <strong>Quartier :</strong> '. $adresse->quartier .'
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
                                <td>' . $appart->nbPieces . '</td>
                            </tr>
                            <tr>
                                <td>Loyer</td>
                                <td>' . $appart-> loyer . ' €</td>
                            </tr>
                            <!--<tr>
                                <td>Charges</td>
                                <td>Comprises</td>
                            </tr>-->
                            <tr>
                                <td>Etat</td>
                                <td>' . $appart->etat . '</td>
                            </tr> 
                            <tr>
                                <td>Vidéophone</td>
                                <td>' . AppartementView::bitToOuiNon($appart->videphone) . '</td>
                            </tr>
                            <tr>
                                <td>Interphone</td>
                                <td>' . AppartementView::bitToOuiNon($appart->interphone) . '</td>
                            </tr>
                            <tr>
                                <td>Digicode</td>
                                <td>' . AppartementView::bitToOuiNon($appart->digicode) . '</td>
                            </tr>
                            <tr>
                                <td>Cable</td>
                                <td>' . AppartementView::bitToOuiNon($appart->cable) . '</td>
                            </tr>
                            <tr>
                                <td>Antenne TV</td>
                                <td>' . AppartementView::bitToOuiNon($appart->antenneTV) . '</td>
                            </tr>
                            <tr>
                                <td>Espace Vert</td>
                                <td>' . AppartementView::bitToOuiNon($appart->espaceVert) . '</td>
                            </tr>
                            <tr>
                                <td>VMC</td>
                                <td>' . AppartementView::bitToOuiNon($appart->VMC) . '</td>
                            </tr>
                            <tr>
                                <td>Piscine</td>
                                <td>' . AppartementView::bitToOuiNon($appart->pirsine) . '</td>
                            </tr>
                            <tr>
                                <td>Parking Collectif</td>
                                <td>' . AppartementView::bitToOuiNon($appart->parkingCollectif) . '</td>
                            </tr>
                            <tr>
                                <td>Jardin Privé</td>
                                <td>' . AppartementView::bitToOuiNon($appart->jardinPrive) . '</td>
                            </tr>
                            <tr>
                                <td>Ascenceur</td>
                                <td>' . AppartementView::bitToOuiNon($appart->ascenseur) . '</td>
                            </tr>
                            <tr>
                                <td>Loge Gardien</td>
                                <td>' . AppartementView::bitToOuiNon($appart->logeGardin) . '</td>
                            </tr>
                            <tr>
                                <td>Vide Ordure</td>
                                <td>' . AppartementView::bitToOuiNon($appart->ordure) . '</td>
                            </tr>
                            <tr>
                                <td>Double Vitrage</td>
                                <td>' . AppartementView::bitToOuiNon($appart->doubleVitrage) . '</td>
                            </tr>
                            <tr>
                                <td>Climatisation</td>
                                <td>' . AppartementView::bitToOuiNon($appart->climatisation) . '</td>
                            </tr>
                            <tr>
                                <td>Eau chaude collective</td>
                                <td>' . AppartementView::bitToOuiNon($appart->eauChaudeCollective) . '</td>
                            </tr>
                            <tr>
                                <td>Eau froide collective</td>
                                <td>' . AppartementView::bitToOuiNon($appart->eauFroideCollective) . '</td>
                            </tr>
                            <tr>
                                <td>Complément eau chaude</td>
                                <td>' . AppartementView::bitToOuiNon($appart->cptEauChaude) . '</td>
                            </tr>
                            <tr>
                                <td>Complément eau froide</td>
                                <td>' . AppartementView::bitToOuiNon($appart->cptEauFroide) . '</td>
                            </tr>
                            <tr>
                                <td>Chauffage</td>
                                <td> ' . $appart->chauffage . '</td>
                            </tr>
                            <tr>
                                <td>Classe Energie</td>
                                <td> ' . $appart->classeEnergie . '</td>
                            </tr>
                            <tr>
                                <td>Cuisine Equipée</td>
                                <td>' . AppartementView::bitToOuiNon($appart->cuisineEquipee) . '</td>
                            </tr>
                            <tr>
                                <td>Branchement machine à laver</td>
                                <td>' . AppartementView::bitToOuiNon($appart->branchementMachineLaver) . '</td>
                            </tr>
                            <tr>
                                <td>Evier</td>
                                <td>' . AppartementView::bitToOuiNon($appart->evier) . '</td>
                            </tr>
                            <tr>
                                <td>Caves</td>
                                <td>' . AppartementView::bitToOuiNon($appart->caves) . '</td>
                            </tr>
                            <tr>
                                <td>Balcon</td>
                                <td>' . AppartementView::bitToOuiNon($appart->balcon) . '</td>
                            </tr>
                            <tr>
                                <td>Garages</td>
                                <td>' . AppartementView::bitToOuiNon($appart->garages) . '</td>
                            </tr>
                            <tr>
                                <td>Terrasses</td>
                                <td>' . AppartementView::bitToOuiNon($appart->terrasses) . '</td>
                            </tr>
                            <tr>
                                <td>Chambre de service</td>
                                <td>' . AppartementView::bitToOuiNon($appart->chambreService) . '</td>
                            </tr>
                            <tr>
                                <td>Parking privé</td>
                                <td>' . AppartementView::bitToOuiNon($appart->parkingPrive) . '</td>
                            </tr>
                            <tr>
                                <td>Greniers</td>
                                <td>' . AppartementView::bitToOuiNon($appart->grenier) . '</td>
                            </tr>
                            <tr>
                                <td>Celliers</td>
                                <td>' . AppartementView::bitToOuiNon($appart->celliers) . '</td>
                            </tr>
                        </table>
                    </div>

                </div>';
        
        return $rep;
    }
    
    
    

}
