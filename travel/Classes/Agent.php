<?php
require_once 'Utilisateur.php';
require_once __DIR__.'/../Classe-db.php';
class Agent extends Utilisateur{
    private $idAgent = 0;
    private $salaire = 0;
    private $grade = null;
    public Utilisateur $parent;
    private $bdd;
    
     public function __construct(
        $idAgent = 0,
        $nom = null,
        $prenom = null,
        $email = null,
        $mdp = null,
        $session = null,
        $numTel = 0,
        $photo = null,
        $sexe = null,
        $salaire = 0,
        $grade = null    
      
    ) {
        $this->parent = new Utilisateur($idAgent,$nom,$prenom,$email,$mdp,$session,$numTel,$photo,$sexe); 
        $this->idAgent = $idAgent;
        $this->salaire = $salaire;
        $this->grade = $grade;
        $this->bdd = new BD();
     
    }

    // Getters
    public function getIdAgent() {
        return $this->idAgent;
    }

    public function getSalaire() {
        return $this->salaire;
    }

    public function getGrade() {
        return $this->grade;
    }

    // Setters
    public function setIdAgent($idAgent) {
        $this->idAgent = $idAgent;
    }

    public function setSalaire($salaire) {
        $this->salaire = $salaire;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }

    // Méthodes
    public function afficherLClient() {
        return $this->bdd->recupererAClient($this->getIdAgent());
    }
    public function afficherNClient() {
        return count($this->bdd->recupererAClient($this->getIdAgent()));
    }
    public function consulterReservation($client) {
        // Implémentez la logique de consulterReservation ici
    }
}
?>


