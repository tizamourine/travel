<?php
require_once 'Classe-db.php';
require_once 'Classes/Client.php';
function generateCsrfToken() {
    // Générer un jeton CSRF aléatoire et unique
    $token = bin2hex(random_bytes(32));
    
    // Stocker le jeton CSRF dans une variable de session
    $_SESSION['csrf_token'] = $token;
    
    return $token;
}
function headerSansSession(){
  echo <<<'EOT'
        <header class="top-area">
        <div class="header-area">
        <div class="container">
        <div class="row">
        <div class="col-sm-2">
        <div class="logo">
        <a href="index.html">
        Tra<span>vel</span>
        </a>
        </div><!-- /.logo-->
        </div><!-- /.col-->
        <div class="col-sm-10">
        <div class="main-menu">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <i class="fa fa-bars"></i>
        </button><!-- / button-->
        </div><!-- /.navbar-header-->
        <div class="collapse navbar-collapse">  
        <ul id="nav-bar" class="nav navbar-nav navbar-right">
        <li class="smooth"><a href="index.php#home">Acceuil</a></li>
        <li class="smooth"><a href="index.php#pack">Offres</a></li>
        <li class="smooth"><a href="index.php#gallery">Destination</a></li>
        <li class="smooth"><a href="index.php#foot">A propos</a></li>
        <li class="smooth"><a href="contact.php">Contact</a></li>
        <li>
        <a href="connexion.php" class="book-btn">se connecter 
        </a>
        </li><!--/.project-btn--> 
        </ul>
        </div><!-- /.navbar-collapse -->
        </div><!-- /.main-menu-->
        </div><!-- /.col-->
        </div><!-- /.row -->
        <div class="home-border"></div><!-- /.home-border-->
        </div><!-- /.container-->
        </div><!-- /.header-area -->
        
        </header><!-- /.top-area-->
        <style>
        #nav-bar{display:inline-block;
        }
        </style>
        <!-- main-menu End -->
        EOT;
}

