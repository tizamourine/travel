<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
</head>
<body>
    

<?php
require_once 'methodes/methodes.php';
require_once 'Classes/Client.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['PHPSESSID'];
$bdd = new BD();
$exist = 0;
$token = "";
  
  if(isset($_POST['mdp1']) && isset($_POST['mdp2']) && isset($_POST['mdp3'])){
    $mdp1 = htmlspecialchars($_POST['mdp1']);
    $mdp1 = md5($mdp1);
    $mdp2 = htmlspecialchars($_POST['mdp2']);
    $mdp3 = htmlspecialchars($_POST['mdp3']);
    $token = $_POST['CSRFToken'];
    $client = $bdd->recupererClient($session);
    if (isset($_POST['confirmer'])){
      if($client->parent->getMdp() == md5($_POST['confirmer'])){
        $bdd->desabonner($client->getIdClient());
        echo "<script>window.location.href='securite.php'</script>";
      }
    }
	else if ($mdp2 == $mdp3){
        if($client->parent->getMdp() == $mdp1){
            $mdp2 = md5($mdp2);
            $client->parent->setMdp($mdp2);
            $bdd->updateMdp($client);
            echo "<script>window.location.href='securite.php'</script>";
        }else{
          echo "<script>window.location.href='securite.php?q=2'</script>";
        }
    }else{
        echo "<script>window.location.href='securite.php?q=1'</script>";
    }
  }else{
    echo "<script>window.location.href='securite.php?q=4'</script>";
  } 


if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='inscription.php?q=3'</script>";
  }                     
}
?>
</body>
</html>