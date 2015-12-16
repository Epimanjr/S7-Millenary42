<?php

/**
 * Description of Signin
 *
 * @author Guillaume
 */
class LoginView {
    public static function displayContent(){
        return '<div class="col-sm-6 page-content">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="signin-email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="signin-email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signin-password" class="col-sm-2 control-label">Mot de passe</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="signin-password" placeholder="Mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a href="../connected_user/index.html" class="btn btn-primary pull-right">Se connecter</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6 page-content">

                    <form class="form-horizontal">

                        <h4>Informations</h4>
                        <hr>
                        <div class="form-group">
                            <label for="signup-name" class="col-sm-2 control-label">Nom</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-name" placeholder="Nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-fname" class="col-sm-2 control-label">Prénom</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-fname" placeholder="Prénom">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="signup-email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="signup-email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-phone" class="col-sm-2 control-label">Téléhone</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-phone" placeholder="Numéro de téléphone">
                            </div>
                        </div>
                        <h4>Adresse</h4>
                        <hr>
                        <div class="form-group">
                            <label for="signup-number" class="col-sm-2 control-label">Numéro</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-number" placeholder="Numéro de rue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-street" class="col-sm-2 control-label">Rue</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-street" placeholder="Rue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-cp" class="col-sm-2 control-label">Code postal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-cp" placeholder="Code postal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-town" class="col-sm-2 control-label">Ville</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="signup-town" placeholder="Ville">
                            </div>
                        </div>
                        <h4>Compte</h4>
                        <hr>
                        <div class="form-group">
                            <label for="signup-password" class="col-sm-2 control-label">Mot de passe</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="signup-password" placeholder="Mot de passe">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-passconf" class="col-sm-2 control-label">Confirmer mot de passe</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="signup-passconf" placeholder="Confirmer mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-success pull-right"><span class="glyphicon glyphicon-ok"></span> Inscription</a>
                            </div>
                        </div>
                    </form>
                    </div>';
    }  
}

?>
