<?php
class Reservation {
    private $idReservation = 0;
    private $status = null;
    private $typePaiement = null;
    private $informationSup = null;
    private $prix = 0;
    private $date = null;
    private $progression = null;
    private $idClient = 0;
    private $idAgent = 0;
    private $idHotel = 0;
    private $idVoyage = 0;
    
    public function __construct(
        $idReservation = 0,
        $status = null,
        $typePaiement = null,
        $informationSup = null,
        $prix = 0,
        $date = null,
        $progression = null,
        $idClient = 0,
        $idAgent = 0,
        $idHotel = 0,
        $idVoyage = 0
    ) {
        $this->idReservation = $idReservation;
        $this->status = $status;
        $this->typePaiement = $typePaiement;
        $this->informationSup = $informationSup;
        $this->prix = $prix;
        $this->date = $date;
        $this->progression = $progression;
        $this->idClient = $idClient;
        $this->idAgent = $idAgent;
        $this->idHotel = $idHotel;
        $this->idVoyage = $idVoyage;
    }

    public function getIdReservation() {
        return $this->idReservation;
    }

    public function setIdReservation($idReservation) {
        $this->idReservation = $idReservation;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getTypePaiement() {
        return $this->typePaiement;
    }

    public function setTypePaiement($typePaiement) {
        $this->typePaiement = $typePaiement;
    }

    public function getInformationSup() {
        return $this->informationSup;
    }

    public function setInformationSup($informationSup) {
        $this->informationSup = $informationSup;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getProgression() {
        return $this->progression;
    }

    public function setProgression($progression) {
        $this->progression = $progression;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getIdAgent() {
        return $this->idAgent;
    }

    public function setIdAgent($idAgent) {
        $this->idAgent = $idAgent;
    }

    public function getIdHotel() {
        return $this->idHotel;
    }

    public function setIdHotel($idHotel) {
        $this->idHotel = $idHotel;
    }

    public function getIdVoyage() {
        return $this->idVoyage;
    }

    public function setIdVoyage($idVoyage) {
        $this->idVoyage = $idVoyage;
    }
}


