<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Administrateur.php';
	require_once 'Classe-db.php';
	session_start();
	$session = $_COOKIE['SESSION'];
	$q=0;
if(isset($_GET['q'])){
  $q = $_GET['q'];
}
$bdd = new BD();
$csrf_token = generateCsrfToken();
$bdd->ajouterToken($session, $csrf_token);
$agent = $bdd->recupererAgentAvecSession($session);

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
		<script src="https://kit.fontawesome.com/0e73c0194a.js" crossorigin="anonymous"></script>
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		
		<![endif]-->

	</head>
	<style>
        body {
			padding-top: 80%;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .card {
			padding-top: 50%;
			
            border-radius: 5px;
            padding: 20px;
            margin: 8px;
            width: 350px;
			height: 200px;
			
			background-color:rgba(77, 177, 177, 0.75);
        }


        section img {
			
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .profile-info {
	
            display: flex;
            align-items: center;
        }

        .profile-info p {
		
            margin-left: 10px;
        }
		.contai {
			padding-top: 50%;
		  z-index: 1;
		  position:absolute;
		  left: 10.1%;
		  margin-top:200px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  background-color: white;
		  width: 80%;
		  height: 61.7%;
		  
		}
		.settings-group {
       padding-top: 80%;
		z-index: 1;
      display: flex;
      margin-bottom: 0.5px;
	  padding:40px;
	  grid-gap: 50px;
	  justify-content: center;

	}
	
		.header{
			padding-top: 50%;
			z-index: 1;
			position:absolute;
	        top:15%;
	        width:80%;
			height: 10%;
	        background-color:rgba(77, 177, 177, 0.75);
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
	        padding: 20px;
	        box-sizing: border-box;
			border-radius: 5px;
		}
		h2{
			text-align:center;
			padding-left: 180px;
		}
		h3{
			color:black;
			text-align: center;
			padding-top: 10px;
			
		}


    </style>
	<body>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		<?php headerAgent($session);
		?>

		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<header class="header">
				<h2 style="font-size:xx-large;">Profil Agent</h2>
			</header>
		
			<section class="contai">
				<div class="settings-group">
				<div class="card">
					<h3><strong>Informations personnelles</strong></h3>
					<div class="profile-info">
					<img src="assets/images/Colorful_splash.jpg" alt="Photo de profil">
						<div>
						<p><strong> Nom complet : <?php echo $agent->parent->getNom().' '.$agent->parent->getPrenom();?></strong></p>
							<p><strong> Email : <?php echo $agent->parent->getEmail();?></strong></p>
							<p><strong> Téléphone : <?php echo $agent->parent->getNumTel();?></strong></p>
						</div>
					</div>
				</div>
		
				<div class="card">
					<?php
					$reservations = $bdd->recuperAgentReservation($agent->getIdAgent());
				if(count($reservations)>0){
				echo <<<'EOT'
				<div class="notification-container">
				<span class="notification-circle"  style="display:flex;";>
				EOT;
				 echo count($reservations)."</span> </div>";
				}
				  ?>
					<h3><strong>Liste des réservations</strong></h3>
					<a href="reservation.php" style="display: block; border-radius: 30px; text-align: center; margin-top: 10%;"> consulter les réservations</a>
					<!-- Liste des réservations passées -->
				</div>
				</div>
	
			</section>
		
			</section><!--/.blog-->
			<!--blog end-->
			  
			
	<!-- /.footer-copyright-->
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

