<?php

namespace coboard\vues;
class VueClient
{
    private $tab;

    public function __construct($tab) {
        $this->tab = $tab;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 1 : {
                $content = $this->inscription();
                $cd = '';
                break;
            }
            case 2 : {
                $content = $this->connexion();
                $cd = '';
                break;
            }
            case 3: {
                $content = $this->monCompte();
                $cd = '';
                break;
            }
        }
        if (isset($_SESSION['Connexion']) == false) {
            $html = <<<END
<!doctype html>
<html class="no-js" lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fridgie</title>
    <link rel="stylesheet" href="{$cd}css/style.css">
  </head>
   <header class="menu" role="banner">
		 <div id="logo"><a href="{$cd}./"><img src="{$cd}img/logo.png"></a></div>
         <div id="menu_button">
			 <ul>
				<li><a class="bouton" href="{$cd}./">Accueil</a></li>
                <li><a class="bouton" href="{$cd}indexevenement">Evenement</a></li>
                <li><a class="bouton" href="{$cd}indexrecette">Recette</a></li>
                <li><a class="bouton" href="{$cd}connexion">Connexion</a></li>
         	 </ul>
	   	</div>
    </header>
    <body>
  
    $content
    
    </body>
</html>
END;
        } else {
            $html = <<<END
<!doctype html>
<html class="no-js" lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fridgie</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
   <header class="menu" role="banner">
		 <div id="logo"><a href="{$cd}./"><img src="{$cd}img/logo.png"></a></div>
         <div id="menu_button">
			 <ul>
				<li><a class="bouton" href="{$cd}./">Accueil</a></li>
                <li><a class="bouton" href="{$cd}indexevenement">Evenement</a></li>
                <li><a class="bouton" href="{$cd}indexrecette">Recette</a></li>
                <li><a class="bouton" href="{$cd}moncompte">Mon Compte</a></li>
         	 </ul>
	   	</div>
    </header>
    <body>
  
    $content
    
    </body>
</html>
END;
        }
        echo $html;
    }

    private function connexion() {
        if(isset($this->tab['erreur'])) {
            $res = '<div id="con"><form action =\'connexion\' method="POST" enctype="multipart/form-data">
					<fieldset>
						<legend>Connexion</legend>
						<div class="conPadding">
						    <label class="labelCon" for="Compte_login">Identifiant : </label><input class="inputCon" type="text" name="Compte_login" placeholder="Identifiant"><br/>
						    <label class="labelCon" for="Compte_mdp">Mot de passe : </label><input class="inputCon" type="password" name="Compte_mdp" placeholder="Mot de passe">
					    </div>
					</fieldset>
					<p>'.$this->tab['erreur'].'</p>
					<input type="submit" value="Connexion">
				</form>
	    	</div>';
        } else {
            $res = '<div id="con"><form action =\'connexion\' method="POST" enctype="multipart/form-data">
					<fieldset>
						<legend>Connexion</legend>
						<div class="conPadding">
						    <label class="labelCon" for="Compte_login">Identifiant : </label><input class="inputCon" type="text" name="Compte_login" placeholder="Identifiant"><br/>
						    <label class="labelCon" for="Compte_mdp">Mot de passe : </label><input class="inputCon" type="password" name="Compte_mdp" placeholder="Mot de passe">
					    </div>
					</fieldset>
					<input type="submit" value="Connexion">
				</form>
	    	</div>';
        }
        return $res;
    }

    private function inscription()
    {
        return '<section><div id="ins"><form method="POST" action="" enctype="multipart/form-data">
					<fieldset>
						<legend>Inscription</legend>
						<div>
						    <label for="Compte_nom" class="labelIns">Nom : </label><input class="inputIns" type="text" name="Compte_nom" placeholder="Nom"> <br>
							<label for="Compte_prenom" class="labelIns">Prenom : </label><input class="inputIns" type="text" name="Compte_prenom" placeholder="Prenom"> <br>
							<label for="Compte_mail" class="labelIns">Adresse mail:</label><input class="inputIns" type="mail" name="Compte_mail" placeholder="Adresse mail"> <br>
							<label for="Compte_login" class="labelIns">Identifiant : </label><input class="inputIns" type="text" name="Compte_login" placeholder="Identifiant"> <br>
							<label for="Compte_mdp" class="labelIns">Mot de passe: </label><input class="inputIns" type="password" name="Compte_mdp" placeholder="Mot de passe"> <br>
							<label for="Compte_vmdp" class="labelIns">Verification mot de passe:</label><input class="inputIns" type="password" name="Compte_vmdp" placeholder="Mot de passe">
						</div>	
					</fieldset>
					<input type="submit" value="Inscription">
				</form></div></section>';
    }

    private function monCompte(){
        $res ="
<div id=\"first\">
	<p class=\"info\">Nom : ".$this->tab['nom']."</p>
	<p class=\"info\">Prenom : ".$this->tab['prenom']."</p>
	<p class=\"info\">Mail : ".$this->tab['mail']."</p>
    <div id=\"footercompte\">
        <form method=\"POST\" action=\"deconnexion\" enctype=\"multipart/form-data\">
            <input type=\"submit\" value=\"Deconnexion\">
        </form>
        <form method=\"POST\" action=\"suppression\" enctype=\"multipart/form-data\">
            <input type=\"submit\" value=\"Suppression\">
        </form>
    </div>
</div>";
        return $res;
    }
}