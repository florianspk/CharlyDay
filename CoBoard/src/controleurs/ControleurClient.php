<?php

namespace coboard\controleurs;
use coboard\modeles\Client;
class ControleurClient
{

    public function login(){
        $vueCompte = new \coboard\vues\VueClient(null);
        $vueCompte->render('login');
    }

    function afficherCompte(){
        $vueCompte = new \coboard\vues\VueClient(null);
        $vueCompte->render('afficherCompte');
    }

}