<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classes/Reservation.php';
	require_once 'Classes/credit.php';
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
	$client = $bdd->recupererClient($session);
	$reserver = 0;
    if (isset($_GET['idExcursion']
    )){
		$excursion = $bdd->recupererExcursion($_GET['idExcursion']);
		if(isset($_POST['informationSup'])&&isset($_POST['nbrAdulte'])&& isset($_POST['nbrBebe'])&& isset($_POST['nbrEnfnts'])){
			$informationSup = $_POST['informationSup'];
			$nbrAdulte = $_POST['nbrAdulte'];
			$nbrEnfnts = $_POST['nbrEnfnts'];
			$nbrBebe = $_POST['nbrBebe'];
			$prix = $excursion->parent->calculerPrix($nbrEnfnts, $nbrAdulte, $nbrBebe);
			if($_POST['cvv'] !=""&&$_POST['dateExpiration']!=""){
				$cvv = $_POST['cvv'];
				$cvv = md5($cvv);
				$dateExpiration = $_POST['dateExpiration'];
				$reservation = new Reservation(
					0,
					1,
					"carte",
					$informationSup,
					$prix,
					date('y-m-d'),
					"attente",
					$client->getIdClient(),
					$client->getIdAgent(),
					0,
					$excursion->getIdExcursion()
				);
				if($_POST['numero']!=""){
					$numero = $_POST['numero'];
					$credit = new credit(
						$client->getIdClient(),
						$numero,
						$cvv,
						$dateExpiration 
					  
					);
					$bdd->ajouterCredit($credit);
				}
				$credit = $bdd->recupererCredit($client);
				if($credit->getCvv() == $cvv){

					$bdd->ajouterReservation($reservation);
					$reserver =1;
				}
			}else{
				$reservation = new Reservation(
					0,
					0,
					"espece",
					$informationSup,
					$prix,
					date('y-m-d'),
					"attente",
					$client->getIdClient(),
					$client->getIdAgent(),
					0,
					$excursion->getIdExcursion()
				);
				$bdd->ajouterReservation($reservation);
				$reserver = 1;
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

h1{
    background-color: rgb(110, 168, 222);
	font-style: italic;
   font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

/* Rexcurion.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
	
  }
  
  .settings-container {
	z-index: 1;
    max-width: 800px;
    margin: 1 auto;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
	margin: 15%;
	width: 80%;
  }
  
  h1 {
    text-align: center;
    color: #333;
    font-weight: bold;
    margin-bottom: 30px;
  }
  
  form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  fieldset {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
  }
  
  legend {
    padding: 5px;
    font-weight: bold;
    color: #333;
  }
  
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 0px;
  }
  
  input[type="text"],
  input[type="number"],
  input[type="tel"],
  input[type="email"],
  input[type="date"],
  input[type="password"],
  textarea,
  select {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }
  
  input[type="radio"] {
    display: inline;
    margin-right: 5px;
  }
  
  button[type="submit"] {
    display: block;
    background-color: #4285f4;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    padding: 10px;
    margin-top: 20px;
    cursor: pointer;
  }
  
  button[type="submit"]:hover {
    background-color: #3274d6;
  }
  

    </style>
	<body style="position:absolute;width:100%;height:100%;">
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		<?php
				verifierSessions($session);
				$Sejour = $bdd->RecupererExcursion($_GET['idExcursion']);
			?>

		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<div class="settings-container" style="top: 80px;">
				<h1>Effectuez votre réservation</h1>
				<h3 id="commentaire" style="text-decoration:green" ><?php if($reserver==1)echo "Réservation Effectué"; ?></h3>
			   <div class="reserver">
				<form method="POST" >
					<fieldset>
						<legend>Informations supplimentaires</legend>
						<label for="infosup">Saisir le nom des compagnons </label><br>
						<textarea id="nomp" name="informationSup"></textarea>
					</fieldset>
					<fieldset>
					<legend>Nombre des personnes</legend>
					<label for='nbr1'> Adulte: </label>
					<input type="number" id="nbr1" name="nbrAdulte" placeholder="0"/>
					<label for='nbr2'> Enfant: </label>
					<input type="number" id="nbr2" name="nbrEnfnts" placeholder="0"/>
					<label for='nbr3'> Bebe: </label>
					<input type="number" id="nbr3" name="nbrBebe" placeholder="0"/>
					</fieldset>
					<fieldset>
					<legend>Informations de paiements</legend>    
					<h5>choisissez un type de paiement:</h5><br>
					<input type="radio" name="typepaiement">paiement en espèce</checkbox><br>
					<input type="radio" name="typepaiement">paiement par carte credit</checkbox><br>
					<fieldset id="paypal" style="display:none">
					<?php 
					$credit = $bdd->recupererCredit($client);
					if($credit->getIdClient()==0){
						echo <<<"EOT"
						<legend>paiement par carte credit</legend>
							<label for='num'> Numéro de la carte: </label>
							<input type='number'  name='numero' />
						EOT;
					}
							
							?>
							<label for='cvv'> cvv: </label>
							<input type="number" id="mdp" name="cvv" />
							<label for='date'> Date d'expiration: </label>
							<input type="text" placeholder="mm-yy"  name="dateExpiration" />
					</fieldset>
						</fieldset>
						<button type="button" id="reserver" style="background-color:#008CBA; color:white;height: 50px;width: 200px;position:relative;left:70%;">Reserver</button>
					</form>
				</div>
				</div>
			</section><!--/.blog-->
			<!--blog end-->
			<script>
			let b = document.getElementsByName('typepaiement');
			let f = document.getElementById('paypal');
			let bouton = document.getElementById("reserver");
			let form = document.getElementsByTagName('form')[0];
			function verifier(i){
				if(i==1){
					f.removeAttribute('style');
				}else{
					f.setAttribute('style', 'display:none');
				}
			}
			for (let i = 0; i < b.length; i++) {
 			 b[i].addEventListener('change',function(event){verifier(i);});
			}
			bouton.addEventListener('click', function(event){
				let inputs = form.getElementsByTagName('input');
			let commentaire = document.getElementById('commentaire');
			let vide =0;
			for(let i=0; i<inputs.length; i++){
				if (inputs[i].value == ""){
					vide=1;
				}
			}
			if(vide == 1){
				commentaire.setAttribute("style", "text-decoration:red");
				commentaire.innerHTML= "Remplissez tous les champs";
			}else
				form.submit();
			});
		</script>
			

		

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
<?php
    }
?>
