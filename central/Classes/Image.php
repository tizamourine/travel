<?php
class Image {
    private $idImage = 0;
    private $idChambre = 0;
    private $idHotel = 0;
    private $idVoyage = null;
    private $image = null;
    
     public function __construct(
        $idImage = 0,
        $idChambre = 0,
        $idHotel = 0,
        $idVoyage = 0,
        $image = null
        
    ) {
        $this->idImage = $idImage;
        $this->idChambre = $idChambre;
        $this->idHotel = $idHotel;
        $this->idVoyage = $idVoyage;
        $this->image = $image;
       
    }

    public function setIdChambre($idChambre) {
        $this->idChambre = $idChambre;
    }

    public function getIdChambre() {
        return $this->idChambre;
    }

    public function setIdHotel($idHotel) {
        $this->idHotel = $idHotel;
    }

    public function getIdHotel() {
        return $this->idHotel;
    }

    public function setIdVoyage($IdVoyage) {
        $this->idVoyage = $IdVoyage;
    }

    public function getIdVoyage() {
        return $this->idVoyage;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }
    public function setIdImage($idImage) {
        $this->idImage = $idImage;
    }

    public function getIdImage() {
        return $this->idImage;
    }


}


