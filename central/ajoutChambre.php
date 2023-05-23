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
require_once 'Classes/Hotel.php';
require_once 'Classes/Chambre.php';
require_once 'Classes/Image.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['SESSION'];

$bdd = new BD();
$exist;
$token = "";
if (isset($_POST['typeChambre']) && isset($_POST['description'])&& isset($_POST['numeroCh'])&& isset($_POST['mdp'])&& isset($_POST['prix'])&& isset($_POST['equipement'])&& isset($_POST['superficie'])&& isset($_POST['CSRFToken'])&& isset($_GET['idHotel'])){
    $total_files = count($_FILES['images']['name']);
    $typeChambre = htmlspecialchars($_POST['typeChambre']);
  $description = htmlspecialchars($_POST['description']);
  $idHotel = $_GET['idHotel'];
  $numeroCh = htmlspecialchars($_POST['numeroCh']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp = md5($mdp);
  $prix = htmlspecialchars($_POST['prix']);
  $equipement = htmlspecialchars($_POST['equipement']);
  $superficie = htmlspecialchars($_POST['superficie']);
  $token = $_POST['CSRFToken'];
  $chambre = new Chambre(
    0,
    $idHotel,
    $typeChambre,
    $description,
    $numeroCh,
    $prix,
    $equipement,
    $superficie,
    1);
    $admin = $bdd->recupererAdmin($session);
    if($bdd->verifierUtilisateur($admin->parent->parent->getEmail(), $mdp)[0] == 4){
        $bdd->insertChambre($chambre);
        if ($total_files > 0){
            $idChambre = $bdd->chambre($chambre);
            $upload_directory = "images/chambre/".$idChambre."/";
            if (!is_dir($upload_directory)) {
                mkdir($upload_directory, 0755, true);
            }
            for ($i = 0; $i < $total_files; $i++) {
                // Vérifiez si le fichier a été correctement téléchargé
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    // Récupérer le nom temporaire du fichier
                    $tmp_name = $_FILES['images']['tmp_name'][$i];
        
                    // Récupérer le nom original du fichier
                    $file_name = $_FILES['images']['name'][$i];
                    $type = array('jpg', 'jpeg', 'gif', 'png');
                    $typeone = strtolower(substr(strrchr($file_name, '.'), 1)); 
                    if(in_array($typeone, $type)){
                        // Générer un nom de fichier unique pour éviter les conflits
                        $unique_file_name = uniqid() . '_' . $file_name;
            
                        // Construire le chemin complet du fichier téléchargé
                        $destination_path = $upload_directory . $unique_file_name;
                        $image = new Image(
                            0,
                            $idChambre,
                            0,
                            0,
                            $destination_path
                            
                        );
                        // Déplacez le fichier téléchargé vers le dossier de destination
                        if (move_uploaded_file($tmp_name, $destination_path)) {
                            $bdd->ajouterImage($image);
                        } else {
                            echo "Erreur lors du téléchargement de l'image " . $file_name . ".<br>";
                        }
                    }
                } else {
                    echo "Erreur lors du téléchargement des images.<br>";
                }
            }
        }
        echo "<script>window.location.href='chambre.php?q=1&idHotel=".$_GET['idHotel']."'</script>";
    }else{
        echo "<script>window.location.href='chambre.php?q=2&idHotel=".$_GET['idHotel']."'</script>";
    }
}else{
    echo "<script>window.location.href='chambre.php?q=4&idHotel=".$_GET['idHotel']."'</script>";
}

if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='chambre.php?q=3&idHotel=".$_GET['idHotel']."'</script>";
  }                     
}
?>
</body>
</html>