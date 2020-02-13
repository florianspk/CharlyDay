<?php


namespace CoBoard\controleurs;


use CoBoard\modeles\Client;
use coboard\vues\VueClient;
use coboard\vues\VuePrincipale;
use Illuminate\Database\QueryException;

class ControleurAdmin
{
    /**
     * Methode static qui permet d'établir la connexion
     * @param $bool
     */
    public static function setConnexion($bool){
        if (!isset( $_SESSION['Connection']))
            $_SESSION['Connection'] = $bool;
    }

    /**
     * Methode pour savoir si une personne est connecté
     * @return bool qui retourne si il y a une connexion ou pas
     */
    public  static  function isConnected(){
        if(isset($_SESSION['Connection'])){
            return ($_SESSION['Connection'] == true);
        }
        return false;
    }

    /**
     * Methode static pour recupérer l'id de connexion
     * @return l'id de connexion de la personne connecté
     */
    public  static function getIdConnexion(){
        return $_SESSION['Compte_id'];
    }

    /**
     * Methode d'affichage de la connexion
     */
    public function creerCompte(){
        $vueCompte = new VueClient(null);
        $vueCompte->render("creerCompte");
    }

    /**
     * Methode de traitement d'une inscription une fois le formulaire poste envoyé
     * @throws \Exception
     */
    public function traitementInscription() {
        $compte = new Client();
        //Filtre les entrées de l'utilisateurs
        $cn = filter_var($_POST['exampleFirstName'],FILTER_SANITIZE_STRING);
        $cp = filter_var($_POST['exampleLastName'],FILTER_SANITIZE_STRING);
        $cl = filter_var($_POST['adress'],FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['exampleInputEmail'], FILTER_SANITIZE_STRING);
        $login = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
        $cmvdp = filter_var($_POST['exampleInputPassword'], FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#',$_POST['Compte_vmdp']);
        $cmdp = filter_var($_POST['exampleRepeatPassword'] , FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#',$_POST['Compte_mdp']);
        $tel = filter_var($_POST['numéroTel'], FILTER_SANITIZE_STRING);
        $permanence = filter_var($_POST['Obligation'], FILTER_SANITIZE_STRING);
        $ctok = bin2hex(random_bytes(32));
        if ($cmvdp != $cmdp){
            $tab = array("erreur" => "Les mots de passes ne sont pas identique");
            $vueCompte = new VueClient($tab);
            $vueCompte->render("creerCompte");

        }else {
            $existe = Client::where("login", "=", $cl);
            if (strlen($cmdp) < 7) {
                $tab = array("erreur" => "Le mot de passe doit faire plus de 7 caractères");
                $vueCompte = new VueClient($tab);
                $vueCompte->render("creerCompte");
            }else{
                if ($existe == null){
                    $tab = array("erreur" => "Login deja existant");
                    $vueCompte = new VueClient($tab);
                    $vueCompte->render("creerCompte");
                }else{
                    $vueCompte = new VueClient(null);
                    $compte->nom = $cn;
                    $compte->prenom = $cp;
                    $compte->login = $login;
                    $compte->tel = $tel;
                    $compte->permanance = $permanence;
                    $compte->password = $cmdp;
                    $compte->token = $ctok;
                    $compte->mail = $mail;
                    $compte->admin = 0;
                    try {
                        $compte->save();
                        $vueCompte->render(2);
                    }catch (QueryException $e){
                        $tab = array("erreur" => "Creation du compte échoué");
                        $vueCompte = new  VueClient($tab);
                        $vueCompte->render("creerCompte");
                    }
                    $_SESSION['Compte_id'] = $compte->token;
                }
            }

        }
    }

    /**
     * Affichage de la page d'identification
     */
    public function identification(){
        $vueCompte = new VueClient(null);
        $vueCompte->render("login");
    }

    /**
     * Methode de traitement de l'inscription une fois le formulaire post envoyé
     */
    public function traitementIdentification(){
        if (isset($_POST['Compte_login']) and isset($_POST['Compte_mdp'])) {
            $lg = filter_var($_POST['Compte_login'], FILTER_SANITIZE_STRING);
            $mdp = filter_var($_POST['Compte_mdp'], FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#', $_POST['Compte_mdp']);
            if ($lg != false and $mdp != false) {
                $utilisateur = null;
                $utilisateur = Client::where('login', '=', $lg)->where('password', '=', $mdp)->first();
                if ($utilisateur != null) {
                    self::setConnexion(true);
                    $vuePrincipale = new VuePrincipale(null);
                    $vuePrincipale->render('afficherAccueil');
                    if (!isset($_SESSION['Compte_id'])) {
                        $_SESSION['Compte_id'] = $utilisateur->token;
                    }
                } else {
                    $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
                    $vueCompte = new  VueClient($tab);
                    $vueCompte->render("login");
                    self::setConnexion(false);
                }
            } else {
                $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
                $vueCompte = new  VueClient($tab);
                $vueCompte->render("login");
                self::setConnexion(false);
            }
        } else {
            $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
            $vueCompte = new  VueClient($tab);
            $vueCompte->render("login");
            self::setConnexion(false);
        }
    }

    /**
     * methode de deconnexion pour un compte
     */
    function deconnexion(){
        unset($_SESSION['Connection']);
        $vuePrinciapel = new VuePrincipale(null);
        $vuePrinciapel->render('afficherAccueil');
    }

    /**
     * Méthode pour afficher les informations d'un compte (Nom / Prenom)
     */
    function afficherCompte(){
        $tab = array("nom" => $_SESSION['nom'], "prenom" => $_SESSION['prenom']);
        $vueCompte = new VueCompte($tab);
        $vueCompte->render(3);
    }

    /**
     * Méthode de suppression d'un compte
     */
    function delete() {
        // Suppression du compte
        $compte = Compte::where('login','=',$_SESSION['login'])->first();
        $compte->delete();
        // Suppression des interactions de l'utilisateurs
        unset($_SESSION['Compte_id']);
        $this->deconnexion();
    }
}