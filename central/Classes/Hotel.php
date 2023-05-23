<?php
require_once __DIR__.'/../Classe-db.php';
class Hotel {
    private $idHotel = 0;
    private $nomHotel = null;
    private $adresse = null;
    private $etoiles = null;
    private $numTel = 0;
    private $ville = null;
    private $coordonne = null;
    private $bdd;
    
       public function __construct(
        $idHotel = 0,
        $nomHotel = null,
        $adresse = null,
        $etoiles = null,
        $numTel = 0,
        $ville = null,
        $coordonne = null
       
    ) {
        $this->idHotel = $idHotel;
        $this->nomHotel = $nomHotel;
        $this->adresse = $adresse;
        $this->etoiles = $etoiles;
        $this->numTel = $numTel;
        $this->ville = $ville;
        $this->coordonne = $coordonne;
        $this->bdd = new BD();
       
    }

    public function setIdHotel($idHotel) {
        $this->idHotel = $idHotel;
    }

    public function getIdHotel() {
        return $this->idHotel;
    }

    public function setNomHotel($nomHotel) {
        $this->nomHotel = $nomHotel;
    }

    public function getNomHotel() {
        return $this->nomHotel;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setEtoiles($etoiles) {
        $this->etoiles = $etoiles;
    }

    public function getEtoiles() {
        return $this->etoiles;
    }

    public function setNumTel($numTel) {
        $this->numTel = $numTel;
    }

    public function getNumTel() {
        return $this->numTel;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setCoordonne($coordonne) {
        $this->coordonne = $coordonne;
    }

    public function getCoordonne() {
        return $this->coordonne;
    }

    // Ajoutez ici la méthode souhaitée
      public function selectionnerP( $prixMin, $prixMax) {
 
    }
       public function selectionnerChDisp( ) {
       
    }
    public function nombreChambre(){
        return $this->bdd->nombreChambre($this->getIdHotel());
    }
}


