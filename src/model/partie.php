<?php
require_once('src/model/tuile.php');
require_once('src/controllers/c-choixPremierJoueur.php');

class partie
{
    private $id;
    private $idUtilisateur;
    private $premierJoueur;
    private $dateDebut;
    private $dateFin;
    private $resultat;
    private $tuileJoueur = array();
    private $tuileIa = array();

    /**
     * @param $id
     * @param $idUtilisateur
     * @param $premierJoueur
     * @param $dateDebut
     * @param array $tuileJoueur
     * @param array $tuileIa
     */
    public function __construct($id, $idUtilisateur, $premierJoueur, $dateDebut, $dateFin, array $tuileJoueur, array $tuileIa)
    {
        $this->id = $id;
        $this->idUtilisateur = $idUtilisateur;
        $this->premierJoueur = $premierJoueur;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->tuileJoueur = $tuileJoueur;
        $this->tuileIa = $tuileIa;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @param mixed $idUtilisateur
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getPremierJoueur()
    {
        return $this->premierJoueur;
    }

    /**
     * @param mixed $premierJoueur
     */
    public function setPremierJoueur($premierJoueur)
    {
        $this->premierJoueur = $premierJoueur;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * @param mixed $resultat
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;
    }

    /**
     * @return array
     */
    public function getTuileJoueur()
    {
        return $this->tuileJoueur;
    }

    /**
     * @param array $tuileJoueur
     */
    public function setTuileJoueur($tuileJoueur)
    {
        $this->tuileJoueur = $tuileJoueur;
    }

    /**
     * @return array
     */
    public function getTuileIa()
    {
        return $this->tuileIa;
    }

    /**
     * @param array $tuileIa
     */
    public function setTuileIa($tuileIa)
    {
        $this->tuileIa = $tuileIa;
    }

    /**
     * @return mixed
     */

    //Insertion des données dans la table partie
    public function insertPartie($premierJoueur, $dateDebut, $dateFin, $tuileJoueur, $tuileIa)
    {
        global $pdo;

        $query = "INSERT INTO partie (premier_joueur, date_debut, date_fin, tuile_joueur, tuile_ia) 
              VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $premierJoueur);
        $stmt->bindParam(2, $dateDebut);
        $stmt->bindParam(3, $dateFin);
        $stmt->bindParam(4, $tuileJoueur);
        $stmt->bindParam(5, $tuileIa);
        // Exécution de la requête
        $stmt->execute();
    }

    public function ouSontTesCinqTuiles($tuilesJoueur): string
    {
        $positionsTuiles5 = [];
        $i = 1;

        foreach ($tuilesJoueur as $tuile) {
            if ($tuile->getNumero() == 5) {
                $positionsTuiles5[$i] = $tuile->getPosition();
                $i++;
            }
        }
        if(count($positionsTuiles5)==2){
            return "J'ai des tuiles 5 aux positions " . $positionsTuiles5[1] . " et " . $positionsTuiles5[2];
        }
        else if(count($positionsTuiles5)==1){
            return "J'ai une tuile 5 à la position " . $positionsTuiles5[1];

        }
        else{
             return "je n'ai pas de tuile 5";
        }

    }

    public function ouSontTesTuilesUnOuDeux($tuilesJoueur,$unOuDeux): string
    {
        $positionsTuilesUnOuDeux = [];
        $i = 1;

        foreach ($tuilesJoueur as $tuile) {
            if ($tuile->getNumero() == $unOuDeux) {
                $positionsTuilesUnOuDeux[$i] = $tuile->getPosition();
                $i++;
            }
        }
        if(count($positionsTuilesUnOuDeux)==2){
            return "J'ai des tuiles ".$unOuDeux." aux positions " . $positionsTuilesUnOuDeux[1] . " et " . $positionsTuilesUnOuDeux[2];
        }
        else if(count($positionsTuilesUnOuDeux)==1){
            return "J'ai une tuile ".$unOuDeux." à la position ".$positionsTuilesUnOuDeux[1];

        }
        else{
            return "je n'ai pas de tuile ".$unOuDeux;
        }

    }


    public function deroulementJeu(){
        //initialisation
        $tuile = new tuile(1,1,1,"carte_gris_1.png");
        $premierJoueur=recupererPremierJoueur();
        $carte = new carte();
        $allTuiles=$tuile->recupererLesTuiles();
        $tuilesPremierJoueur = $tuile->generationDe5Tuiles($allTuiles);
        $tuilesRestantes =$tuile->deduitTuiles($tuilesPremierJoueur,$allTuiles);
        $tuilesSecondJoueur = $tuile->generationDe5Tuiles($tuilesRestantes);
        $allCartes= $carte->recupererLesCartes();
        $cartes = $carte->generationDe6Cartes($allCartes);

    }


}