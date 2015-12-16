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
                                            <a href="./?a=details&id='.$appart->id_appartement.'" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-list-alt"></span> Détails</a>
                                        </p>
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
    
    
    

}
