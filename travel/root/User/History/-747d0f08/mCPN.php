<?php
require_once 'methodes/methodes.php';
require_once 'Classes/Client.php';
require_once 'Classe-db.php';
session_start();
$csrf_token = generateCsrfToken();
$session = $_COOKIE['PHPSESSID'];
$bdd = new BD();
$exist = 0;
$ajout = 0;
$q=0;
if(isset($_GET['q'])){
  $q = $_GET['q'];
}
$bdd->ajouterToken($session, $csrf_token);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="asset/onts/material-icon/css/material-design-iconic-font.min.css">

		<!-- favicon img -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--animate.css-->
		<link rel="stylesheet" href="assets/css/animate.css" />

		<!--hover.css-->
		<link rel="stylesheet" href="assets/css/hover-min.css">

		<!--datepicker.css-->
		<link rel="stylesheet"  href="assets/css/datepicker.css" >

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css"/>

		<!-- range css-->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css"/>
        <!--style.css-->
		<link rel="stylesheet" href="assets/css/style.css" />

		<!--responsive.css-->
		<link rel="stylesheet" href="assets/css/responsive.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>
<body>
<?php
    if($bdd->verifierSession($session) == 1){
      echo '<script> window.location.href="index.php"</script>';
    }
  ?>
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
										<li class="smooth"><a href="index.php#home">Acceuil</a></li>
										<li class="smooth"><a href="index.php#blog">Actualitées </a></li>
										<li class="smooth"><a href="index.php#pack">Offres</a></li>
										<li class="smooth"><a href="index.php#gallery">Destination</a></li>
										<li class="smooth"><a href="index.php#foot">A propos</a></li>
										<li class="smooth"><a href="contact.php">Aide</a></li>
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
		<!-- main-menu End -->
        <section id="home" class="about-us" >    
    <div class="main">
    
        <div class="container">
            <div class="signup-content" style="" >
                <form method="POST" action="verifierCl.php" id="signup-form" class="signup-form">
                    <h2 style="font-size:36px" >Se Connecter </h2>
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
                        <input type="button" id="connexion" class="form-submit submit" value="Se Connecter"/>
                      </div>
                    <div class="form-group">
                        <label for="agree-term" class="label-agree-term"><span> <span></span> </span>Si vous n'avez pas de compte <a href="inscription.php" class="term-service" style="color:white; text-decoration:white;">S'inscrire.</a></label>
                        <input type="text" <?php echo'value="'.$csrf_token.'"';?> name="CSRFToken" style="display:none"/>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>
    </section>
    <script>
			let form = document.getElementById('signup-form');
			let bouton = document.getElementById('connexion');
			input = form.getElementsByTagName('input');
			let email = input[0];
			let mdp = input[1];
			let commentaire = form.getElementsByTagName('h3')[0];
			function verifier(){
				if(mdp.value=="" || email.value==""){
					commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Remplissez tous les champs!";
				}else{
          form.submit();
				}
			}
			bouton.addEventListener("click", verifier);
		</script>
    <!-- footer-copyright start -->
		<?php footer() ;?>


		<script src="assets/js/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->

		<!--modernizr.min.js-->
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


		<!--bootstrap.min.js-->
		<script  src="assets/js/bootstrap.min.js"></script>

		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!-- jquery.filterizr.min.js -->
		<script src="assets/js/jquery.filterizr.min.js"></script>

		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!--jquery-ui.min.js-->
        <script src="assets/js/jquery-ui.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

		<!--owl.carousel.js-->
        <script  src="assets/js/owl.carousel.min.js"></script>

        <!-- jquery.sticky.js -->
		<script src="assets/js/jquery.sticky.js"></script>

        <!--datepicker.js-->
        <script  src="assets/js/datepicker.js"></script>

		<!--Custom JS-->
		<script src="assets/js/custom.js"></script>

    <!-- JS -->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/js/main.js"></script>
    <script src="assets/js/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->

		<!--modernizr.min.js-->
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


		<!--bootstrap.min.js-->
		<script  src="assets/js/bootstrap.min.js"></script>

		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!-- jquery.filterizr.min.js -->
		<script src="assets/js/jquery.filterizr.min.js"></script>

		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!--jquery-ui.min.js-->
        <script src="assets/js/jquery-ui.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

		<!--owl.carousel.js-->
        <script  src="assets/js/owl.carousel.min.js"></script>

        <!-- jquery.sticky.js -->
		<script src="assets/js/jquery.sticky.js"></script>

        <!--datepicker.js-->
        <script  src="assets/js/datepicker.js"></script>

		<!--Custom JS-->
		<script src="assets/js/custom.js"></script>


			<!-- Style -->
	
  <style>
			input, select, textarea {
  outline: none;
  appearance: unset !important;
  -moz-appearance: unset !important;
  -webkit-appearance: unset !important;
  -o-appearance: unset !important;
  -ms-appearance: unset !important; }

input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
  appearance: none !important;
  -moz-appearance: none !important;
  -webkit-appearance: none !important;
  -o-appearance: none !important;
  -ms-appearance: none !important;
  margin: 0; }

input:focus, select:focus, textarea:focus {
  outline: none;
  box-shadow: none !important;
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  -o-box-shadow: none !important;
  -ms-box-shadow: none !important; }

input[type=checkbox] {
  appearance: checkbox !important;
  -moz-appearance: checkbox !important;
  -webkit-appearance: checkbox !important;
  -o-appearance: checkbox !important;
  -ms-appearance: checkbox !important; }

