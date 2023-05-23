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
if (isset($_POST['email'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['mdp'])&&isset($_POST['mdp2'])&&isset($_POST['numTel'])&&$_POST['sexe'] != "Sexe" &&$_POST['identite']!="Identite"&&isset($_POST['numIdentite'])){
  $email = htmlspecialchars($_POST['email']);
  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp = md5($mdp);
  $mdp2 = htmlspecialchars($_POST['mdp2']);
  $mdp2 = md5($mdp2);
  $numTel = htmlspecialchars($_POST['numTel']);
  $sexe = htmlspecialchars($_POST['sexe']);
  $identite = htmlspecialchars($_POST['identite']);
  $numIdentite = htmlspecialchars($_POST['numIdentite']);
  $token = $_POST['CSRFToken'];
  if($mdp == $mdp2){
      if($bdd->verifierUtilisateur($email, $mdp)[0] == 0){
        $client = new Client(0, $nom, $prenom, $email,$mdp, null, $numTel, null, $sexe, $identite, $numIdentite);
        $bdd->insertClient($client);echo $client->getSession();
        echo "<script>window.location.href='inscription.php?q=1'</script>";
      }else{
        $exist = 1;
      }
  }else{
    echo "<script>window.location.href='inscription.php?q=5'</script>";
  } 
}else{
  echo "<script>window.location.href='inscription.php?q=4'</script>";
}

if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='inscription.php?q=3'</script>";
  }                     
}
if ($exist == 1){
    echo "<script>window.location.href='inscription.php?q=2'</script>";
            
}
?>
</body>
</html>