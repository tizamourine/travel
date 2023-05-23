<?php
require_once 'Classe-db.php';
require_once 'Classes/Client.php';
session_start();
$session = $_COOKIE['PHPSESSID'];
$bdd = new BD();
$client = $bdd->recupererClient($session);
$bdd->updateSession($client->getIdClient(), null);
header("Location: index.php");
?>