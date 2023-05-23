<?php
require_once 'Utilisateur.php';
class credit{
    private $idClient = 0;
    private $numero = 0;
    private $dateExpiration = null;
    private $cvv=0;
    public Utilisateur $parent;
    
     public function __construct(
        $idClient = 0,
        $numero = null,
        $cvv = null,
        $dateExpiration = null    
      
    ) {
         
        $this->idClient = $idClient;
        $this->numero = $numero;
        $this->cvv = $cvv;
        $this->dateExpiration = $dateExpiration;
     
    }

    // Getters
    public function getIdClient() {
        return $this->idClient;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getCvv() {
        return $this->cvv;
    }
    public function getDateExpiration() {
        return $this->dateExpiration;
    }

    // Setters
    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function setNumero($numeo) {
        $this->numero = $numero;
    }

    public function setCvv($cvv) {
        $this->cvv = $cvv;
    }
    public function setDateExpiration($dateExpiration) {
        $this->dateExpiration = $dateExpiration;
    }

}
?>


