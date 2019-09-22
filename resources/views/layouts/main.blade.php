<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Demo Law Firm | Porto - Responsive HTML5 Template 5.7.2</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- tema/vendor CSS -->
		<link rel="stylesheet" href="tema/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="tema/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="tema/vendor/animate/animate.min.css">
		<link rel="stylesheet" href="tema/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="tema/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="tema/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="tema/vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="tema/vendor/rs-plugin/css/settings.css">
		<link rel="stylesheet" href="tema/vendor/rs-plugin/css/layers.css">
		<link rel="stylesheet" href="tema/vendor/rs-plugin/css/navigation.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/skin-law-firm.css"> 

		<!-- Demo CSS -->
		<link rel="stylesheet" href="css/demos/demo-law-firm.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="tema/vendor/modernizr/modernizr.min.js"></script>
	</head>
	<body>

		<div class="body">

			<header id="header" class="header-no-border-bottom" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 115, 'stickySetTop': '-115px', 'stickyChangeLogo': false}">
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<a href="./">
										<img alt="Porto" width="164" height="54" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="dosya/img/logo.png">
									</a>
								</div>
							</div>
							<div class="header-column">
								<ul class="header-extra-info">
									<li>
										<div class="feature-box feature-box-call feature-box-style-2">
											<div class="feature-box-icon">
												<i class="icon-call-end icons"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="mb-none">(800) 123-4567</h4>
											</div>
										</div>
									</li>
									<li class="hidden-xs">
										<div class="feature-box feature-box-mail feature-box-style-2">
											<div class="feature-box-icon">
												<i class="icon-envelope icons"></i>
											</div>
											<div class="feature-box-info">
												<h4 class="mb-none"><a href="mailto:mail@example.com">mail@example.com</a></h4>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="header-container header-nav header-nav-bar header-nav-bar-primary">
						<div class="container">
							<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
								Menu <i class="fa fa-bars"></i>
							</button>
							<div class="header-search visible-lg">
								<form id="searchForm" action="page-search-results.html" method="get">
									<div class="input-group">
										<input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="icon-magnifier icons"></i></button>
										</span>
									</div>
								</form>
							</div>
							<div class="header-nav-main header-nav-main-light header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
								<nav>
									<ul class="nav nav-pills" id="mainNav">
										

									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</header>
			
        @yield('content')
 
			<footer class="short" id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-5">
							<a href="demo-law-firm.html" class="logo mb-md">
								<img alt="Porto Website Template" class="img-responsive" width="97" height="32" src="img/demos/law-firm/logo-law-firm-footer.png">
							</a>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu pulvinar magna. Phasellus semper scelerisque purus, et semper nisl lacinia sit amet. Praesent venenatis turpis vitae purus semper, eget sagittis velit venenatis.</p>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<h5 class="mb-sm">Porto Law Firm</h5>
							<ul class="list list-icons mt-xl">
								<li><i class="fa fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<h5 class="mb-sm">Toll Free</h5>
							<span class="phone">(800) 123-4567</span>
							<ul class="social-icons mt-lg">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<p>© Copyright 2017. All Rights Reserved. | <a href="demo-law-firm-contact-us.html">Contact</a></p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			
</div>

		<!-- tema/vendor -->
		<script src="tema/vendor/jquery/jquery.min.js"></script>
		<script src="tema/vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="tema/vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="tema/vendor/jquery-cookie/jquery-cookie.min.js"></script>
		<script src="tema/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="tema/vendor/common/common.min.js"></script>
		<script src="tema/vendor/jquery.validation/jquery.validation.min.js"></script>
		<script src="tema/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="tema/vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="tema/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="tema/vendor/isotope/jquery.isotope.min.js"></script>
		<script src="tema/vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="tema/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="tema/vendor/vide/vide.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Current Page tema/vendor and Views -->
		<script src="tema/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="tema/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

		<!-- Current Page tema/vendor and Views -->
		<script src="js/views/view.contact.js"></script>

		<!-- Demo -->
		<script src="js/demos/demo-law-firm.js"></script>	
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>




		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->


	</body>
</html>
