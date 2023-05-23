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
		<script src="https://kit.fontawesome.com/0e73c0194a.js" crossorigin="anonymous"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<style>
	    .payment {
        width:100%;
  margin: 20px 0px 20px 0px;
  padding: 20px;
  border: 1px solid #ccc;
}
	ol .settings-container{
	margin-top: 10%;
      margin: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
	  height: 50px;
    }
	.settings-group .settings-container {
		  z-index: 1;
		  margin: 10px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  position: relative;
		  left:15%;
		  background-color: white;
		  width: 200%;
		  height: 5%;
		  margin-top: 200px;
		  margin-bottom: 200px;
		  
		}
    .settings-group {
		z-index: 1;
      display: flex;
      margin-bottom: 10px;
	}
	  .settings-contain .settings-container {
		  z-index: 1;
		  margin: 10px 0px 10px 0px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  background-color: white;
		  width: 100%;
		  position:relative;
		  left:0px;
		  height:40px;
		  
		}
		.settings-contain {
		  z-index: 1;
		  position:absolute;
		  left: 5%;
		  margin-top: 200px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  background-color: white;
		  width: 22%;
		  height: 59.5%;
		}
	
       h3 {
	margin: 0;
  }
  
  .payment form {
	display: flex;
	flex-direction: column;
  }
  #left{
	margin: 10px;
	width: 300px;
	color: #222222;
}
#left a{
	color:#222222;
}
  .payment label {
	margin-bottom: 10px;
  }
  
  .payment input, .payment select {
	padding: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
  }
  
  .payment button {
	padding: 10px;
	border-radius: 5px;
	border: none;
	background-color: #008CBA;
	color: white;
	font-weight: bold;
	cursor: pointer;
  }
  #setting{
	width: 800px;
  }
  .payment button:hover {
	background-color: #005F6B;
  }
  
  a {
	text-decoration: none;
	color:#000;
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
		<?php
				verifierSessions($session);
			?>
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<div class="settings-group">
				<div id="left" class="settings-contain">
				  <div>
					<ol>
					  <div class="settings-container">
					  <li><a href="infopers.php"><i class="fas fa-user-circle"></i>  Informations personnelles</a></li>
					  </div>
					  <div class="settings-container">
					  <li><a href="prefer.php"><i class="fas fa-cog"></i>  Préférences</a></li>
					  </div>
					  <div class="settings-container">
					  <li><a href="securite.php"><i class="fas fa-lock"></i> Sécurité</a></li>
					  </div>
					  <div class="settings-container">
					  <li><a href="paiement.php"><i class="fas fa-credit-card"></i>  Paiement</a></li>
					  </div>
					</ol>
				  </div>
				  </div>
			  <div id="setting" class="settings-container">
				<?php
				$credit = $bdd->recupererCredit($client);
				if ($credit->getNumero() == null){
				echo <<<'EOT'
					<h3>Ajouter un moyen de paiement</h3>
					<div class="payment">
					<form id="form" method="POST" action="ajouterPaiement.php">
					<h3 style="text-decoration:red">
					EOT;
					if($q==3){
					echo'csrf_token ncorrect.';
					}elseif($q==4){
					echo'remplissez toutes les informations';
					}elseif($q==2){
					echo'AjoutRéussie';
					}
					echo <<<'EOT'
					</h3>
					<label for="cardNumber">Numéro de carte de crédit:</label>
					<input type="text" id="cardNumber" name="numero" required>
					<label for="expirationDate">Date d'expiration:</label>
					<input type="text" placeholder="mm-yy"id=" expirationDate" name="dateExpiration" required>
					<label for="securityCode">Code de sécurité:</label>
					<input type="num" id="securityCode" name="cvv" required>
					EOT;
					echo '<input type="text" value="'.$csrf_token.'" name="CSRFToken" style="display:none"/>';
					echo <<<'EOT'
					<button id="bouton" type="button">Ajouter</button>
					</form>
					</div>
					EOT;
				}else{
					echo <<<'EOT'
					<h3>Modifier votre moyen de paiement</h3>
					<div class="payment">
					<form id="form" method="POST" action="modCredit.php">
					<h3 style="text-decoration:red">
					EOT;
					if($q==3){
					echo'csrf_tokenincorrect.';
					}elseif($q==4){
					echo'remplissez toutes les informations';
					}

					echo <<<'EOT'
					</h3>
					<label for="cardNumber">Numéro de carte de crédit:</label>
					<input type="text" id="cardNumber" name="numero" required>
					<label for="expirationDate">Dated'expiration:</label>
					<input type="text" placeholder="mm-yy" id="expirationDate" name="dateExpiration"required>
					<label for="securityCode">Code de sécurité:</label>
					<input type="num" id="securityCode" name="cvv" required>
					EOT;
					echo '<input type="text" value="'.$csrf_token.'" name="CSRFToken" style="display:none"/>';
					echo <<<'EOT'
					<button id="bouton" type="button">Modifier</button>
					</form>



					</div>
					</div>
					EOT;
				}
				  ?>
			</div>
			</body>
			</section><!--/.blog-->
			<!--blog end-->
			<script>
			let form = document.getElementById('form');
			let bouton = document.getElementById('bouton');
			input = document.getElementsByTagName('input');
			let numero = input[0];
			let date = input[1];
			let cvv = input[2];
			let commentaire = document.createElement('h3');
			form.appendChild(commentaire);
			function verifier(){
				if(numero.value=="" || date.value=="" || numero.value==""){
					commentaire.style.color = "red";
					commentaire.innerHTML = "Remplissez tous les champs!";
				}else{
				commentaire.style.color = "green";
					commentaire.innerHTML = "Modification éfféctué";
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


	</body>

</html>

