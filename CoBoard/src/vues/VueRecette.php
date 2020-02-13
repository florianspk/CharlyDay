<?php
namespace fridgie\vues;

class VueRecette
{
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur)
    {
        switch ($selecteur) {
            case 'rechercheRecette' :
            {
                $content = $this->formulaireRecherche();
                $cd = '';
                break;
            }
            case 'afficherRecetteId' :
            {
                $content = $this->afficherRecette();
                $cd = '../';
                break;
            }
            case 'afficherRecette' :
            {
                $content = $this->afficherRecette();
                $cd = '';
                break;
            }
            case 'indexRecette' :
            {
                $content = $this->indexRecette();
                $cd = '';
                break;
            }
            case 'insererRecette' :
            {
                $content = $this->insererRecette();
                $cd = '';
                break;
            }
            case 'rechercheRecetteParIngredient' :
            {
                $content = $this->rechercheRecette();
                $cd = '';
                break;
            }
            case 'afficherRecetteParIngredient' :
            {
                $content = $this->afficherRechercheRecette();
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

    private function formulaireRecherche() {
        $res ='
<div class="center"><form action =\'recette\' method="POST">
    <fieldset> 
        <legend>Rechercher une recette</legend>
        <label for="libelle">Libellé : </label><input class="search" type="search" name="libelle" placeholder="libelle">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form></div>';
        return $res;
    }

    private function afficherRecette() {
        return '<div id="first"><p>Id : '.$this->tab[0]->idRecette."<br>Libelle : ".$this->tab[0]->libelleRecette."</p></div>";
    }

    private function indexRecette() {
        $res = "
            <div class='choixRecette'>
                <p>Rechercher une recette</p>
                <a class=\"bouton\" href=\"recette\">Rechercher</a>
                <p>Ajouter une recette</p>
                <a class=\"bouton\" href=\"nouvellerecette\">Ajouter</a>
            </div>";
        return $res;
    }

    private function insererRecette() {
        $res ='
<div class="center"><form action =\'nouvellerecette\' method="POST">
    <fieldset> 
        <legend>Ajouter une recette</legend>
        <label for="libelle">Libellé : </label><input type="text" name="libelle" placeholder="libelle">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form></div>';
        return $res;
    }

    private function rechercheRecette() {
        $res ='
<div class="center"><form action =\'rechercherecette\' method="POST">
    <fieldset> 
        <legend>Rechercher une recette</legend>
        <label for="ingredient0">Ingrédient 1 : </label><input type="text" name="ingredient0" placeholder="libelle"><br>
        <label for="ingredient1">Ingrédient 2 : </label><input type="text" name="ingredient1" placeholder="libelle"><br>
        <label for="ingredient2">Ingrédient 3 : </label><input type="text" name="ingredient2" placeholder="libelle"><br>
        <label for="ingredient3">Ingrédient 4 : </label><input type="text" name="ingredient3" placeholder="libelle"><br>
        <label for="ingredient4">Ingrédient 5 : </label><input type="text" name="ingredient4" placeholder="libelle">
    </fieldset>
    <button name="btn1" value="Valider">Valider</button>
</form></div>';
        return $res;
    }

    private function afficherRechercheRecette() {
        $res = '<div id="first"><p>'.$this->tab[0].'</p></div>';
        return $res;
    }

}