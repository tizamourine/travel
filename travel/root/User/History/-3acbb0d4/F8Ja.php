<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classe-db.php';
	session_start();
  $bdd= new BD();
	$session = $_COOKIE['PHPSESSID'];
  $client = $bdd->recupererClient($session);
  $envoyer = 0;
  if (isset($_POST['objet']) &&$_POST['contenu']){
    $c = $_POST['contenu'];
    $o = $_POST['objet'];
    $message = new Contact(0, $client->getIdClient(), $client->getIdAgent(), $o, $c,date('y-m-d'), 0);
    $bdd->ajouterMessage($message);
    $envoyer=1;
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <style>
    .panel {
      position: fixed;
      bottom: 0px;
      right: 20px;
      background-color: #ADD8E6;
      border: 1px solid #ccc;
      box-shadow: 0 4px 6px #ffffff;
      display: none;
      width: 30%;
      max-height: 450px;
      overflow-y: auto;
      z-index: 1000;
      padding: 15px;
      background-image: url("assets/images/sky.jpg");
  background-size: cover;
    }
    .btn {
      background-color:#fff;
      color: rgb(0, 0, 0);
      padding: 10px 20px;
      text-align: center;
      cursor: pointer;
      margin-top: 10px;
      border:rgba(77, 157, 177, 0.75)
    }
    .btn:hover {
      color: black;
      background-color: rgba(77, 157, 177, 0.75);
      border:rgba(77, 157, 177, 0.75)
    }
    .btn1 {
      background-color: rgba(77, 157, 177, 0.75);
      color: rgb(0, 0, 0);
      padding: 10px 20px;
      text-align: center;
      cursor: pointer;
      margin-top: 10px;
      border:rgba(77, 157, 177, 0.75)
    }

    .close {
      float: right;
      cursor: pointer;
      font-weight: bold;
      background-color: red;
      text-decoration: rgb(90, 90, 90);
      border:10px;
      border-radius: 50%;
    }
    .buttons-container {
      display: flex; /* Ajout de flexbox */
      flex-direction: column; /* Alignement vertical des boutons */
      margin-top: 90px; /* Alignement à gauche des boutons */
      margin-right: 5px;
      margin-left: 10%; /* Espace entre les boutons et la boîte de réception */
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    #home .container {
      display: flex;
     /* Ajout de flexbox */
    }
    .button {
      display: block;
      text-decoration: none;
      text-align: center;
      border-radius: 4px;
      margin-top: 10px;
      margin-bottom: 5px;
      background-color: #fff;
      color: rgb(0, 0, 0);
      padding: 10px 20px;
      cursor: pointer;
      border:rgba(77, 157, 177, 0.75)
    }

    .button:hover {
      color: black;
      background-color: rgba(77, 157, 177, 0.75);
      border:rgba(77, 157, 177, 0.75);
    }

    .inbox {
      margin-right: 20%;
      width: 90%;
      height: 400px;
      background-color: white;
      border: 1px solid #ddd;
      padding: 20px;
      flex-grow: 1;/* La boîte de réception occupe tout l'espace disponible */
      overflow-y: scroll;
      box-shadow: 0px 0px 10px #bfbfbf;
    }

    .inbox h2 {
      margin-top: 0;
      padding-bottom: 10px;
      border-bottom: 1px solid #ddd;
    }

    .message {
      margin-top: 20px;
    }

    .message .sender {
      font-weight: bold;
    }

    .message .timestamp {
      font-size: 12px;
      color: #999;
    }
    h3{
      color: black;
    }
    .messages{
      display:flex;
      flex-direction:row;
      border:1px solid #222222;
      padding:10px;
      margin:10px;
    }
    .messages p{
      margin:5px
    }
    .contenu{
      width:100%;
      height:80%;
      border: 1px solid #222222;
      position:relative;
      top:10%;
      display:flex;
      flex-direction:column;
      padding:10px;
      box-shadow: 0px 0px 10px #bfbfbf;
    }
    #contenu{
      width:100%;
      height:80%;
      position:relative;
      top:5%;
      padding:10px;
      box-shadow: 0px 0px 10px #bfbfbf;
    }
  </style>
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
<body>
  <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<?php
				verifierSessions($session);
        $messages=$bdd->recupererListeMessageRecu($client->getIdClient());
        $messagesE=$bdd->recupererListeMessageEnvoye($client->getIdClient());
			?>
  <section id="home" class="about-us">
			<div class="container">
				<div class="about-us-content">
        <div class="col-sm-12">
							<div class="single-about-us">
		<!--gallery end-->
    <div class="container">
    <div class="buttons-container">
  <button id="newMessageBtn" class="btn">Contactez nous</button>
  <button id="reçuBtn" class="button"> Messages reçus  </button>
          <button id="enovBtn" class="button"> Messages envoyés</button>
        </div>
  <div id="messagePanel" class="panel">
    <h2 style="text-align: center;font-size: 24px;margin-bottom: 20px;" >Contactez nous <span class="close" id="closeBtn">&times;</span></h2>
    <form class="contact-form row justify-content-center" method="POST" id="contactForm">
      <div class="col-md-6">
        <div class="form-group">
          <label for="Objet" class="sr-only">Objet</label>
          <input type="text" class="form-control" placeholder="Objet" class="center" name="objet" id="Objet">
        </div>
      </div>
    
      <div class="col-md-6">
        <div class="form-group">
          <label for="message" class="sr-only">Message</label>
          <textarea class="form-control" placeholder="Message" class="center" name="contenu" id="message" cols="30" rows="8"></textarea>
        </div>
      </div>
    
      <div class="col-12">
        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary rounded-0 py-2 px-4">Envoyer</button>
        </div>
      </div>
    </form>
    
    </div><!--/.galley-box-->
    <div class="inbox">
      <h3><?php if(isset($_GET['envoye'])&& !isset($_GET['idMessage'])) echo 'Boite d\'envoie';else if(isset($_GET['idMessage'])) echo "Message"; else echo 'Boîte de réception' ?></h3>
     <h3 id="commentaire" style="text-decoration:green" ><?php if($envoyer == 1) echo "Message Envoyé";?></h3>
     <?php
      if(count($messages) == 0){
        echo "Messagerie vide .";
      }else if(count($messages) > 0 && !isset($_GET['envoye'])&& !isset($_GET['idMessage'])){
        foreach($messages as $message){
        echo '<a class="link" href="messagerie.php?idMessage='.$message->getIdMessage().'">';
        echo '</a>';
        echo '<div class="messages">';
        echo '<p>';
        echo $message->getDate()."</p>";
        echo "<p>".$message->getObjet()."</p>";
      echo "</div>";
        }
      }else if (isset($_GET['envoye'])&& !isset($_GET['idMessage'])){
        foreach($messagesE as $message){
          echo '<a class="link" href="messagerie.php?idMessage='.$message->getIdMessage().'">';
          echo '</a>';
          echo '<div class="messages">';
          echo '<p>';
        echo $message->getDate()."</p>";
        echo '<p style="text-transform:bold">'.$message->getObjet()."</p>";
       echo "</div>";
        }
      }else if (isset($_GET['idMessage'])){
        $message = $bdd->recupererMessage($_GET['idMessage']);
        if($message != null){
          echo '<div class="contenu" >';
        echo '<p><strong>Date:</strong> ';
        echo $message->getDate()."</p>";
        echo "<p> <strong>Objet:</strong> ".$message->getObjet()."</p>";
        echo '<div id="Contenu">';
        echo '<p>'.$message->getContenu().'</p>';
        echo '</div>';
        echo '</div>';
        $bdd->lireMessage($message->getIdMessage(), $client->getIdClient());
        }else{
          echo '<div class="contenu" >';
          echo "<p>message Inconnu.</p>";
          echo '</div>';
        }
      }

      ?>
    </div>
  </div>
				</div><!--/.gallery-details-->
			</div><!--/.container-->

		</section><!--/.gallery-->
    <!-- footer-copyright start -->
  <?php footer(); ?>


