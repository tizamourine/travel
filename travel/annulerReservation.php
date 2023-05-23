<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classes/Reservation.php';
	require_once 'Classes/credit.php';
	require_once 'Classe-db.php';
	session_start();
	$csrf_token = generateCsrfToken();
	$session = $_COOKIE['PHPSESSID'];
	$bdd = new BD();
	$exist = 0;
	$ajout = 0;
	$q=0;
	if(isset($_GET['q'])){
	$q = $_GET['q'];
	}
	$bdd->ajouterToken($session, $csrf_token);
	$client = $bdd->recupererClient($session);
    if (isset($_GET['idReservation']
    )){
		if(isset($_POST['mdp'])){
			$mdp=md5($_POST['mdp']);
			if($client->parent->getMdp() == $mdp){
				$bdd->annulerReservation($_GET['idReservation']);
				header('Location: mesReservations.php');
			}else{
				echo "mot de passe incorrect ";
			}
		}
	}