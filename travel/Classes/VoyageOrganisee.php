<?php
class VoyageOrganisee {
    private $idVoyage = 0;
    private $description = null;
    private $transport = null;
    private $destination = null;
    private $iteneraire = null;
    private $prixDefault = 0;
    private $nbrPlaces = 0;
    private $equipement = null;
    private $prixAdulte = 0;
    private $prixEnfnts = 0;
    private $prixBebe = 0;
    private $image = null;
    private $heureDepart = null;
    private $dateD = null;
    
    
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
        $prixEnfnts=0,
        $prixBebe=0,
        $heureDepart=null,
        $dateD=null
    ) {
        $this->idVoyage = $idVoyage;
        $this->description = $description;
        $this->transport = $transport;
        $this->destination = $destination;
        $this->iteneraire = $iteneraire;
        $this->prixDefault = $prixDefault;
        $this->nbrPlaces = $nbrPlaces;
        $this->equipement = $equipement;
        $this->prixAdulte = $prixAdulte;
        $this->prixEnfnts=$prixEnfnts;
        $this->prixBebe=$prixBebe;
        $this->heureDepart=$heureDepart;
        $this->dateD=$dateD;
       
    }

    public function setIdVoyage($idVoyage) {
        $this->idVoyage = $idVoyage;
    }

    public function getIdVoyage() {
        return $this->idVoyage;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setTransport($transport) {
        $this->transport = $transport;
    }

    public function getTransport() {
        return $this->transport;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function setIteneraire($iteneraire) {
        $this->iteneraire = $iteneraire;
    }

    public function getIteneraire() {
        return $this->iteneraire;
    }

    public function setPrixDefault($prixDefault) {
        $this->prixDefault = $prixDefault;
    }

    public function getPrixDefault() {
        return $this->prixDefault;
    }

    public function setNbrPlaces($nbrPlaces) {
        $this->nbrPlaces = $nbrPlaces;
    }

    public function getNbrPlaces() {
        return $this->nbrPlaces;
    }

    public function setEquipement($equipement) {
        $this->equipement = $equipement;
    }

    public function getEquipement() {
        return $this->equipement;
    }

    public function setPrixAdulte($prixAdulte) {
        $this->prixAdulte = $prixAdulte;
    }

    public function getPrixAdulte() {
        return $this->prixAdulte;
    }

    public function setPrixEnfnts($prixEnfnts) {
        $this->prixEnfnts = $prixEnfnts;
    }

    public function getPrixEnfnts() {
        return $this->prixEnfnts;
    }

    public function setPrixBebe($prixBebe) {
        $this->prixBebe = $prixBebe;
    }

    public function getPrixBebe() {
        return $this->prixBebe;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public function setHeureDepart($heureDepart) {
        $this->heureDepart = $heureDepart;
    }

    public function getHeureDepart() {
        return $this->heureDepart;
    }

    public function setDateD($dateD) {
        $this->dateD = $dateD;
    }

    public function getDateD() {
        return $this->dateD;
    }
    
     public function calculerPrix($nbrEnfant, $nbrAdulte, $nbrBebe, $prixChambre=0) {
        // Ici, vous pouvez ajouter la logique pour sélectionner les voyages organisés en fonction des prix min et max.
        // Pour l'instant, cette méthode est vide.
        return $this->getPrixDefault()+($this->getPrixAdulte()*$nbrAdulte)+($this->getPrixEnfnts()*$nbrEnfant)+($this->getPrixBebe()*$nbrBebe)+$prixChambre;
    }
}


