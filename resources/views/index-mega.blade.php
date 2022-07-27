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
        <header class="navbar-fixed-top s-header-v2 js__header-sticky">
        <!-- <header class="navbar-fixed-top s-header s-header__shrink js__header-overlay"> -->
            <!-- Navbar -->
            <nav class="s-header-v2__navbar">
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
                                    
                                    <li class="s-header-v2__nav-item"><a href="{{ url('/') }}" class="s-header-v2__nav-link -is-active">HOME</a></li>
                                    <li class="dropdown s-header-v2__nav-item s-header-v2__dropdown-on-hover">
                                        <a href="javascript:void(0);" class="dropdown-toggle s-header-v2__nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TENTANG KAMI<span class="g-font-size-10--xs g-margin-l-5--xs ti-angle-down"></span></a>
                                        <ul class="dropdown-menu s-header-v2__dropdown-menu">
                                            <li><a href="#" class="s-header-v2__dropdown-menu-link">Profil</a></li>
                                            <li><a href="#" class="s-header-v2__dropdown-menu-link">Tugas & Fungsi</a></li>
                                            <li><a href="{{url('/tim')}}" class="s-header-v2__dropdown-menu-link">Tim JAMC</a></li>
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

        <!--========== SWIPER SLIDER ==========-->
        <div class="s-swiper js__swiper-one-item">
            <!-- Swiper Wrapper -->
            <div class="g-fullheight--xs g-bg-position--center swiper-slide" style="background: url({{ asset('landing/assets/img/header-bg.jpg') }});">
                <div class="container g-text-center--xs g-ver-center--xs">
                    <div class="g-margin-b-30--xs">
                        <div class="g-margin-b-30--xs">
                            <h2 class="g-font-size-25--xs g-font-size-35--sm g-font-size-45--md g-color--white masthead-subheading">Selamat datang di</h2>
                            <h1 class="g-font-size-40--xs g-font-size-50--sm g-font-size-60--md g-color--white masthead-heading text-uppercase">JAKARTA ASSET<br>MANAGEMENT CENTER</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Swiper Wrapper -->

            <a href="#js__scroll-to-section" class="s-scroll-to-section-v1--bc g-margin-b-15--xs">
                <span class="g-font-size-18--xs g-color--white ti-angle-double-down"></span>
                <p class="text-uppercase g-color--white g-letter-spacing--3 g-margin-b-0--xs">More</p>
            </a>
        </div>
        <!--========== END SWIPER SLIDER ==========-->

        <!--========== PAGE CONTENT ==========-->
        <!-- Features -->
        <div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
            <div class="g-text-center--xs g-margin-b-100--xs">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Welcome to JAMC</p>
                <h2 class="g-font-size-30--xs g-font-size-30--md">
                    Membantu Badan menyelenggarakan kegiatan teknis operasional 
                    <br> optimalisasi pendayagunaan Barang Milik Daerah
                    <br> <span style="font-size: 20px;"> --Sumber: Peraturan Gubernur No. 59 Tahun 2021-- </span>
                </h2>       
            </div>
            <div class="row g-margin-b-60--xs g-margin-b-70--md">
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".1s">
                                <i class="g-font-size-28--xs g-color--primary ti-desktop"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Penelitian dan analisis pasar properti serta pelayanan konsultasi teknis</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".2s">
                                <i class="g-font-size-28--xs g-color--primary ti-settings"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Perencanaan, pengadaan, pemeliharaan dan/atau konstruksi aset</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".3s">
                                <i class="g-font-size-28--xs g-color--primary ti-ruler-alt-2"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Pengamanan dan pengendalian aset</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // end row  -->
            <div class="row">
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".4s">
                                <i class="g-font-size-28--xs g-color--primary ti-package"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Pengembangan usaha, strategi komunikasi dan publikasi, strategi pemasaran aset</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".5s">
                                <i class="g-font-size-28--xs g-color--primary ti-star"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Pemanfaatan dalam bentuk pendayagunaan dan kerja sama operasional aset</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".6s">
                                <i class="g-font-size-28--xs g-color--primary ti-panel"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Penyusunan perjanjian kerja sama aset</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // end row  -->
        </div>
        <!-- End Features -->

        <!-- Testimonials -->
        <div class="" style="background: url({{asset('megakit/img/1920x1080/04.jpg')}}) 50% 0 no-repeat fixed;">
            <div class="container g-text-center--xs g-padding-y-80--xs g-padding-y-125--sm">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-50--xs">
                    <!-- Testimonials -->
                </p>
                <div class="s-swiper js__swiper-testimonials">
                    <!-- Swiper Wrapper -->
                    <div class="g-margin-b-50--xs">
                        <div class="swiper-slide g-padding-x-130--sm g-padding-x-150--lg">
                            <div class="g-padding-x-20--xs g-padding-x-50--lg">
                                <div class="g-margin-b-40--xs">
                                    <p class="g-font-size-22--xs g-font-size-28--sm g-color--white"><i>" Jaga Amanah, Berikan Yang Terbaik. "</i></p>
                                </div>
                                <div class="center-block g-hor-divider__solid--white-opacity-lightest g-width-100--xs g-margin-b-30--xs"></div>
                                <h4 class="g-font-size-15--xs g-font-size-18--sm g-color--white-opacity-light g-margin-b-5--xs">Riswan Sentosa / Direktur JAMC</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End Swipper Wrapper -->
                </div>
            </div>
        </div>
        <!-- End Testimonials -->

        <!-- Features -->
        <div id="section-layanan" class="g-bg-color--sky-light" style="padding-bottom: 40px;">
            <div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="g-text-center--xs">
                    <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Dari kami, untuk anda, secara prima</p>
                    <h2 class="g-font-size-32--xs g-font-size-36--md">Layanan Kami</h2>
                </div>
            </div>
            <!-- Portfolio Gallery -->
            <div class="container g-margin-b-100--xs">
                <div class="row">
                    <div class="col-sm-4 g-margin-b-30--xs g-margin-b-0--md">
                        <!-- News -->
                        <article>
                            <img class="img-responsive" src="{{ asset('landing/assets/img/portfolio/1.png') }}" alt="Image">
                            <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-text-center--xs g-padding-x-40--xs g-padding-y-40--xs">
                                <h3 class="g-font-size-22--xs g-letter-spacing--1 g-font-weight--700">Digitalisasi<br>Dokumen</h3>
                                <a target="_blank" href="https://simaster.jakarta.go.id/digidok/start">
                                    <button class="btn btn-info">Kunjungi</button>
                                </a>
                            </div>
                        </article>
                        <!-- End News -->
                    </div>
                    <div class="col-sm-4 g-margin-b-30--xs g-margin-b-0--md">
                        <!-- News -->
                        <!-- News -->
                        <article>
                            <img class="img-responsive" src="{{ asset('landing/assets/img/portfolio/2.png') }}" alt="Image">
                            <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-text-center--xs g-padding-x-40--xs g-padding-y-40--xs">
                                <h3 class="g-font-size-22--xs g-letter-spacing--1 g-font-weight--700">HGB<br>Diatas HPL</h3>
                                <a target="_blank" href="https://aset.jakarta.go.id/hgb/">
                                    <button class="btn btn-info">Kunjungi</button>
                                </a>
                            </div>
                        </article>
                        <!-- End News -->
                    </div>
                    <div class="col-sm-4 g-margin-b-30--xs g-margin-b-0--md">
                        <!-- News -->
                        <!-- News -->
                        <article>
                            <img class="img-responsive" src="{{ asset('landing/assets/img/portfolio/3.png') }}" alt="Image">
                            <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-text-center--xs g-padding-x-40--xs g-padding-y-40--xs">
                                <h3 class="g-font-size-22--xs g-letter-spacing--1 g-font-weight--700">Pelayanan<br>Pemanfaatan</h3>
                                <a target="_blank" href="https://simaster.jakarta.go.id/dpa/start">
                                    <button class="btn btn-info">Kunjungi</button>
                                </a>
                            </div>
                        </article>
                        <!-- End News -->
                    </div>
                </div>
            </div>
            <!-- End Portfolio -->
        </div>
        <!-- End Features -->

        <!-- Culture -->
        <div id="section-berita" class="container g-padding-y-80--xs g-padding-y-125--sm">
            <div class="g-text-center--xs g-margin-b-80--xs">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Hanya yang "terhangat"</p>
                <h2 class="g-font-size-32--xs g-font-size-36--md">Berita</h2>
            </div>
            <div class="row">
                @foreach($beritas as $berkey => $news)
                <div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
                    <!-- News -->
                    <article style="padding-top: 20px;">
                        @if (file_exists(config('app.openfileimgberita') . $news['tfile'])) 
                        <img class="img-responsive" src="{{ asset('publicimg/images/media/1/file') }}/{{ $news['tfile'] }}" alt="Image" />
                        @else
                        <img class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" />
                        @endif
                        <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-padding-x-40--xs g-padding-y-40--xs">
                            <!-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2">News</p> -->
                            <h3 class="g-font-size-22--xs g-letter-spacing--1"><a href="javascript:void(0);">{{ $news['judul'] }}</a></h3>
                            <p style="text-align:center">{!! html_entity_decode($news['isi1']) !!}</p>
                        </div>
                    </article>
                    <!-- End News -->
                </div>
                @endforeach
            </div>
        </div>
        <!-- End Culture -->

        <!-- Culture -->
        <div id="section-galeri" class="g-bg-color--sky-light">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="g-text-center--xs g-margin-b-80--xs">
                    <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Langsung dari mata sang kamera</p>
                    <h2 class="g-font-size-32--xs g-font-size-36--md">Galeri Foto</h2>
                </div>
                <div class="row">
                    @foreach($galeris as $fotkey => $foto)
                    @if(($fotkey)%3 == 0)
                    <div class="row">
                    @endif

                    
                    <div class="col-sm-4 g-margin-b-30--xs g-margin-b-0--md">
                        <!-- News -->
                        <article style="padding-top: 20px;">
                            @if (file_exists(config('app.openfileimggambar') . $foto['tfile'])) 
                            <img class="img-responsive" src="{{ asset('publicimg/images/media/5/file') }}/{{ $foto['tfile'] }}" alt="Image" />
                            @else
                            <img class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" />
                            @endif
                            <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-padding-x-40--xs g-padding-y-40--xs g-text-center--xs ">
                                <!-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2">News</p> -->
                                <h3 class="g-font-size-16--xs g-letter-spacing--1">{{ $foto['judul'] }}</h3>
                            </div>
                        </article>
                        <!-- End News -->
                    </div>

                    @if(($fotkey+1)%3 == 0)
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Culture -->

        <!-- Counter -->
        <div class="js__parallax-window" style="background: url({{ asset("megakit/img/1920x1080/06.jpg") }}) 50% 0 no-repeat fixed;">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="row">
                    <div class="col-md-4 col-xs-4 g-full-width--xs g-margin-b-70--xs g-margin-b-0--lg">
                        <div class="g-text-center--xs">
                            <figure class="g-display-block--xs g-font-size-70--xs g-color--white g-margin-b-10--xs js__counter">3</figure>
                            <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                            <h4 class="g-font-size-18--xs g-color--white">Aplikasi</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4 g-full-width--xs g-margin-b-70--xs g-margin-b-0--sm">
                        <div class="g-text-center--xs">
                            <figure class="g-display-block--xs g-font-size-70--xs g-color--white g-margin-b-10--xs js__counter">{{ $jamc_pegawais['total_pegawai'] }}</figure>
                            <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                            <h4 class="g-font-size-18--xs g-color--white">Pegawai</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4 g-full-width--xs">
                        <div class="g-text-center--xs">
                            <div class="g-margin-b-10--xs">
                                <figure class="g-display-inline-block--xs g-font-size-70--xs g-color--white js__counter">100</figure>
                                <span class="g-font-size-40--xs g-color--white">%</span>
                            </div>
                            <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                            <h4 class="g-font-size-18--xs g-color--white">Pelayanan</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Counter -->

        <!-- Feedback Form -->
        <div class="g-bg-color--sky-light">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="g-text-center--xs g-margin-b-80--xs">
                    <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Feedback</p>
                    <h2 class="g-font-size-32--xs g-font-size-36--md">Send us a note</h2>
                </div>
                <form>
                    <div class="row g-margin-b-40--xs">
                        <div class="col-sm-6 g-margin-b-20--xs g-margin-b-0--md">
                            <div class="g-margin-b-20--xs">
                                <input type="text" class="form-control s-form-v2__input g-radius--50" placeholder="* Name">
                            </div>
                            <div class="g-margin-b-20--xs">
                                <input type="email" class="form-control s-form-v2__input g-radius--50" placeholder="* Email">
                            </div>
                            <input type="text" class="form-control s-form-v2__input g-radius--50" placeholder="* Phone">
                        </div>
                        <div class="col-sm-6">
                            <textarea class="form-control s-form-v2__input g-radius--10 g-padding-y-20--xs" rows="8" placeholder="* Your message"></textarea>
                        </div>
                    </div>
                    <div class="g-text-center--xs">
                        <button type="submit" class="text-uppercase s-btn s-btn--md s-btn--primary-bg g-radius--50 g-padding-x-80--xs">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Feedback Form -->

        <!-- Google Map -->
        
        <iframe id="js__google-container" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.646195305157!2d106.81646615115619!3d-6.178092662238274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f42a96d4428f%3A0x19ca3e98a96811ee!2sBPAD%20Provinsi%20DKI%20Jakarta!5e0!3m2!1sen!2sid!4v1658426656998!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- End Google Map -->
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
