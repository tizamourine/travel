<?php
require_once 'Utilisateur.php';
class Client extends Utilisateur{
    private $idClient = 0;
    private $identite = 0;
    private $numIdentite=0;
    private $idAgent=0;
    public Utilisateur $parent;
     public function __construct(
        $idClient = 0,
        $nom = null,
        $prenom = null,
        $email = null,
        $mdp = null,
        $session = null,
        $numTel = 0,
        $photo = null,
        $sexe = null,
        $identite = null,
        $numIdentite = null,
        $idAgent= null
    ) {
        $this->parent = new Utilisateur($idClient,$nom,$prenom,$email,$mdp ,$session,$numTel,$photo,$sexe);
        $this->idClient = $idClient;
        $this->identite = $identite;
        $this->numIdentite = $numIdentite;
        $this->idAgent= $idAgent;
    }
    
    // Getters
    public function getIdClient() {
        return $this->idClient;
    }
    public function getIdAgent() {
        return $this->idAgent;
    }
    public function getIdentite() {
        return $this->identite;
    }

    public function getNumIdentite() {
        return $this->numIdentite;
    }

    // Setters
    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }
    public function setIdAgent($idAgent) {
        $this->idAgent = $idAgent;
    }
    public function setIdentite($identite) {
        $this->identite = $identite;
    }

    public function setNumIdentite($numIdentite) {
        $this->numIdentite = $numIdentite;
    }

    // Méthodes
    public function consulterR() {
        // Implémentez la logique de consulterR ici
        return array();
    }

    public function rechercherH($ville, $dateD, $dateF, $numA, $numE) {
        // Implémentez la logique de rechercherH ici
    }
    public function rechervherV($ville,$dateD,$dateR,$type,$transport) {
        
    }
    public function afficherNReservations(){
        echo count($this->consulterR());
    }
    public function modifierInfo() {
        
    }
    
    public function desabonner() {
        
    }
    
    public function annulerR($reservation) {
        
    }
}
?>



