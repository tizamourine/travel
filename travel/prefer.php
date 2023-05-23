<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classe-db.php';
	session_start();
	$session = $_COOKIE['PHPSESSID'];
	$q=0;
if(isset($_GET['q'])){
  $q = $_GET['q'];
}
$bdd = new BD();
$csrf_token = generateCsrfToken();
$bdd->ajouterToken($session, $csrf_token);
$client = $bdd->recupererClient($session);

?>
<html class="no-js"  lang="en">

	<head>
		<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="asset/onts/material-icon/css/material-design-iconic-font.min.css">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

		<!-- TITLE OF SITE -->
		<title>Travel</title>

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
	<style>
        .preferences {
  margin: 20px;
width: 700px;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
 
}
.settings-group .settings-container {
		  z-index: 1;
		  margin: 10px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  position: relative;
		  left:20%;
		  background-color: white;
		  width: 100%;
		  height: 5%;
		  margin-top: 200px;
		  margin-bottom: 200px;
		  
		}
.settings-container {
	z-index: 1;
      margin: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
	  background-color: white;
	  color: #000;
      
    }
	.settings-contain .settings-container {
		  z-index: 1;
		  margin: 10px 0px 10px 0px;
		  padding: 0px 0px 0px 0px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  background-color: white;
		  width: 100%;
		  position:relative;
		  left:0px;
		  
		}
		.settings-contain {
		  z-index: 1;
		  position:absolute;
		  left: 9%;
		  margin-top:200px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  background-color: white;
		  width: 22%;
		  height: 61.7%;

		}
	
    .settings-group {
		z-index: 1;
      display: flex;
      margin-bottom: 10px;}



.preferences label {
  display: block;
  margin-bottom: 5px;
  font-size: 16px;
}
#left{
	color: #222222;
	margin: 10px 0px 10px 0px;
	padding-bottom: 20px;
}
#left a{
	color:#222222;
	margin: 0px 0px 30px 0px;
}
.preferences select, .preferences input[type="range"] {
  margin-bottom: 15px;
}

.preferences input[type="submit"] {
  background-color: #0066cc;
  color: #fff;
  border: none;
  border-radius: 3px;
  padding: 10px 15px;
  font-size: 18px;
  cursor: pointer;
}

.preferences input[type="submit"]:hover {
  background-color: #004eaa;
}
a {
  text-decoration: none;
  color: #000;
}
ul, ol {
  list-style: none;
}

    </style>
	<body>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		<?php
				verifierSessions($session);
			?>
		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<div class="settings-group">
				<div  class="settings-contain">
				  <div>
					<ol>
					  <div id="left" class="settings-container">
					  <li><a href="infopers.php"><i class="fas fa-user-circle"></i>Informations personnelles</a></li>
					  </div>
					  <div class="settings-container">
					  <li><a href="prefer.php"><i class="fas fa-cog"></i>Préférences</a></li>
					  </div>
					  <div class="settings-container">
					  <li><a href="securite.php"><i class="fas fa-lock"></i>Sécurité</a></li>
					  </div>
					  <div class="settings-container">
					  <li><a href="paiement.php"><i class="fas fa-credit-card"></i>Paiement</a></li>
					  </div>
					</ol>
				  </div>
				  </div>
				 
			  <div class="settings-container">
				<h3 style="color: #000;">Préférences</h3>
				<div class="preferences">
					
					<form>
					  <fieldset>
						<legend>Langue</legend>
						<label for="langue">Langue:</label>
						<select id="langue">
						  <option value="fr">Français</option>
						  <option value="en">Arabe</option>
						  <option value="es">Anglais</option>
						</select>
					  </fieldset>
				  
					  <fieldset>
						<legend>Devise</legend>
						<label for="devise">Devise:</label>
						<select id="devise">
						  <option value="EUR">DA</option>
						  <option value="USD">EUR</option>
						  <option value="GBP">USD</option>
						</select>
					  </fieldset>
				  
					  <fieldset>
						<legend>Personnalisation de l'interface</legend>  
						<label for="contraste">Contraste:</label>
						<select id="contraste">
						  <option value="normal">Normal</option>
						  <option value="élevé">Élevé</option>
						</select>
				  
						<label for="navigation">Navigation:</label>
						<select id="navigation">
						  <option value="tabulation">Tabulation</option>
						  <option value="raccourcis">Raccourcis clavier</option>
						</select>
				  
						<label for="couleurs">Couleurs:</label>
						<select id="couleurs">
						  <option value="clair">Clair</option>
						  <option value="sombre">Sombre</option>
						</select>
					  </fieldset>
					  
					  <input type="submit" value="Enregistrer">
					</form>
				  </div>
				  </div>
				 
					</div>
			</section><!--/.blog-->
			<!--blog end-->
			  
			

		

		<!-- footer-copyright start -->
		<?php footer() ;?>
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


	</body>

</html>

