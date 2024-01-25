<?php
require_once('src/model.php');

Class tuile
{
    private $id;
    private $numero;
    private $id_couleur;
    private $image;
    private $position;

    /**
     * @param $id
     * @param $numero
     * @param $id_couleur
     * @param $image
     */
    public function __construct($id, $numero, $id_couleur, $image)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->id_couleur = $id_couleur;
        $this->image = $image;
    }

    /**
 * @param $id
 * @param $numero
 * @param $id_couleur
     * @param $image
     */


    public function __constructSansParametre(){

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
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getIdCouleur()
    {
        return $this->id_couleur;
    }

    /**
     * @param mixed $id_couleur
     */
    public function setIdCouleur($id_couleur)
    {
        $this->id_couleur = $id_couleur;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }


    public function recupererLesTuiles()
    {
        $lstTuiles = get_results("SELECT * FROM tuile");

        $tuiles = array();
        foreach ($lstTuiles as $tuileData) {
            $tuile = new Tuile(
                $tuileData['id'],
                $tuileData['numero'],
                $tuileData['id_couleur'],
                $tuileData['image']
            );
            $tuiles[] = $tuile;
        }

        return $tuiles;
    }


    // les 5 tuiles du joeur ou de l'ordi

    public function generationDe5Tuiles($allTuiles){
        $tuiles=[];
        for($i=0;$i<5;$i++){
            $x= rand(0,9);
            $tuiles[]=$allTuiles[$x];
            $allTuiles=$this->deduitTuiles($tuiles,$allTuiles);
        }
        // Tri des tuiles générées
        usort($tuiles, array($this, 'comparerTuiles'));
        for($i=0;$i<count($tuiles);$i++){
            $tuiles[$i]->setPosition($this->chiffreVersLettre($i+1));
        }
        return $tuiles;
    }

    function chiffreVersLettre($chiffre) {
        // Tableau associatif chiffre à lettre
        $correspondance = [
            1 => 'a',
            2 => 'b',
            3 => 'c',
            4 => 'd',
            5 => 'e'
        ];

        // Vérifier si le chiffre est dans le tableau
        return isset($correspondance[$chiffre]) ? $correspondance[$chiffre] : "Non applicable";
    }

    // Fonction de comparaison pour trier les tuiles
    public function comparerTuiles($tuile1, $tuile2)
    {
        // Comparaison par numéro
        if ($tuile1->getNumero() < $tuile2->getNumero()) {
            return -1;
        } elseif ($tuile1->getNumero() > $tuile2->getNumero()) {
            return 1;
        } else {
            // Les tuiles ont le même numéro, tri par couleur
            if ($tuile1->getIdCouleur() < $tuile2->getIdCouleur()) {
                return -1;
            } elseif ($tuile1->getIdCouleur() > $tuile2->getIdCouleur()) {
                return 1;
            } else {
                return 0;
            }
        }
    }


    public function deduitTuiles($tuilesAdeduire, $allTuiles) {

        if (!empty($tuilesAdeduire) && is_array($tuilesAdeduire) &&
            !empty($allTuiles) && is_array($allTuiles)) {

            foreach ($tuilesAdeduire as $tuileToRemove) {

                foreach ($allTuiles as $index => $tuile) {
                    if ($tuile->getNumero() == $tuileToRemove->getNumero() &&
                        $tuile->getIdCouleur() == $tuileToRemove->getIdCouleur()) {
                        unset($allTuiles[$index]);
                        break;
                    }
                }
            }
            $allTuiles = array_values($allTuiles);
        }

        return $allTuiles;
    }


}