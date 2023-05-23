<?php
class Contact {
    private $idMessage;
    private $idSource = 0;
    private $idDestinataire = 0;
    private $objet = null;
    private $contenu = null;
    private $date = null;
    private $lu = null;
    
      public function __construct(
        $idMessage = 0,
        $idSource = 0,
        $idDestinataire = null,
        $objet = null,
        $contenu = null,
        $date = null,
        $lu = 0
       
    ) {
        $this->idSource = $idSource;
        $this->idDestinataire = $idDestinataire;
        $this->objet = $objet;
        $this->contenu = $contenu;
        $this->date = $date;
        $this->lu = $lu;
        $this->idMessage=$idMessage;
       
       
    }

    // Getters
    public function getIdSource() {
        return $this->idSource;
    }
    public function getIdMessage() {
        return $this->idMessage;
    }

    public function getIdDestinataire() {
        return $this->idDestinataire;
    }

    public function getObjet() {
        return $this->objet;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLu() {
        return $this->lu;
    }

    // Setters
    public function setIdSource($idSource) {
        $this->idSource = $idSource;
    }
    public function setIdMessage($idMessage) {
        $this->idMessage = $idMessage;
    }
    public function setIdDestinataire($idDestinataire) {
        $this->idDestinataire = $idDestinataire;
    }

    public function setObjet($objet) {
        $this->objet = $objet;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setLu($lu) {
        $this->lu = $lu;
    }
}
?>


