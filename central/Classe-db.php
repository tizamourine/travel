<?php
require_once 'Classes/Utilisateur.php';
require_once 'Classes/Administrateur.php';
require_once 'Classes/Agent.php';
require_once 'Classes/Client.php';
require_once 'Classes/Actualites.php';
require_once 'Classes/Chambre.php';
require_once 'Classes/Contact.php';
require_once 'Classes/Excursion.php';
require_once 'Classes/Hotel.php';
require_once 'Classes/Reservation.php';
require_once 'Classes/Sejour.php';
require_once 'Classes/Utilisateur.php';
require_once 'Classes/VoyageOrganisee.php';
class BD {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "travel";

    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: ".$conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
	public function insertClient(Client $Client){
		$prepare = $this->db->prepare("INSERT INTO Utilisateur(nom, prenom, email, mdp, session, numTel, photo, sexe) VALUES (?,?,?,?,?,?,?,?)");
		$prepare->execute(array($Client->parent->getNom(), $Client->parent->getPrenom(), $Client->parent->getEmail(), $Client->parent->getMdp(), $Client->parent->getSession(), $Client->parent->getNumTel(), $Client->parent->getPhoto(), $Client->parent->getSexe()));
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE email=?");
        $email = $Client->parent->getEmail();
    	$prepare->bind_param('s', $email);
    	$prepare->execute();
        $req = $prepare->get_result();
    	$utilisateur = $req->fetch_assoc();
        $idUtilisateur = $utilisateur['idUtilisateur'];
        $prepare = $this->db->prepare("INSERT INTO Clients(idClient, identite, numIdentite) VALUES (?,?,?)");
		$prepare->execute(array($idUtilisateur, $Client->getIdentite(), $Client->getNumIdentite()));
    }
    public function insertAgent(Agent $Agent){
		$prepare = $this->db->prepare("INSERT INTO Utilisateur(nom, prenom, email, mdp, session, numTel, photo, sexe) VALUES (?,?,?,?,?,?,?,?)");
        $prepare->execute(array($Agent->parent->getNom(), $Agent->parent->getPrenom(), $Agent->parent->getEmail(), $Agent->parent->getMdp(), $Agent->parent->getSession(), $Agent->parent->getNumTel(), $Agent->parent->getPhoto(), $Agent->parent->getSexe()));
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE email=?");
        $email = $Agent->parent->getEmail();
    	$prepare->bind_param('s', $email);
    	$prepare->execute();
        $req = $prepare->get_result();
    	$utilisateur = $req->fetch_assoc();
        $idUtilisateur = $utilisateur['idUtilisateur'];
        $prepare = $this->db->prepare("INSERT INTO Agents(idAgent, salaire, grade) VALUES (?,?,?)");
		$prepare->execute(array($idUtilisateur, $Agent->getSalaire(), $Agent->getGrade()));
    }
    public function verifierUtilisateur($email, $mdp){
		$prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE email=?");
    	$prepare->bind_param('s', $email);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
    	    $utilisateur = $req->fetch_assoc();
            $idUtilisateur = $utilisateur["idUtilisateur"];
            $prepare = $this->db->prepare("SELECT * FROM Clients WHERE idClient=?");
    	    $prepare->bind_param('i', $idUtilisateur);
    	    $prepare->execute();
            $req = $prepare->get_result();
            if ($req->num_rows){
                $client = $req->fetch_assoc();
                if($mdp == $utilisateur['mdp']){
                    return array(3, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $client['identite'], $client['numIdentite']));
                }else{
                    return array(1);
                }
            }else{
                $prepare = $this->db->prepare("SELECT * FROM Agents WHERE idAgent=?");
    	        $prepare->bind_param('i', $idUtilisateur);
    	        $prepare->execute();
                $req = $prepare->get_result();
                $agent = $req->fetch_assoc();
                $prepare = $this->db->prepare("SELECT * FROM Administrateur WHERE idAdministrateur=?");
    	        $prepare->bind_param('i', $idUtilisateur);
    	        $prepare->execute();
                $req = $prepare->get_result();
                if ($req->num_rows){
                    if ($mdp == $utilisateur['mdp']){
                        return array(4,new Administrateur($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $agent['salaire'], $agent['grade']));
                    }else{
                        return array(1);
                    }
                    
                }else{
                    if ($mdp == $utilisateur['mdp']){
                        return array(5,new Agent($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $agent['salaire'], $agent['grade']));
                    }else{
                     return array(1);
                    }
                    
                }
            }
        }else{
            return array(0);
        }
    }
    function ajouterToken($session, $token){
        $prepare = $this->db->prepare("SELECT * FROM token WHERE session=?");
    	$prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if(!$req->num_rows){
            $prepare = $this->db->prepare("INSERT INTO token(session, csrfToken) VALUES (?,?)");
            $prepare->execute(array($session, $token));
        }else{
            $prepare = $this->db->prepare("UPDATE token SET csrfToken=? WHERE session=?");
    	    $prepare->execute(array($token, $session));
        }
    }
    function verifierToken($token, $session){
        $prepare = $this->db->prepare("SELECT * FROM token WHERE session=?");
    	$prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            if($token == $t['csrfToken']){
                return 1;
            }else{
                return 0;
            }
        }
    }
    function updateSession($id, $session){
        $prepare = $this->db->prepare("UPDATE Utilisateur SET session=? WHERE idUtilisateur=?");
    	$prepare->execute(array($session, $id));
    }
    function verifierSession($session){
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE session=?");
    	$prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            if($session == $t['session']){
                return 1;
            }else{
                return 0;
            }
        }
    }
    function recupererAdmin($session){
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE session=?");
    	$prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            $u = $this->verifierUtilisateur($t['email'], $t['mdp']);
            if($u[0] == 4){
                return $u[1];
            }else if($u[0] == 5){
                header("Location: profileAgent.php");
            }
            else{
                header("Location: index.php");
            }
        }else{
            header("Location: index.php");
        }
    }
    function verifierAdminSession($session){
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE session=?");
    	$prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            $u = $this->verifierUtilisateur($t['email'], $t['mdp']);
            if($u[0] == 4){
                header("Location: profileAdmin.php");
            }else if($u[0] == 5){
                header("Location: profileAgent.php");
            }
        }
    }
    function recupererAgentAvecSession($session){
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE session=?");
    	$prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            $u = $this->verifierUtilisateur($t['email'], $t['mdp']);
            if($u[0] == 4){
                return $u[1]->parent;
            }if($u[0] == 5){
                return $u[1];
            }
            else{
                header("Location: index.php");
            }
        }else{
            header("Location: index.php");
        }
    }
    public function insertHotel(Hotel $hotel){
		$prepare = $this->db->prepare("INSERT INTO Hotels(nomHotel, adresse, etoiles, numTel, ville, coordonne) VALUES (?,?,?,?,?,?)");
		$prepare->execute(array($hotel->getNomHotel(),$hotel->getAdresse(),$hotel->getEtoiles(),$hotel->getNumTel(),$hotel->getVille(),$hotel->getCoordonne()));
    }
    public function modifierHotel(Hotel $hotel){
		$prepare = $this->db->prepare("UPDATE Hotels SET nomHotel=?, adresse=?, etoiles=?, numTel=?, ville=?, coordonne=? WHERE idHotel=?");
		$prepare->execute(array($hotel->getNomHotel(),$hotel->getAdresse(),$hotel->getEtoiles(),$hotel->getNumTel(),$hotel->getVille(),$hotel->getCoordonne(),$hotel->getIdHotel()));
    }
    public function supprimerHotel($idHotel){
		$prepare = $this->db->prepare("DELETE FROM Hotels WHERE idHotel=?");
		$prepare->execute(array($idHotel));
    }
    public function deleteAgent($idAgent){
		$prepare = $this->db->prepare("DELETE FROM Agents WHERE idAgent=?");
		$prepare->execute(array($idAgent));
    }
    public function deleteClient($idClient){
		$prepare = $this->db->prepare("DELETE FROM Clients WHERE idClient=?");
		$prepare->execute(array($idClient));
    }
    public function searchHotel($mot){
        $mot = "%".$mot."%";
        $prepare = $this->db->prepare("SELECT * FROM Hotels WHERE nomHotel LIKE ? OR adresse LIKE ? OR etoiles LIKE ? OR numTel LIKE ? OR ville LIKE ? OR coordonne LIKE ?");
    	$prepare->bind_param('ssssss',$mot,$mot,$mot,$mot,$mot,$mot);
    	$prepare->execute();
        $req = $prepare->get_result();
        $hotels = array();
    	while ($hotel = mysqli_fetch_array($req)){
    		$hotel = new Hotel($hotel['idHotel'],
            $hotel['nomHotel'],
            $hotel['adresse'],
            $hotel['etoiles'],
            $hotel['numTel'],
            $hotel['ville'],
            $hotel['coordonne']);
    		array_push($hotels, $hotel);
    	}
    	
    	return $hotels;
    }
    public function insertChambre(Chambre $chambre){
		$prepare = $this->db->prepare("INSERT INTO Chambres(idHotel, typeChambre, description, numeroChambre, equipement, prix, superficie, disponible) VALUES (?,?,?,?,?,?,?,?)");
		$prepare->execute(array($chambre->getIdHotel(), $chambre->getTypeChambre(),$chambre->getDescription(),$chambre->getnumeroCh(),$chambre->getEquipement(),$chambre->getPrix(),$chambre->getSuperficie(),$chambre->getDisponible()));
    }
    public function modifierChambre(Chambre $chambre){
		$prepare = $this->db->prepare("UPDATE Chambres SET typeChambre=?, description=?, numeroChambre=?, equipement=?,prix=?, superficie=?, disponible=? WHERE idChambre=?");
		$prepare->execute(array($chambre->getTypeChambre(),$chambre->getDescription(),$chambre->getnumeroCh(),$chambre->getEquipement(),$chambre->getPrix(),$chambre->getSuperficie(),$chambre->getDisponible(), $chambre->getIdChambre()));
    }
    public function supprimerChambre(Chambre $chambre){
		$prepare = $this->db->prepare("DELETE FROM Chambres WHERE idChambre=?");
		$prepare->execute(array($chambre->getIdChambre()));
    }
    function VoyageOrganises($sejour){
        $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises WHERE (iteneraire=? AND description=? AND prixDefault=?)");
    	$prepare->bind_param('sss', $sejour->parent->getIteneraire(), $sejour->parent->getDescription(), $sejour->parent->getPrixDefault());
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            return $t['idVoyage'];
        }else{
            return 0;
        }
    }
    function recupererNClient(){
        $req = $this->db->query("SELECT * FROM Utilisateur, Clients WHERE idUtilisateur IN (SELECT idClient FROM Clients WHERE idAgent IS NULL)");
        $clients = array();
        while($utilisateur = mysqli_fetch_array($req)){
            array_push($clients, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite']));
        }
        return $clients;
    }
    function recupererAClient($idAgent){
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur, Clients WHERE idUtilisateur=idClient AND idAgent=?");
        $prepare->bind_param('i', $idAgent);
        $prepare->execute();
        $req = $prepare->get_result();
        $clients = array();
        while($utilisateur = mysqli_fetch_array($req)){
            array_push($clients, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite']));
        }
        return $clients;
    }
    public function insertSejour(Sejour $sejour){
		$prepare = $this->db->prepare("INSERT INTO VoyageOrganises(description,transport,destination,iteneraire,prixDefault,nbrPlaces,equipement,prixAdult,prixEnfnts,prixBebe,heureDepart,dateD) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		$prepare->execute(array($sejour->parent->getDescription(),$sejour->parent->getTransport(),$sejour->parent->getDestination(),$sejour->parent->getIteneraire(),$sejour->parent->getPrixDefault(),$sejour->parent->getNbrPlaces(),$sejour->parent->getEquipement(),$sejour->parent->getPrixAdulte(),$sejour->parent->getPrixEnfnts(),$sejour->parent->getPrixBebe(),$sejour->parent->getHeureDepart(),$sejour->parent->getDateD()));
        $idSejour = $this->VoyageOrganises($sejour);
        $prepare = $this->db->prepare("INSERT INTO Sejour(dateR,nbrJour,idHotel, idSejour) VALUES (?,?,?,?)");
        $prepare->execute(array($sejour->getDateR(), $sejour->getNbrJours(),$sejour->getIdHotel(), $idSejour));
    }
    public function modifierSejour(Sejour $sejour){
		$prepare = $this->db->prepare("UPDATE VoyageOrganises SET description=?,transport=?,destination=?,iteneraire=?,prixDefault=?,nbrPlaces=?,equipement=?,prixAdult=?,prixEnfnts=?,prixBebe=?,heureDepart=?,dateD=?  WHERE idVoyage=?");
		$prepare->execute(array($sejour->parent->getDescription(),$sejour->parent->getTransport(),$sejour->parent->getDestination(),$sejour->parent->getIteneraire(),$sejour->parent->getPrixDefault(),$sejour->parent->getNbrPlaces(),$sejour->parent->getEquipement(),$sejour->parent->getPrixAdulte(),$sejour->parent->getPrixEnfnts(),$sejour->parent->getPrixBebe(),$sejour->parent->getHeureDepart(),$sejour->parent->getDateD(), $sejour->getIdSejour()));
        $prepare = $this->db->prepare("UPDATE Sejour SET dateR=?, nbrJour=?, idHotel=? WHERE idSejour=?");
		$prepare->execute(array($sejour->getDateR(), $sejour->getNbrJours(), $sejour->getIdHotel(), $sejour->getIdSejour()));
    }
    public function supprimerSejour($idSejour){
		$prepare = $this->db->prepare("DELETE FROM Sejour WHERE idSejour=?");
		$prepare->execute(array($idSejour));
        $prepare = $this->db->prepare("DELETE FROM VoyageOrganises WHERE idVoyage=?");
		$prepare->execute(array($idSejour));
    }
    public function listeSejour(){
            $req = $this->db->query("SELECT * FROM VoyageOrganises, Sejour WHERE idVoyage=idSejour");
            $sejours = array();
            while ($sejour = mysqli_fetch_array($req)){
                $sejour = new Sejour(
                    $sejour['idSejour'],
                    $sejour['description'],
                    $sejour['transport'],
                    $sejour['destination'],
                    $sejour['iteneraire'],
                    $sejour['prixDefault'],
                    $sejour['nbrPlaces'],
                    $sejour['equipement'],
                    $sejour['prixAdult'],
                    $sejour['PrixEnfnts'],
                    $sejour['prixBebe'],
                    $sejour['heureDepart'],
                    $sejour['dateD'],
                    $sejour['dateR'],
                    $sejour['nbrJour'],
                    $sejour['idHotel']  
                );
                array_push($sejours, $sejour);
            }
            
            return $sejours;
    }
    public function searchSejour($mot){
        $mot= "%".$mot."%";
        $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises, Sejour WHERE description LIKE ? OR transport LIKE ? OR destination LIKE ? OR iteneraire LIKE ? OR prixDefault LIKE ? OR nbrPlaces LIKE ? OR equipement LIKE ? OR prixAdult LIKE ? OR prixEnfnts LIKE ? OR prixBebe LIKE ? OR heureDepart LIKE ? OR dateD LIKE ? OR dateR LIKE ? OR nbrJour LIKE ?");
        $prepare->bind_param("ssssssssssssss",$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot);
        $prepare->execute();
        $req = $prepare->get_result();
        $sejours = array();
            while ($sejour = mysqli_fetch_array($req)){
                $sejour = new Sejour(
                    $sejour['idSejour'],
                    $sejour['description'],
                    $sejour['transport'],
                    $sejour['destination'],
                    $sejour['iteneraire'],
                    $sejour['prixDefault'],
                    $sejour['nbrPlaces'],
                    $sejour['equipement'],
                    $sejour['prixAdult'],
                    $sejour['PrixEnfnts'],
                    $sejour['prixBebe'],
                    $sejour['heureDepart'],
                    $sejour['dateD'],
                    $sejour['dateR'],
                    $sejour['nbrJour'],
                    $sejour['idHotel']  
                );
                array_push($sejours, $sejour);
            }
            
            return $sejours;
    }
    public function RecupererSejour($idSejour){
        $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises, Sejour WHERE idSejour=? AND idSejour=idVoyage");
        $prepare->bind_param("i",$idSejour);
        $prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $sejour = $req->fetch_assoc();
            $sejour = new Sejour(
                $sejour['idSejour'],
                $sejour['description'],
                $sejour['transport'],
                $sejour['destination'],
                $sejour['iteneraire'],
                $sejour['prixDefault'],
                $sejour['nbrPlaces'],
                $sejour['equipement'],
                $sejour['prixAdult'],
                $sejour['PrixEnfnts'],
                $sejour['prixBebe'],
                $sejour['heureDepart'],
                $sejour['dateD'],
                $sejour['dateR'],
                $sejour['nbrJour'],
                $sejour['idHotel'] 
            );
        }
        
        return $sejour;
    }
    public function listeExcursion(){
        $req = $this->db->query("SELECT * FROM VoyageOrganises, Excursions WHERE idVoyage=idExcursion");
        $excursions = array();
        while ($excursion = mysqli_fetch_array($req)){
            $excursion = new Excursion(
                $excursion['idExcursion'],
                $excursion['description'],
                $excursion['transport'],
                $excursion['destination'],
                $excursion['iteneraire'],
                $excursion['prixDefault'],
                $excursion['nbrPlaces'],
                $excursion['equipement'],
                $excursion['prixAdult'],
                $excursion['PrixEnfnts'],
                $excursion['prixBebe'],
                $excursion['heureDepart'],
                $excursion['dateD'],
                $excursion['heureRetour']
            );
            array_push($excursions, $excursion);
        }
        
        return $excursions;
    }
    public function searchExcursion($mot){
        $mot= "%".$mot."%";
        $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises, Excursions WHERE description LIKE ? OR transport LIKE ? OR destination LIKE ? OR iteneraire LIKE ? OR prixDefault LIKE ? OR nbrPlaces LIKE ? OR equipement LIKE ? OR prixAdult LIKE ? OR prixEnfnts LIKE ? OR prixBebe LIKE ? OR heureDepart LIKE ? OR dateD LIKE ? OR heureRetour LIKE ?");
        $prepare->bind_param("sssssssssssss",$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot);
        $prepare->execute();
        $req = $prepare->get_result();
        $excursions = array();
        while ($excursion = mysqli_fetch_array($req)){
            $excursion = new Excursion(
                $excursion['idExcursion'],
                $excursion['description'],
                $excursion['transport'],
                $excursion['destination'],
                $excursion['iteneraire'],
                $excursion['prixDefault'],
                $excursion['nbrPlaces'],
                $excursion['equipement'],
                $excursion['prixAdult'],
                $excursion['PrixEnfnts'],
                $excursion['prixBebe'],
                $excursion['heureDepart'],
                $excursion['dateD'],
                $excursion['heureRetour']
            );
            array_push($excursions, $excursion);
        }
        
        return $excursions;
    }
    public function RecupererExcursion($idExcursion){
        $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises, Excursions WHERE idExcursion=? AND idExcursion=idVoyage");
        $prepare->bind_param("i",$idExcursion);
        $prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $excursion = $req->fetch_assoc();
            $excursion = new Excursion(
                $excursion['idExcursion'],
                $excursion['description'],
                $excursion['transport'],
                $excursion['destination'],
                $excursion['iteneraire'],
                $excursion['prixDefault'],
                $excursion['nbrPlaces'],
                $excursion['equipement'],
                $excursion['prixAdult'],
                $excursion['PrixEnfnts'],
                $excursion['prixBebe'],
                $excursion['heureDepart'],
                $excursion['dateD'],
                $excursion['heureRetour']
            );
        }
        
        return $excursion;
    }
    public function insertExcursion(Excursion $excursion){
		$prepare = $this->db->prepare("INSERT INTO VoyageOrganises(description,transport,destination,iteneraire,prixDefault,nbrPlaces,equipement,prixAdult,prixEnfnts,prixBebe,heureDepart,dateD) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $prepare->execute(array($excursion->parent->getDescription(),$excursion->parent->getTransport(),$excursion->parent->getDestination(),$excursion->parent->getIteneraire(),$excursion->parent->getPrixDefault(),$excursion->parent->getNbrPlaces(),$excursion->parent->getEquipement(),$excursion->parent->getPrixAdulte(),$excursion->parent->getPrixEnfnts(),$excursion->parent->getPrixBebe(),$excursion->parent->getHeureDepart(),$excursion->parent->getDateD()));
        $idExcursion = $this->VoyageOrganises($excursion);
        $prepare = $this->db->prepare("INSERT INTO Excursions(heureRetour, idExcursion) VALUES (?,?)");
        $prepare->execute(array($excursion->getHeureRetour(), $idExcursion));
    }
    public function modifierExcursion(Excursion $excursion){
		$prepare = $this->db->prepare("UPDATE VoyageOrganises SET description=?,transport=?,destination=?,iteneraire=?,prixDefault=?,nbrPlaces=?,equipement=?,prixAdult=?,prixEnfnts=?,prixBebe=?,heureDepart=?,dateD=?  WHERE idVoyage=?");
		$prepare->execute(array($excursion->parent->getDescription(),$excursion->parent->getTransport(),$excursion->parent->getDestination(),$excursion->parent->getIteneraire(),$excursion->parent->getPrixDefault(),$excursion->parent->getNbrPlaces(),$excursion->parent->getEquipement(),$excursion->parent->getPrixAdulte(),$excursion->parent->getPrixEnfnts(),$excursion->parent->getPrixBebe(),$excursion->parent->getHeureDepart(),$excursion->parent->getDateD(), $excursion->getIdExcursion()));
        $prepare = $this->db->prepare("UPDATE Excursions SET heureRetour=? WHERE idExcursion=?");
		$prepare->execute(array($excursion->getHeureRetour(), $excursion->getIdExcursion()));
    }
    public function supprimerExcursion($idExcursion){
		$prepare = $this->db->prepare("DELETE FROM Excursions WHERE idExcursion=?");
		$prepare->execute(array($idExcursion));
        $prepare = $this->db->prepare("DELETE FROM VoyageOrganises WHERE idVoyage=?");
		$prepare->execute(array($idExcursion));
    }

    function chambre($chambre){
        $prepare = $this->db->prepare("SELECT * FROM Chambres WHERE (typeChambre=? AND equipement=? AND description=?)");
    	$prepare->bind_param('sss', $chambre->getTypeChambre(), $chambre->getEquipement(), $chambre->getDescription());
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            return $t['idChambre'];
        }else{
            return 0;
        }
    }
    function hotel($hotel){
        $prepare = $this->db->prepare("SELECT * FROM Hotels WHERE (numTel=? AND ville=? AND nomHotel=?)");
    	$prepare->bind_param('sss', $hotel->getNumTel(), $hotel->getVille(), $hotel->getNomHotel());
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            return $t['idHotel'];
        }else{
            return 0;
        }
    }
    function recupererListehotels(){
    	$req = $this->db->query("SELECT * FROM Hotels");
    	$hotels = array();
    	while ($hotel = mysqli_fetch_array($req)){
    		$hotel = new Hotel($hotel['idHotel'],
            $hotel['nomHotel'],
            $hotel['adresse'],
            $hotel['etoiles'],
            $hotel['numTel'],
            $hotel['ville'],
            $hotel['coordonne']);
    		array_push($hotels, $hotel);
    	}
    	
    	return $hotels;
    }
    function recupererListeAgents(){
    	$req = $this->db->query("SELECT * FROM Utilisateur, Agents WHERE idAgent=idUtilisateur");
    	$agents = array();
    	while ($utilisateur = mysqli_fetch_array($req)){
    		array_push($agents, new Agent($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['salaire'], $utilisateur['grade']));
    	}
    	
    	return $agents;
    }
    function recupererListeClients(){
    	$req = $this->db->query("SELECT * FROM Utilisateur, Clients WHERE idClient=idUtilisateur");
    	$clients = array();
    	while ($utilisateur = mysqli_fetch_array($req)){
    		array_push($clients, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite']));
    	}
    	
    	return $clients;
    }
    function recupererListeAgentClients($idAgent){
    	$prepare = $this->db->prepare("SELECT * FROM Utilisateur, Clients WHERE idClient=idUtilisateur AND idAgent=?");
    	$prepare->bind_param("i", $idAgent);
        $prepare->execute();
        $req = $prepare->get_result();
        $clients = array();
    	while ($utilisateur = mysqli_fetch_array($req)){
    		array_push($clients, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite']));
    	}
    	
    	return $clients;
    }
    function recupererListeClientsDesabonnee(){
    	$req = $this->db->query("SELECT * FROM Utilisateur, Clients WHERE idClient=idUtilisateur AND desabonner=1");
    	$clients = array();
    	while ($utilisateur = mysqli_fetch_array($req)){
    		array_push($clients, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite']));
    	}
    	
    	return $clients;
    }
    function searchChambre($mot){
        $mot = "%".$mot."%";
    	$prepare = $this->db->prepare("SELECT * FROM Chambres WHERE typeChambre LIKE ? OR  description LIKE ? OR  numeroChambre LIKE ? OR  equipement LIKE ? OR prix LIKE ? OR  superficie LIKE ? OR  disponible LIKE ?");
        $prepare->bind_param("sssssss", $mot, $mot, $mot, $mot, $mot, $mot, $mot);
        $prepare->execute();
        $req = $prepare->get_result();
        $chambres = array();
        while ($chambre = mysqli_fetch_array($req)){
    		$chambre = new Chambre(
                $chambre['idChambre'],
                $chambre['idHotel'],
                $chambre['typeChambre'],
                $chambre['description'],
                $chambre['numeroChambre'],
                $chambre['prix'],
                $chambre['equipement'],
                $chambre['superficie'],
                $chambre['disponible']
                
            );
    		array_push($chambres, $chambre);
    	}
        return $chambres;
    }
    function recupererHotel($idHotel){
        $prepare = $this->db->prepare("SELECT * FROM Hotels WHERE idHotel=?");
    	$prepare->bind_param('i', $idHotel);
    	$prepare->execute();
        $req = $prepare->get_result();
        if($req->num_rows){
            $hotel = $req->fetch_assoc();
            $hotel = new Hotel($hotel['idHotel'],
            $hotel['nomHotel'],
            $hotel['adresse'],
            $hotel['etoiles'],
            $hotel['numTel'],
            $hotel['ville'],
            $hotel['coordonne']);
            return $hotel;
        }
    }
    function updateReservation($idReservation){
        $prepare = $this->db->prepare("UPDATE Reservations SET status=1 WHERE idReservation=?");
        $prepare->execute(array($idReservation));
    }
    function updateProgressionReservation($reservation){
        $prepare = $this->db->prepare("UPDATE Reservations SET progression=? WHERE idReservation=?");
        $prepare->execute(array($reservation->getProgression(), $reservation->getIdReservation()));
    }
    function nombreChambre($idHotel){
    	$prepare = $this->db->prepare("SELECT * FROM Chambres WHERE idHotel in (SELECT idHotel FROM Hotels WHERE idHotel=?)");
        $prepare->bind_param("i", $idHotel);
        $prepare->execute();
        $req = $prepare->get_result();
        return $req->num_rows;
    }
    function listeChambre($idHotel){
    	$prepare = $this->db->prepare("SELECT * FROM Chambres WHERE idHotel=?");
        $prepare->bind_param("i", $idHotel);
        $prepare->execute();
        $req = $prepare->get_result();
        $chambres = array();
        while ($chambre = mysqli_fetch_array($req)){
    		$chambre = new Chambre(
                $chambre['idChambre'],
                $chambre['idHotel'],
                $chambre['typeChambre'],
                $chambre['description'],
                $chambre['numeroChambre'],
                $chambre['prix'],
                $chambre['equipement'],
                $chambre['superficie'],
                $chambre['disponible']
                
            );
    		array_push($chambres, $chambre);
    	}
        return $chambres;
    }
    function searchAgent($mot){
        $mot = "%".$mot."%";
    	$prepare = $this->db->prepare("SELECT * FROM Utilisateur, Agents WHERE idUtilisateur=idAgent AND( nom LIKE ? OR prenom LIKE?  OR email LIKE ? OR numTel LIKE ? OR sexe LIKE ? OR salaire LIKE ? OR grade LIKE ?)");
        $prepare->bind_param("sssssss", $mot, $mot, $mot, $mot, $mot, $mot, $mot);
        $prepare->execute();
        $req = $prepare->get_result();
        $agents = array();
        while ($utilisateur = mysqli_fetch_array($req)){
    		array_push($agents, new Agent($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['salaire'], $utilisateur['grade']));
    	}
        return $agents;
    }
    function searchClient($mot){
        $mot = "%".$mot."%";
    	$prepare = $this->db->prepare("SELECT * FROM Utilisateur, Clients WHERE idUtilisateur=idClient AND( nom LIKE ? OR prenom LIKE?  OR email LIKE ? OR numTel LIKE ? OR sexe LIKE ? OR identite LIKE ? OR numIdentite LIKE ?)");
        $prepare->bind_param("sssssss", $mot, $mot, $mot, $mot, $mot, $mot, $mot);
        $prepare->execute();
        $req = $prepare->get_result();
        $clients = array();
        while ($utilisateur = mysqli_fetch_array($req)){
    		array_push($clients, new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite']));
    	}
        return $clients;
    }
    function modifierClient($client){
        $prepare = $this->db->prepare("UPDATE Utilisateur, Clients SET nom=?,prenom=?,email=?,numTel=?,identite=?, numIdentite=?, idAgent=? WHERE idUtilisateur=idClient AND idClient=?");
    	$prepare->execute(array($client->parent->getNom(),$client->parent->getPrenom(), $client->parent->getEmail(), $client->parent->getNumtel(), $client->getIdentite(),$client->getNumIdentite(),$client->getIdAgent(), $client->getIdClient()));
    }
    function modifierAgent($agent){
        $prepare = $this->db->prepare("UPDATE Utilisateur, Agents SET nom=?,prenom=?,email=?,numTel=?,salaire=?, grade=? WHERE idUtilisateur=idAgent AND idAgent=?");
    	$prepare->execute(array($agent->parent->getNom(),$agent->parent->getPrenom(), $agent->parent->getEmail(), $agent->parent->getNumtel(), $agent->getSalaire(),$agent->getGrade(), $agent->getIdAgent()));
    }
    function deletAgent($idAgent){
        $prepare = $this->db->prepare("DELETE FROM Agents WHERE idAgent=? UNION DELETE FROM Utilisateur WHERE idUtilisateur=?");
    	$prepare->execute(array($idAgent, $idAgent));
    }
    function deletClient($idClient){
        $prepare = $this->db->prepare("DELETE FROM Clients WHERE idClient=? UNION DELETE FROM Utilisateur WHERE idUtilisateur=?");
    	$prepare->execute(array($idClient, $idClient));
    }
    function recupererAgent($idAgent){
            $prepare = $this->db->prepare("SELECT * FROM Utilisateur, Agents WHERE idUtilisateur=idAgent AND idAgent=?");
            $prepare->bind_param("i", $idAgent);
            $prepare->execute();
            $req = $prepare->get_result();
            $utilisateur = $req->fetch_assoc();
            return new Agent($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['salaire'], $utilisateur['grade']);
    }
    function recupererClient($idClient){
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur, Clients WHERE idUtilisateur=idClient AND idClient=?");
        $prepare->bind_param("i", $idClient);
        $prepare->execute();
        $req = $prepare->get_result();
        $utilisateur = $req->fetch_assoc();
        return new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $utilisateur['identite'], $utilisateur['numIdentite'], $utilisateur['idAgent']);
}
    function recupererChambre($idChambre){
    	$prepare = $this->db->prepare("SELECT * FROM Chambres WHERE idChambre=?");
        $prepare->bind_param("i", $idChambre);
        $prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $chambre = $req->fetch_assoc();
    		$chambre = new Chambre(
                $chambre['idChambre'],
                $chambre['idHotel'],
                $chambre['typeChambre'],
                $chambre['description'],
                $chambre['numeroChambre'],
                $chambre['prix'],
                $chambre['equipement'],
                $chambre['superficie'],
                $chambre['disponible']     
            );
    	}
        return $chambre;
    }
    function ajouterImage($image){
        $prepare = $this->db->prepare("INSERT INTO Images(idHotel, idChambre, idVoyage, image) VALUES (?,?,?,?)");
		$prepare->execute(array($image->getIdHotel(), $image->getIdChambre(),$image->getIdVoyage(),$image->getImage()));
    }
    function recupererHotelImage($idHotel){
        $prepare = $this->db->prepare("SELECT * FROM Images WHERE idHotel=?");
        $prepare->bind_param('i', $idHotel);
		$prepare->execute();
        $req = $prepare->get_result();
        $images = array();
        while ($image = mysqli_fetch_array($req)){ 
            array_push($images, $image['image']);
        }
        return $images;
    }
    function recupererChambreImage($idChambre){
        $prepare = $this->db->prepare("SELECT * FROM Images WHERE idChambre=?");
        $prepare->bind_param('i', $idChambre);
		$prepare->execute();
        $req = $prepare->get_result();
        $images = array();
        while ($image = mysqli_fetch_array($req)){ 
            array_push($images, $image['image']);
        }
        return $images;
    }
    function recupererVoyageImage($idVoyage){
        $prepare = $this->db->prepare("SELECT * FROM Images WHERE idVoyage=?");
        $prepare->bind_param('i', $idVoyage);
		$prepare->execute();
        $req = $prepare->get_result();
        $images = array();
        while ($image = mysqli_fetch_array($req)){ 
            array_push($images, $image['image']);
        }
        return $images;
    }
    public function recuperAgentReservation($mot){
        $prepare = $this->db->prepare("SELECT * FROM Reservations WHERE idClient in (SELECT idClient FROM Clients WHERE idAgent=?) AND status=1 AND progression='attente'");
    	$prepare->bind_param('i',$mot);
    	$prepare->execute();
        $req = $prepare->get_result();
        $reservations = array();
    	while ($reservation = mysqli_fetch_array($req)){
    		$reservation = new Reservation(
                $reservation['idReservation'],
                $reservation['status'],
                $reservation['typePaiement'],
                $reservation['informationSup'],
                $reservation['prix'],
                $reservation['date'],
                $reservation['progression'],
                $reservation['idClient'],
                $reservation['idAgent'],
                $reservation['idChambre'],
                $reservation['idVoyage']
            );
    		array_push($reservations, $reservation);
    	}
    	
    	return $reservations;
    }
       function recupererListeMessageEnvoye($idSource){
        $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idSource=?");
        $prepare->bind_param('i',$idSource);
        $prepare->execute();
        $req = $prepare->get_result();
        $messages = array();
        while ($message = mysqli_fetch_array($req)){
            $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
            array_push($messages, $message);
        }
        
        return $messages;
}
function recupererListeAdminMessageEnvoye($idSource){
    $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idSource=? AND idDestinataire NOT IN (SELECT idClient FROM Clients)");
    $prepare->bind_param('i',$idSource);
    $prepare->execute();
    $req = $prepare->get_result();
    $messages = array();
    while ($message = mysqli_fetch_array($req)){
        $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
        array_push($messages, $message);
    }
    
    return $messages;
}
function recupererListeMessageNonLu($idSource){
    $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idDestinataire=? AND lu=0");
    $prepare->bind_param('i',$idSource);
    $prepare->execute();
    $req = $prepare->get_result();
    $messages = array();
    while ($message = mysqli_fetch_array($req)){
        $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
        array_push($messages, $message);
    }
    
    return $messages;
}
function recupererListeAdminMessageNonLu($idSource){
    $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idDestinataire=? AND idDestinataire!=idSource AND lu=0 AND idSource NOT IN (SELECT idClient FROM Clients)");
    $prepare->bind_param('i',$idSource);
    $prepare->execute();
    $req = $prepare->get_result();
    $messages = array();
    while ($message = mysqli_fetch_array($req)){
        $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
        array_push($messages, $message);
    }
    
    return $messages;
}
function lireMessage($idMessage, $idDestinataire){
    $prepare= $this->db->prepare("UPDATE Contact SET lu=1 WHERE idMessage=? AND idDestinataire=? AND lu=0");
    $prepare->execute(array($idMessage, $idDestinataire));
}
    function recupererMessage($idSource){
        $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idMessage=?");
        $prepare->bind_param('i',$idSource);
        $prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
        $message = $req->fetch_assoc();
        $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
        
        return $message;
        }
}
function recupererListeMessageRecu($idDestinataire){
    $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idDestinataire=?");
    $prepare->bind_param('i',$idDestinataire);
    $prepare->execute();
    $req = $prepare->get_result();
    $messages = array();
    while ($message = mysqli_fetch_array($req)){
        $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
        array_push($messages, $message);
    }
    
    return $messages;
}
function recupererListeAdminMessageRecu($idDestinataire){
    $prepare= $this->db->prepare("SELECT * FROM Contact WHERE idDestinataire=? AND idSource!=idDestinataire AND idSource NOT IN (SELECT idClient FROM Clients)");
    $prepare->bind_param('i',$idDestinataire);
    $prepare->execute();
    $req = $prepare->get_result();
    $messages = array();
    while ($message = mysqli_fetch_array($req)){
        $message = new Contact($message['idMessage'], $message['idSource'], $message['idDestinataire'], $message['objet'], $message['contenu'], $message['date'], $message['lu']);
        array_push($messages, $message);
    }
    
    return $messages;
}
function ajouterMessage($message){
    $prepare = $this->db->prepare("INSERT INTO Contact (idSource, idDestinataire, objet, contenu,date, lu) VALUES (?,?,?,?,?,?)");
    $prepare->execute(array($message->getIdSource(), $message->getIdDestinataire(), $message->getObjet(), $message->getContenu(), $message->getDate(), $message->getLu()));
}
function modifierMessage($message){
    $prepare = $this->db->prepare("UPDATE Contact SET idSource=? idDestinataire=?, objet=?, contenu=?,date=?, lu=? WHERE idMessage=?");
    $prepare->execute(array($message->getIdSource(), $message->getIdDestinataire(), $message->getObjet(), $message->getContenu(), $message->getDate(), $message->getLu(), $message->getIdMessage()));
}
public function recuperClientReservation($mot){
    $prepare= $this->db->prepare("SELECT * FROM Reservations WHERE idClient=?");
    $prepare->bind_param('i',$mot);
    $prepare->execute();
    $req = $prepare->get_result();
    $reservations = array();
    while ($reservation = mysqli_fetch_array($req)){
        $reservation = new Reservation(
            $reservation['idReservation'],
            $reservation['status'],
            $reservation['typePaiement'],
            $reservation['informationSup'],
            $reservation['prix'],
            $reservation['date'],
            $reservation['progression'],
            $reservation['idClient'],
            $reservation['idAgent'],
            $reservation['idChambre'],
            $reservation['idVoyage']
        );
        array_push($reservations, $reservation);
    }
    
    return $reservations;
}
public function recupererReservation($mot){
    $prepare= $this->db->prepare("SELECT * FROM Reservations WHERE idReservation=?");
    $prepare->bind_param('i',$mot);
    $prepare->execute();
    $req = $prepare->get_result();
    $reservation = $req->fetch_assoc();
        $reservation = new Reservation(
            $reservation['idReservation'],
            $reservation['status'],
            $reservation['typePaiement'],
            $reservation['informationSup'],
            $reservation['prix'],
            $reservation['date'],
            $reservation['progression'],
            $reservation['idClient'],
            $reservation['idAgent'],
            $reservation['idChambre'],
            $reservation['idVoyage']
        );
    
    return $reservation;
}
public function recuperReservationsNonPayee(){
    $req= $this->db->query("SELECT * FROM Reservations WHERE status=0");
    $reservations = array();
    while ($reservation = mysqli_fetch_array($req)){
        $reservation = new Reservation(
            $reservation['idReservation'],
            $reservation['status'],
            $reservation['typePaiement'],
            $reservation['informationSup'],
            $reservation['prix'],
            $reservation['date'],
            $reservation['progression'],
            $reservation['idClient'],
            $reservation['idAgent'],
            $reservation['idChambre'],
            $reservation['idVoyage']
        );
        array_push($reservations, $reservation);
    }
    
    return $reservations;
}
public function searchReservation($mot){
    $mot = "%".$mot."%";
    $prepare = $this->db->prepare("SELECT idReservation, status, typePaiement, R.prix, date, informationSup, idClient, idAgent, idChambre, R.idVoyage, progression FROM Reservations AS R, VoyageOrganises AS V, Sejour as S, Hotels AS H WHERE (R.idVoyage=V.idVoyage AND V.idVoyage=S.idSejour AND S.idHotel=H.idHotel) AND (status LIKE ? OR typePaiement LIKE ?  OR date LIKE ? OR informationSup LIKE ? OR progression LIKE ? OR nomHotel LIKE ? OR ville LIKE ? OR destination LIKE ? OR dateD LIKE ? OR heureDepart LIKE ?) UNION SELECT idReservation, status, typePaiement, R.prix, date, informationSup, idClient, idAgent, idChambre, R.idVoyage, progression FROM Reservations AS R, VoyageOrganises AS V, Excursions as E WHERE (R.idVoyage=V.idVoyage AND V.idVoyage=E.idExcursion) AND (status LIKE ? OR typePaiement LIKE ?  OR date LIKE ? OR informationSup LIKE ? OR progression LIKE ? OR destination LIKE ? OR dateD LIKE ? OR heureDepart LIKE ?) UNION SELECT idReservation, status, typePaiement, R.prix, date, informationSup, idClient, idAgent, R.idChambre, idVoyage, progression FROM Reservations AS R, Hotels AS H, Chambres as C WHERE (R.idChambre=C.idChambre AND H.idHotel=C.idHotel) AND (status LIKE ? OR typePaiement LIKE ?  OR date LIKE ? OR informationSup LIKE ? OR progression LIKE ? OR nomHotel LIKE ? OR ville LIKE ?)");
    $prepare->bind_param('sssssssssssssssssssssssss',$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot,$mot);
    $prepare->execute();
    $req = $prepare->get_result();
    $reservations = array();
    while ($reservation = mysqli_fetch_array($req)){
        $reservation = new Reservation(
            $reservation['idReservation'],
            $reservation['status'],
            $reservation['typePaiement'],
            $reservation['informationSup'],
            $reservation['prix'],
            $reservation['date'],
            $reservation['progression'],
            $reservation['idClient'],
            $reservation['idAgent'],
            $reservation['idChambre'],
            $reservation['idVoyage']
        );
        array_push($reservations, $reservation);
    }
    
    return $reservations;
}
public function RecupererVoyage($idSejour){
    $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises WHERE idVoyage=?");
    $prepare->bind_param("i",$idSejour);
    $prepare->execute();
    $req = $prepare->get_result();
    if ($req->num_rows){
        $sejour = $req->fetch_assoc();
        $sejour = new VoyageOrganisee(
            $sejour['idVoyage'],
            $sejour['description'],
            $sejour['transport'],
            $sejour['destination'],
            $sejour['iteneraire'],
            $sejour['prixDefault'],
            $sejour['nbrPlaces'],
            $sejour['equipement'],
            $sejour['prixAdult'],
            $sejour['PrixEnfnts'],
            $sejour['prixBebe'],
            $sejour['heureDepart'],
            $sejour['dateD']
        );
    }
return $sejour;
}
}
?>