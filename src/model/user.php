<?php
require_once ('src/model/global.php');
class user
{
    public function Connexion($pseudo,$mdp) {
        global $pdo;
        $hashedPassWord= hash("sha256",$mdp);
        $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = ? ");
        $requete->execute([$pseudo]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
        if ($hashedPassWord===$utilisateur["mdp"]) {
            header("Location: https://s5-gp2.kevinpecro.info/accueilUtilisateur");
            exit;
        } else {
            echo "L'authentification a échoué. Veuillez vérifier vos informations d'identification.";
            return false;
        }
    }

    public function inscription($nom, $prenom, $pseudo,$mdp, $email, $date_naissance)
    {
        global $pdo;
        $request = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = ? and email= ?");
        $request->execute([$pseudo, $email]);
        $resultat = $request->fetch(PDO::FETCH_ASSOC);
         echo "here we go";
        if (!$resultat) {
            $requete = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, pseudo,mdp, email, date_naissance) 
           VALUES (?, ?, ?, ?, ?,?)");
            if ($requete) {
                $res = $requete->execute([$nom, $prenom, $pseudo, $mdp, $email, $date_naissance]);
                if ($res) {
                    header("Location: https://s5-gp2.kevinpecro.info/connexion");
                } else {
                    echo "Erreur lors de l'insertion dans la base de données";
                }
            } else {
                echo "Erreur lors de la préparation de la requête SQL";
            }
        }
        else{
            echo "compte avec ce pseudo existe déjà";
        }
    }
    public function Suppression($email) {
        global $pdo;
        $requete = $pdo->prepare("DELETE FROM  utilisateur WHERE email= ?");
        $requete->execute([$email]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
        if ($utilisateur) {
            echo "Votre compte à bien été supprimer";
            header("Location: https://s5-gp2.kevinpecro.info/accueilUtilisateur");
            exit;
        } else {
            echo "Problème survenu lors de la suppression";
            return false;
        }
    }

    public function incrementeNombrePartieUser($pseudo){
        global $pdo;
        $requete = $pdo->prepare("Update utilisateur set nb_parties=nb_parties+1 WHERE pseudo= ?");
        $requete->execute([$pseudo]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
        if($utilisateur){
            Recuperation($pseudo);
        }

    }
    public function Recuperation($pseudo) {
        global $pdo;
        $requete = $pdo->prepare("select pseudo,date_naissance,nb_parties,nb_victoirs from  utilisateur where  pseudo= ?");
        $requete->execute([$pseudo]);
       return $requete->fetch(PDO::FETCH_ASSOC);
    }
}