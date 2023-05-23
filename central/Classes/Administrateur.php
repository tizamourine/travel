<?php
require_once 'Agent.php';
require_once __DIR__.'/../Classe-db.php';
class Administrateur extends Utilisateur {
    private $idAdministrateur = 0;
    public Agent $parent;
    private $bdd;
     public function __construct(
        $idAdministrateur = 0,
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
        $this->parent = new Agent($idAdministrateur,$nom,$prenom,$email,$mdp,$session,$numTel,$photo,$sexe,$salaire,$grade);
        $this->idAdministrateur = $idAdministrateur;
        $this->bdd = new BD();
       
    }

    // Getters
    public function getIdAdministrateur() {
        return $this->idAdministrateur;
    }

    // Setters
    public function setIdAdministrateur($idAdministrateur) {
        $this->idAdministrateur = $idAdministrateur;
    }

    // Méthodes
    public function ajouterA($agent) {
        // Implémentez la logique d'ajouterA ici
    }

    public function modifierA($agent) {
        // Implémentez la logique de modifierA ici
    }

    public function supprimerAgent($agent) {
        // Implémentez la logique de supprimerAgent ici
    }

    public function supprimerClient($client) {
        // Implémentez la logique de supprimerClient ici
    }

    public function consulterH($client) {
        // Implémentez la logique de consulterH ici
    }

    public function modifierS($client, $reservation) {
        // Implémentez la logique de modifierS ici
    }
    public function getIdAgent(){
        return $this->getIdAdministrateur();
    }
    public function notification(){
        $messages = $this->bdd->recupererListeAdminMessageNonLu($this->getIdAdministrateur());
        $clients = $this->bdd->recupererListeClientsDesabonnee();
        $NClients = $this->bdd->recupererNClient();
        return count($messages)+count($clients)+count($NClients);
    }
}
?>



