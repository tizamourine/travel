
<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classe-db.php';
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	   <script src="https://kit.fontawesome.com/0e73c0194a.js" crossorigin="anonymous"></script>
    <style>
.security-settings {
  width:900px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f5f5f5;
  border: 1px solid #ddd;
  justify-content: space-between;
}
.settings-container {
	z-index: 1;
     margin: 10px 0px 10px 0px;
	padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: white;
	width : 100%
    }

.settings-group {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
	margin: 10px;}
.security-settings h2 {
  margin-top: 0;
}

.security-settings h3 {
  margin-top: 20px;
}

.security-settings form {
  margin-top: 10px;
}

.security-settings label {
  display: block;
  margin-bottom: 5px;
}

.security-settings input[type="text"] {
  padding: 5px;
  border: 1px solid #ddd;
  border-radius: 3px;
  width: 100%;
  margin-bottom: 10px;
}

.security-settings button {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.security-settings button:hover {
  background-color: #0069d9;
}

.security-settings .btn-secondary {
  background-color: #ddd;
  color: #333;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  margin-left: 10px;
}
#left{
	margin: 10px;
	width: 300px;
	color: #222222;
}
#left a{
	color:#222222;
}
.security-settings .btn-secondary:hover {
  background-color: #ccc;
}
a {
  text-decoration: none;
  color:#222222;
}
h2{
	margin-bottom:20px;
}
ul, ol {
  list-style: none;
}
#desabonner{
	position:absolute;
	right: 10%;
	height: 40px;
}

    </style>
    		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

		<!-- TITLE OF SITE -->
		<title>Informations de sécurité</title>

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
		<link rel="stylesheet" href="assets/css/confirmation.css" />
		<!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css"/>
		<script src="assets/js/scripts.js"></script>
		<!-- range css-->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/confirmation.css" />

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
</head>
<body>
<?php
				verifierSessions($session);
			?>
		
		<!--about-us start -->
		<section id="home" class="about-us" style="z-index: 0;">
  <div class="settings-group">
    <div id="left" class="settings-container">
        <ol>
          <div class="settings-container">
          <li><a href="infopers.php"><i class="fas fa-user-circle"></i>Informations personnelles</a></li>
          </div>
          <div class="settings-container">
          <li><a href="pref.php"><i class="fas fa-cog"></i>Préférences</a></li>
          </div>
          <div class="settings-container">
          <li><a href="securite.php"><i class="fas fa-lock"></i>Sécurité</a></li>
          </div>
          <div class="settings-container">
          <li><a href="paiement.php"><i class="fas fa-credit-card"></i>Paiement</a></li>
          </div>
          
        </ol>
      </div>
  <div class="settings-container">
    <h2 style="color:#222222; font-size: 24px;">Paramètre de sécurité</h2>
    <div class="security-settings">
  <h3>Authentification à 2 facteurs</h3>
  <p>Protégez votre compte avec une authentification à 2 facteurs. Pour activer cette fonctionnalité, suivez les étapes ci-dessous.</p>
  <form id="formulaire" method="POST" action="modSecurite.php">
	<h3>
	<?php
	if($q==1){
		echo "Les mots de passe ne sont pas correct!";
	}else if($q==2){
		echo "Confirmation incorrect !";
	}else if($q==4){
		echo "Remplissez toutes les informations !";
	}else if($q==3){
		echo "CSRFToken Incorrect !";
	}
	?>
	</h3>
  <div class="password-change">
    <h3>Changer de mot de passe</h3>
    <p>Changez régulièrement votre mot de passe pour protéger votre compte.</p>
    <label for="mdp1">Mot de passe actuel.</label>
	<input type="password" id="mdp1" name="mdp1">
	<label for="mdp2">Nouveau mot de passe.</label>
	<input type="password" id="mdp2" name="mdp2">
	<label for="mdp3">Nouveau mot de passe.</label>
	<input type="password" id="mdp3" name="mdp3">
	<div id="popupForm" class="modal">
	<div class="modal-content">
	<span id="closeBtn">&times;</span>
	<h3>Confirmation</h3>
	<label for="name">Mot de passe :</label>
	<input type="password" id="name" name="confirmer"><br><br>
	<button type="submit">Envoyer</button>
	</div> 
	</div> 
	<?php echo '<input type="text" value="'.$csrf_token.'" name="CSRFToken" style="display:none"/>';?>
  </div>
	<button id="bouton" type="button" >enregistrer</button>
	<button id="desabonner" type="button" >Se désabonner</button>
  </form>
  
  </div>
  </div>
  </div>
  	</section><!--/.blog-->
		<!--blog end-->
		<script>
			let form = document.getElementById('formulaire');
			let bouton = document.getElementById('bouton');
			input = document.getElementsByTagName('input');
			let mdp1 = input[0];
			let mdp2 = input[1];
			let mdp3 = input[2];
			let commentaire = document.createElement('h3');
			form.appendChild(commentaire);
			let desabonner = document.getElementById('desabonner');
			const popupForm = document.getElementById('popupForm');
			function verifier(){
				if(mdp2.value=="" || mdp1.value=="" || mdp3.value==""){
					commentaire.style.color = "red";
					commentaire.innerHTML = "Remplissez tous les champs!";
				}else if(mdp2.value != mdp3.value){
					commentaire.style.color = "red";
					commentaire.innerHTML = "Les mot de passe ne sont égauts";
				}else{
					form.submit();
				}
			}
			bouton.addEventListener("click", verifier);
			desabonner.addEventListener('click', function(){
				popupForm.style.display = 'block';
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