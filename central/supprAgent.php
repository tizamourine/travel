<?php
    require_once 'Classe-db.php';
    $session = $_COOKIE['SESSION'];
    $bdd = new BD();
    $exist;
    $token = "";
    $bdd = new BD();
    $admin = $bdd->recupererAdmin($session);
    if(isset($_GET['idAgent'])){
        $bdd->deleteAgent($_GET['idAgent']);
        header('Location: listeAgent.php');
    }
?>