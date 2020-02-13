<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection(parse_ini_file('./src/conf/conf.ini'));

$db->setAsGlobal();
$db->bootEloquent();

$app = new \Slim\Slim();

$app->get('/',function () {
    $c = new \coboard\controleurs\ControleurPrincipal();
    $c->afficherAccueil();
});

$app->get('/permanence', function() {
   $c = new \coboard\controleurs\ControleurPermanence();
   $c->afficherPermanence();
});

$app->get('/role', function() {
   $c = new \coboard\controleurs\ControleurRole();
   $c->afficherRole();
});

$app->get('/compte', function() {
   $c = new \coboard\controleurs\ControleurClient();
   $c->afficherCompte();
});

$app->get('/login', function() {
   $c = new \coboard\controleurs\ControleurClient();
   $c->login();
});

$app->post('/login', function() {
    $c = new \coboard\controleurs\ControleurClient();
    $c->login();
});

$app->get('/periode1', function() {
    $c = new \coboard\controleurs\ControleurPermanence();
    $c->afficherPermanence();
});

$app->get('/periode2', function() {
    $c = new \coboard\controleurs\ControleurPermanence();
    $c->afficherPermanence();
});

$app->get('/periode3', function() {
    $c = new \coboard\controleurs\ControleurPermanence();
    $c->afficherPermanence();
});

$app->get('/periode4', function() {
    $c = new \coboard\controleurs\ControleurPermanence();
    $c->afficherPermanence();
});


$app->run();