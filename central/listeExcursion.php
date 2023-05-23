<?php
require_once 'methodes/methodes.php';
require_once 'Classes/Hotel.php';
require_once 'Classes/Excursion.php';
require_once 'Classes/Image.php';
require_once 'Classe-db.php';
session_start();
$session = $_COOKIE['SESSION'];
$bdd = new BD();
$exist;
$token = "";
$bdd = new BD();
$csrf_token = generateCsrfToken();
$bdd->ajouterToken($session, $csrf_token);
$admin = $bdd->recupererAdmin($session);
?>
<html class="no-js"  lang="en">

	<head>
		<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
		.search-input{
			border: 1px solid #222222;
			position:relative;
			top:10%;
			left:30%;
			width:35%;
			box-shadow: 0px 0px 10px #bfbfbf;
		}
		.search-input *{
			position: relative;
		}
		.search-input input[type="text"]{
			width:80%;
		}
		.search-panel{
			border: 1px solid #222222;
			width:80%;
			position: relative;
			left:18%;
			height:60%;
			top:15%;
			box-shadow: 0px 0px 10px #bfbfbf;
			overflow-y: scroll;
		}
		.ho{
			margin: 10px;
			display:flex;
			flex-direction:row;
			border: 1px solid #222;
			box-shadow: 0px 0px 10px #bfbfbf;
			justify-content:space-between;
		}
		.ho *{
			z-index: 1;
			margin: 10px;
		}
		.ho button[type="button"]{
			position:relative;
			margin: 5px;
			right:5px;
			background-color: #3333;
		}
		.filter-input{
			display:block;
			border: 1px solid #222222;
			position: absolute;
			left:1%;
			top:18%;
			width:15%;
			height:60%;
			border: 1px solid #222;
			box-shadow: 0px 0px 10px #bfbfbf;
		}
		.filter-input a{
			z-index: 1;
			box-shadow: 0px 0px 10px #bfbfbf;
			background-color: aqua;
			border: 1px solid #222222;
    		width: 90%;
    		height: 40px;
			position: relative;
			left:5%;
			padding: 10px;
			text-align:center;
			text-decoration:#222222;
			border-radius:10px;
		}
		.contain{
			z-index: 1;
			position:absolute;
			height:100%;
			width:100%;
		}

</style>

	<body>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		<?php
				headerAdmin($session);
				$excursions = $bdd->listeExcursion();
			?>
		<section id="home" class="about-us" id="home" class="about-us" style="z-index: 1;">
		<div class="contain">
		<div class="search-input">
			<form action="listeExcursion.php" method="get">
				<input id="recherche" type="text" id="recherche" name="s">
				<input type="submit" value="Rechercher">

			</form>
		</div>
		<div class="search-panel">
		<?php
		if (isset($_GET['s'])){$excursions = $bdd->searchExcursion($_GET['s']);
		if($_GET['s']==''){$excursions = $bdd->listeExcursion();}}
		if (count($excursions) == 0) echo "<p> aucune excursion de la sorte. </p>";
		foreach($excursions as $excursion){
			echo <<<"EOT"
			<div class="ho">
			<p>
			EOT; echo $excursion->parent->getDestination(); echo "</p>";
		    echo "<p>".$excursion->parent->getNbrPlaces();

			echo '</p><button class="modifier" type="button" value="'.$excursion->getIdExcursion().'"';echo '> modifier l\'excursion</button>
			 	<button class="supprimer" type="button" value="'.$excursion->getIdExcursion().'"';echo'> supprimer l\'excursion</button></div>';
		}
		?>
		</div>
		
			
	
		
	    </div>
		<div class="filter-input">
			<form>
				<label for="filtrer"> Liste des excursions </label><br>
				<a href=<?php echo '"excursion.php"';?>> Ajouter une excursion </a>
				
			</form>
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
		</section>
		<!-- footer-copyright start -->
		<script>
			let m = document.getElementsByClassName('modifier');
			let s = document.getElementsByClassName('supprimer');
			let input = document.getElementsByTagName('input');
			let bouton = document.getElementById("enregistrer");
			let form = document.getElementById('form');
			const popupForm = document.getElementById('popupForm');
			function mHotel(i){
				window.location.href = "modExcursion.php?idExcursion="+m[i].value;
			}
			function sHotel(i){
				form.setAttribute("action", "supprExcursion.php?idExcursion="+s[i].value);
				popupForm.style.display = 'block';
			}
			for (let i = 0; i < m.length; i++) {
 			 m[i].addEventListener('click',function(event){mHotel(i);});
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

