<?php
namespace fridgie\controleurs;

use fridgie\modeles\Apporte as Apporte;
use fridgie\modeles\Evenement as Evenement;
use fridgie\modeles\Ingredient;

class ControleurIngredient
{
    public function addIngredient($id){

    }

    public function apporterIngredientForm($token){
        $ev = Evenement::where('tokenEvent','=',$token)->first();
        $v = new \fridgie\vues\VueIngredient($ev);
        $v->render('apporterIngredientForm');
    }

    public function apporterIngredient($token){
        $apporte = new Apporte();
        $apporte->idEvent = Evenement::where('tokenEvent', '=', $token)->first()->idEvent;
        $apporte->idIngre = Ingredient::where('libelleIngre', '=', $_POST['ingredient'])->first()->idIngre;
        $apporte->idCli = ControleurClient::getIdConnexion();
        $apporte->quantite = $_POST['quantite'];
        $maj = Apporte::where('idEvent', '=', $apporte->idEvent)
            ->where('idIngre', '=', $apporte->idIngre)
            ->where('idCli', '=', $apporte->idCli)->first();
        if ($maj != null) {
            if($_POST['quantite'] >0) {
                $maj->quantite = $_POST['quantite'];
                $maj->save();
            } else $maj->delete();
        } else {
            if($_POST['quantite'] >0) $apporte->save();
        }
    }

    public function removeIngredient($id){

    }

    public function setIngredient($id){

    }
}