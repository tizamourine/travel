<?php
require_once 'Classe-db.php';
require_once 'Classes/Administrateur.php';
require_once 'Classes/Agent.php';
function generateCsrfToken() {
    // Générer un jeton CSRF aléatoire et unique
    $token = bin2hex(random_bytes(32));
    
    // Stocker le jeton CSRF dans une variable de session
    $_SESSION['csrf_token'] = $token;
    
    return $token;
}
function verifierSession($session){
    $bdd = new BD();
    if($bdd->verifierSession($session) == 0){
        echo "<script> window.location.href = 'index.php'</script>";
    }
}
function headerAdmin($session){
    $bdd = new BD();
    $admin = $bdd->recupererAdmin($session);
    $messages = $bdd->recupererListeAdminMessageNonLu($admin->getIdAdministrateur());
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
<ul class="nav navbar-nav navbar-right">
<li class="smooth"><a href="profileAdmin.php">Profile</a></li>
<li class="smooth"><a href="listeClient.php">Clients</a></li>
<li class="smooth"><a href="listeAgent.php">Agents </a></li>
<li class="smooth"><a href="listeHotels.php">Hotels</a></li>
<li class="smooth"><a href="listeSejour.php">Séjours</a></li>
<li class="smooth"><a href="listeExcursion.php">Excursions</a></li>
<li class="smooth">
EOT;
if (count($messages) > 0){
    echo <<<'EOT'
    <div class="notification-container">
    <span class="notification-circle"  style="display:flex;";>
    EOT;
     echo count($messages)."</span> </div>";
}
echo <<<'EOT'
<a href="messagerieAdmin.php">Messagerie</a></li>
<li class="smooth"><a href="deconnexion.php" class="book-btn">Déconnexion</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.main-menu-->
</div><!-- /.col-->
</div><!-- /.row -->
<div class="home-border"></div><!-- /.home-border-->
</div><!-- /.container-->
</div><!-- /.header-area -->

</header><!-- /.top-area-->
<!-- main-menu End -->
<style>
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
  }

function headerAgent($session){
  $bdd = new BD();
  $agent = $bdd->recupererAgentAvecSession($session);
  $messages = $bdd->recupererListeMessageNonLu($agent->getIdAgent());
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
<ul class="nav navbar-nav navbar-right">
<li class="smooth"><a href="profileAdmin.php">profile</a></li>
<li class="smooth">
EOT;
if (count($messages) > 0){
    echo <<<'EOT'
    <div class="notification-container">
    <span class="notification-circle"  style="display:flex;";>
    EOT;
     echo count($messages)."</span> </div>";
}
echo <<<'EOT'
<a href="messagerieAgent.php">Messagerie</a></li>
<li class="smooth"><a href="deconnexion.php" class="book-btn">Déconnexion</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.main-menu-->
</div><!-- /.col-->
</div><!-- /.row -->
<div class="home-border"></div><!-- /.home-border-->
</div><!-- /.container-->
</div><!-- /.header-area -->

</header><!-- /.top-area-->
<!-- main-menu End -->
<style>
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
?>