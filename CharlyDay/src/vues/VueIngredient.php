<?php
namespace fridgie\vues;

class VueIngredient
{
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur){
        switch ($selecteur){
            case 'apporterIngredientForm' :
            {
                $content = $this->apporterIngredientForm();
                $cd = '../';
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
                <link rel="stylesheet" href="{$cd}css/style.css">
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

    private function apporterIngredientForm(){
        $res = "<div id='center'>";
        $res = $res .
            "<form class = form action ='./{$this->tab->tokenEvent}' method=\"POST\">
                <fieldset> 
                    <legend>Recherche d'ingredient</legend>      
                    <label class='labelForm' for='ingredient'>Titre : </label><input class='inputForm' type='text' name='ingredient' placeholder='Libelle ingredient'><br>
                    <label class='labelForm' for='quantite'>Quantité : </label><input class='inputForm' type='number' name='quantite' placeholder='Quantité'><br>
                </fieldset>
                <button name=\"submit\" value=\"Apporter\">Apporter</button>
            </form>";
        $res = $res . "</div>";
        return $res;
    }
}