
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
	<style>
		body {
		  font-family: Arial, sans-serif;
		  margin: 0;
		  padding: 0;
		}
		header {
		  background-color: #333;
		  color: #fff;
		  padding: 20px;
		}
		h1 {
		  margin: 0;
		}
		.settings-group .settings-container {
		  z-index: 1;
		  margin: 10px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  position: relative;
		  left:21%;
		  background-color: white;
		  width: 76%;
		  
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
		}
		.settings-contain {
		  z-index: 1;
		  position:absolute;
		  left: 10px;
		  margin-top: 10px;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  background-color: white;
		  width: 22%;
		  height: 50.5%;
		}
		.settings-group {
			z-index: 1;
		  display: flex;
		  
		  margin-bottom: 10px;
		}
		section.container {
		  margin: 20px;
		  padding: 20px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  width:850px;
		}
		label {
		  display: block;
		  margin-bottom: 10px;
		  font-weight: bold;
		}
		input[type="text"], input[type="email"], input[type="tel"], input[type="date"] {
		  width: 50%;
		  padding: 10px;
		  border: 1px solid #ccc;
		  border-radius: 5px;
		  margin-bottom: 20px;
		}
		input[type="file"] {
		  margin-bottom: 20px;
		}
		button {
		  background-color: #333;
		  color: #fff;
		  padding: 10px 20px;
		  border: none;
		  border-radius: 5px;
		  cursor: pointer;
		}
		button:hover {
		  background-color: #666;
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

		<?php
				verifierSessions($session);
			?>

		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<div class="settings-group">
				<div class="settings-contain">
				  <div>
					<ol>
					  <div class="settings-container">
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
				  <h1>Informations personnelles</h1>
			  <div class="container">
			  <h3 style="text-decoration:red">
                    <?php
                    if ($q == 3){
                      echo 'csrf_token incorrect.';               
                    }else if ($q ==2 ){
                       echo 'Mot de passe incorrect !';
                    }else if($q ==4){
                        echo "remplissez tous les champs !";
                    }else if ($q == 1){
                        echo 'Format du fichier incorrect !';
                    }else if ($q == 5){
                      echo 'Connecter vous sur une autre plateforme !';
                    }
                    ?>
                    </h3>
				<form  action="modifierInfoPers.php" method="POST" enctype="multipart/form-data">
					<img src=<?php echo '"'.$client->parent->getPhoto().'" '?> width="5%" height="5%"/>
					<label for="photo-de-profil">Photo de profil :</label>
					<input type="file" id="photo" name="photo" >
				  <label for="nom">Nom :</label>
				  <input type="text" id="nom" name="nom" <?php echo 'value="'.$client->parent->getNom().'" '?>placeholder="Dites-nous comment vous appeler." disabled="true"><button type="button" class="modifier"> modifier</button>
				  <label for="nom">Prenom :</label>
				  <input type="text" id="prenom" <?php echo 'value="'.$client->parent->getPrenom().'" '?> name="prenom" placeholder="Dites-nous comment vous appeler." disabled="true"><button type="button" class="modifier"> modifier</button>
			  	
				  <label for="email">Adresse email :</label>
				  <input type="email" id="email" name="email" <?php echo 'value="'.$client->parent->getEmail().'" '?>placeholder="il s'agit de l'email que vous utilisez pour vous connecter et sur lequel nous vous envoyons vos confirmations." disabled="true"><button type="button" class="modifier" > modifier</button>
				  
				  <label for="telephone">Numéro de téléphone :</label>
				  <input type="tel" id="telephone" name="numTel" <?php echo 'value="'.$client->parent->getNumTel().'" '?>placeholder ="Ajoutez votre numéro de téléphone. Le numéro de contact pour les hébergementset attractions réservés, également utilisable pour vous connecter." disabled="true"><button type="button" class="modifier"> modifier</button>
				  <input type="text" <?php echo'value="'.$csrf_token.'"';?> name="CSRFToken" style="display:none"/>
				</br><button id="enregistrer" type="button" >Enregistrer</button>
				</form>
			  </div>  
			  </div>
			
			  </div>
			</section><!--/.blog-->
			<!--blog end-->
			  
			

		<script>
			let b = document.getElementsByClassName('modifier');
			let input = document.getElementsByTagName('input');
			let bouton = document.getElementById("enregistrer");
			let form = document.getElementsByTagName('form')[0];
			function modifier(i){
				if(input[i].disabled){
					input[i].removeAttribute('disabled');
					
				}else{
					input[i].setAttribute('disabled', true);
				}
			}
			for (let i = 0; i < b.length; i++) {
 			 b[i].addEventListener('click',function(event){modifier(i+1);});
			}
			bouton.addEventListener('click', function(event){
				for (let i = 1; i < b.length+1; i++) {
 			 		input[i].removeAttribute('disabled');
				}
				form.submit();
			});
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

