<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Administrateur.php';
	require_once 'Classes/Hotel.php';
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
$admin = $bdd->recupererAdmin($session);
if (isset($_GET['idHotel'])){
	$hotel = $bdd->recupererHotel($_GET['idHotel']);
	if (isset($_POST['nomHotel']) && isset($_POST['adresse'])&& isset($_POST['etoiles'])&& isset($_POST['mdp'])&& isset($_POST['numTel'])&& isset($_POST['ville'])&& isset($_POST['coordonnee'])&& isset($_POST['CSRFToken'])){
		$nomHotel = htmlspecialchars($_POST['nomHotel']);
		$adresse = htmlspecialchars($_POST['adresse']);
		$etoiles = htmlspecialchars($_POST['etoiles']);
		$mdp = htmlspecialchars($_POST['mdp']);
		$mdp = md5($mdp);
		$numTel = htmlspecialchars($_POST['numTel']);
		$ville = htmlspecialchars($_POST['ville']);
		$coordonnee = htmlspecialchars($_POST['coordonnee']);
		$token = $_POST['CSRFToken'];
		if ($mdp == $admin->parent->parent->getMdp()){
			$hotel->setNomHotel($nomHotel);
			$hotel->setAdresse($adresse);
			$hotel->setEtoiles($etoiles);
			$hotel->setNumTel($numTel);
			$hotel->setVille($ville);
			$hotel->setCoordonne($coordonnee);
			$bdd->modifierHotel($hotel);
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
		<link rel="stylesheet" href="assets/css/confirmation.css" />
		<script src="assets/js/scripts.js"></script>
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
		  overflow-y:scroll;
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
		input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="float"] {
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
				headerAdmin($session);
				$images = $bdd->recupererHotelImage($hotel->getIdHotel());
			?>

		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<div class="settings-group">
			<div class="settings-contain">
				  <div>
					<ol>
						<?php foreach($images as $image){
					  echo '<div class="settings-container">';
					  echo '<li><img src="'.$image.'"></li>';
					  echo "</div>";
						}
					  ?>
					</ol>
				  </div>
				  </div>
				<div class="settings-container">
				  <h1>modifier un hotel</h1>
			  <div class="container">
			  <form  action=<?php echo '"modHotel.php?idHotel='.$hotel->getIdHotel().'"';?> method="POST" enctype="multipart/form-data">
                <h3 id="commentaire" style="text-decoration:green;">
					<?php
					if($q ==4){
                        echo "remplissez tous les champs !";
					}else if($q==3){
						echo "CSRFToken incorrect !";
					}else if ($q==1){
						echo "Hotel Modifié.";
					}else if ($q==2){
						echo "Mot de passe incorrect";
					}
                    ?>
                    </h3>
				  <label for="nom">Nom de l'hotel: </label>
				  <input type="text" id="nom" name="nomHotel" value=<?php echo '"'.$hotel->getNomHotel().'"';?> disabled="true" ><button type="button" class="modifier"> modifier</button><br><br>
			
				  <label for="adresse">Adresse :</label>
				  <input type="text" id="adresse" name="adresse" value=<?php echo '"'.$hotel->getAdresse().'"';?> disabled="true"><button type="button" class="modifier"> modifier</button><br><br>
			
				  <label for="etoile">Etoiles :</label>
				  <input type="float" id="etoile" name="etoiles" value=<?php echo '"'.$hotel->getEtoiles().'"';?> disabled="true"><button type="button" class="modifier"> modifier</button><br><br>
			
				  <label for="numTel">Numéro de téléphone :</label>
				  <input type="text" id="numTel" name="numTel" value=<?php echo '"'.$hotel->getNumTel().'"';?>  disabled="true"><button type="button" class="modifier"> modifier</button><br><br>
			
				  <label for="ville">Ville :</label>
				  <input type="text" id="ville" name="ville" value=<?php echo '"'.$hotel->getVille().'"';?> disabled="true"><button type="button" class="modifier"> modifier</button><br><br>
				  <label for="coordonnee">Coordonnée</label>
				  <input type="text" id="coordonnee" name="coordonnee" value=<?php echo '"'.$hotel->getCoordonne().'"';?> disabled="true"><button type="button" class="modifier"> modifier</button><br><br>
				  <input type="text" <?php echo'value="'.$csrf_token.'"';?> name="CSRFToken" style="display:none"/>
				  <button type="button" id="enregistrer">modifier l'hotel</button>
				  <div id="popupForm" class="modal">
					<div class="modal-content">
					<span id="closeBtn">&times;</span>
					<h3>Confirmation</h3>
						<label for="name">Mot de passe :</label>
						<input type="password" id="name" name="mdp" required><br><br>
						<button type="submit">Envoyer</button>
					</div> 
				</div>
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
			const popupForm = document.getElementById('popupForm');
			function modifier(i){
				if(input[i].disabled){
					input[i].removeAttribute('disabled');
					
				}else{
					input[i].setAttribute('disabled', true);
				}
			}
			for (let i = 0; i < b.length; i++) {
 			 b[i].addEventListener('click',function(event){modifier(i);});
			}
			bouton.addEventListener('click', function(event){
				for (let i = 0; i < b.length; i++) {
 			 		input[i].removeAttribute('disabled');
				}
				popupForm.style.display = 'block';
			});
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
<?php
}
?>
