<?php


namespace fridgie\vues;


class VuePrincipale
{
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'afficherAccueil' : {
                $content = $this->afficherAccueil();
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

    private function afficherAccueil() {
        if (isset($_SESSION['Connexion']) == false) {
            $res="
<div id=\"first\"> 
    <p><strong>Bienvenue sur Fridgie !</strong>
    <br>Rejoignez-nous en vous inscrivant en appuyant ci-dessous.</p> 
    <a class=\"bouton\" href=\"inscription\">Inscription</a>
</div>";
        } else {
            $res="
<div id=\"first\"> 
    <p><strong>Bienvenue sur Fridgie !</strong>
    <br>Recherchez une recette en appuyant ci-dessous.</p> 
    <a class=\"bouton\" href=\"recette\">Recherche</a>
</div>";
        }
        return $res."<div id='arrow01'></div><div id=\"second\">
	<p>
	    Fridgie est une application web développée par quatre étudiants de 2ème de DUT Informatique.			
	    Principe du site-web :
	    <br>Aujourd'hui, nous avons tellement de produits à consommer dans nos frigos qu'au final, nous ne savons même plus quoi manger.
	    C'est là que Fridgie intervient. En effet, il vous permet de trouver une liste de recette en fonction des ingrédients que vous avez dans votre frigo.
	    Mais Fridgie est plus grand que ça ! Vous pouvez aussi par exemple créer un évenement qui tourne autour d'une recette, suivant ce principe,
	    les membres qui s'inscrivent à l'évenement peuvent vous notifier qu'ils apportent tel ou tel ingrédient, et réalisez, facilement,
	    un plat collaboratif !
	    <br><br> S3C - KRELL SPICK PERCIN SASSU
    </p>
</div>";
    }
}