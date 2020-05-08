<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>BPAD DKI Jakarta</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ ('/portal/public/img/photo/bpad-logo-00.png') }}" />

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400%7CSource+Sans+Pro:700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ ('/portal/public/css/bootstrap.min.css') }}" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="{{ ('/portal/public/css/owl.carousel.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ ('/portal/public/css/owl.theme.default.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ ('/portal/public/css/font-awesome.min.css') }}" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ ('/portal/public/css/style.css') }}" />

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
						<a  href="{{ url('/') }}"><img src="{{ ('/portal/public/img/photo/bpad-logo-04b.png') }}" alt="logo" height="85"></a>
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
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('profil') }}">Profil</a></li>
					<li><a href="http://aset.jakarta.go.id" target="_blank">Produk</a></li>
					<li class="has-dropdown"><a href="#">Konten</a>
						<ul class="dropdown" style="list-style: none; padding: 0;">
							<li><a href="{{ url('content/berita') }}">Berita</a></li>
							<li><a href="{{ url('content/foto') }}">Foto</a></li>
							<li><a href="{{ url('content/video') }}">Video</a></li>
							<!-- <li><a href="{{ url('content/Infografis') }}">Infografis</a></li> -->
						</ul>
					</li>
					<li><a href="http://download.bpadjakarta.id/" target="_blank">Download</a>
					<li><a href="https://ppid.jakarta.go.id/" target="_blank">PPID</a></li>
					<!-- <li>
						<ul class="dropdown">
							<li><a href="single-event.html">Produk Hukum</a></li>
							<li><a href="single-event.html">Manual Book</a></li>
							<li><a href="single-event.html">Aplikasi</a></li>
						</ul>
					</li> -->
					<!-- <li class="has-dropdown"><a href="#">Blog</a>
						<ul class="dropdown">
							<li><a href="blog.html">Blog Page</a></li>
							<li><a href="single-blog.html">Single Blog</a></li>
						</ul>
					</li> -->
					<li style="background: #006cb8;"><a style="color: white" href="{{ url('login') }}">
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
			<!-- row -->
			<div class="row">
				<!-- footer contact -->
				<div class="col-md-4">
					<div class="footer">
						<div class="footer-logo" style="margin-bottom: 0px">
							<a href="#"><img src="{{ ('/portal/public/img/photo/bpad-logo-02.png') }}" alt="" height="100"></a>
						</div>
						<address>
							<span style="font-weight: bold;">Gedung Dinas Teknis</span><br>
							Jl. Abdul Muis No. 66 (Lt. 5)<br>
							Tanah Abang-Jakarta Pusat
				 		</address>
						<ul class="footer-contact" style="list-style: none; padding: 0;">
							<!-- <li><i class="fa fa-map-marker"></i> 2736 Hinkle Deegan Lake Road </li> -->
							<li><i class="fa fa-phone"></i> (021) 3865745 - (021) 3865745</li>
							<li><i class="fa fa-envelope"></i> asetbpad@gmail.com</li>
						</ul>
					</div>
				</div>
				<!-- /footer contact -->

				<!-- footer galery -->
				<div class="col-md-4">
					<div class="footer">
						<h3 class="footer-title">Lokasi</h3>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13246.003047911674!2d106.82764239905804!3d-6.184647288073016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f42a97a0358d%3A0x907e5135edab49ff!2sBADAN%20PAJAK%20DAN%20RETRIBUSI%20DAERAH!5e0!3m2!1sen!2sid!4v1577342271846!5m2!1sen!2sid" frameborder="0" style=" height: 200px;" allowfullscreen="true"></iframe>
					</div>
				</div>
				<!-- /footer galery -->

				<!-- footer newsletter -->
				<div class="col-md-4">
					<div class="footer">
						<h3 class="footer-title">Bantuan dan Saran</h3>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p> -->
						<form class="footer-newsletter" action="mail" method="post">
							@csrf
							<!-- <input class="input" type="email" placeholder="Enter your email"> -->
							<textarea class="input" placeholder="Ketik saran dan masukkan" name="body"></textarea>
							<input class="input" type="email" name="sender" placeholder="Masukkan email" autocomplete="off">
							<button class="primary-button" type="submit">Kirim</button>
						</form>
						<ul class="footer-social text-center">
							<!-- <li><a href="JavaScript:void(0);"><i class="fa fa-facebook"></i></a></li> -->
							<li><a target="_blank" href="https://twitter.com/BPAD_Jakarta"><i class="fa fa-twitter"></i></a></li>
							<li><a target="_blank" href="https://www.youtube.com/channel/UC_S1y4yWE7nngg66DfG_hxg/"><i class="fa fa-youtube"></i></a></li>
							<li><a target="_blank" href="https://instagram.com/bpad_jakarta"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<!-- /footer newsletter -->

				<!-- footer galery -->
				<!-- <div class="col-md-4">
					<div class="footer">
						<h3 class="footer-title">Galery</h3>
						<ul class="footer-galery">
							<li><a href="#"><img src="./img/galery-1.jpg" alt=""></a></li>
							<li><a href="#"><img src="./img/galery-2.jpg" alt=""></a></li>
							<li><a href="#"><img src="./img/galery-3.jpg" alt=""></a></li>
							<li><a href="#"><img src="./img/galery-4.jpg" alt=""></a></li>
							<li><a href="#"><img src="./img/galery-5.jpg" alt=""></a></li>
							<li><a href="#"><img src="./img/galery-6.jpg" alt=""></a></li>
						</ul>
					</div>
				</div> -->
				<!-- /footer galery -->

				<!-- footer newsletter -->
				<!-- <div class="col-md-4">
					<div class="footer">
						<h3 class="footer-title">Newsletter</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
						<form class="footer-newsletter">
							<input class="input" type="email" placeholder="Enter your email">
							<button class="primary-button">Subscribe</button>
						</form>
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
					</div>
				</div> -->
				<!-- /footer newsletter -->
			</div>
			<!-- /row -->

			<!-- footer copyright & nav -->
			<div id="footer-bottom" class="row">
				<div class="col-md-6 col-md-push-6">
					<!-- <ul class="footer-nav">
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Causes</a></li>
						<li><a href="#">Events</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Contact</a></li>
					</ul> -->
				</div>

				<div class="col-md-6 col-md-pull-6">
					<div class="footer-copyright">
						<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
						<span>&copy; Copyright <?php echo date('Y'); ?> BPAD DKI Jakarta.</span><br>
						Powered by <a href="JavaScript:void(0);"><span style="cursor: default;">Sub Bidang Data & Informasi</span></a>
					</div>
				</div>
			</div>
			<!-- /footer copyright & nav -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{ ('/portal/public/js/jquery.min.js') }}"></script>
	<script src="{{ ('/portal/public/js/bootstrap.min.js') }}"></script>
	<script src="{{ ('/portal/public/js/owl.carousel.min.js') }}"></script>
	<script src="{{ ('/portal/public/js/jquery.stellar.min.js') }}"></script>
	<script src="{{ ('/portal/public/js/main.js') }}"></script>

	<!-- <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script> -->
	<script src="{{ ('/portal/public/js/jquery.zoom.js') }}"></script>
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
</body>

</html>