function headerAvecSession($bdd, $client){
  echo <<<'EOT'
  <header class="top-area">
  <div class="header-area">
  <div class="container">
  <div class="row">
  <div class="col-sm-2">
  <div class="logo">
  <a href="index.html">
  Tra<span>vel</span>
  </a>
  </div><!-- /.logo-->
  </div><!-- /.col-->
  <div class="col-sm-10">
  <div class="main-menu">
  
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  <i class="fa fa-bars"></i>
  </button><!-- / button-->
  </div><!-- /.navbar-header-->
  <div class="collapse navbar-collapse">  
  <ul id="nav-bar" class="nav navbar-nav navbar-right" style="">
  <li class="smooth"><a href="index.php#home">Acceuil</a></li>
  <li class="dropdown" style="width:10px;pading: bottom 30px;margin-bottom:29px; padding-right:50px;"><a href="javascript:void(0)" class="dropbtn">Offres</a> 
    <div class="dropdown-content" style="width:190px;postion:relative; left:-25px;">
    <div class="list"><img class="img" src="assets/images/hotel.png" width="10%" height="3%">
    <a href="hotels.php" style="color: black;" >hotel</a></div>
  <div class="list"><img class="img" width="10%" height="3%" src="assets/images/avion.png" alt="">
    <a href="sejours.php" style="color: black;">Séjour</a></div>
  <div class="list"><img class="img" width="10%" height="3%" src="assets/images/icone-de-messagerie.png" alt="">
    <a href="excursions.php" style="color: black;">Excursion</a></div>
  </div>
  </li>
  <li class="smooth"><a href="index.php#gallery">Destination</a></li>
  <li class="smooth"><a href="index.php#foot" style="width: 90px;">A propos</a></li>
  <li class="smooth"><a href="contact.php">Contact</a></li>
  <li class="dropdown">
  EOT;
  $messages = $bdd->recupererListeMessageNonLu($client->getIdClient());
  if (count($messages) > 0){
      echo <<<'EOT'
      <div class="notification-container">
      <span class="notification-circle"  style="display:flex;";>
      EOT;
       echo count($messages)."</span> </div>";
  }
  echo '<a href="javascript:void(0)" class="dropbtn" >'.$client->parent->getNom()."</a>";
  echo <<<'EOT'
    <div class="dropdown-content">
    <div class="list"><img class="img" src="assets/images/utilisateur.png" width="10%" height="3%">
      <a href="profile.php" style="color: black;" >Profil</a></div>
    <div class="list"><img class="img" width="10%" height="3%" src="assets/images/avion.png" alt="">
      <a href="mesReservations.php" style="color: black;">Réservations</a></div>
    <div class="list"><img class="img" width="10%" height="3%" src="assets/images/icone-de-messagerie.png" alt="">
    EOT;
    if (count($messages) > 0){
      echo <<<'EOT'
      <div class="notification-container">
      <span class="notification-circle"  style="display:flex;";>
      EOT;
       echo count($messages)."</span> </div>";
  }  
  echo <<<'EOT'
    <a href="messagerie.php" style="color: black;">Méssagerie</a></div>
    <div class="list"><img class="img" width="10%" height="3%" src="assets/images/symbole-dengrenage.png" alt="">
      <a href="parametre.php" style="color: black;">Paramètres</a></div>
    <div class="list"><img class="img" src="assets/images/deconnexion.png" width="10%" height="3%">
      <a href="deconnexion.php" style="color: black;">Déconnexion</a></div>
      </div>
  </li>
  EOT;
  if($client->parent->getPhoto() == null){
    afficherImage("assets/images/Colorful_splash.jpg");
  }else{
    afficherImage($client->parent->getPhoto());
  }
  echo <<<'EOT'
        </ul>
        </div><!-- /.navbar-collapse -->
        </div><!-- /.main-menu-->
        </div><!-- /.col-->
        </div><!-- /.row -->
        <div class="home-border"></div><!-- /.home-border-->
        </div><!-- /.container-->
        </div><!-- /.header-area -->
        
        </header><!-- /.top-area-->
        <style>header ul a{margin-left:5%;margin-right:5%}
        #nav-bar{display:inline-block;direction: ltr;
        }
        #profile{
          position:fixed;
          right:1%;
          top:3%;
          z-index: 1000; 
          height: 9%;
        }
        @media (max-width:1150px){
          #profile{
            width:5%;
            z-index: 1000; 
          }
        }
        @media (max-width:760px){
          #profile{
            position:relative;
            width:50%;
            height:70%;
            right:-200px;
            top:-45;
            z-index: 1000; 
          }
        }
        .notification-container {
          position: relative;
          display: inline-block;
        }
        
        .notification-circle {
          position: absolute;
          top: -5px;
          right: -5px;
          width: 20px;
          height: 20px;
          background-color: red;
          border-radius: 50%;
          display: flex;
          justify-content: center;
          align-items: center;
          color: white;
          font-size: 12px;
          font-weight: bold;
        }
        </style>
        EOT;
}
function afficherImage($chemin){
  echo '<img width="5%" id="profile" class="img" src="'.$chemin.'" style="border-radius: 50%;"/>';
}
function verifierSession($session){
    $bdd = new BD();
    if($bdd->verifierSession($session) == 0){
        headerSansSession();
    }else{
        $client = $bdd->recupererClient($session);
        headerAvecSession($bdd, $client);
    }
  }
    function verifierSessions($session){
      $bdd = new BD();
      if($bdd->verifierSession($session) == 0){
        echo "<script> window.location.href = 'connexion.php'</script>";
      }else{
        $client = $bdd->recupererClient($session);
          headerAvecSession($bdd, $client);
      }
    
}
function footer(){
  $bdd = new BD();
  $sejours = $bdd->listeSejour();
  $excursions = $bdd->listeExcursion();
  echo <<<'EOT'
  <!-- footer-copyright start -->
<footer  class="footer-copyright" id="foot">
<div class="container">
<div class="footer-content">
<div class="row">

<div class="col-sm-3">
<div class="single-footer-item">
<div class="footer-logo">
<a href="index.html">
Tra<span>vel</span>
</a>
<p>
Méilleur agence de voyage.
</p>
</div>
</div><!--/.single-footer-item-->
</div><!--/.col-->

<div class="col-sm-3">
<div class="single-footer-item">
<h2>link</h2>
<div class="single-footer-txt">
<p><a href="index.php#home">Acceuil</a></p>
<p><a href="index.php#gallery">Destinations</a></p>
<p><a href="index.php#pack">Offres</a></p>
<p><a href="#">Blog</a></p>
<p><a href="contact.php">Contact</a></p>
</div><!--/.single-footer-txt-->
</div><!--/.single-footer-item-->

</div><!--/.col-->

<div class="col-sm-3">
<div class="single-footer-item">
<h2>destinations populaires</h2>
<div class="single-footer-txt">
EOT;
foreach($sejours as $sejour){
echo '<p><a href="sejours.php?s='.$sejour->parent->getDestination().'">'.$sejour->parent->getDestination().'</a></p>';
}
foreach($excursions as $excursion){
echo '<p><a href="excursions.php?s='.$excursion->parent->getDestination().'">'.$excursion->parent->getDestination().'</a></p>';
}
echo <<<'EOT'
</div><!--/.single-footer-txt-->
</div><!--/.single-footer-item-->
</div><!--/.col-->

<div class="col-sm-3">
<div class="single-footer-item text-center">
<h2 class="text-left">Contact</h2>
<div class="single-footer-txt text-left">
<p>+213 798117690</p>
<p class="foot-email"><a href="#">abdelkaderamine.karbache@se.univ-bejaia.dz</a></p>
<p>Akfadou</p>
<p>Béjaia, Algérie</p>
</div><!--/.single-footer-txt-->
</div><!--/.single-footer-item-->
</div><!--/.col-->

</div><!--/.row-->

</div><!--/.footer-content-->
<hr>
<div class="foot-icons ">
<ul class="footer-social-links list-inline list-unstyled">
                <li><a href="#" target="_blank" class="foot-icon-bg-1"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" target="_blank" class="foot-icon-bg-2"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" target="_blank" class="foot-icon-bg-3"><i class="fa fa-instagram"></i></a></li>
        </ul>
        <p>&copy; 2017 <a href="https://www.themesine.com">ThemeSINE</a>. All Right Reserved</p>

        </div><!--/.foot-icons-->
<div id="scroll-Top">
<i class="fa fa-angle-double-up return-to-top" id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
</div><!--/.scroll-Top-->
</div><!-- /.container-->

</footer><!-- /.footer-copyright-->
<!-- footer-copyright end -->
EOT;
}
function sejours(){
  $bdd = new BD();
  $sejours = $bdd->listeSejour();
  echo "<h3 style='text-align:center;color:#222222;text-decoration:underline;'> Sejours</h3><br><br>";
  foreach($sejours as $sejour){
  echo <<<'EOT'
  <div class="col-md-4 col-sm-6">
<div class="single-package-item">
EOT;
echo '<img src="'.$bdd->recupererVoyageImage($sejour->getIdSejour())[0].'"';
echo <<<'EOT'
alt="package-place">
<div class="single-package-item-txt">
<h3>
EOT;
echo $sejour->parent->getDestination();
echo <<<'EOT'
<span class="pull-right">
EOT;
echo $sejour->parent->getPrixDefault().'DA';
echo <<<'EOT'
</span></h3>
<div class="packages-para">
<p>
<span>
<i class="fa fa-angle-right"></i>
EOT;
echo $sejour->getNbrJours()." Jours";
echo <<<'EOT'
</span>
<i class="fa fa-angle-right"></i>
EOT;
  echo "Hébergement ".$sejour->recupererHotel()->getEtoiles()." étoiles";
  echo <<<'EOT'
</p>
<p>
<span>
<i class="fa fa-angle-right"></i>  
EOT;
echo "Transport avec ".$sejour->parent->getTransport();
echo <<<'EOT'
</span>
 </p>
</div><!--/.packages-para-->
<div class="packages-review">
<p>
EOT;
for($i=0; $i<$sejour->recupererHotel()->getEtoiles();$i++)
  echo '<i class="fa fa-star"></i>';



echo <<<'EOT'
</p>
</div><!--/.packages-review-->
<div class="about-btn">
<a 
EOT;
echo 'href="reserverSejour.php?idSejour='.$sejour->getIdSejour().'"';
echo <<<'EOT'
class="about-view packages-btn">
Réserver
</a>
</div><!--/.about-btn-->
</div><!--/.single-package-item-txt-->
</div><!--/.single-package-item-->

</div><!--/.col-->
EOT;
  }
}
function excursions(){
  $bdd = new BD();
  $excursions = $bdd->listeExcursion();
  echo "<h3 style='text-align:center;color:#222222;text-decoration:underline;'> Excursions</h3><br><br>";
  foreach($excursions as $excursion){
  echo <<<'EOT'
  <div class="col-md-4 col-sm-6">
<div class="single-package-item">
EOT;
echo '<img src="'.$bdd->recupererVoyageImage($excursion->getIdExcursion())[0].'"';
echo <<<'EOT'
 alt="package-place">
<div class="single-package-item-txt">
<h3>
EOT;
echo $excursion->parent->getDestination();
echo <<<'EOT'
<span class="pull-right">
EOT;
echo $excursion->parent->getPrixDefault().'DA';
echo <<<'EOT'
</span></h3>
<div class="packages-para">
<p>
<span>
<i class="fa fa-angle-right"></i>
EOT;
echo "Retour à ".$excursion->getHeureRetour();
echo <<<'EOT'
</span>
<i class="fa fa-angle-right"></i>  
EOT;
echo "Transport avec ".$excursion->parent->getTransport();
echo <<<'EOT'
</span>
 </p>
</div><!--/.packages-para-->
<div class="packages-review">
EOT;
echo <<<'EOT'
</p>
</div><!--/.packages-review-->
<div class="about-btn">
<a 
EOT;
echo 'href="reserverExcursion.php?idExcursion='.$excursion->getIdExcursion().'"';
echo <<<'EOT'
class="about-view packages-btn">
Réserver
</a>
</div><!--/.about-btn-->
</div><!--/.single-package-item-txt-->
</div><!--/.single-package-item-->

</div><!--/.col-->
EOT;
  }
}
function destinations(){
  $bdd = new BD();
  $sejours = $bdd->listeSejour();
  $excursions = $bdd->listeExcursion();
  foreach($sejours as $sejour){
    destination($bdd->recupererVoyageImage($sejour->getIdSejour())[0], "reserverSejour.php?idSejour=".$sejour->getIdSejour(), $sejour->parent->getDestination());
  }
  foreach($excursions as $excursion){
    destination($bdd->recupererVoyageImage($excursion->getIdExcursion())[0], "reserverExcursion.php?idExcursion=".$excursion->getIdExcursion(), $excursion->parent->getDestination());
  }
}
function destination($image, $chemin, $destination){
  echo <<<'EOT'
  <div class="col-md-6">
<div class="filtr-item" style="height:300px;width:500px">
EOT;
echo '<img src="'.$image.'"';

echo <<<'EOT'
alt="image du portfolio" />
<div class="item-title">
EOT;
echo '<a href="'.$chemin.'">';


echo $destination;
echo <<<'EOT'
</a>
<p><span>12 circuits</span><span>9 lieux</span></p>
</div> <!-- /.item-title-->
</div><!-- /.filtr-item -->
</div><!-- /.col -->
EOT;
}
function hotels(){
  $bdd = new BD();
  $hotels = $bdd->recupererListeHotels();
  echo "<h3 style='text-align:center;color:#222222;text-decoration:underline;'> Hotels</h3><br><br>";
  foreach($hotels as $hotel){
  echo <<<'EOT'
  <div class="col-md-4 col-sm-6">
<div class="single-package-item">
EOT;
echo '<img src="'.$bdd->recupererHotelImage($hotel->getIdHotel())[0].'"';
echo <<<'EOT'
 alt="package-place">
<div class="single-package-item-txt">
<h3>
EOT;
echo $hotel->getVille();
echo <<<'EOT'
<span class="pull-right">
</span></h3>
<div class="packages-para">
<p>
<span>
<i class="fa fa-angle-right"></i>
EOT;
echo $hotel->getNomHotel();
echo <<<'EOT'
</span>
</p>
<p>
<i class="fa fa-angle-right"></i>  
EOT;
echo "Addresse: ".$hotel->getAdresse();
echo <<<'EOT'
</span>
 </p>
</div><!--/.packages-para-->
<div class="packages-review">
<p>
EOT;
for($i=0; $i<$hotel->getEtoiles();$i++)
  echo '<i class="fa fa-star"></i>';



echo <<<'EOT'
</p>
</div><!--/.packages-review-->
<div class="about-btn">
<a 
EOT;
echo 'href="chambres.php?idHotel='.$hotel->getIdHotel().'"';
echo <<<'EOT'
class="about-view packages-btn">
Réserver
</a>
</div><!--/.about-btn-->
</div><!--/.single-package-item-txt-->
</div><!--/.single-package-item-->

</div><!--/.col-->
EOT;
  }
}
function reservation($image, $offre,$nom, $status, $date, $progression, $idReservation){
  echo '<div class="settings-container">';
								echo '<img src="'.$image.'" alt="Image 1" style="display: inline-block;">';
						    echo '<div class="hotel-info" style="display: inline-block;text-align:left;font-size:30px;margin: 20px;position:absolute; bottom: 5px;">';
							echo '<p>Offre: '.$offre.'</p>';
              if($offre=="hotel"){
                echo '<p>Nom: ';
              }else{
                echo '<p>Destination: ';
              }
              echo $nom.'</p>';
							echo '<p>Paiement: '.$status.'</p>';
							echo '<p>Date: '.$date.'</p>';
							echo '<p>Progression: '.$progression.'</p></div>';
							
					
							echo '<button class="annuler" type="button" value="'.$idReservation.'" style="position:absolute;right:3px;bottom:3px;background-color:#008CBA;height: 40px;width: 90px;padding: 10px;text-align:center;color:white;">Annuler</button></div>';
}
?>