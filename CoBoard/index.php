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

/*
 * ----------------------------------------------------------------
 *  Controleur Recette
 * ----------------------------------------------------------------
 */

/*
$app->get('/indexrecette', function() {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->indexRecette();
});

$app->get('/recette',function () {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->getRecette();
});

$app->post('/recette',function () {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->afficherRecette();
});

$app->get('/afficherrecette/:id',function ($id) {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->afficherRecetteId($id);
});

$app->get('/nouvellerecette', function() {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->formulaireInsererRecette();
});

$app->post('/nouvellerecette', function() {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->traitementformulaireInsererRecette();
});

$app->get('/rechercherecette', function() {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->formulaireRechercheRecette();
});

$app->post('/rechercherecette', function() {
    $c = new \fridgie\controleurs\ControleurRecette();
    $c->traitementFormulaireRechercheRecette();
});
*/

/*
 * ----------------------------------------------------------------
 *  Controleur Evenement
 * ----------------------------------------------------------------
 */

/*
$app->get('/indexevenement', function() {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->indexEvenement();
});

$app->get('/creationevenement',function () {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->creerEvenement();
});

$app->post('/creationevenement',function () {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->creerEvenementPost();
});

$app->get('/afficherevenements', function() {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->afficherEvenements();
});

$app->get('/afficherevenement/:token',function ($token) {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->afficherEvenement($token);
});

//$app->get('/participerevenement/:token', function($token) {
//    $c = new \fridgie\controleurs\ControleurEvenement();
//    $c->participerEvenement($token);
//});

$app->post('/participerevenement/:token', function($token) {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->participerEvenementPost($token);
});

//par nom
$app->get('/rechercheevenement/:recherche',function ($recherche) {
    $c = new \fridgie\controleurs\ControleurEvenement();
    $c->rechercheEvenement($recherche);
});
*/

/*
 * ----------------------------------------------------------------
 * Controleur Ingredient
 * ----------------------------------------------------------------
 */

/*
$app->post('/apporteringredient/:token', function($token) { //token = token de l'event
    $c = new \fridgie\controleurs\ControleurIngredient();
    $c->apporterIngredient($token);
    header('Location: ../afficherevenement/' . $token);
    exit();
});

$app->get('/apporteringredient/:token', function($token) { //token = token de l'event
    $c = new \fridgie\controleurs\ControleurIngredient();
    $c->apporterIngredientForm($token);
});

$app->get('/ingredient/:id', function($id) { //id = id de l'ingredient à afficher
    $c = new \fridgie\controleurs\ControleurIngredient();
    $c->afficherIngredient($id);
});
*/

/*
 * ----------------------------------------------------------------
 * Controleur Client
 * ----------------------------------------------------------------
 */

/*
$app->get('/inscription', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    $c->creerCompte();
});

$app->post('/inscription', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    $c->traitementInscription();
});

$app->get('/connexion', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    if (isset($_SESSION['Connexion']) == true) {
        header('Location: ./moncompte');
        exit();
    }
    else $c->identification();
});

$app->post('/connexion', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    $c->traitementIdentification();
});

$app->post('/deconnexion', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    $c->deconnexion();
});

$app->get('/moncompte', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    $c->afficherCompte();
});

$app->post('/suppression', function() {
    $c = new \fridgie\controleurs\ControleurClient();
    $c->delete();
});
*/

$app->run();