<?php
require_once 'VoyageOrganisee.php';
class Excursion extends VoyageOrganisee{
    private $idExcursion = 0;
    private $heureRetour = null;
    public $parent;
        public function __construct(
            $idExcursion = 0,
            $description = null,
            $transport = null,
            $destination = null,
            $iteneraire = null,
            $prixDefault = 0,
            $nbrPlaces = 0,
            $equipement = null,
            $prixAdulte = 0,
            $prixEnfnts = 0,
            $prixBebe = 0,
            $heureDepart = null,
            $dateD = null,
            $heureRetour = null       
       
    ) {
        $this->parent = new VoyageOrganisee($idExcursion,$description,$transport,$destination,$iteneraire,$prixDefault,$nbrPlaces,$equipement,$prixAdulte,$prixEnfnts,$prixBebe,$heureDepart,$dateD);
        $this->idExcursion = $idExcursion;
        $this->heureRetour = $heureRetour;
     
       
       
    }

    public function setIdExcursion($idExcursion) {
        $this->setIdExcursion = $idExcursion;
    }

    public function getIdExcursion() {
        return $this->idExcursion;
    }

    public function setHeureRetour($heureRetour) {
        $this->heureRetour = $heureRetour;
    }

    public function getHeureRetour() {
        return $this->heureRetour;
    }
}


