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
require_once 'Classes/credit.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['PHPSESSID'];
$bdd = new BD();
$exist = 0;
$token = "";
  $numero = htmlspecialchars($_POST['numero']);
  $cvv = htmlspecialchars($_POST['cvv']);
  $cvv = md5($cvv);
  $dateExpiration = htmlspecialchars($_POST['dateExpiration']);
  $token = $_POST['CSRFToken'];
  if($numero!="" && $cvv !="" && $dateExpiration !=""){
      $client = $bdd->recupererClient($session);
        $credit = new credit($client->getIdClient(), $numero,$cvv, $dateExpiration);
        $bdd->modCredit($client->getIdClient(), $credit);
        echo "<script>window.location.href='paiement.php?q=2'</script>";
  }else{
    echo "<script>window.location.href='paiement.php?q=4'</script>";
  } 

if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='paiement.php?q=3'</script>";
  }                     
}

?>
</body>
</html>