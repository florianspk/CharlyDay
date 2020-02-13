<?php

namespace coboard\vues;
class VuePrincipale
{
    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'afficherAccueil' : {
                $this->afficherAccueil();
                break;
            }
        }
    }

    private function afficherAccueil() {
        include('Front/index.html');
    }
}