<!doctype html>
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

		<!-- main-menu Start -->
		<header class="top-area">
			<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="logo">
								<a href="index.html">
									Tra<span>vel</span>
								</a>
							</div><!-- /.logo-->
						</div><!-- /.col-->
						<div class="col-sm-10">
							<div class="main-menu">
							
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<i class="fa fa-bars"></i>
									</button><!-- / button-->
								</div><!-- /.navbar-header-->
								<div class="collapse navbar-collapse">		  
									<ul class="nav navbar-nav navbar-right">
										<li class="smooth-menu"><a href="#home">Acceuil</a></li>
										<li class="smooth-menu"><a href="#blog">Actualitées </a></li>
										<li class="smooth-menu"><a href="#pack">Offres</a></li>
										<li class="smooth-menu"><a href="#gallery">Destination</a></li>
										<li class="smooth-menu"><a href="#foot">A propos</a></li>
										<li class="smooth-menu"><a href="#spo">Aide</a></li>
										<li>
											<a href="connexion.php" class="book-btn">se connecter 
											</a>
										</li><!--/.project-btn--> 
									</ul>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.main-menu-->
						</div><!-- /.col-->
					</div><!-- /.row -->
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div><!-- /.header-area -->

		</header><!-- /.top-area-->
		<!-- main-menu End -->

		
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
									<div class="about-btn">
										<button  class="about-view">
											explorez maintenant
										</button>
									</div><!--/.about-btn-->
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
		<section  class="travel-box">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="single-travel-boxes">
        					<div id="desc-tabs" class="desc-tabs">

								<ul class="nav nav-tabs" role="tablist">

									<li role="presentation" class="active">
									 	<a href="#tours" aria-controls="tours" role="tab" data-toggle="tab">
									 		<i class="fa fa-tree"></i>
									 		Excursion
									 	</a>
									</li>
									
									<li role="presentation">
										<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">
											<i class="fa fa-plane"></i>
											Voyages sur plusieurs jours
										</a>
								   </li>

									<li role="presentation">
										<a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">
											<i class="fa fa-building"></i>
											hotels
										</a>
									</li>

									
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									
									<div role="tabpanel" class="tab-pane active fade in" id="tours">
										<form method="POST" action="search.php?q=excursion">
										<div class="tab-para">

											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-12">
													<div class="single-tab-select-box">
														<h2>destination</h2>

														<div class="travel-select-icon">
															<select class="form-control " name=destination>

															  	<option value="default">enter your destination country</option><!-- /.option-->

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->


													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-3 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Départ</h2>
														<div class="travel-check-icon">
														
																<input type="text" name="depart" class="form-control" data-toggle="datepicker" placeholder="12 -01 - 2017">
														</div><!-- /.travel-check-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-3 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Retour</h2>
														<div class="travel-check-icon">
																<input type="text" name="retour" class="form-control"  data-toggle="datepicker" placeholder="22 -01 - 2017 ">
														
														</div><!-- /.travel-check-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-1 col-sm-4">
													<div class="single-tab-select-box" name="adultes">
														<h2>Nombre de nombre</h2>
														<div class="nbrPlace">
															<input name="nbrPlace" type="number"/>
														</div><!-- /.travel-select-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												
												

											</div><!--/.row-->

											<div class="row">
												<div class="col-sm-5">
													<div class="travel-budget">
														<div class="row">
															<div class="col-md-3 col-sm-4">
																<h3>budget : </h3>
															</div><!--/.col-->
															<div class="co-md-9 col-sm-8">
																<div class="travel-filter">
																	<div class="info_widget">
																		<div class="price_filter">
																			
																			<div id="slider-range"></div><!--/.slider-range-->

																			<div class="price_slider_amount">
																				<input type="text" id="amount" name="price"  placeholder="Add Your Price" />
																			</div><!--/.price_slider_amount-->
																		</div><!--/.price-filter-->
																	</div><!--/.info_widget-->
																</div><!--/.travel-filter-->
															</div><!--/.col-->
														</div><!--/.row-->
													</div><!--/.travel-budget-->
												</div><!--/.col-->
												<div class="clo-sm-7">
													<div class="about-btn travel-mrt-0 pull-right">
														<button  class="about-view travel-btn">
															Rechercher	
														</button><!--/.travel-btn-->
													</div><!--/.about-btn-->
												</div><!--/.col-->

											</div><!--/.row-->

										</div><!--/.tab-para-->
									</form>
									</div><!--/.tabpannel-->
								
								
									<div role="tabpanel" class="tab-pane fade in" id="hotels">
										<form method="POST" action="search.php?q=hotels"></form>
										<form action="" method="get" id="form-hotels">
										<div class="tab-para">

											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-12">
													<div class="single-tab-select-box">

														<h2>destination</h2>

														<div class="travel-select-icon">
															<select class="form-control ">

															  	<option value="default">enter your destination country</option><!-- /.option-->

															  	
															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->

														

													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-3 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Départ</h2>
														<div class="travel-check-icon">
															
																<input type="text" name="depart" class="form-control" data-toggle="datepicker" placeholder="12 -01 - 2017 ">
														
														</div><!-- /.travel-check-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->



												<div class="col-lg-2 col-md-1 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Séjours</h2>
														<div class="travel-select-icon">
															<select class="form-control ">

															  	<option value="default">5</option><!-- /.option-->

															  	<option value="10">10</option><!-- /.option-->

															  	<option value="15">15</option><!-- /.option-->
															  	<option value="20">20</option><!-- /.option-->

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->
 
												<div class="col-lg-2 col-md-1 col-sm-4">
													<div class="single-tab-select-box">
														<h2>members</h2>
														<div class="travel-select-icon">
															<select class="form-control ">

															  	<option value="default">1</option><!-- /.option-->

															  	<option value="2">2</option><!-- /.option-->

															  	<option value="4">4</option><!-- /.option-->
															  	<option value="8">8</option><!-- /.option-->

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

											</div><!--/.row-->

											<div class="row">
												<div class="col-sm-5"></div><!--/.col-->
												<div class="clo-sm-7">
													<div class="about-btn travel-mrt-0 pull-right">
														<button  class="about-view travel-btn">
															Rechercher	
														</button><!--/.travel-btn-->
													</div><!--/.about-btn-->
												</div><!--/.col-->

											</div><!--/.row-->

										</div><!--/.tab-para-->
									</form>
									</div><!--/.tabpannel-->
								
									<div role="tabpanel" class="tab-pane fade in" id="flights">
										<form method="POST" action="search.php?q=VSP">
										<div class="tab-para">

											<div class="row">
												<div class="col-lg-2 col-md-3 col-sm-4">
													<div class="single-tab-select-box">
														<h2>destination</h2>

														<div class="travel-select-icon">
															<select class="form-control " name=destination>

															  	<option value="default">Séléctionner destination country</option><!-- /.option-->

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->


													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-3 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Départ</h2>
														<div class="travel-check-icon">
														
																<input type="text" name="depart" class="form-control" data-toggle="datepicker" placeholder="12 -01 - 2017">
														</div><!-- /.travel-check-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-3 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Retour</h2>
														<div class="travel-check-icon">
																<input type="text" name="retour" class="form-control"  data-toggle="datepicker" placeholder="22 -01 - 2017 ">
														
														</div><!-- /.travel-check-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-1 col-sm-4">
													<div class="single-tab-select-box" name="adultes">
														<h2>Adultes</h2>
														<div class="travel-select-icon">
															<select class="form-control " name="nbrAdultes">

															  	<option value="default">nombre d'adultes</option><!-- /.option-->
																<option value="0">0</option><!-- /.option-->
															  	<option value="1">1</option><!-- /.option-->
		
															  	<option value="2">2</option><!-- /.option-->														
															  	<option value="3">3</option><!-- /.option-->
															  	<option value="4">4</option><!-- /.option-->

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

												<div class="col-lg-2 col-md-1 col-sm-4">
													<div class="single-tab-select-box">
														<h2>Enfants</h2>
														<div class="travel-select-icon">
															<select class="form-control " name="nbrEnfants">

															  	<option value="default">nombres d'enfants</option><!-- /.option-->
															  	<option value="0">0</option><!-- /.option-->
																<option value="1">1</option><!-- /.option-->
															  	<option value="2">2</option><!-- /.option-->

															  	<option value="3">3</option><!-- /.option-->
															  	<option value="4">4</option><!-- /.option-->

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->
												<div class="col-lg-2 col-md-1 col-sm-4">
													<div class="single-tab-select-box" name="adultes">
														<h2>Type de chambre</h2>
														<div class="travel-select-icon">
															<select class="form-control " name="typeChambre">

															  	<option value="default">nombre de chambre</option><!-- /.option-->
																<option value="unique">unique</option><!-- /.option-->
															  	<option value="double">double</option><!-- /.option-->
		
															  	<option value="triple">triple</option><!-- /.option-->														
															  	<option value="quadruple">quadruple</option><!-- /.option-->
														

															</select><!-- /.select-->
														</div><!-- /.travel-select-icon -->
													</div><!--/.single-tab-select-box-->
												</div><!--/.col-->

											</div><!--/.row-->

											<div class="row">
												<div class="col-sm-5">
													<div class="travel-budget">
														<div class="row">
															<div class="col-md-3 col-sm-4">
																<h3>budget : </h3>
															</div><!--/.col-->
															<div class="co-md-9 col-sm-8">
																<div class="travel-filter">
																	<div class="info_widget">
																		<div class="price_filter">
																			
																			<div id="slider-rang"></div><!--/.slider-range-->

																			<div class="price_slider_amount">
																				<input type="text" id="amoun" name="price"  placeholder="Add Your Price" />
																			</div><!--/.price_slider_amount-->
																		</div><!--/.price-filter-->
																	</div><!--/.info_widget-->
																</div><!--/.travel-filter-->
															</div><!--/.col-->
														</div><!--/.row-->
													</div><!--/.travel-budget-->
												</div><!--/.col-->
												<div class="clo-sm-7">
													<div class="about-btn travel-mrt-0 pull-right">
														<button  class="about-view travel-btn">
															Rechercher	
														</button><!--/.travel-btn-->
													</div><!--/.about-btn-->
												</div><!--/.col-->

											</div><!--/.row-->

										</div><!--/.tab-para-->
									</form>
									</div><!--/.tabpannel-->
								
								</div><!--/.tab content-->
							</div><!--/.desc-tabs-->
        				</div><!--/.single-travel-box-->
        			</div><!--/.col-->
        		</div><!--/.row-->
        	</div><!--/.container-->

        </section><!--/.travel-box-->
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
		
									<div class="col-md-6">
										<div class="filtr-item">
											<img src="assets/images/gallary/g1.jpg" alt="image du portfolio" />
											<div class="item-title">
												<a href="#">
													Chine
												</a>
												<p><span>20 circuits</span><span>15 lieux</span></p>
											</div><!-- /.item-title -->
										</div><!-- /.filtr-item -->
									</div><!-- /.col -->
		
									<div class="col-md-6">
										<div class="filtr-item">
											<img src="assets/images/gallary/g2.jpg" alt="image du portfolio" />
											<div class="item-title">
												<a href="#">
													Venezuela
												</a>
												<p><span>12 circuits</span><span>9 lieux</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
									</div><!-- /.col -->
		
									<div class="col-md-4">
										<div class="filtr-item">
											<img src="assets/images/gallary/g3.jpg" alt="image du portfolio" />
											<div class="item-title">
												<a href="#">
													Brésil
												</a>
												<p><span>25 circuits</span><span>10 lieux</span></p>
											</div><!-- /.item-title -->
										</div><!-- /.filtr-item -->
									</div><!-- /.col -->
		
									<div class="col-md-4">
										<div class="filtr-item">
											<img src="assets/images/gallary/g4.jpg" alt="image du portfolio" />
											<div class="item-title">
												<a href="#">
													Australie
												</a>
												<p><span>18 circuits</span><span>9 lieux</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
									</div><!-- /.col -->
		
									<div class="col-md-4">
										<div class="filtr-item">
											<img src="assets/images/gallary/g5.jpg" alt="image du portfolio" />
											<div class="item-title">
												<a href="#">
													Pays-Bas
												</a>
												<p><span>14 circuits</span><span>12 lieux</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
									</div><!-- /.col -->
		
									<div class="col-md-8">
										<div class="filtr-item">
											<img src="assets/images/gallary/g6.jpg" alt="image du portfolio" />
											<div class="item-title">
												<a href="#">
													Turquie
												</a>
												<p><span>14 circuits</span><span>6 lieux</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
									</div><!-- /.col -->
		
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
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p1.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>Italie <span class="pull-right">499€</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 jours 6 nuits
											</span>
											<i class="fa fa-angle-right"></i>  Hébergement 5 étoiles
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Transport
											</span>
											<i class="fa fa-angle-right"></i>  Restauration
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>2544 avis</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Réserver
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->
	
						</div><!--/.col-->
	
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p2.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>Angleterre <span class="pull-right">1499€</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 jours 6 nuits
											</span>
											<i class="fa fa-angle-right"></i>  Hébergement 5 étoiles
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Transport
											</span>
											<i class="fa fa-angle-right"></i>  Restauration
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>2544 avis</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Réserver
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->

					</div><!--/.row-->
				</div><!--/.packages-content-->
			</div><!--/.container-->

		</section><!--/.packages-->
		<!--packages end-->

		<!-- testemonial Start -->
		<section   class="testemonial">
			<div class="container">

				<div class="gallary-header text-center">
					<h2>
						avis des clients
					</h2>
					<p>
						Duis aute irure dolor in  velit esse cillum dolore eu fugiat nulla.
					</p>
	
				</div><!--/.gallery-header-->
	
				<div class="owl-carousel owl-theme" id="testemonial-carousel">
	
					<div class="home1-testm item">
						<div class="home1-testm-single text-center">
							<div class="home1-testm-img">
								<img src="assets/images/client/testimonial1.jpg" alt="img"/>
							</div><!--/.home1-testm-img-->
							<div class="home1-testm-txt">
								<span class="icon section-icon">
									<i class="fa fa-quote-left" aria-hidden="true"></i>
								</span>
								<p>
									Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam.
								</p>
								<h3>
									<a href="#">
										kevin watson
									</a>
								</h3>
								<h4>londres, angleterre</h4>
							</div><!--/.home1-testm-txt-->	
						</div><!--/.home1-testm-single-->
	
					</div><!--/.item-->
	
					<div class="home1-testm item">
						<div class="home1-testm-single text-center">
							<div class="home1-testm-img">
								<img src="assets/images/client/testimonial2.jpg" alt="img"/>
							</div><!--/.home1-testm-img-->
							<div class="home1-testm-txt">
								<span class="icon section-icon">
									<i class="fa fa-quote-left" aria-hidden="true"></i>
								</span>
								<p>
									Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam.
								</p>
								<h3>
									<a href="#">
										kevin watson
									</a>
								</h3>
								<h4>londres, angleterre</h4>
							</div><!--/.home1-testm-txt-->	
						</div><!--/.home1-testm-single-->
	
					</div><!--/.item-->
	
					<div class="home1-testm item">
						<div class="home1-testm-single text-center">
							<div class="home1-testm-img">
								<img src="assets/images/client/testimonial1.jpg" alt="img"/>
							</div><!--/.home1-testm-img-->
							<div class="home1-testm-txt">
								<span class="icon section-icon">
									<i class="fa fa-quote-left" aria-hidden="true"></i>
								</span>
								<p>
									Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam.
								</p>
								<h3>
									<a href="#">
										kevin watson
									</a>
								</h3>
								<h4>londres, angleterre</h4>
							</div><!--/.home1-testm-txt-->	
						</div><!--/.home1-testm-single-->
	
					</div><!--/.item-->

				<div class="home1-testm item">
					<div class="home1-testm-single text-center">
						<div class="home1-testm-img">
							<img src="assets/images/client/testimonial2.jpg" alt="img"/>
						</div><!--/.home1-testm-img-->
						<div class="home1-testm-txt">
							<span class="icon section-icon">
								<i class="fa fa-quote-left" aria-hidden="true"></i>
							</span>
							<p>
								Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
							<h3>
								<a href="#">
									kevin watson
								</a>
							</h3>
							<h4>londres, angleterre</h4>
						</div><!--/.home1-testm-txt-->	
					</div><!--/.home1-testm-single-->

				</div><!--/.item-->

				<div class="home1-testm item">
					<div class="home1-testm-single text-center">
						<div class="home1-testm-img">
							<img src="assets/images/client/testimonial1.jpg" alt="img"/>
						</div><!--/.home1-testm-img-->
						<div class="home1-testm-txt">
							<span class="icon section-icon">
								<i class="fa fa-quote-left" aria-hidden="true"></i>
							</span>
							<p>
								Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam.
							</p>
							<h3>
								<a href="#">
									kevin watson
								</a>
							</h3>
							<h4>londres, angleterre</h4>
						</div><!--/.home1-testm-txt-->	
					</div><!--/.home1-testm-single-->

				</div><!--/.item-->

				<div class="home1-testm item">
					<div class="home1-testm-single text-center">
						<div class="home1-testm-img">
							<img src="assets/images/client/testimonial1.jpg" alt="img"/>
						</div><!--/.home1-testm-img-->
						<div class="home1-testm-txt">
							<span class="icon section-icon">
								<i class="fa fa-quote-left" aria-hidden="true"></i>
							

								</span>
								<p>
									Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam. 
								</p>
								<h3>
									<a href="#">
										kevin watson
									</a>
								</h3>
								<h4>london, england</h4>
							</div><!--/.home1-testm-txt-->	
						</div><!--/.home1-testm-single-->

					</div><!--/.item-->

					<div class="home1-testm item">
						<div class="home1-testm-single text-center">
							<div class="home1-testm-img">
								<img src="assets/images/client/testimonial1.jpg" alt="img"/>
							</div><!--/.home1-testm-img-->
							<div class="home1-testm-txt">
								<span class="icon section-icon">
									<i class="fa fa-quote-left" aria-hidden="true"></i>
								</span>
								<p>
									Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam. 
								</p>
								<h3>
									<a href="#">
										kevin watson
									</a>
								</h3>
								<h4>londres, angleterre</h4>
							</div><!--/.home1-testm-txt-->	
						</div><!--/.home1-testm-single-->

					</div><!--/.item-->

				</div><!--/.testemonial-carousel-->
			</div><!--/.container-->

		</section><!--/.testimonial-->	
		<!-- testemonial End -->


		
		<!--blog start-->
		<section id="blog" class="blog">
			<div class="container">
				<div class="blog-details">
					<div class="gallary-header text-center">
						<h2>
							dernières nouvelles
						</h2>
						<p>
							Actualités de voyage du monde entier
						</p>
					</div><!--/.gallery-header-->
					<div class="blog-content">
						<div class="row">
							<div class="col-sm-4 col-md-4">
								<div class="thumbnail">
									<h2>actus tendances <span>15 novembre 2017</span></h2>
									<div class="thumbnail-img">
										<img src="assets/images/blog/b1.jpg" alt="blog-img">
										<div class="thumbnail-img-overlay"></div><!--/.thumbnail-img-overlay-->
									
									</div><!--/.thumbnail-img-->
								  
									<div class="caption">
										<div class="blog-txt">
											<h3>
												<a href="#">
													Découvrez le beau temps, les plats fantastiques et les lieux historiques à Prague
												</a>
											</h3>
											<p>
												Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam 
											</p>
											<a href="#">Lire la suite</a>
										</div><!--/.blog-txt-->
									</div><!--/.caption-->
								</div><!--/.thumbnail-->

							</div><!--/.col-->

							<div class="col-sm-4 col-md-4">
								<div class="thumbnail">
									<h2>actus tendances <span>15 novembre 2017</span></h2>
									<div class="thumbnail-img">
										<img src="assets/images/blog/b2.jpg" alt="blog-img">
										<div class="thumbnail-img-overlay"></div><!--/.thumbnail-img-overlay-->
									</div><!--/.thumbnail-img-->
									<div class="caption">
										<div class="blog-txt">
											<h3>
												<a href="#">
													Découvrez le beau temps, les plats fantastiques et les lieux historiques en Inde
												</a>
											</h3>
											<p>
												Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam 
											</p>
											<a href="#">Lire la suite</a>
										</div><!--/.blog-txt-->
									</div><!--/.caption-->
								</div><!--/.thumbnail-->

							</div><!--/.col-->


							</div><!--/.row-->
						</div><!--/.blog-content-->
					</div><!--/.blog-details-->
				</div><!--/.container-->

		</section><!--/.blog-->
		<!--blog end-->

		

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

