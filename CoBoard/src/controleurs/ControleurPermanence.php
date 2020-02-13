<?php

namespace coboard\controleurs;
class ControleurPermanence
{

    public function afficherPermanence() {
        $contenu = \coboard\modeles\Creneau::get();
        /*$i = 0;
        foreach ($contenu as $c){
            $tab[$i] = $c;
            $i++;
        }*/
        $v = new \coboard\vues\VuePermanence([$contenu]);
        $v->render('afficherPermanence');
    }

}