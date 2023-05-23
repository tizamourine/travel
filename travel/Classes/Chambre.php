<?php
class Chambre {
    private $idChambre = 0;
    private $idHotel = 0;
    private $typeChambre = null;
    private $description = null;
    private $numeroCh = 0;
    private $prix = 0;
    private $equipement = null;
    private $superficie = null;
    private $disponible = null;
    
     public function __construct(
        $idChambre = 0,
        $idHotel = null,
        $typeChambre = null,
        $description = null,
        $numeroCh = 0,
        $prix = null,
        $equipement = null,
        $superficie = null,
        $disponible = 1
        
    ) {
        $this->idChambre = $idChambre;
        $this->idHotel = $idHotel;
        $this->typeChambre = $typeChambre;
        $this->description = $description;
        $this->numeroCh = $numeroCh;
        $this->prix = $prix;
        $this->equipement = $equipement;
        $this->superficie = $superficie;
        $this->disponible = $disponible;
       
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

    public function setTypeChambre($typeChambre) {
        $this->typeChambre = $typeChambre;
    }

    public function getTypeChambre() {
        return $this->typeChambre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setNumeroCh($numeroCh) {
        $this->numeroCh = $numeroCh;
    }

    public function getNumeroCh() {
        return $this->numeroCh;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setEquipement($equipement) {
        $this->equipement = $equipement;
    }

    public function getEquipement() {
        return $this->equipement;
    }

    public function setSuperficie($superficie) {
        $this->superficie = $superficie;
    }

    public function getSuperficie() {
        return $this->superficie;
    }

    public function setDisponible($disponible) {
        $this->disponible = $disponible;
    }

    public function getDisponible() {
        return $this->disponible;
    }
}


