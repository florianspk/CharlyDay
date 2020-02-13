<?php


namespace fridgie\controleurs;

use fridgie\modeles\Client;

class ControleurClient
{

    public static function setConnexion($bool){
        if (!isset( $_SESSION['Connexion']))
            $_SESSION['Connexion'] = $bool;
    }

    public  static  function isConnected(){
        if(isset($_SESSION['Connexion'])){
            return ($_SESSION['Connexion'] == true);
        }
        return false;
    }
    public  static function getIdConnexion(){
        return Client::where('tokenCli','=',$_SESSION['Compte_token'])->first()->idCli;
    }

    public function creerCompte(){
        $vueCompte = new \fridgie\vues\VueClient(null);
        $vueCompte->render(1);
    }

    public function traitementInscription() {
        $compte = new \fridgie\modeles\Client();
        $vueCompte = new \fridgie\vues\VueClient(null);
        //Filtre les entrées de l'utilisateurs
        $cn = filter_var($_POST['Compte_nom'],FILTER_SANITIZE_STRING);
        $cp = filter_var($_POST['Compte_prenom'],FILTER_SANITIZE_STRING);
        $cl = filter_var($_POST['Compte_login'],FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['Compte_mail'],FILTER_SANITIZE_STRING);
        $cmdp = filter_var($_POST['Compte_mdp'] , FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#',$_POST['Compte_mdp']);
        $ctoken = bin2hex(random_bytes(32));
        /*if(!isset($_POST['Compte_nom'])) new ConnexionException("ERREUR");
        if(!isset($_POST['Compte_prenom'])) new ConnexionException("ERREUR");
        if (!isset($_POST['Compte_login'])) new ConnexionException("ERREUR");
        if (!isset($_POST['Compte_mdp'])) new ConnexionException("ERREUR");*/
        if ($_POST['Compte_vmdp'] != $_POST['Compte_mdp']){
            $vueCompte->render(1);
            /*new ConnexionException("Mot de passse pas identique");*/
        }else{
            $compte->nomCli = $cn;
            $compte->prenomCli = $cp;
            $compte->login = $cl;
            $compte->mdp = $cmdp;
            $compte->mailCli = $mail;
            $compte->tokenCli = $ctoken;
            $vueCompte->render(2);
            try {
                $compte->save();
            }
            catch (QueryException $ex){
                //TODO
            }
            $_SESSION['Compte_token'] = $compte->tokenCli;
        }
    }

    public function identification(){
        $vueCompte = new \fridgie\vues\VueClient(null);
        $vueCompte->render(2);
    }

    public function traitementIdentification(){
        if (isset($_POST['Compte_login']) and isset($_POST['Compte_mdp'])) {
            $lg = filter_var($_POST['Compte_login'], FILTER_SANITIZE_STRING);
            $mdp = filter_var($_POST['Compte_mdp'], FILTER_SANITIZE_SPECIAL_CHARS) or preg_match('#^.{1,50}$#', $_POST['Compte_mdp']);
            if ($lg != false and $mdp != false) {
                $utilisateur = null;
                $utilisateur = \fridgie\modeles\Client::where('login', '=', $lg)->where('mdp', '=', $mdp)->first();
                if ($utilisateur != null) {
                    $_SESSION['nom'] = $utilisateur->nomCli;
                    $_SESSION['prenom'] = $utilisateur->prenomCli;
                    $_SESSION['login'] = $utilisateur->login;
                    $_SESSION['mail'] = $utilisateur->mailCli;
                    self::setConnexion(true);
                    $vuePrincipale = new \fridgie\vues\VuePrincipale(null);
                    $vuePrincipale->render('afficherAccueil');
                    if (!isset($_SESSION['Compte_token'])) {
                        $_SESSION['Compte_token'] = $utilisateur->tokenCli;
                    }
                } else {
                    $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
                    $vueCompte = new \fridgie\vues\VueClient($tab);
                    $vueCompte->render(2);
                    self::setConnexion(false);
                }
            } else {
                $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
                $vueCompte = new \fridgie\vues\VueClient($tab);
                $vueCompte->render(2);
                self::setConnexion(false);
            }
        } else {
            $tab = array("erreur" => "Identifiant ou mot de passe incorrect.");
            $vueCompte = new \fridgie\vues\VueClient($tab);
            $vueCompte->render(2);
            self::setConnexion(false);
        }
    }

    function deconnexion(){
        unset($_SESSION['Connexion']);
        unset($_SESSION['nom']);
        unset($_SESSION['prenom']);
        unset($_SESSION['login']);
        unset($_SESSION['Compte_token']);
        $vuePrinciapel = new \fridgie\vues\VuePrincipale(null);
        $vuePrinciapel->render('afficherAccueil');
    }

    function afficherCompte(){
        $tab = array("nom" => $_SESSION['nom'], "prenom" => $_SESSION['prenom'], "mail" => $_SESSION['mail']);
        $vueCompte = new \fridgie\vues\VueClient($tab);
        $vueCompte->render(3);
    }

    function delete() {
        // Suppression du compte
        $compte = \fridgie\modeles\Client::where('idCli','=',ControleurClient::getIdConnexion())->first();
        $compte->delete();
        // Suppression des interactions de l'utilisateurs
        //TODO
        // Déconexion
        $this->deconnexion();
    }


}