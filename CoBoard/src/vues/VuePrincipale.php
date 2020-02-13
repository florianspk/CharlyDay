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
                $html = $this->afficherAccueil();
                $cd = '';
                break;
            }
        }
        echo $html;
    }

    private function afficherAccueil() {
        readfile('../../Front/index.html');
    }
}