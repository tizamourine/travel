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
require_once 'Classes/Excursion.php';
require_once 'Classes/Image.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$exist = 0;
$token = "";
if (isset($_POST['description']) && isset($_POST['transport'])&& isset($_POST['destination'])&& isset($_POST['mdp'])&& isset($_POST['iteneraire'])&& isset($_POST['prixDefault'])&& isset($_POST['nbrPlaces'])&&isset($_POST['equipement'])&& isset($_POST['prixAdulte'])&&isset($_POST['prixEnfnts'])&& isset($_POST['prixBebe'])&&isset($_POST['heureDepart'])&& isset($_POST['dateD'])&&isset($_POST['heureRetour'])&& isset($_POST['CSRFToken'])){
  $total_files = count($_FILES['images']['name']);
  $description = htmlspecialchars($_POST['description']);
  $transport = htmlspecialchars($_POST['transport']);
  $destination = htmlspecialchars($_POST['destination']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp = md5($mdp);
  $iteneraire = htmlspecialchars($_POST['iteneraire']);
  $prixDefault = htmlspecialchars($_POST['prixDefault']);
  $nbrPlaces = htmlspecialchars($_POST['nbrPlaces']);
  $equipement = htmlspecialchars($_POST['equipement']);
  $prixEnfnts = htmlspecialchars($_POST['prixEnfnts']);
  $prixBebe = htmlspecialchars($_POST['prixBebe']);
  $heureDepart = htmlspecialchars($_POST['heureDepart']);
  $dateD = htmlspecialchars($_POST['dateD']);
  $heureRetour = htmlspecialchars($_POST['heureRetour']);
  $prixAdulte = htmlspecialchars($_POST['prixAdulte']);
  $token = $_POST['CSRFToken'];
  $excursion = new Excursion(
    0,
    $description,
    $transport,
    $destination,
    $iteneraire,
    $prixDefault,
    $nbrPlaces,
    $equipement,
    $prixAdulte,
    $prixEnfnts,
    $prixBebe,
    $heureDepart,
    $dateD,
    $heureRetour  
);
    $admin = $bdd->recupererAdmin($session);
    if($bdd->verifierUtilisateur($admin->parent->parent->getEmail(), $mdp)[0] == 4){
        $bdd->insertExcursion($excursion);
        if ($total_files > 0){
        $idExcursion = $bdd->VoyageOrganises($excursion);
        $upload_directory = "images/Excursion/".$idExcursion."/";
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
                        0,
                        $idExcursion,
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
        echo "<script>window.location.href='excursion.php?q=1'</script>";
    }else{
        echo "<script>window.location.href='excursion.php?q=2'</script>";
    }
}else{
    echo "<script>window.location.href='excursion.php?q=4'</script>";
}


if ($token != ""){
  if($bdd->verifierToken($token, $session) == 0){
    echo "<script>window.location.href='excursion.php?q=3'</script>";
  }                     
}
?>
</body>
</html>