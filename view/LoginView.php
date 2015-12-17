<?php

/**
 * Description of Signin
 *
 * @author Guillaume
 */
class LoginView {
    
    public static function displayUtilisateur() {
        return '<div class="row">
                    <div class="col-sm-12 page-title">
                        <h2><span class="glyphicon glyphicon-user"></span> Informations de compte</h2>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12 page-content">

                           <form class="form-horizontal">

                            <h4>Informations</h4>
                            <hr>
                            <div class="form-group">
                                <label for="signup-name" class="col-sm-2 control-label">Nom</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-name" placeholder="Nom" value="'.$_SESSION['nom'].'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signup-fname" class="col-sm-2 control-label">Prénom</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-fname" placeholder="Prénom" value="'.$_SESSION['prenom'].'">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="signup-email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control" id="signup-email" placeholder="Email" value="'.$_SESSION['email'].'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signup-phone" class="col-sm-2 control-label">Téléhone</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-phone" placeholder="Numéro de téléphone" value="'.$_SESSION['telephone'].'">
                                </div>
                            </div>
                            <h4>Adresse</h4>
                            <hr>
                            <div class="form-group">
                                <label for="signup-number" class="col-sm-2 control-label">Numéro</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-number" placeholder="Numéro de rue" value="23">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signup-street" class="col-sm-2 control-label">Rue</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-street" placeholder="Rue" value="Rue des fontaines">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signup-cp" class="col-sm-2 control-label">Code postal</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-cp" placeholder="Code postal" value="57290">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signup-town" class="col-sm-2 control-label">Ville</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="signup-town" placeholder="Ville" value="Fameck">
                                </div>
                            </div>
                            <h4>Compte</h4>
                            <hr>
                            <div class="form-group">
                                <label for="signup-password" class="col-sm-2 control-label">Mot de passe</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" id="signup-password" placeholder="Mot de passe" value="yolo">
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
                                    <a onclick="alert("modified");" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-ok"></span> Enregistrer</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>';
    }
    
    /**
     * Affiche les formulaires de connexion et d'inscription
     * @return string
     */
    public static function displayContent(){
        return '<div class="col-sm-6 page-content">
                    <form class="form-horizontal" action="controller/signin.php" method="POST">

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input name="email" type="email" class="form-control" id="signin-email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="motDePasse" class="col-sm-2 control-label">Mot de passe</label>
                            <div class="col-sm-4">
                                <input name="motDePasse" type="password" class="form-control" id="signin-password" placeholder="Mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-primary pull-right">Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6 page-content">

                    <form class="form-horizontal" action="controller/signup.php" method="POST">

                        <h4>Informations</h4>
                        <hr>
                        <div class="form-group">
                            <label for="signup-name" class="col-sm-2 control-label">Nom</label>
                            <div class="col-sm-4">
                                <input type="text" name="nom" class="form-control" id="signup-name" placeholder="Nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-fname" class="col-sm-2 control-label">Prénom</label>
                            <div class="col-sm-4">
                                <input type="text" name="prenom" class="form-control" id="signup-fname" placeholder="Prénom">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="signup-email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control" id="signup-email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-phone" class="col-sm-2 control-label">Téléhone</label>
                            <div class="col-sm-4">
                                <input type="text" name="tel" class="form-control" id="signup-phone" placeholder="Numéro de téléphone">
                            </div>
                        </div>
                        <h4>Adresse</h4>
                        <hr>
                        <div class="form-group">
                            <label for="signup-number" class="col-sm-2 control-label">Numéro</label>
                            <div class="col-sm-4">
                                <input type="text" name="numerorue" class="form-control" id="signup-number" placeholder="Numéro de rue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-street" class="col-sm-2 control-label">Rue</label>
                            <div class="col-sm-4">
                                <input type="text" name="nomrue" class="form-control" id="signup-street" placeholder="Rue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-cp" class="col-sm-2 control-label">Code postal</label>
                            <div class="col-sm-4">
                                <input type="text" name="codepostal" class="form-control" id="signup-cp" placeholder="Code postal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-town" class="col-sm-2 control-label">Ville</label>
                            <div class="col-sm-4">
                                <input type="text" name="ville" class="form-control" id="signup-town" placeholder="Ville">
                            </div>
                        </div>
                        <h4>Compte</h4>
                        <hr>
                        <div class="form-group">
                            <label for="signup-password" class="col-sm-2 control-label">Mot de passe</label>
                            <div class="col-sm-4">
                                <input type="password" name="pass" class="form-control" id="signup-password" placeholder="Mot de passe">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signup-passconf" class="col-sm-2 control-label">Confirmer mot de passe</label>
                            <div class="col-sm-4">
                                <input type="password" name="pass2" class="form-control" id="signup-passconf" placeholder="Confirmer mot de passe">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-ok"></span> Inscription</button>
                            </div>
                        </div>
                    </form>
                    </div>';
    }  
}

?>
