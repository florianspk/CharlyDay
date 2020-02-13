<?php


namespace fridgie\controleurs;


class ControleurPrincipal
{
    public function afficherAccueil() {
        $tab = [];
        $v = new \fridgie\vues\VuePrincipale($tab);
        $v->render('afficherAccueil');
    }
}