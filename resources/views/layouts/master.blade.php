<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>BPAD DKI Jakarta</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ ('/dasarhukum/public/img/photo/bpad-logo-00.png') }}" />

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400%7CSource+Sans+Pro:700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ ('/dasarhukum/public/css/bootstrap.min.css') }}" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="{{ ('/dasarhukum/public/css/owl.carousel.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ ('/dasarhukum/public/css/owl.theme.default.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ ('/dasarhukum/public/css/font-awesome.min.css') }}" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ ('/dasarhukum/public/css/style.css') }}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header id="home" style="height: 100px">
		<!-- NAVGATION -->
		<nav id="main-navbar" style="top: 20px">
			<div class="container">
				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a  href="{{ url('/') }}"><img src="{{ ('/dasarhukum/public/img/photo/bpad-logo-04b.png') }}" alt="logo" height="85"></a>
					</div>
					<!-- Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle-btn">
							<i class="fa fa-bars"></i>
						</button>
					<!-- Mobile toggle -->

					<!-- Mobile Search toggle -->
					<button class="search-toggle-btn">
							<i class="fa fa-search"></i>
						</button>
					<!-- Mobile Search toggle -->
				</div>

				<!-- Search -->
				<!-- <div class="navbar-search">
					<button class="search-btn"><i class="fa fa-search"></i></button>
					<div class="search-form">
						<form>
							<input class="input" type="text" name="search" placeholder="Search">
						</form>
					</div>
				</div> -->
				<!-- Search -->

				<!-- Nav menu -->
				<ul class="navbar-menu nav navbar-nav navbar-right">
					<li style="background: #006cb8;"><a style="color: white" href="{{ url('/login') }}">
						@if(Auth::check())
						Masuk
						@else
						Login
						@endif
					</a></li>
				</ul>

				<!-- Nav menu -->
			</div>
		</nav>
		<!-- /NAVGATION -->
	</header>
	<!-- /HEADER -->

	@yield('content')

	<!-- FOOTER -->
	<footer id="footer" class="section">
		<!-- container -->
		<div class="container">

			<!-- footer copyright & nav -->
			<div id="footer-bottom" class="row">
				<div class="col-sm-12">
					<div class="col-sm-6">
						<div class="footer-copyright">
							<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
	<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
	<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							<span>&copy; Copyright <?php echo date('Y'); ?> BPAD DKI Jakarta.</span><br>
							Powered by <a href="JavaScript:void(0);"><span style="cursor: default;">Sub Bidang Data & Informasi</span></a>
						</div>
					</div>
					<div class="col-sm-6" style="top: -20px">
						<div class="footer-copyright pull-right">
							
							<!-- <img src="{{ ('/dasarhukum/public/img/photo/plusjakartalogo2.png') }}" alt="" height="100"> -->
						</div>
					</div>
				</div>
			</div>
			<!-- /footer copyright & nav -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{ ('/dasarhukum/public/js/jquery.min.js') }}"></script>
	<script src="{{ ('/dasarhukum/public/js/bootstrap.min.js') }}"></script>
	<script src="{{ ('/dasarhukum/public/js/owl.carousel.min.js') }}"></script>
	<script src="{{ ('/dasarhukum/public/js/jquery.stellar.min.js') }}"></script>
	<script src="{{ ('/dasarhukum/public/js/main.js') }}"></script>

	<!-- <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script> -->
	<script src="{{ ('/dasarhukum/public/js/jquery.zoom.js') }}"></script>
	<script type="text/javascript">
		var main = function(){
			var ads = $('#ads')
			
			$(document).scroll(function(){
				if ( $(this).scrollTop() >= $(window).height() - ads.height() ){
				ads.removeClass('bottom').addClass('top')
				} else {
				ads.removeClass('top').addClass('bottom')
				}
			})
		}
		$(document).ready(main);
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#adsbutton").click(function(){
				$("#ads").hide();
			});
			$("#mail_submit").click(function(){
				var isi = $("#isi").val();
				var sender = $("#sender").val();

				if (isi != '' && sender != '') {
					alert("Saran berhasil tersimpan");
				}
			});
		});
	</script>
</body>

</html>
