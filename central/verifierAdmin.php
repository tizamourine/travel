<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central</title>
</head>
<body>
    

<?php
require_once 'methodes/methodes.php';
require_once 'Classes/Agent.php';
require_once 'Classes/Administrateur.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$exist = 1;
$token = "";
if (isset($_POST['email'])){
  $email = htmlspecialchars($_POST['email']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $token = $_POST['CSRFToken'];
    if($email!="" ||$mdp !=""){
        $mdp = md5($mdp);
        $c = $bdd->verifierUtilisateur($email, $mdp);
        if($c[0] == 4){
                $admin = $c[1];
                $bdd->updateSession($admin->getIdAdministrateur(), $session);
                echo "<script>window.location.href='profileAdmin.php'</script>";
        }else if($c[0] == 5){
            $admin = $c[1];
            $bdd->updateSession($admin->getIdAgent(), $session);
            echo "<script>window.location.href='profileAgent.php'</script>";
        }else if($c[0] == 0){
            echo "<script>window.location.href='index.php?q=1'</script>";
        }else if($c[0] == 1){
            $exist = 0;
            echo "<script>window.location.href='index.php?q=2'</script>";
        }else{
            echo "<script>window.location.href='index.php?q=5'</script>";
        }
    }else{
        echo "<script>window.location.href='index.php?q=4'</script>";
    } 
}
if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='index.php?q=3'</script>";
  }                     
}
if ($exist == 0){
    echo "<script>window.location.href='index.php?q=2'</script>";
            
}
?>
</body>
</html>