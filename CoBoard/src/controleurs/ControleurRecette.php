<?php
namespace fridgie\controleurs;


class ControleurRecette
{
    public function getRecette() {
        $tab = [];
        $v = new \fridgie\vues\VueRecette($tab);
        $v->render('rechercheRecette');
    }

    public function afficherRecette() {
        $libelle = filter_var($_POST['libelle'], FILTER_SANITIZE_STRING);
        $r = \fridgie\modeles\Recette::select('idRecette', 'libelleRecette')->where('libelleRecette', '=', $libelle)->first();
        $v = new \fridgie\vues\VueRecette([$r]);
        $v->render('afficherRecette');
    }

    public function afficherRecetteId($id) {
        $r = \fridgie\modeles\Recette::where('idrecette', '=', $id)->first();
        $v = new \fridgie\vues\VueRecette([$r]);
        $v->render('afficherRecetteId');
    }

    public function indexRecette() {
        $tab = [];
        $v = new \fridgie\vues\VueRecette($tab);
        $v->render('indexRecette');
    }

    public function formulaireInsererRecette() {
        $tab = [];
        $v = new \fridgie\vues\VueRecette($tab);
        $v->render('insererRecette');
    }

    public function traitementFormulaireInsererRecette() {

    }

    public function formulaireRechercheRecette() {
        $tab = [];
        $v = new \fridgie\vues\VueRecette($tab);
        $v->render('rechercheRecetteParIngredient');
    }

    public function traitementFormulaireRechercheRecette() {
        $tmp1 = [];
        $tmp2 = [];
        for ($i=0;$i<5;$i++) {
            if(isset($_POST["ingredient$i"])) {
                $tmp1[$i] = filter_var($_POST["ingredient$i"], FILTER_SANITIZE_STRING);
            }
        }

        /*$tmp1 = [];
        $tmp2 = [];
        foreach($_POST as $key => $val) {
            if (isset($key)) {
                $tmp1[$key] = filter_var($_POST["$key"], FILTER_SANITIZE_STRING);
            }
        }*/

        for ($i=0;$i<5;$i++) {
            $tmp2[$i] = \fridgie\modeles\Ingredient::select('idIngre')->where('libelleIngre', '=', "$tmp1[$i]")->first();
        }

        $r = \fridgie\modeles\Contient::select('idRecette')->where('idIngre', '=', "$tmp2[0]")/*->orWhere('idIngre', '=', "$tmp2[1]")->orWhere('idIngre', '=', "$tmp2[2]")->orWhere('idIngre', '=', "$tmp2[3]")->orWhere('idIngre', '=', "$tmp2[4]")*/  ->get();
        $v = new \fridgie\vues\VueRecette([$r]);
        $v->render('afficherRecetteParIngredient');
    }

}