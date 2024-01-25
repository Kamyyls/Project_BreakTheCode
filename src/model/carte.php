<?php

class carte
{
    private $id;
    private $question;
    private $image;


    /**
     * @param $id
     * @param $question
     */

    public function __construct($id, $question, $image)
    {
        $this->id = $id;
        $this->question = $question;
        $this->image=$image;
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
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    public function recupererLesCartes(){
        $lstCartes = get_results("SELECT * FROM carte");

        $Cartes = array();
        foreach ($lstCartes as $carteData) {
            $Carte = new carte(
                $carteData['id'],
                $carteData['question'],
                $carteData['image'],
                $carteData['image_cachee']
            );
            $Cartes[] = $Carte ;
        }

        return $Cartes;
    }

    public function generationDe6Cartes(&$allCartes){
        $cartes=[];
        for($i=0;$i<6;$i++){
            $x= rand(0,9);
            $cartes[]=$allCartes[$x];
            $allCartes=$this->deduitCartes($cartes,$allCartes);
        }
        return $cartes;
    }
    public function deduitCartes($cartesAdeduire, $allCartes) {

        if (!empty($cartesAdeduire) && is_array($cartesAdeduire) &&
            !empty($allCartes) && is_array($allCartes)) {

            foreach ($cartesAdeduire as $carteToRemove) {

                foreach ($allCartes as $index => $carte) {
                    if ($carte->getId() == $carteToRemove->getId()) {
                        unset($allCartes[$index]);
                        break;
                    }
                }
            }
            $allCartes = array_values($allCartes);
        }

        return $allCartes;
    }

    public function supprimeCartes($ImagecartesAdeduire, $Cartes, &$allCartes)
    {
        if(!empty($Cartes) && is_array($Cartes)) {
            foreach ($Cartes as $key => $carteToRemove) {
                if ($carteToRemove->getImage() == $ImagecartesAdeduire) {
                    // Supprime la carte de $Cartes
                    unset($Cartes[$key]);
                    // Ajoute la première carte de $allCartes à $Cartes
                    if(!empty($allCartes)){
                        $Cartes[] = $allCartes[0];
                    }
                    // Supprime la première carte de $allCartes
                    array_shift($allCartes);
                    break;
                }
            }
        }

        return $Cartes;
    }


}

