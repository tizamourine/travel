
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
	$admin = $bdd->recupererAdmin($session);
    if(isset($_GET['idReservation'])){
        if (isset($_POST['mdp'])){
            if($admin->parent->parent->getMdp() == md5($_POST['mdp'])){
                $bdd->updateReservation($_GET['idReservation']);
            }
        }
    }

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
        <link rel="stylesheet" href="assets/css/confirmation.css" />
		<script src="assets/js/scripts.js"></script>
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
		.hotel{
			z-index: 1;
			background-color: white;
			width:100%;
			height:700px;
			
		}
		/* Styles pour la div avec scrollbar */
		.scrollable-div {
			z-index: 1;
			position: absolute;
			top:25%;
		  width: 700px;
		  height: 700px;
		  overflow:scroll; /* Déclenche l'affichage de la scrollbar uniquement si nécessaire */
        border:1px solid #222222;
        }
		.settings-container {
		  z-index: 1;
		  margin: 10px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  position: relative;
		  left:1%;
		  background-color: white;
		
		  
		}

 
	.hotel-info {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 10px;
      text-align: center;
    }
	.settings-container p {
      margin-right: 90px;
    }
	input[type="submit"] {
		  background-color: #008CBA;
		  color: #ffffff;
		  padding: 10px 10px;
		  border: none;
		  border-radius: 5px;
		  cursor: pointer;
		
		}
  
		input[type="submit"]:hover {
		  background-color: #006F8E;
		  
		}
		.search-input{
			border: 1px solid #222222;
			position:absolute;
			top:15%;
			left:24%;
			align-items:center;
			width: 700px;
			background-color:white;
			box-shadow: 0px 0px 10px #bfbfbf;
		}
		.search-input *{
			position: relative;
		}
		.search-input input[type="text"]{
			width:80%;
			height: 40px;;
		}
		.search-input input[type="submit"]{
			width: 19%;
		}
	
	  </style>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		<?php
				headerAdmin($session);
				$Reservations = $bdd->recuperReservationsNonPayee();
			?>
		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
	</div>
			<div class="scrollable-div" style="background-color:white;">
				<div class="hotel" style="position:absolute;height:fit-content;">
				
				<?php

			
				if (count($Reservations) == 0) echo "<p> aucune reservation de la sorte. </p>";
							foreach ($Reservations as $Reservation){
                                if ($Reservation->getStatus())$status = "Payé"; else $status = "Non payé";
								if ($Reservation->getIdHotel() == 0){
                                    $voyage = $bdd->RecupererVoyage($Reservation->getIdVoyage());
                                    reservation($bdd->recupererVoyageImage($Reservation->getIdVoyage())[0], "Voyage Organise", $voyage->getDestination(), $status, $Reservation->getDate(), $Reservation->getProgression(), $Reservation->getIdReservation());
									echo '<button class="annuler" type="button" value="'.$Reservation->getIdReservation().'" style="position:absolute;right:3px;bottom:3px;background-color:#008CBA;height: 40px;width: 90px;padding: 10px;text-align:center;color:white;">Payé</button></div>';
								}else{
                                    $chambre = $bdd->recupererChambre($Reservation->getIdHotel());
                                    $hotel = $bdd->recupererHotel($chambre->getIdHotel());
                                    reservation($bdd->recupererChambreImage($Reservation->getIdHotel())[0], "hotel", $hotel->getNomHotel()." Chambre: ".$chambre->getNumeroCH(), $status, $Reservation->getDate(), $Reservation->getProgression(), $Reservation->getIdReservation());
									echo '<button class="annuler" type="button" value="'.$Reservation->getIdReservation().'" style="position:absolute;right:3px;bottom:3px;background-color:#008CBA;height: 40px;width: 90px;padding: 10px;text-align:center;color:white;">Payé</button></div>';
                                }
							}
							?>
					
			            
				
				</div>
			</div>
            <form id="form" method="POST">
	<div id="popupForm" class="modal">
					<div class="modal-content">
					<span id="closeBtn">&times;</span>
					<h3>Confirmation</h3>
						<label for="name">Mot de passe :</label>
						<input type="password" id="name" name="mdp" required><br><br>
						<button type="submit">Envoyer</button>
					</div> 
				</div>
	<form>
		 </section><!--/.blog-->
			<!--blog end-->
         
            <script>;
			let s = document.getElementsByClassName('annuler');
			let form = document.getElementById('form');
			const popupForm = document.getElementById('popupForm');
			function sHotel(i){
				form.setAttribute("action", "reservationsNonPayee.php?idReservation="+s[i].value);
				popupForm.style.display = 'block';
			}
			for (let i = 0; i < s.length; i++) {
 			 s[i].addEventListener('click',function(event){sHotel(i);});
			}
		</script>


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