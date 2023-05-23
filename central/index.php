<?php
require_once 'methodes/methodes.php';
require_once 'Classes/Client.php';
require_once 'Classe-db.php';
session_start();
$csrf_token = generateCsrfToken();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$exist = 0;
$ajout = 0;
$q=0;
if(isset($_GET['q'])){
  $q = $_GET['q'];
}
$bdd->ajouterToken($session, $csrf_token);
$bdd->verifierAdminSession($session);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Central</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="asset/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>
</head>
<body>
<?php
    //if($bdd->verifierSession($session) == 1){
     // echo '<script> window.location.href="index.php"</script>';
    //}
  ?>
    <div class="main">
      


        <div class="container" >
            <div class="signup-content" >
                <form method="POST" action="verifierAdmin.php" id="signup-form" class="signup-form">
                    <h2 style="font-size:30px;text-align:center" >Plateforme Privée </h2>
                    <img src="assets/logo/favicon.png" width="30%" height="30%" id="logo"/></img>
                    <h3 style="text-decoration:red">
                    <?php
                    if ($q == 3){
                      echo 'csrf_token incorrect.';               
                    }else if ($q ==2 ){
                       echo 'Mot de passe incorrect !';
                    }else if($q ==4){
                        echo "remplissez tous les champs !";
                    }else if ($q == 1){
                        echo 'Email incorrect !';
                    }else if ($q == 5){
                      echo 'Connecter vous sur une autre plateforme !';
                    }
                    ?>
                    </h3>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="mdp" id="password" placeholder="Mot de passe"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="center">
                        <input type="submit" name="submit" id="submit" class="form-submit submit" value="Se Connecter"/>
                      </div>
                    <div class="form-group">
                        <label for="agree-term" class="label-agree-term"><span> <span></span> </span>Si vous n'avez pas de compte <a href="#" class="term-service">S'inscrire.</a></label>
                        <input type="text" <?php echo'value="'.$csrf_token.'"';?> name="CSRFToken" style="display:none"/>
                    </div>
                  
                </form>
            </div>
        </div>

    </div>
    <style>
        #logo{
            background:transparent;
            position: relative;
            left:35%;
        }
        .form-group{
            position: relative;
            top:40px;
        }
    </style>
    <!-- JS -->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>