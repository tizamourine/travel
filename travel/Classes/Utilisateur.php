<?php
class Utilisateur {
    private $idUtilisateur = 0;
    private $nom = null;
    private $prenom = null;
    private $email = null;
    private $mdp = null;
    private $session = null;
    private $numTel = 0;
    private $photo = null;
    private $sexe = null;
    
    
     public function __construct(
        $idUtilisateur = 0,
        $nom = null,
        $prenom = null,
        $email = null,
        $mdp = null,
        $session = null,
        $numTel = 0,
        $photo = null,
        $sexe = null
    ) {
        $this->idUtilisateur = $idUtilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->session = $session;
        $this->numTel = $numTel;
        $this->photo = $photo;
        $this->sexe = $sexe;
       
    }

    // Getters
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getSession() {
        return $this->session;
    }

    public function getNumTel() {
        return $this->numTel;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getSexe() {
        return $this->sexe;
    }

    // Setters
    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function setSession($session) {
        $this->session = $session;
    }

    public function setNumTel($numTel) {
        $this->numTel = $numTel;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    // Méthodes
    public function connexion($date, $CSRFToken) {
        // Implémentez la logique de connexion ici
    }
}
?>




