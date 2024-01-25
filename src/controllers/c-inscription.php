<?php

require_once('src/model/global.php');

function inscription() {
    $regex = '/^(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/';
    $menu['page'] = "inscription";

    require('view/inc/inc.head.php');
    require('view/v-inscription.php');
    require('view/inc/inc.footer.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['inscription'])) {
            $nom = $_POST['nomJoueur_inscription'];
            $prenom = $_POST['prenomJoueur_inscription'];
            $pseudo = $_POST['pseudoJoueur_inscription'];
            $mdp =$_POST['mdpJoueur_inscription'];
            $mdp2 =$_POST['mdpConfirmationJoueur_inscription'];
            $email = $_POST['emailJoueur_inscription'];
            $date_naissance = $_POST['dateJoueur_inscription'];
            $hashPassWord= hash ("sha256",$mdp);
            if($mdp == $mdp2){
                if (preg_match($regex, $mdp)){
                    $User = new user();
                    $User->Inscription($nom, $prenom, $pseudo,$hashPassWord, $email, $date_naissance);
                }
                else{
                    echo "Format du mot de passe non respecté";
                }
            }
            else{
                echo "erreur saisie mot de passe: ";
            }



        }
    }
}