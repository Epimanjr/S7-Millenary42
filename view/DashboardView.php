<?php

include_once 'model/Impaye.php';
include_once 'model/Utilisateur.php';
include_once 'model/TypeUtilisateur.php';

/**
 * Description of DashboardView
 *
 * @author antoine
 */
class DashboardView {
    
    public static function generateDashboard() {
        $res = '<div class="row">
                    <div class="col-sm-12 page-title">
                        <h2><span class="glyphicon glyphicon-dashboard"></span> Tableau de bord</h2>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12 page-content">

                        <div class=" col-sm-6">
                            <h3>Paiements en retard</h3>
                            <hr>
                            <table class="table table-striped">
                                <!-- header du tableau -->
                                <thead>
                                <th class="col-sm-4">Adresse</th>
                                <th class="col-sm-2">Montant du</th>
                                <th class="col-sm-3">Prochaine écheance du loyer</th> 
                                <th class="col-sm-1">Rappel</th>
                                </thead>
                                <!-- contenu du tableau -->
                                <tbody>';
        $res2 ="";
        $res3= "";
        $impayes = Impaye::findAll();
        foreach ($impayes as $impaye) {
            $location = Location::findById($impaye->id_location);
            $utilisateur = Utilisateur::findById($impaye->id_utilisateur);
            $typeutilisateur = TypeUtilisateur::findById($utilisateur->id_type_utilisateur);
            if($typeutilisateur->id_type_utilisateur!=14) {
                $appart = Appartement::findById($location->id_appartement);
                $adresse = Adresse::findById($appart->id_adresse);
                $res .= '               <tr id="appart_01">
                                            <td>' . $adresse->numRue . ' ' . $adresse->rue . '<br>' . $adresse->codePostal . ' ' . $adresse->ville .'</td>
                                            <td>' . $impaye->montant . ' €</td>
                                            <td>' . $impaye->dateLimite . '</td>
                                            <td>
                                                <a class="btn btn-sm btn-default">
                                                    Envoyer rappel
                                                </a>
                                            </td>
                                        </tr>';
            }
                $res2 .= '               <tr id="proprio01">
                                            <td>' . $utilisateur->prenom . ' ' . $utilisateur->nom . '</td>
                                            <td>' . $impaye->montant . ' €</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary">
                                                    Payer
                                                </a>
                                            </td>
                                        </tr>';
        }
        $res .=                '</tbody>
                            </table>

                        </div>
                        <div class="col-sm-5 col-sm-offset-1">
                            <h3>Propriétaires à payer</h3>
                            <hr>
                            <table class="table table-striped">
                                <!-- header du tableau -->
                                <thead>
                                <th class="col-sm-6">Nom</th>
                                <th>Montant à régler</th>
                                <th class="col-sm-2">Régler</th>
                                </thead>
                                <!-- contenu du tableau -->
                                <tbody>';
        $res .= $res2;
        $res .= '               </tbody>
                            </table>

                        </div>
                    
                ';
        $options = Option::findAll();
        $idappart = "";
        $old_idappart="";
        foreach($options as $option) {
            $id_appart = $option->id_appartement;
            if($id_appart != $old_idappart) {
                $res3 .= '               <tr id="proprio01">
                                            <td>Appartement n°' . $option->id_appartement . '</td>
                                            <td></td>
                                            <td>
                                                <center><a class="btn btn-sm btn-primary">
                                                    Détails
                                                </a></center>
                                            </td>
                                        </tr>';   
            }
            $utilisateur = Utilisateur::findById($option->id_utilisateur);
            $appart = Appartement::findById($option->id_appartement);
            $res3 .= '               <tr id="proprio01">
                                        <td>' . $utilisateur->prenom . ' ' . $utilisateur->nom . '</td>
                                        <td>' . $option->date . '</td>
                                        <td>
                                            <center><a class="btn btn-sm btn-success">
                                                Attribuer
                                            </a></center>
                                        </td>
                                    </tr>';
            $old_idappart = $id_appart;
        }
        $res .=                '<br>
                        <div class="col-sm-5 col-sm-offset-1">
                            <h3>Options</h3>
                            <hr>
                            <table class="table table-striped">
                                <!-- header du tableau -->
                                <thead>
                                <th class="col-sm-4">Posée par</th>
                                <th class="col-sm-5">Le</th>
                                <th class="col-sm-3">Attribuer l\'appartement</th>
                                </thead>
                                <!-- contenu du tableau -->
                                <tbody>';
        $res .= $res3;
        $res .= '               </tbody>
                            </table>

                        </div>
                    </div>
                </div>';
        
        return $res;
    }
    
}
