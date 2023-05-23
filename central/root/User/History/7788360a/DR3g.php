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
$admin = $bdd->recupererAdmin($session);

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
		<title>Ajouter un hotel</title>

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
		<link rel="stylesheet" href="assets/css/confirmation.css" />
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
		  background-color: #f2f2f2;
		}
  
		h1 {
			z-index: 1;
			position: absolute;
		  text-align:center;
		  top: 25%;
		  left: 38%;
		  background-color:rgba(77, 177, 177, 0.75);
		  color: #fff;
		
		}
  
		form {
			z-index: 1;
		  position: absolute;
		top: 30%;
		left: 30%;
	        width:80%;
			height: 50%;
		  background-color: #ffffff;
		  padding: 20px;
		  border-radius: 5px;
		  box-shadow: 0px 0px 10px #bfbfbf;
		  width: 500px;
		  margin: auto;
		}
  
		button[type="button"] {
		  background-color: #008CBA;
		  color: #ffffff;
		  padding: 10px 40px;
		  margin-top: 5%;
		  margin-left: 25%;
		  border: none;
		  border-radius: 5px;
		  cursor: pointer;
		  position: absolute;
		  bottom: 5px;
		}
  
		button[type="button"]:hover {
		  background-color: #006F8E;
		  
		}
		input[type="text"] {
		  position:absolute;
		  right: 5px;
		  width:50%;
		  height:8%;
		  margin:10px;
		  padding:10px;
		}
		label{
		  height:5%;
		  margin:10px;
		  padding:10px;
		}
		input[type="float"] {
		  position:absolute;
		  right: 5px;
		  width:50%;
		  height:8%;
		  margin:10px;
		}
	  </style>
	
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		<?php
				headerAdmin($session);
			?>

		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 1; height: 100%;">
			<div>
				<h1>ajouter un hotel</h1>
				<form id="form" method="POST" action="ajoutHotel.php" enctype="multipart/form-data">
					<h3 id="commentaire" style="text-decoration:green;">
					<?php
					if($q ==4){
                        echo "remplissez tous les champs !";
					}else if($q==3){
						echo "CSRFToken incorrect !";
					}else if ($q==1){
						echo "Hotel Ajouté.";
					}else if ($q==2){
						echo "Mot de passe incorrect";
					}
                    ?>
                    </h3>
					<label for="images">Sélectionnez les images de l'hotel :</label>
        			<input type="file" name="images[]" id="images" multiple>
				  <label for="nom">Nom de l'hotel: </label>
				  <input type="text" id="nom" name="nomHotel"><br><br>
			
				  <label for="adresse">Adresse :</label>
				  <input type="text" id="adresse" name="adresse"><br><br>
			
				  <label for="etoile">Etoiles :</label>
				  <input type="float" id="etoile" name="etoiles"><br><br>
			
				  <label for="numTel">Numéro de téléphone :</label>
				  <input type="text" id="numTel" name="numTel"><br><br>
			
				  <label for="ville">Ville :</label>
				  <input type="text" id="ville" name="ville"><br><br>
				  <label for="coordonnee">Coordonnée</label>
				  <input type="text" id="coordonnee" name="coordonnee" ><br><br>
				  <input type="text" <?php echo'value="'.$csrf_token.'"';?> name="CSRFToken" style="display:none"/>
				  <button type="button" id="ajouter">Ajouter l'hotel</button>
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
			</section><!--/.blog-->
			<!--blog end-->
			<script>
			let form = document.getElementById('form');
			let bouton = document.getElementById('ajouter');
			input = document.getElementsByTagName('input');
			let nom = input[1];
			let adresse = input[2];
			let etoile = input[3];
      		let numTel = input[4];
			let ville = input[5];
			let coordonnee = input[6];
			let commentaire = form.getElementsByTagName('h3')[0];
			const popupForm = document.getElementById('popupForm');
			function verifier(){
				if(nom.value=="" || adresse.value=="" || etoile.value==""|| numTel.value=="" || ville.value=="" || coordonnee.value==""){
					commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Remplissez tous les champs!";
				}else if(!numTel.value.match("0[0-9]{9}")){
        			commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Veuillez introduire un numéro valide";
				}else if(!(/[0-9]+/.test(etoile.value)) || !(/[0-9]+.[0-9]+/.test(etoile.value))){
					commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Le nombres d'étoiles doit etre un entier ou réel";
				}else if(input[0].value == ""){
					commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Veuillez ajouter des photos";
        		}else{
					popupForm.style.display = 'block';
					
				}
			}
			bouton.addEventListener("click", verifier);
		</script>  




		<script src="assets/js/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->

		<!--modernizr.min.js-->
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


		<!--bootstrap.min.js-->
		<script  src="assets/js/bootstrap.min.js"></script>
		<script  src="assets/js/scripts.js"></script>
		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!-- jquery.filterizr.min.js -->
		<script src="assets/js/jquery.filterizr.min.js"></script>

		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!--jquery-ui.min.js-->
        <script src="assets/js/jquery-ui.min.js"></script>
		<script src="assets/js/scripts.js"></script>
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