input[type=radio] {
  appearance: radio !important;
  -moz-appearance: radio !important;
  -webkit-appearance: radio !important;
  -o-appearance: radio !important;
  -ms-appearance: radio !important; }

input:-webkit-autofill {
  box-shadow: 0 0 0 30px transparent inset;
  -moz-box-shadow: 0 0 0 30px transparent inset;
  -webkit-box-shadow: 0 0 0 30px transparent inset;
  -o-box-shadow: 0 0 0 30px transparent inset;
  -ms-box-shadow: 0 0 0 30px transparent inset;
  background-color: transparent !important; }

img {
  max-width: 100%;
  height: auto; }

figure {
  margin: 0; }

p {
  margin-bottom: 32px;
  margin-top: 0px;
  font-weight: 400; }
  p span {
    font-weight: bold; }

#connecter {
  line-height: 1.2;
  margin: 0;
  padding: 0;
  font-weight: bold;
  color: #fff;
  font-family: 'Poppins';
  font-size: 36px;
  margin-bottom: 10px; }

.clear {
  clear: both; }


body {
  font-size: 14px;
  line-height: 1.8;
  color: #fff;
  font-weight:600;
  font-family: 'Poppins';
  margin:0px;
 background-image: url("../images/container-bg.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  -moz-background-size: cover;
  -webkit-background-size: cover;
  -o-background-size: cover;
  -ms-background-size: cover;
  background-position: center center; 
  width: 100%;
}

.main {
  position: relative; }



.signup-content {
  margin-right: 470px;
  background: rgba(77, 177, 177, 0.75);
  float: right; 
  position: relative;
  top:37px;
  width:40%; left:10%; bottom:100px;}

.signup-form {
  padding: 56px 80px 36px 55px; 
  }

.form-group {
  margin-bottom:20px;
   }

input {
  border: none;
  box-sizing: border-box;
  border-bottom: 1px solid #ebebeb;
  background: transparent;
  width: 100%;
  display: block;
  color: #fff;
  font-weight: bold;
  font-family: 'Poppins';
  font-size: 14px;
  padding: 3px 0; }
  input::-webkit-input-placeholder {
    font-weight: 400;
    color: #fff; }
  input::-moz-placeholder {
    font-weight: 400;
    color: #fff; }
  input:-ms-input-placeholder {
    font-weight: 400;
    color: #fff; }
  input:-moz-placeholder {
    font-weight: 400;
    color: #fff; }
  input:focus {
    font-weight: bold; }

.field-icon {
  float: right;
  margin-right: 0px;
  margin-top: -22px;
  position: relative;
  z-index: 2;
  color: #fff; }

input[type=checkbox]:not(old) {
  width: 2em;
  margin: 0;
  padding: 0;
  font-size: 1em;
  display: none; }

input[type=checkbox]:not(old) + label {
  display: inline-block;
  margin-bottom: 25px; }

input[type=checkbox]:not(old) + label > span {
  display: inline-block;
  width: 13px;
  height: 13px;
  margin-right: 15px;
  margin-bottom: 4px;
  border: 1px solid #fff;
  border-radius: 2px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  -o-border-radius: 2px;
  -ms-border-radius: 2px;
  background: transparent;
  vertical-align: bottom; }

input[type=checkbox]:not(old):checked + label > span {
  background: transparent; }

input[type=checkbox]:not(old):checked + label > span:before {
  content: '\f26b';
  display: block;
  color: #fff;
  font-size: 11px;
  line-height: 1.2;
  text-align: center;
  font-family: 'Material-Design-Iconic-Font';
  font-weight: bold; }


.form-submit {
  width: auto;
  display: inline-block;
  border: none;
  background: #fff;
  color: #b18757;
  padding: 10px;
  height: 50px;
  box-shadow: 0px 15px 9.9px 0.1px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 15px 9.9px 0.1px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0px 15px 9.9px 0.1px rgba(0, 0, 0, 0.15);
  -o-box-shadow: 0px 15px 9.9px 0.1px rgba(0, 0, 0, 0.15);
  -ms-box-shadow: 0px 15px 9.9px 0.1px rgba(0, 0, 0, 0.15);
  margin-right: 25px; }
  .form-submit:hover {
    background-color: #e6e6e6; }

.submit {
  width: 130px;
  border-radius: 25px;
  -moz-border-radius: 25px;
  -webkit-border-radius: 25px;
  -o-border-radius: 25px;
  -ms-border-radius: 25px;
  text-transform: uppercase;
  font-size: 13px;
  cursor: pointer; }
  .center {
    text-align: center;
  }

.submit-link {
  border: 2px solid #fff;
  text-decoration: none;
  display: inline-block;
  vertical-align: middle;
  padding: 12px 0;
  text-align: center;
  color: #fff; }
  .submit-link:hover {
    background: #fff;
    color: #b18757; }

@media screen and (max-width: 992px) {
  .container {
    width: calc( 100% - 30px);
    max-width: 100%;
    margin: 0 auto; }

  .signup-content {
    width: 40%; 
    position: relative;
    left:200px;} }
    
@media screen and (max-width: 480px) {
  .submit {
    width: 100%; }

  .form-submit {
    margin-bottom: 20px;
    margin-right: 0px; }

  .signup-form {
    padding: 54px 30px 36px 30px; 
    } 
    .signup-content {
    width: 43%; 
    position:relative;
    right:0px;
    top:50%;
    left:270px}
  }
	</style>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>