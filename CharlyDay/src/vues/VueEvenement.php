<?php
namespace fridgie\vues;

use fridgie\modeles\Evenement as Evenement;

class VueEvenement
{
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'CreationEvenement' : {
                $content = $this->CreationEvenement();
                $cd = '';
                break;
            }
            case 'choixEvenement' : {
                $content = $this->choixEvenement();
                $cd = '';
                break;
            }
            case 'creerEvenementPost' : {
                $content = $this->creationEvenementPost();
                $cd = '';
                break;
            }
            case 'afficherEvenements' : {
                $content = $this->afficherEvenements();
                $cd = '';
                break;
            }
            case 'afficherEvenement' : {
                $content = $this->afficherEvenement();
                $cd = '../';
                break;
            }
            case 'participerEvenement' : {
                $content = $this->participerEvenement();
                $cd = '../';
                break;
            }
            case 'participerEvenementPost' : {
                $content = $this->participerEvenementPost();
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

    private function choixEvenement() {
        $res = "<div id='center'>";
        $res = $res .
            "<div class='choixEvent'>
                <p>Créer votre propre évènement !</p>
                <a class=\"bouton\" href=\"creationevenement\">Créer</a>
                <p>Participer à un évènement !</p>
                <a class=\"bouton\" href=\"afficherevenements\">Rechercher</a>
          
            </div>";
        $res = $res . "</div>";
        return $res;
    }

    private function afficherEvenements() {
        $res = "<section>   <div class=\"list\"> ";
        /* A mettre en POST pour fonctionner */
        $res= $res . '<div class="searchDiv"><form action ="" method="GET"> 
                <fieldset>
                 <legend>Rechercher un évènement</legend>
                 <label for="libelle">Recherche : </label><input class="searchEvent" type="search" name="libelle" placeholder="Mots-clés">
                </fieldset>
                <button name="btn1" value="Rechercher">Rechercher</button>
                </form></div>';

        foreach ($this->tab as $l) {
            $res = $res . "<div  class='element'>";
            if(is_null($l->description) || $l->description=='')
                $res = $res . "<a href='./afficherevenement/" . $l->tokenEvent. "'>" . $l->nomEvent . "</a> <p>Aucune description.</p>";
            else
                $res = $res . "<a href='./afficherevenement/" . $l->tokenEvent. "'>" . $l->nomEvent . "</a> <p>" . $l->description . "</p>";
            $res = $res . "</div>";
        }
        return $res."</div> </section>";
    }


    private function creationEvenement() {
        $res = "<div id='center'>";
        $res = $res .
            "<form class = creationEvenement action ='./creationevenement' method=\"POST\">
                <fieldset> 
                    <legend>Création de l'évènement</legend>      
                    <label class='labelEvent' for='titre'>Titre : </label><input type='text' name='titre' placeholder='titre'><br>
                    <label class='labelEvent' for='description'>Description : </label><input type=\"text\" name=\"description\" placeholder=\"description\"><br>
                    <label class='labelEvent' for='idRecette'>Recette : </label><input type=\"number\" name=\"idRecette\" placeholder=\"idRecette\"><br>
                    <label class='labelEvent' for='dateEvenement'>Date : </label><input type=\"date\" name=\"dateEvenement\" placeholder=\"dateEvenement\">                    
                </fieldset>
                <button name=\"submit\" value=\"Valider\">Créer</button>
            </form>";
        $res = $res . "</div>";
        return $res;
    }

    private function creationEvenementPost() {
        $res="<section> <div id=\"first\"> 
        <p><strong>Evenement ajouté avec succès ! </strong>
        <a class=\"bouton\" href='./afficherevenement/". $this->tab->tokenEvent . "'>retour à l'evenement</a>
        <a class=\"bouton\" href=\"indexevenement\">Retour au menu évenement</a>
        <a class=\"bouton\" href=\".\">Accueil</a>";
        return $res."</div> </section>";
    }

    private function afficherEvenement() {
        $res="<section> <div class=\"list\"> ";
        $l = $this->tab['Event'];
        $res = $res . "<div  class='element'>";
        /* METTRE UN FORMULAIR ET UN BOUTTON POUR PARTICIPER */
        if(is_null($l->description) || $l->description=='')
            $res = $res . "<p>" . $l->nomEvent . "</p> <p>Aucune description.</p> <p>Recette(s) de l'évènement : " . "</p>";
        else
            $res = $res . "<p>" . $l->nomEvent . "</p> <p>" . $l->description . "</p> <p>Recette(s) de l'évènement : " . "</p>";
        $res = $res . "</div>";
        /*
         * LISTE PARTICIPANT
         */
        $res = $res . "<section> <div class=\"element\"><p>Participants : </p>";
        if(isset($this->tab['Participants']) && $this->tab['Participants']!=null) {
            foreach ($this->tab['Participants'] as $p) {
                $res = $res . "<p>" . $p->login . "</p>";
            }

        } else {
            $res = $res . "<p> Aucun participant </p>";
        }
        $res = $res . "</div>";
        /*
         * Liste d'ingredients
         */
        $res = $res . "<section> <div class=\"element\"><p>Ingredient(s) : </p>";
        if(isset($this->tab['Apporte']) && $this->tab['Apporte']!=null) {
            foreach ($this->tab['Apporte'] as $ing) {
                $res = $res . "<p>" . $ing['login']->login . $ing['Ingredient']->libelleIngre . $ing['quantite'] . "</p>";
            }
        } else {
            $res = $res . "<p> Aucun ingrédient</p>";
        }
        $res = $res . "</div>";
        /*
         * LISTE RECETTES
         */
        $res = $res . "<section> <div class=\"element\"><p>Recette(s) Disponible(s) : </p>";
        if(isset($this->tab['Recette']) && $this->tab['Recette']!=null) {
            foreach ($this->tab['Recette'] as $recette) {
                $res = $res . "<p><a href='../afficherrecette/{$recette[0]->idRecette}'>" . $recette[0]->libelleRecette .  "</a> : ";
                foreach ($recette[1] as $ingRecette) {
                    $res = $res . "<br> - {$ingRecette['quantite']}  {$ingRecette['unite']}  {$ingRecette['libelle']}";
                }
                $res = $res . "</p>";
            }
        } else {
            $res = $res . "<p> Aucun ingrédient</p>";
        }
        $res = $res . "</div>";
        /*
         * FORMULAIRES
         */
        $res = $res . "<section> <div class=\"element\">";
    if(isset($_SESSION['Connexion'])) {
        if($this->tab['Participe']==false) {
            $res = $res . "<form id='reserve' action='../participerevenement/{$l->tokenEvent}' method='POST'> 
            <p><strong>Voulez-vous participer ?</strong>
            <button class='etat' type='submit'>Participer</button> </form>";
         } else {
            $res = $res . "<p><strong>Vous participez déja à l'evenement.</strong>";
            $res = $res ."<form id='apporte' action='../apporteringredient/{$l->tokenEvent}' method='GET'> 
            <p><strong>Apporter un ingredient !</strong>
            <button class='etat' type='submit'>Apporter</button> </form> </div>";
        }
    } else {
        $res = $res . "<form id='reserve' action='../connexion' method='GET'> 
            <p><strong>Voulez-vous participer ?</strong>
            <button class='etat' type='submit'>Participer</button> </form> </div>";
    }

            /*PLUS TARD METTRE DES COMMENTAIRES ET AUTRES LISTE DE RECETTES ... */
            /* A COMPLETER */
        return $res . "</div> </section>";
    }



    private function participerEvenement()
    {
        $l=$this->tab;
        $res = "<section> <div id=\"first\">     
        <form class='reserve' action='../participerevenement/{$l->idEvent}' method='post'> 
            <p><strong>Voulez-vous participer ?</strong>
            <button class='etat' type='submit'>Participer</button> </form>"
            //<a class=\"bouton\" href=\"../afficherevenement/{$l->idEvent}>Annuler</a>
    . "</div>";

        return $res."</div> </section>";

    }



    private function participerEvenementPost() {
        $res="<section> <div id=\"first\"> 
        <p><strong>Participation ajouté avec succès ! </strong>
        <a class=\"bouton\" href='../afficherevenement/". $this->tab->tokenEvent . "'>retour à l'evenement</a>
    </div>";
        return $res."</div> </section>";
    }
}