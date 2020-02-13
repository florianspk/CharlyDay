<?php

namespace coboard\vues;
class VueClient
{

    public $tab;

    public function __construct($tableau) {
        $this->tab = $tableau;
    }

    public function render($selecteur) {
        switch ($selecteur){
            case 'afficherCompte' : {
                $content = $this->afficherCompte();
                break;
            }
            case 'login' : {
                $content = $this->login();
                break;
            }
            case 'creerCompte' : {
                $content = $this->creerCompte();
                break;
            }

            case 'permanence' : {
                $content = $this->permanence();
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

  <title>Mon compte</title>

  <!-- Custom fonts for this template-->
  <link href="../Front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../Front/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  $content
  
  <!-- Bootstrap core JavaScript-->
  <script src="../Front/vendor/jquery/jquery.min.js"></script>
  <script src="../Front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../Front/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../Front/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../Front/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../Front/js/demo/chart-area-demo.js"></script>
  <script src="../Front/js/demo/chart-pie-demo.js"></script>
</body>
</html>
END;

        echo $html;
    }

    private function afficherCompte() {
      return  include('../Front/compte.html');
    }

    private function login() {
       return include('../Front/login.html');
    }

    private function creerCompte()
    {
       return include('../Front/register.html');
    }

    private function permanence()
    {
       return include ('../Front/permanance.html');
    }


}