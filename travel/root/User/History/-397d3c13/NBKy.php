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
require_once 'Classes/credit.php';
class BD {
    private $dbHost     = "localhost";
    private $dbUsername = "travel";
    private $dbPassword = "root";
    private $dbName     = "root";

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
                    $client = new Client($utilisateur["idUtilisateur"], $utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["mdp"], $utilisateur["session"], $utilisateur["numTel"], $utilisateur["photo"], $utilisateur["sexe"], $client['identite'], $client['numIdentite'], $client['idAgent']);
                    return array(3, $client);
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
    function updateInfoPers($client){
        $prepare = $this->db->prepare("UPDATE Utilisateur SET nom=?,prenom=?,email=?,numTel=?,photo=? WHERE idUtilisateur=?");
    	$prepare->execute(array($client->parent->getNom(),$client->parent->getPrenom(), $client->parent->getEmail(), $client->parent->getNumtel(), $client->parent->getPhoto(), $client->getIdClient()));
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
    function recupererClient($session){
        
        $prepare = $this->db->prepare("SELECT * FROM Utilisateur WHERE session=?");
        $prepare->bind_param('s', $session);
    	$prepare->execute();
        $req = $prepare->get_result();
        if ($req->num_rows){
            $t = $req->fetch_assoc();
            $u = $this->verifierUtilisateur($t['email'], $t['mdp']);
            if($u[0] == 3){
                return $u[1];
            }else{
                header("Location: index.php");
            }
        }else{
            header("Location: index.php");
        }
    }
    function ajouterCredit($id, $credit){
        $prepare = $this->db->prepare("INSERT credit (idClient, numero, cvv, dateExpiration) value (?,?,?,?)");
    	$prepare->execute(array($id, $credit->getNumero(), $credit->getCvv(), $credit->getDateExpiration()));
    }
    function recupererCredit($client){
        $prepare = $this->db->prepare("SELECT * FROM credit WHERE idClient=?");
        $id = $client->getIdClient();
        $prepare->bind_param('i', $id);
        $prepare->execute();
        $req = $prepare->get_result();
    	if ($req->num_rows){
            $credit = $req->fetch_assoc();
            return new credit($credit['idClient'], $credit['numero'], $credit['cvv'], $credit['dateExpiration']);
        }else{
            return new credit();
        }
    	
    }
    function modCredit($id, $credit){
        $prepare = $this->db->prepare("UPDATE credit SET numero=?, cvv=?, dateExpiration=? WHERE idClient=?");
    	$prepare->execute(array($credit->getNumero(), $credit->getCvv(), $credit->getDateExpiration(),$id));
    }
    function UpdateMdp($client){
        $prepare = $this->db->prepare("UPDATE Utilisateur SET mdp=? WHERE idUtilisateur=?");
    	$prepare->execute(array($client->parent->getMdp(), $client->getIdClient()));
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
    function searchChambre($mot, $idHotel){
        $mot = "%".$mot."%";
    	$prepare = $this->db->prepare("SELECT * FROM Chambres WHERE (typeChambre LIKE ? OR  description LIKE ? OR  numeroChambre LIKE ? OR  equipement LIKE ? OR prix LIKE ? OR  superficie LIKE ? OR  disponible LIKE ?) AND idHotel=?");
        $prepare->bind_param("sssssssi", $mot, $mot, $mot, $mot, $mot, $mot, $mot, $idHotel);
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
        $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises, Excursions WHERE idVoyage=idExcursion AND (description LIKE ? OR transport LIKE ? OR destination LIKE ? OR iteneraire LIKE ? OR prixDefault LIKE ? OR nbrPlaces LIKE ? OR equipement LIKE ? OR prixAdult LIKE ? OR prixEnfnts LIKE ? OR prixBebe LIKE ? OR heureDepart LIKE ? OR dateD LIKE ? OR heureRetour LIKE ?)");
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
    $prepare = $this->db->prepare("SELECT * FROM VoyageOrganises, Sejour WHERE idVoyage=idSejour AND (description LIKE ? OR transport LIKE ? OR destination LIKE ? OR iteneraire LIKE ? OR prixDefault LIKE ? OR nbrPlaces LIKE ? OR equipement LIKE ? OR prixAdult LIKE ? OR prixEnfnts LIKE ? OR prixBebe LIKE ? OR heureDepart LIKE ? OR dateD LIKE ? OR dateR LIKE ? OR nbrJour LIKE ?)");
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
    function ajouterReservation($reservation){
        $prepare = $this->db->prepare("INSERT INTO Reservations (status, typePaiement, prix, date, informationSup, idClient, idAgent, idChambre, idVoyage, progression) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $prepare->execute(array($reservation->getStatus(), $reservation->getTypePaiement(), $reservation->getPrix(), $reservation->getDate(), $reservation->getInformationSup(), $reservation->getIdClient(), $reservation->getIdAgent(), $reservation->getIdHotel(), $reservation->getIdVoyage(), $reservation->getProgression()));
    }
    function annulerReservation($idReservation){
        $prepare = $this->db->prepare("DELETE FROM Reservations WHERE idReservation=?");
        $prepare->execute(array($idReservation));
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
function ajouterMessage($message){
    $prepare = $this->db->prepare("INSERT INTO Contact (idSource, idDestinataire, objet, contenu,date, lu) VALUES (?,?,?,?,?,?)");
    $prepare->execute(array($message->getIdSource(), $message->getIdDestinataire(), $message->getObjet(), $message->getContenu(), $message->getDate(), $message->getLu()));
}

function desabonner($id){
    $prepare = $this->db->prepare("UPDATE Clients SET desabonner=1 WHERE idClient=?");
    $prepare->execute(array($id));
}
}
?>