<?php
    require_once 'Classe-db.php';
    $session = $_COOKIE['SESSION'];
    $bdd = new BD();
    $exist;
    $token = "";
    $bdd = new BD();
    $admin = $bdd->recupererAdmin($session);
    if(isset($_GET['idExcursion'])){
        $bdd->supprimerExcursion($_GET['idExcursion']);
        header('Location: listeExcursion.php');
    }
?>