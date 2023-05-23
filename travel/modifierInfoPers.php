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
  
  if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])&& isset($_POST['numTel'])){
    $email = htmlspecialchars($_POST['email']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $numTel = htmlspecialchars($_POST['numTel']);
    $photo = htmlspecialchars($_FILES['photo']['name']);
    $token = $_POST['CSRFToken'];
    $client = $bdd->recupererClient($session);
    $client->parent->setEmail($email);
    $client->parent->setNom($nom);
    $client->parent->setPrenom($prenom);
    $client->parent->setNumTel($numTel);
    $type = array('jpg', 'jpeg', 'gif', 'png');				
    if(isset($_FILES['photo'])) $typeone = strtolower(substr(strrchr($photo, '.'), 1)); 
    if ($_FILES['photo']['name'] == "") {$typeone = strtolower(substr(strrchr($client->parent->getPhoto(), '.'), 1));
    }
    
	if (in_array($typeone, $type)){
        $chemin = "membres/profiles/" . $client->getIdClient().'.'. $typeone;
        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'] , $chemin);
        if($resultat){
            $client->parent->setPhoto($chemin);
        }
        $bdd->updateInfoPers($client);
        echo "<script>window.location.href='infopers.php'</script>";
    }else{
        echo "<script>window.location.href='infopers.php?q=1'</script>";
      }
  }else{
    echo "<script>window.location.href='infopers.php?q=4'</script>";
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