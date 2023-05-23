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
require_once 'Classes/Image.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$exist = 0;
$token = "";
if (isset($_POST['nomHotel']) && isset($_POST['adresse'])&& isset($_POST['etoiles'])&& isset($_POST['mdp'])&& isset($_POST['numTel'])&& isset($_POST['ville'])&& isset($_POST['coordonnee'])&& isset($_POST['CSRFToken'])){
  $total_files = count($_FILES['images']['name']);
  $nomHotel = htmlspecialchars($_POST['nomHotel']);
  $adresse = htmlspecialchars($_POST['adresse']);
  $etoiles = htmlspecialchars($_POST['etoiles']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp = md5($mdp);
  $numTel = htmlspecialchars($_POST['numTel']);
  $ville = htmlspecialchars($_POST['ville']);
  $coordonnee = htmlspecialchars($_POST['coordonnee']);
  $token = $_POST['CSRFToken'];
  $hotel = new Hotel(0,
    $nomHotel,
    $adresse,
    $etoiles,
    $numTel,
    $ville,
    $coordonnee);
    $admin = $bdd->recupererAdmin($session);
    if($bdd->verifierUtilisateur($admin->parent->parent->getEmail(), $mdp)[0] == 4){
        $bdd->insertHotel($hotel);
        if ($total_files > 0){
        $idHotel = $bdd->hotel($hotel);
        $upload_directory = "images/hotel/".$idHotel."/";
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
                        0,
                        $idHotel,
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
        echo "<script>window.location.href='hotel.php?q=1'</script>";
    }else{
        echo "<script>window.location.href='hotel.php?q=2'</script>";
    }
}else{
    echo "<script>window.location.href='hotel.php?q=4'</script>";
}

if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='hotel.php?q=3'</script>";
  }                     
}
if ($exist == 1){
    echo "<script>window.location.href='hotel.php?q=2'</script>";
            
}
?>
</body>
</html>