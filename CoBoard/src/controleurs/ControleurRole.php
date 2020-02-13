<?php

namespace coboard\controleurs;
class ControleurRole
{

    public function afficherRole() {
        $tab = [];
        $v = new \coboard\vues\VueRole($tab);
        $v->render('afficherRole');
    }
}