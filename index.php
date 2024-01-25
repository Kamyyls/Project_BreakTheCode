<?php
require_once('src/controllers/c-accueil.php');
require_once('src/controllers/c-choixPremierJoueur.php');
require_once('src/controllers/c-inscription.php');
require_once('src/controllers/c-connexion.php');
require_once('src/controllers/c-regles.php');
require_once('src/controllers/c-accueilUtilisateur.php');
require_once('src/controllers/c-profil.php');
require_once('src/controllers/c-partie.php');
require_once('src/controllers/c-historique.php');
session_start();
if(isset($_GET['url']) && $_GET['url']) {
    $url = rtrim($_GET['url'], '/');
    if ($url) {
        switch ($url) {
            case 'choixPremierJoueur':
                choixPremierJoueur();
                break;
            case 'connexion':
                connexion();
                break;
            case 'inscription':
                inscription();
                break;
            case 'accueilUtilisateur':
                accueilUtilisateur();
                break;
            case 'regles':
                regles();
                break;
            case 'profil':
                profil();
                break;
            case 'historique':
                 historique();
                 break;
            case 'partie':
                partie();
                break;
            default:
                accueil();
                break;
        }
    }else
        accueil();
} else
    accueil();

?>