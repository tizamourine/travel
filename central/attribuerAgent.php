<?php
    require_once 'Classe-db.php';
    $session = $_COOKIE['SESSION'];
    $bdd = new BD();
    $exist;
    $token = "";
    $bdd = new BD();
    $admin = $bdd->recupererAdmin($session);
    if(isset($_GET['idClient']) && isset($_GET['idAgent'])){
        $client = $bdd->recupererClient($_GET['idClient']);
        $client->setIdAgent($_GET['idAgent']);
        $bdd->modifierClient($client);
        $bdd->updateReservation($_GET['idAgent'], $client->getIdClient());
        $messages = $bdd->recupererListeMessageEnvoye($client->getIdClient());
        foreach($messages as $message){
            $message->setIdDestinataire($_GET['idAgent']);
            $bdd->modifierMessage($message);
        }
        header('Location: listeNClient.php');
    }
?>