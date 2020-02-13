<?php

namespace coboard\controleurs;
class ControleurPermanence
{

    public function afficherPermanence() {
        $tab = [];
        $v = new \coboard\vues\VuePermanence($tab);
        $v->render('afficherPermanence');
    }

}