<?php
require_once('src/model/global.php');
require_once('src/model/carte.php');
require_once('src/model.php');
require_once('src/model/tuile.php');
require_once ('src/model/partie.php');
require_once ('src/controllers/c-connexion.php');
require_once ('src/model/global.php');
require_once ('src/model/Database.php');

function partie(){
        if(!isset($_SESSION['pseudo']) || !isset($_SESSION['mdp'])){
            connexion();
        }
        else{
            $menu['page'] = "partie";
            //Traitement
            $valeur_Carte = null;
            $reponse=null;
            $tuileO = [];
            $tuileJ = [];
            $date = date("Y-m-d H:i:s");
            $tuile = new tuile(1, 1, 1, "carte_gris_1.png");
            $carte = new carte(1, "hello", "carte_gris_1.png", "carte.png");
            $partie = new partie(1, 2, "hakim", "10/03/2003", "10/03/2003", $tuileJ, $tuileO);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['button-carte'])) {
                    $valeur_Carte = $_POST['button-carte'];

                    //cas de la question où sont tes tuiles 5 ?
                    if($valeur_Carte=="Carte_17.png"){
                        $reponse=$partie->ouSontTesCinqTuiles($_SESSION['tuilesJoueur']);
                    }

                    // cas de la où sont tes tuiles 1 ou 2 ?
                    else if($valeur_Carte=="Carte_13.png"){
                        $reponse = "Pour quel chiffre, le 1 ou le 2?";
                        if (isset($_POST['soumettre'])) {
                            $reponseJoueur = intval($_POST['reponseJoueur']);
                            var_dump($_POST['reponseJoueur']);
                            if ($reponseJoueur == 1 || $reponseJoueur == 2) {
                                $reponse = $partie->traiterReponseJoueur($reponseJoueur);
                            } else {
                                $reponse = "Vous devez répondre par 1 ou 2";
                            }
                        } else {
                            $reponse = "Soumettez votre réponse";
                        }
                    }
                    $_SESSION['cartes'] = $carte->supprimeCartes($valeur_Carte, $_SESSION['cartes'], $_SESSION['allCartes']);

                }
            }
            if (isset($_SESSION['allTuiles']) && $_SESSION['allTuiles']) {
                $_SESSION['allTuiles'] = $_SESSION['allTuiles'];
                $_SESSION['tuilesJoueur'] = $_SESSION['tuilesJoueur'];
                $partie->setTuileJoueur($_SESSION['tuilesJoueur']);
                $_SESSION['tuilesRestantes'] = $_SESSION['tuilesRestantes'];
                $_SESSION['tuilesRobot'] = $_SESSION['tuilesRobot'];
                $partie->setTuileIa($_SESSION['tuilesRobot']);
                $_SESSION['allCartes'] = $_SESSION['allCartes'];
                $_SESSION['cartes'] = $_SESSION['cartes'];
                $partie->setPremierJoueur($_SESSION['premierJoueur']);

            } else {
                if($_SESSION['premierJoueur'] =='human'){
                    echo "toi";
                    $_SESSION['allTuiles'] = $tuile->recupererLesTuiles();
                    $_SESSION['tuilesJoueur'] = $tuile->generationDe5Tuiles($_SESSION['allTuiles']);
                    $partie->setTuileJoueur($_SESSION['tuilesJoueur']);
                    $_SESSION['tuilesRestantes'] = $tuile->deduitTuiles($_SESSION['tuilesJoueur'], $_SESSION['allTuiles']);
                    $_SESSION['tuilesRobot'] = $tuile->generationDe5Tuiles($_SESSION['tuilesRestantes']);
                    $partie->setTuileIa($_SESSION['tuilesRobot']);
                }
                else{
                    $_SESSION['allTuiles'] = $tuile->recupererLesTuiles();
                    $_SESSION['tuilesRobot'] = $tuile->generationDe5Tuiles($_SESSION['allTuiles']);
                    $partie->setTuileJoueur($_SESSION['tuilesRobot']);
                    $_SESSION['tuilesRestantes'] = $tuile->deduitTuiles($_SESSION['tuilesRobot'], $_SESSION['allTuiles']);
                    $_SESSION['tuilesJoueur'] = $tuile->generationDe5Tuiles($_SESSION['tuilesRestantes']);
                    $partie->setTuileIa($_SESSION['tuilesJoueur']);
                }
                $_SESSION['allCartes'] = $carte->recupererLesCartes();
                $_SESSION['cartes'] = $carte->generationDe6Cartes($_SESSION['allCartes']);
            }

            $partie->insertPartie($partie->getPremierJoueur(), $date, $date, $partie->getTuileJoueur(), $partie->getTuileIa());

            require('view/inc/inc.head.php');
            require('view/inc/inc.header.php');
            require('view/v-partie.php');
            require('view/inc/inc.footer.php');
        }

}
