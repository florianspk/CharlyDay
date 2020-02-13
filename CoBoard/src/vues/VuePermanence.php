<?php

namespace coboard\vues;
use CoBoard\modeles\Creneau;

class VuePermanence
{

    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'afficherPermanence' : {
                $content = $this->afficherPermanence();
                break;
            }
        }
        $html =  <<<END
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Permanence</title>

  <!-- Custom fonts for this template-->
  <link href="Front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="Front/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  $content
  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="Front/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="Front/js/demo/chart-area-demo.js"></script>
  <script src="Front/js/demo/chart-pie-demo.js"></script>
</body>
</html>
END;

        echo $html;
    }

    private function afficherpermanence() {
        $res = file_get_contents('Front/permanence.html');
        foreach ($this->tab as $c) {
            $contenu = <<<HTML
<div class="row row-striped">
                        <div class="col-2 text-right">
                            <h1 class="display-4"><span class="badge badge-secondary">$c->id_jour</span></h1>
                            <h2>$c->id_mois</h2>
                        </div>
                        <div class="col-10">
                            <h3 class="text-uppercase"><strong>$c->id_cycle</strong></h3>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> $c->jour</li>
                                <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i> $c->heure_debut - $c->heure_fin</li>
                            </ul>
                            <p>$c->desc</p>
                        </div>
                    </div>
HTML;
        }
        return  str_replace("%contenu%", $contenu, $res);
    }

}