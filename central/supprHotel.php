<?php
    require_once 'Classe-db.php';
    $session = $_COOKIE['SESSION'];
    $bdd = new BD();
    $exist;
    $token = "";
    $bdd = new BD();
    $admin = $bdd->recupererAdmin($session);
    if(isset($_GET['idHotel'])){
        $bdd->supprimerHotel($_GET['idHotel']);
        header('Location: listeHotels.php');
    }
?>