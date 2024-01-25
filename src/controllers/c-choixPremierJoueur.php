<?php

require_once('src/model/global.php');

function choixPremierJoueur() {

    $menu['page'] = "choixPremierJoueur";
    require ('view/inc/inc.head.php');
    require ('view/inc/inc.header.php');
    require ('view/v-choixPremierJoueur.php');
    require ('view/inc/inc.footer.php');
    recupererPremierJoueur();
}

function recupererPremierJoueur()
{
    $premierJoueur = 'robot';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['human'])) {
            $premierJoueur = $_POST['human'];
        } else if (isset($_POST['robot'])) {
            $premierJoueur = $_POST['robot'];
        }
        $_SESSION['premierJoueur']=$premierJoueur;
        header("Location: https://s5-gp2.kevinpecro.info/partie?premierJoueur=" . urlencode($premierJoueur));
        exit;
    }
}