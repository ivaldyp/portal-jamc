<!DOCTYPE html>
<html lang="en" class="no-js">
    <!-- Begin Head -->
    <head>
        <!-- Basic -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Jakarta Asset Management Center</title>
        <meta name="keywords" content="HTML5 Theme" />
        <meta name="description" content="JAMC PORTAL PAGE">
        <meta name="author" content="Pusdatin BPAD 2022">

        <!-- Web Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">

        <!-- Vendor Styles -->
        <link href="{{ asset('megakit/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/css/animate.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/vendor/themify/themify.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/vendor/scrollbar/scrollbar.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/vendor/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/vendor/cubeportfolio/css/cubeportfolio.min.css') }}" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="{{ asset('megakit/css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('megakit/css/global/global.css') }}" rel="stylesheet" type="text/css"/>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('landing/assets/favicon.ico') }}" />
        <link rel="shortcut icon" href="{{ asset('landing/assets/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('megakit/img/aple-touch-icon.png') }}">

        <style>
            html {
                scroll-behavior: smooth;
            }

            .masthead-subheading {
                font-size: 1.5rem;
                font-style: italic;
                line-height: 1.5rem;
                margin-bottom: 25px;
                font-family: "Roboto Slab", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }

            .masthead-heading {
                font-size: 3.25rem;
                font-weight: 700;
                line-height: 3.25rem;
                margin-bottom: 2rem;
                font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }

            @media (min-width: 768px) {
                .masthead-subheading {
                    font-size: 2.25rem;
                    font-style: italic;
                    line-height: 2.25rem;
                    margin-bottom: 2rem;
                }
                .masthead-heading {
                    font-size: 4.5rem;
                    font-weight: 700;
                    line-height: 4.5rem;
                    margin-bottom: 4rem;
                }
            }

            .cbp-item {
                cursor: pointer; 
                border: rgb(230, 227, 227) 1px solid; 
                border-radius: 10px 10px 10px 10px;
            }
        </style>
    </head>
    <!-- End Head -->

    <!-- Body -->
    <body>

        <!--========== HEADER ==========-->
        <header class="navbar-fixed-top s-header js__header-sticky js__header-overlay">
            <!-- Navbar -->
            <nav class="s-header__navbar">
                <div class="container g-display-table--lg">
                    <!-- Navbar Row -->
                    <div class="s-header-v2__navbar-row">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="s-header-v2__navbar-col">
                            <button type="button" class="collapsed s-header-v2__toggle" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
                                <span class="s-header-v2__toggle-icon-bar"></span>
                            </button>
                        </div>

                        <div class="s-header-v2__navbar-col s-header-v2__navbar-col-width--180">
                            
                            <!-- Logo -->
                            <div class="s-header__logo">
                                <a href="{{ url('/') }}" class="s-header__logo-link">
                                    <img class="s-header__logo-img s-header__logo-img-default" src="{{ asset('landing/assets/img/logo_white.png') }}" alt="J A M C" style="width: 100%;">
                                    <img class="s-header__logo-img s-header__logo-img-shrink" src="{{ asset('landing/assets/img/logo.png') }}" alt="J A M C" style="width: 100%;">
                                </a>
                            </div>
                            <!-- End Logo -->
                        </div>
                        
                        <div class="s-header-v2__navbar-col s-header-v2__navbar-col--right">
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse s-header-v2__navbar-collapse" id="nav-collapse">
                                <ul class="s-header-v2__nav">
                                    
                                    <li class="s-header-v2__nav-item"><a href="{{ url('/') }}" class="s-header-v2__nav-link">HOME</a></li>
                                    <li class="dropdown s-header-v2__nav-item s-header-v2__dropdown-on-hover">
                                        <a href="javascript:void(0);" class=" -is-active dropdown-toggle s-header-v2__nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TENTANG KAMI<span class="g-font-size-10--xs g-margin-l-5--xs ti-angle-down"></span></a>
                                        <ul class="dropdown-menu s-header-v2__dropdown-menu">
                                            <li><a href="#" class="s-header-v2__dropdown-menu-link">Profil</a></li>
                                            <li><a href="#" class="s-header-v2__dropdown-menu-link">Tugas & Fungsi</a></li>
                                            <li><a href="#" class="s-header-v2__dropdown-menu-link -is-active">Tim JAMC</a></li>
                                        </ul>
                                    </li>
                                    <li class="s-header-v2__nav-item"><a href="#section-layanan" class="s-header-v2__nav-link">Layanan</a></li>
                                    
                                    <li class="dropdown s-header-v2__nav-item s-header-v2__dropdown-on-hover">
                                        <a href="javascript:void(0);" class="dropdown-toggle s-header-v2__nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Konten <span class="g-font-size-10--xs g-margin-l-5--xs ti-angle-down"></span></a>
                                        <ul class="dropdown-menu s-header-v2__dropdown-menu">
                                            <li><a href="#section-berita" class="s-header-v2__dropdown-menu-link">Berita</a></li>
                                            <li><a href="#section-galeri" class="s-header-v2__dropdown-menu-link">Galeri Foto</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li class="s-header-v2__nav-item"><a href="#section-kontak" class="s-header-v2__nav-link s-header-v2__nav-link--dark">Kontak</a></li>
                                </ul>
                            </div>
                            <!-- End Nav Menu -->
                        </div>
                    </div>
                    <!-- End Navbar Row -->
                </div>
            </nav>
            <!-- End Navbar -->
        </header>
        <!--========== END HEADER ==========-->

        <!--========== PROMO BLOCK ==========-->
        <div class="g-bg-position--center js__parallax-window" style="background: url({{ asset('landing/assets/img/header-bg.jpg') }}) 50% 0 no-repeat fixed;">
            <div class="g-container--md g-text-center--xs g-padding-y-150--xs">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-25--xs">Meet JAMC</p>
                <h1 class="g-font-size-40--xs g-font-size-50--sm g-font-size-60--md g-color--white g-letter-spacing--1">Creative Teams</h1>
            </div>
        </div>
        <!--========== END PROMO BLOCK ==========-->

        <!--========== PAGE CONTENT ==========-->
        <!-- Speakers -->
        <div class="container g-padding-y-80--xs g-padding-y-100--sm">
            <div class="row g-overflow--hidden">
                <div class="col-xs-6 g-full-width--xs">
                    <!-- Speaker -->
                    <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                        <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing/assets/img/team/JAMC/RISWAN SENTOSA.jpg') }}" alt="Image" style="border-radius: 10%;">
                        <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                            <div class="g-bg-color--primary g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                                <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">Riswan Sentosa</h4>
                            </div>
                            <p class="g-font-weight--700">Direktur JAMC</p>
                            
                        </div>
                    </div>
                    <!-- End Speaker -->
                </div>
                <div class="col-xs-6 g-full-width--xs g-margin-b-30--xs g-margin-b-0--lg g-padding-y-70--xs">
                    <!-- Speaker -->
                    <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                        <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing/assets/img/team/JAMC/LAILA LATIFAH.jpg') }}" alt="Image" style="border-radius: 10%;">
                        <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                            <div class="g-bg-color--primary g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                                <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">LAILA LATIFAH</h4>
                            </div>
                            <p class="g-font-weight--700">Kepala Sub Bagian Tata Usaha</p>
                            
                        </div>
                    </div>
                    <!-- End Speaker -->
                </div>
                
            </div>
        </div>
        <!-- End Speakers -->

        <!-- Team -->
        <div class="row g-row-col--0">
            <div class="col-md-3 col-xs-6 g-full-width--xs">
                <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                    <!-- Team -->
                    <div class="s-team-v1">
                        <img class="img-responsive g-width-100-percent--xs" style="width: 100%;" src="{{ asset('landing/assets/img/team/JAMC/HELMI NOURMAN ADITTYA.jpg') }}" alt="Image">
                        <div class="g-text-center--xs g-bg-color--white g-padding-x-30--xs g-padding-y-40--xs">
                            <h2 class="g-font-size-18--xs g-margin-b-5--xs">HELMI NOURMAN ADITTYA</h2>
                            <span class="g-font-size-15--xs g-color--text"><i>KEPALA SATUAN PELAKSANA RISET, KONSULTASI, DAN MANAJEMEN RESIKO</i></span>
                        </div>
                    </div>
                    <!-- End Team -->
                </div>
            </div>
            <div class="col-md-3 col-xs-6 g-full-width--xs">
                <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                    <!-- Team -->
                    <div class="s-team-v1">
                        <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing/assets/img/team/JAMC/No Name.jpg') }}" alt="Image">
                        <div class="g-text-center--xs g-bg-color--white g-padding-x-30--xs g-padding-y-40--xs">
                            <h3 class="g-font-size-18--xs g-margin-b-5--xs">--Coming Soon--</h3>
                            <span class="g-font-size-15--xs g-color--text"><i>KEPALA SATUAN PELAKSANA KONSTRUKSI, PEMELIHARAAN, DAN PENGENDALIAN</i></span>
                        </div>
                    </div>
                    <!-- End Team -->
                </div>
            </div>
            <div class="col-md-3 col-xs-6 g-full-width--xs">
                <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".3s">
                    <!-- Team -->
                    <div class="s-team-v1">
                        <img class="img-responsive g-width-100-percent--xs" style="width: 100%;" src="{{ asset('landing/assets/img/team/JAMC/HAIKAL RAHMAT FADILAH.jpg') }}" alt="Image">
                        <div class="g-text-center--xs g-bg-color--white g-padding-x-30--xs g-padding-y-40--xs">
                            <h4 class="g-font-size-18--xs g-margin-b-5--xs">HAIKAL RAHMAT FADILAH</h4>
                            <span class="g-font-size-15--xs g-color--text"><i>KEPALA SATUAN PELAKSANA PENGEMBANGAN USAHA, KOMUNIKASI, DAN KEMITRAAN</i></span>
                        </div>
                    </div>
                    <!-- End Team -->
                </div>
            </div>
            <div class="col-md-3 col-xs-6 g-full-width--xs">
                <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".4s">
                    <!-- Team -->
                    <div class="s-team-v1">
                        <img class="img-responsive g-width-100-percent--xs" style="width: 100%;" src="{{ asset('landing/assets/img/team/JAMC/EKA MAHLIDA.jpg') }}" alt="Image">
                        <div class="g-text-center--xs g-bg-color--white g-padding-x-30--xs g-padding-y-40--xs">
                            <h4 class="g-font-size-18--xs g-margin-b-5--xs">EKA MAHLIDA</h4>
                            <span class="g-font-size-15--xs g-color--text"><i>KEPALA SATUAN PELAKSANA HUKUM, PERJANJIAN, DAN PENDAYAGUNAAN</i></span>
                        </div>
                    </div>
                    <!-- End Team -->
                </div>
            </div>
        </div>
        <!-- End Team -->
        <!--========== END PAGE CONTENT ==========-->

        <!--========== FOOTER ==========-->
        <footer id="section-kontak" class="g-bg-color--dark">
            <!-- Links -->
            <div class="g-hor-divider__dashed--white-opacity-lightest">
                <div class="container g-padding-y-80--xs">
                    <div class="row">
                        <div class="col-sm-3 g-margin-b-20--xs g-margin-b-0--md">
                            <ul class="list-unstyled g-ul-li-tb-5--xs g-margin-b-0--xs">
                                <li class="g-font-size-15--xs g-color--white-opacity">
                                    <i class="ti-location-pin"></i><span style="font-weight: bold;">&ensp;Gedung Dinas Teknis</span><br>
                                    <i class="ti-location-pin" style="opacity: 0;"></i>&ensp;Jl. Abdul Muis No. 66 (Lt. 4)<br>
                                    <i class="ti-location-pin" style="opacity: 0;"></i>&ensp;Tanah Abang - Jakarta Pusat<br>
                                    <i class="ti-location-pin" style="opacity: 0;"></i>&ensp;10160
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3 g-margin-b-20--xs g-margin-b-0--md">
                            <ul class="list-unstyled g-ul-li-tb-5--xs g-margin-b-0--xs">
                                <li class="g-font-size-15--xs g-color--white-opacity">
                                    <i class="ti-instagram"></i>&ensp;@jamc_bpaddki
                                </li>
                                <li class="g-font-size-15--xs g-color--white-opacity">
                                    <i class="ti-mobile"></i>&ensp;(021) 3865745 - (021) 3865745
                                </li>
                                <li class="g-font-size-15--xs g-color--white-opacity">
                                    <i class="ti-email"></i>&ensp;dki.manajemenaset@gmail.com<br>
                                    <i class="ti-email" style="opacity: 0;"></i>&ensp;bpad@jakarta.go.id
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-md-offset-2 s-footer__logo g-padding-y-50--xs g-padding-y-0--md">
                            <h3 class="g-font-size-18--xs g-color--white">J A M C</h3>
                            <p class="g-color--white-opacity">
                                Jakarta Asset Management Center menyelenggarakan kegiatan 
                                Pendayagunaan dan Pemanfaatan Barang Milik Daerah
                                di Pemerintah Provinsi DKI Jakarta.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Links -->

            <!-- Copyright -->
            <div class="container g-padding-y-50--xs">
                <div class="row">
                    <div class="col-xs-6">
                        <a href=""><img class="g-width-100--xs" src="{{ asset('landing/assets/img/logo_bottom_white.png') }}" alt="Megakit Logo" style="width: 25%"></a>
                    </div>
                    <div class="col-xs-6 g-text-right--xs">
                        <p class="g-font-size-16--xs g-margin-b-0--xs g-color--white-opacity-light"> Powered by: <a href="http://bpad.jakarta.go.id/">BPAD</a></p>
                    </div>
                </div>
            </div>
            <!-- End Copyright -->
        </footer>
        <!--========== END FOOTER ==========-->

        <!-- Back To Top -->
        <a href="javascript:void(0);" class="s-back-to-top js__back-to-top"></a>

        <!--========== JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) ==========-->
        <!-- Vendor -->
        <script type="text/javascript" src="{{ asset('megakit/vendor/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/jquery.migrate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/jquery.smooth-scroll.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/jquery.back-to-top.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/swiper/swiper.jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/waypoint.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/counterup.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/cubeportfolio/js/jquery.cubeportfolio.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/jquery.parallax.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsXUGTFS09pLVdsYEE9YrO2y4IAncAO2U"></script>
        <script type="text/javascript" src="{{ asset('megakit/vendor/jquery.wow.min.js') }}"></script>

        <!-- General Components and Settings -->
        <script type="text/javascript" src="{{ asset('megakit/js/global.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/header-sticky.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/magnific-popup.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/swiper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/counter.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/portfolio-3-col.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/parallax.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/google-map.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('megakit/js/components/wow.min.js') }}"></script>
        <!--========== END JAVASCRIPTS ==========-->

    </body>
    <!-- End Body -->
</html>
