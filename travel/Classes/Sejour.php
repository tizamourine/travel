<?php
require_once 'VoyageOrganisee.php';
require_once __DIR__.'/../Classe-db.php';
class Sejour extends VoyageOrganisee{
    private $idSejour = 0;
    private $dateR = null;
    private $nbrJours = 0;
    private $idHotel = 0;
    private $bdd;
    public VoyageOrganisee $parent;
       public function __construct(
        $idVoyage = 0,
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
        $dateR = null,
        $nbrJours = null,
        $idHotel = null   
    
    ) {
        $this->parent = new VoyageOrganisee($idVoyage,$description,$transport,$destination,$iteneraire,$prixDefault,$nbrPlaces,$equipement,$prixAdulte,$prixEnfnts,$prixBebe,$heureDepart,$dateD);   
        $this->idSejour = $idVoyage;
        $this->dateR = $dateR;
        $this->nbrJours = $nbrJours;
        $this->idHotel = $idHotel;
        $this->bdd = new BD();
    }

    public function setIdVoyage($idSejour) {
        $this->idSejour = $idSejour;
    }

    public function getIdSejour() {
        return $this->idSejour;
    }

    public function setDateR($dateR) {
        $this->dateR = $dateR;
    }

    public function getDateR() {
        return $this->dateR;
    }

    public function setNbrJours($nbrJours) {
        $this->nbrJours = $nbrJours;
    }

    public function getNbrJours() {
        return $this->nbrJours;
    }

    public function setIdHotel($idHotel) {
        $this->idHotel = $idHotel;
    }

    public function getIdHotel() {
        return $this->idHotel;
    }
    public function recupererHotel(){
        return $this->bdd->recupererHotel($this->getIdHotel());
    }

   
}


