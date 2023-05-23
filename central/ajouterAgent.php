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
		<link rel="stylesheet" href="assets/css/confirmation.css" />
		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css"/>
		<script src="assets/js/scripts.js"></script>
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
		  top: 15%;
		  left: 35%;
		  background-color:rgba(77, 177, 177, 0.75);
		  color: #fff;
		
		}
  
		form {
			z-index: 1;
		  position: absolute;
		top: 20%;
		left: 30%;
	        width:80%;
			height: 650px;
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
		  margin-left: 20%;
		  border: none;
		  border-radius: 5px;
		  cursor: pointer;
		  position: absolute;
          right:35%;
		  bottom: 20px;
		}
  
		button[type="button"]:hover {
		  background-color: #006F8E;
		  
		}
		.form-group input[type="text"], input[type="num"],input[type="date"], .form-group input[type="password"], input[type="email"], select, input[type="float"] {
		  position:absolute;
		  right: 10%;
		  width:80%;
		  height:7%;
		  margin:20px;
		}
		label{
		  height:3%;
		  margin:10px;
		  padding:10px;
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
		<section id="home" class="about-us" style="position:relative; z-index: 1; height: 1050px">
			<div class="div">
				<h1>Ajouter un agent</h1>
				<form id="form" method="POST" action="ajoutAgent.php" enctype="multipart/form-data">
				<h3 id="commentaire" style="text-decoration:green;">
                <?php
                    if ($q == 3){
                      echo 'csrf_token incorrect.';               
                    }else if ($q ==2 ){
                       echo 'Email existe déja.';
                    }else if($q ==4){
                        echo "remplissez tous les champs !";
                    }else if ($q==5){
                        echo "Les mot de passe ne sont pas égaut !";
                    }else if ($q == 1){
                        echo "Inscription réussie.";
                    }
                        
                    ?>
                    </h3>
                    <div class="form-group">
                        <input type="text" class="form-input" name="nom" id="nom" placeholder="Nom"/><br><br>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="prenom" id="prenom" placeholder="Prénom"/><br><br>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email"/><br><br>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="numTel" id="numTel" placeholder="Numero de téléphone"/><br><br>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="mdp" id="password" placeholder="Mot de passe"/><br><br>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                     <div class="form-group">
                        <input type="password" class="form-input" name="mdp1" id="mdp2" placeholder="Confirmer mot de passe"/><br><br>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="float" class="form-input" name="salaire" id="salaire" placeholder="Salaire"/><br><br>
                        <span toggle="#salaire" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="grade" id="grade" placeholder="Grade"/><br><br>
                        <span toggle="#grade" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                      <select class="form-input" name="sexe" ><br><br>
                        <option default>Sexe</option>
                        <option>Homme</option>
                        <option>Femme</option>
                      </select>
                    </div>
				  <input type="text" <?php echo'value="'.$csrf_token.'"';?> name="CSRFToken" style="display:none"/>
				  <button type="button" id="ajouter">Ajouter l'agent</button>
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
			</section><!--/.blog-->
			<!--blog end-->
			<script>
			let form = document.getElementById('form');
			let bouton = document.getElementById('ajouter');
			input = document.getElementsByTagName('input');
			let description = document.getElementsByTagName('textarea')[0];
			let nom = input[0];
			let prenom = input[1];
			let email = input[2];
            let numTel = input[3];
			let mdp1 = input[4];
			let mdp2 = input[5];
            let salaire = input[6];
            let grade = input[7];
            select = form.getElementsByTagName('select');
            let sexe = select[0];
			let commentaire = form.getElementsByTagName('h3')[0];
			const popupForm = document.getElementById('popupForm');
			function verifier(){
				if(mdp2.value=="" || mdp1.value=="" || email.value==""|| nom.value=="" || prenom.value=="" || sexe.value=="Sexe" || grade.value=="" || salaire.value==""){
					commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Remplissez tous les champs!";
				}else if(mdp1.value != mdp2.value){
					commentaire.setAttribute("style", "text-decoration:red");
					commentaire.innerHTML = "Les mot de passe ne sont égauts";
				}else if(!numTel.value.match("0[0-9]{9}")){
                    commentaire.setAttribute("style", "text-decoration:red");
                    commentaire.innerHTML = "Veuillez introduire un numéro valide";
                }else if(!mdp1.value.match(/[A-Za-z0-9!@#$%^&*(),.?":{}|<>]+/) && mdp1.length()<8){
                    commentaire.setAttribute("style", "text-decoration:red");
                    commentaire.innerHTML = "Les mot de passe doit etre fort: au minimum 8 caractère avec des nombres, symboles, lettres miniscules et majuscules";
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

