
<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classe-db.php';
	session_start();
	$session = $_COOKIE['PHPSESSID'];
?>
<html class="no-js"  lang="en">

	<head>
		<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="asset/onts/material-icon/css/material-design-iconic-font.min.css">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<script src="https://kit.fontawesome.com/0e73c0194a.js" crossorigin="anonymous"></script>
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
			<div class="settings-container">
					<h2 style="color: #222222;font-size:30px; z-index: 3;margin-left: 30px;margin-top: 10px;font-style:oblique;text-decoration: underline;">Paramètres</h2>
					<div class="settings-group">
						<div class="settings-containers">  
							<div class="setting">
							<h3><i class="fas fa-user-circle"></i>  Informations personnelles</h3>
							<p>Mettez à jour vos informations et découvrez comment elles sont utilisées.</p>
							<a href="infopers.php">Gérer mes informations personnelles</a>
							</div>
						</div>
						<div class="settings-containers">
								<div class="setting">
									<h3><i class="fas fa-cog"></i>  Préférences</h3>
									<p>Modifiez votre langue, votre devise et vos exigences en matière d'accessibilité.</p>
									<a href="prefer.php">Gérer mes préférences</a>
								</div> 
						</div>
					</div>

					<div class="settings-group">
						<div class="settings-containers">
							<div class="setting">
							<h3><i class="fas fa-lock"></i>  Sécurité</h3>
							<p>Ajustez vos paramètres et configurez une authentification à 2 facteurs.</p>
							<a href="securite.php">Gérer la sécurité de mon compte</a> 
							</div>
						</div>
						<div class="settings-containers">
								<div class="setting">
								<h3><i class="fas fa-credit-card"></i>  Informations de paiement</h3>
								<p>Ajoutez ou supprimez vos moyens de paiement en toute sécurité.</p>
								<a href="paiement.php">Gérer mes moyens de paiement</a>
								</div>
							
						</div>
					</div>
			</div>
			</section><!--/.blog-->
			<!--blog end-->
			  <style>
				.settings-container {
				  z-index: 2;
				  border: 1px solid #ccc;
				  border-radius: 5px;
				  background-color: white;
				  text-decoration: black;
				  height: 700px;
				  width: 90%;
				}
				.settings-containers {
				  flex: 1;
				  z-index: 3;
				  margin: 10px;
				  padding: 10px;
				  border: 1px solid #ccc;
				  border-radius: 5px;
				  background-color: white;
				  height: 80%;
				}
				.settings-group {
				  display: flex;
				  justify-content: space-between
				  margin-bottom: 10px;
				  height: 40% ;
				}
				.setting {
				  flex-basis: 50%;
				  background-color: #fff;
				  flex-grow: 1;
				}
				a {
			  color: blue;
			}
			  </style>
			

		

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


	</body>

</html>

