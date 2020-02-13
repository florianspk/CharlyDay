<?php
namespace fridgie\controleurs;

use fridgie\controleurs\ControleurClient as ControleurClient;
use fridgie\controleurs\ControleurRecette as ControleurRecette;
use fridgie\modeles\Client;
use fridgie\modeles\Contient;
use fridgie\modeles\Evenement as Evenement;

use fridgie\modeles\Ingredient;
use fridgie\modeles\Participe;
use fridgie\modeles\Recette as Recette;
use fridgie\vues\VueEvenement;
use fridgie\vues\VueRecette;

class ControleurEvenement
{

    public function indexEvenement(){
        $tab = [];
        $v = new \fridgie\vues\VueEvenement($tab);
        $v->render('choixEvenement');
    }

    public function creerEvenement(){
        $tab = [];
        $v = new \fridgie\vues\VueEvenement($tab);
        $v->render('CreationEvenement');
    }

    public function creerEvenementPost(){
        $v = new \fridgie\vues\VueEvenement(null);
        $ev = new Evenement();
        $ev->tokenEvent =  filter_var(bin2hex(random_bytes(32)), FILTER_SANITIZE_STRING);
        $ev->idCli = ControleurClient::getIdConnexion();
        $ev->nomEvent = filter_var($_POST['titre'], FILTER_SANITIZE_STRING);
        if(isset($_POST['description']) && $_POST['description']!=null)
            $ev->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        else $ev->description = null;
        /*
         *  debut search bar dans le future
         */
        if(isset($_POST['idRecette']) && $_POST['idRecette']!=null && $_POST['idRecette']>=0)
        $ev->idRecette = filter_var($_POST['idRecette'], FILTER_SANITIZE_NUMBER_INT);
        else $ev->idRecette = null;
        /*
         *  fin search bar dans le future
         */
        $ev->dateEvenement = $_POST['dateEvenement'];
        $ev->save();
        $ev=Evenement::where('tokenEvent','=',$ev->tokenEvent)->first();
        /*
         * ajout du créateur dans l'event
         */
        $p = new Participe();
        $p->idEvent = $ev->idEvent;
        $p->idCli = ControleurClient::getIdConnexion();
        $p->save();
        //render dans la vue
        $v = new \fridgie\vues\VueEvenement($ev);
        $v->render('creerEvenementPost');
    }

    public function afficherEvenements(){
        $ev = Evenement::get();
        $v = new \fridgie\vues\VueEvenement($ev);
        $v->render('afficherEvenements');
    }

    public function afficherEvenement($token){
        $ev['Apporte']=null;
        $ev['Participe'] = false;
        $ev['Event'] = Evenement::where('tokenEvent','=',$token)->first();
        $participe = Evenement::where('tokenEvent','=',$token)->first()->participe()->get();
        if(isset($_SESSION['Connexion'])) {
            foreach ($participe as $p) {
                $ev['Participants'][] = Client::where('idCli', '=', $p->idCli)->first();
                if($p->idCli == ControleurClient::getIdConnexion()) {
                    $ev['Participe'] = true;
                }
            }
        } else {
            foreach ($participe as $p) {
                $ev['Participants'][] = Client::where('idCli', '=', $p->idCli)->first();
            }
        }
        $apporte = Evenement::where('tokenEvent','=',$token)->first()->apporte()->get();
        foreach ($apporte as $a) {
            $tab['login'] = Client::where('idCli', '=', $a->idCli)->first();
            $tab['Ingredient'] = Ingredient::where('idIngre', '=', $a->idIngre)->first();
            $tab['quantite'] = $a->quantite;

            $ev['Apporte'][] = $tab;
            $contient = Contient::where('idIngre', '=', $a->idIngre)->get();


            foreach ($contient as $c){
                $r = Recette::where('idRecette', '=', $c->idRecette)->first();
                if(!isset($ev['Recette'][$r->idRecette])){
                    $ev['Recette'][$r->idRecette][0]=$r;
                }
                foreach (Contient::where('idRecette', '=', $r->idRecette)->get() as $cR) {
                    $iR = Ingredient::where('idIngre', '=', $cR->idIngre)->first();
                    $array = ['libelle' => $iR->libelleIngre, 'quantite' => $cR->quantite, "unite" => $cR->unite];
                    if(isset($array) && $array != null)
                    $ev['Recette'][$r->idRecette][1][] = $array;
                }
            }


        }
        $v = new \fridgie\vues\VueEvenement($ev);
        $v->render('afficherEvenement');
    }

    public function participerEvenementPost($token){
        if (isset($_SESSION['Connexion']) == true) {
            $ev = Evenement::where('tokenEvent','=',$token)->first();
            $p = new Participe();
            $p->idEvent = $ev->idEvent;
            $p->idCli = ControleurClient::getIdConnexion();
            if(Participe::where('idCli','=', $p->idCli)->where('idEvent', '=', $p->idEvent)->first() == null) {
                $p->save();
                $v = new \fridgie\vues\VueEvenement($ev);
                $v->render('participerEvenementPost');
            } else {
                echo("Vous participez déjà à cet évènement");
            }
        } else {
            header("Location: ./../connexion");
        }
    }




}