<script>
  recu = document.getElementById('reçuBtn');
  envoye = document.getElementById('enovBtn');
  messages = document.getElementsByClassName('messages');
  link = document.getElementsByClassName('link');
  recu.addEventListener('click', function (){
      window.location.href = "messagerie.php";
  });
  envoye.addEventListener('click', function (){
      window.location.href = "messagerie.php?envoye=";
  });
  for (let i=0; i<messages.length;i++){
    messages[i].addEventListener('click', function (){
      link[i].click();
  });
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
    <style>
      body{
        background: url("assets/images/home/banner.jpg")no-repeat;
      }
  
    .contact-form {
      background-color: #ADD8E6;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgb(0,0,0,0.1);
      font-family: Arial, sans-serif;
      background-image: url("assets/images/cloud.jpg");
      display: flex;
      width: 80%;
      position: relative;
      right: 10%;
      left: 0%;
      flex-direction:column;
    }
   
    
    .contact-form input[type="text"]{
      border-radius: 5px;
      border: none;
      background-color: #ffffff;
      padding: 10px;
      margin-bottom: 20px;
      width: 270%;
      position: relative;
      right: 10%;
      left: -20%;
      font-size: 16px;
    }
    .contact-form textarea {
      border-radius: 5px;
      border: none;
      background-color: #ffffff;
      padding: 10px;
      margin-bottom: 20px;
      width: 270%;
      position: relative;
      right: 10%;
      left: -20%;
      font-size: 16px;
    }
    
    .contact-form input[type="submit"] {
      background-color: #428bca;
      border: none;
      border-radius: 5px;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    
    .contact-form input[type="submit"]:hover {
      background-color: #3071a9;
    }
    
    @media (min-width: 768px) {
      .contact-form {
        max-width: 600px;
        margin: 0 auto;
      }
    }
    </style>
    
    
    
    
  </div>
  </div>
  <script>
    document.getElementById("newMessageBtn").addEventListener("click", function() {
  var panel = document.getElementById("messagePanel");
  panel.style.display = "block"; // Afficher le panel
});

document.getElementById("closeBtn").addEventListener("click", function() {
  var panel = document.getElementById("messagePanel");
  panel.style.display = "none"; // Masquer le panel
});

  </script>
</body>
</html>
