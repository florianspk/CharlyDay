<?php

namespace coboard\controleurs;
class ControleurPrincipal
{
    public function afficherAccueil() {
        $tab = [];
        $v = new \coboard\vues\VuePrincipale($tab);
        $v->render('afficherAccueil');
    }


}