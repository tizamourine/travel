<?php
require_once 'Classe-db.php';
require_once 'Classes/Administrateur.php';
require_once 'Classes/Agent.php';
session_start();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$admin = $bdd->recupererAgentAvecSession($session);

$bdd->updateSession($admin->getIdAgent(), null);
header("Location: index.php");
?>