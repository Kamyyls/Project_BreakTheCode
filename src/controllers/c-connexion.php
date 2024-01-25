<?php

require_once('src/model/global.php');
require_once ('src/controllers/c-choixPremierJoueur.php');
require_once ('src/model/user.php');


function connexion() {
    $menu['page'] = "connexion";

    require('view/inc/inc.head.php');
    require('view/v-connexion.php');
    require('view/inc/inc.footer.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['connexion'])) {
            $pseudo = $_POST['pseudo_Joueur_connexion'];
            $mdp = $_POST['mdp_Joueur_connexion'];
            $User = new user();
            $_SESSION['pseudo']=$pseudo;
            $_SESSION['mdp']=$mdp;
            $User->Connexion($pseudo,$mdp);
        }
    }
}
