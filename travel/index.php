
<?php
	require_once 'methodes/methodes.php';
	require_once 'Classes/Client.php';
	require_once 'Classe-db.php';
	session_start();
	$session = $_COOKIE['PHPSESSID'];
?>
<html class="no-js"  lang="en">
	<head>
		<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!--font-family-->
		
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
		<style>
			.packages-content img{
				height: 300px;
			}
		</style>

	</head>
	<body>
			<?php
				verifierSession($session);
			?>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		

		
		<!--about-us start -->
		<section id="home" class="about-us">
			<div class="container">
				<div class="about-us-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="single-about-us">
								<div class="about-us-txt">
									<h2>
										Explorez le monde avec nous. 

									</h2>
									<?php 
									$bdd= new BD();
									if ($bdd->verifierSession($session) != 1){
									echo <<<'EOT'
									<div class="about-btn">
										<a href="inscription.php" style="font-size:14px" class="about-view">
											Rejoignez nous
										</a>
									</div><!--/.about-btn-->
									EOT;
									}?>
								</div><!--/.about-us-txt-->
							</div><!--/.single-about-us-->
						</div><!--/.col-->
						<div class="col-sm-0">
							<div class="single-about-us">
								
							</div><!--/.single-about-us-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.about-us-content-->
			</div><!--/.container-->

		</section><!--/.about-us-->
		<!--about-us end -->

		<!--travel-box start-->
		
		<!--travel-box end-->

        <!--service start-->
		<section id="service" class="service">
			<div class="container">

				<div class="service-counter text-center">

					<div class="col-md-4 col-sm-4">
						<div class="single-service-box">
							<div class="service-img">
								<img src="assets/images/service/s1.png" alt="service-icon" />
							</div><!--/.service-img-->
							<div class="service-content">
								<h2>
									<a href="#">
									Des éxcursion toute au long du pays.
									</a>
								</h2>
								<p>Quelle meilleure façon de connaitre son histoire que de voir les traces qu'elle a laissé pour nous.</p>
							</div><!--/.service-content-->
						</div><!--/.single-service-box-->
					</div><!--/.col-->

					<div class="col-md-4 col-sm-4">
						<div class="single-service-box">
							<div class="service-img">
								<img src="assets/images/service/s2.png" alt="service-icon" />
							</div><!--/.service-img-->
							<div class="service-content">
								<h2>
									<a href="#">
										Des hotels en tout genre.
									</a>
								</h2>
								<p>Un hébergemnt de la plus haute classe.</p>
							</div><!--/.service-content-->
						</div><!--/.single-service-box-->
					</div><!--/.col-->

					<div class="col-md-4 col-sm-4">
						<div class="single-service-box">
							<div class="statistics-img">
								<img src="assets/images/service/s3.png" alt="service-icon" />
							</div><!--/.service-img-->
							<div class="service-content">

								<h2>
									<a href="#">
										Des voyages totalement organisée.
									</a>
								</h2>
								<p>Un voyage des plus mérveilleux sans se soucier de son organisation.</p>
							</div><!--/.service-content-->
						</div><!--/.single-service-box-->
					</div><!--/.col-->

				</div><!--/.statistics-counter-->	
			</div><!--/.container-->

		</section><!--/.service-->
		<!--service end-->

		<!--galley start-->
		<section id="gallery" class="gallery">
			<div class="container">
				<div class="gallery-details">
					<div class="gallary-header text-center">
						<h2>
							Destinations
						</h2>
		
					</div><!--/.gallery-header-->
					<div class="gallery-box">
						<div class="gallery-content">
							<div class="filtr-container">
								<div class="row">
		
		
									<?php destinations();?>
		
								</div><!-- /.row -->
		
							</div><!-- /.filtr-container-->
						</div><!-- /.gallery-content -->
					</div><!--/.galley-box-->
				</div><!--/.gallery-details-->
			</div><!--/.container-->

		</section><!--/.gallery-->
		<!--gallery end-->


		<!--discount-offer start-->
		

		<!--packages start-->
		<section id="pack" class="packages">
			<div class="container">
				<div class="gallary-header text-center">
					<h2>
						Offres
					</h2>
				</div><!--/.gallery-header-->
				<div class="packages-content">
					<div class="row">
					
					<?php sejours();?>
					</div><!--/.row-->
					<div class="row">
					
					<?php excursions();?>
					</div><!--/.row-->
					<div class="row">
					
					<?php hotels();?>
					</div><!--/.row-->
				</div><!--/.packages-content-->
			</div><!--/.container-->

		</section><!--/.packages-->
		<!--packages end-->

		<!-- testemonial Start -->
		

		

		

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

