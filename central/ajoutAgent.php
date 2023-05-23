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
require_once 'Classes/Agent.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$exist = 0;
$token = "";
if (isset($_POST['email'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['mdp'])&&isset($_POST['mdp1'])&&isset($_POST['numTel'])&&$_POST['sexe'] != "Sexe"&&isset($_POST['salaire'])&&isset($_POST['grade'])){
  $email = htmlspecialchars($_POST['email']);
  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp = md5($mdp);
  $mdp2 = htmlspecialchars($_POST['mdp1']);
  $mdp2 = md5($mdp2);
  $numTel = htmlspecialchars($_POST['numTel']);
  $sexe = htmlspecialchars($_POST['sexe']);
  $salaire = htmlspecialchars($_POST['salaire']);
  $grade = htmlspecialchars($_POST['grade']);
  $token = $_POST['CSRFToken'];
  if($mdp == $mdp2){
      if($bdd->verifierUtilisateur($email, $mdp)[0] == 0){
        $agent = new Agent(0, $nom, $prenom, $email,$mdp, null, $numTel, null, $sexe, $salaire, $grade);
        $bdd->insertAgent($agent);
        echo "<script>window.location.href='ajouterAgent.php?q=1'</script>";
      }else{
        $exist = 1;
      }
  }else{
    echo "<script>window.location.href='ajouterAgent.php?q=5'</script>";
  } 
}else{
  echo "<script>window.location.href='ajouterAgent.php?q=4'</script>";
}

if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='ajouterAgent.php?q=3'</script>";
  }                     
}
if ($exist == 1){
    echo "<script>window.location.href='ajouterAgent.php?q=2'</script>";
            
}
?>
</body>
</html>