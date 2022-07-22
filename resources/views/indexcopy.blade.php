<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>JAMC - Jakarta Asset Management Center</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('landing/assets/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />

        <style>
            .portfolio-item {
                padding-top: 20px;
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{ asset('landing/assets/img/logo.svg') }}" alt="JAMC" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#news">Berita</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Pelayanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Aplikasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Tim JAMC</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                        <li class="nav-item" style="background-color: rgb(14, 95, 143);"><a class="nav-link" href="{{ url('/login') }}">LOGIN</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Selamat datang di</div>
                <div class="masthead-heading text-uppercase">Jakarta Asset<br> Management Center</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Lihat Kami</a>
            </div>
        </header>
        
        <!-- About -->
        <section class="page-section" id="news">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Berita</h2>
                    <h3 class="section-subheading text-muted">Semua Tentang JAMC</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('landing/assets/img/about/1.jpg') }}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2025</h4>
                                <h4 class="subheading">coming soon</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('landing/assets/img/about/2.jpg') }}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2024</h4>
                                <h4 class="subheading">comming soon</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('landing/assets/img/about/3.jpg') }}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2023</h4>
                                <h4 class="subheading">Berperan serta meningkatkan Pendapatan Asli Daerah</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('landing/assets/img/about/4.jpg') }}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2022</h4>
                                <h4 class="subheading">JAMC mulai beraksi</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Tahun 2021
                                <br />
                                Tonggak JAMC
                                <br />
                                Dimulai
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Services-->
        <section class="page-section bg-light" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Aplikasi</h2>
                    <h3 class="section-subheading text-muted">Berbagai sistem aplikasi yang dimiliki oleh JAMC.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4" style="padding-top: 20px;">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-building fa-stack-1x fa-inverse"></i>
                            
                        </span>
                        <h4 class="my-3">B.O.T</h4>
                        <p class="text-muted">Build, Operated, Transfer</p>
                        <a class="btn btn-warning text-uppercase" style="margin-top: 10px;" href="#">Kunjungi</a><br>
                        <a class="btn btn-info text-uppercase" style="margin-top: 10px;" href="#">Monitoring</a>
                    </div>
                    <div class="col-md-4" style="padding-top: 20px;">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="far fa-building fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">B.T.O</h4>
                        <p class="text-muted">Build, Transfer, Operated</p>
                    </div>
                    <div class="col-md-4" style="padding-top: 20px;">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-tree fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">HPL</h4>
                        <p class="text-muted">Hak Penggunaan Lahan</p>
                        </div>
                    <div class="col-md-4" style="padding-top: 20px;">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="far fa-handshake fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Kerjasama Infrastruktur</h4>
                        <p class="text-muted">Kerjasama Infrastruktur</p>
                        </div>
                    <div class="col-md-4" style="padding-top: 20px;">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-tags fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Sewa</h4>
                        <p class="text-muted">Sewa Menyewa</p>
                        </div>
                    <div class="col-md-4" style="padding-top: 20px;">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">(coming-soon)</h4>
                        <p class="text-muted">segera hadir</p>            
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Layanan</h2>
                    <h3 class="section-subheading text-muted">Berbagai pelayanan JAMC.</h3>
                </div>
                <div class="row" style="display: flex; flex-wrap: wrap;">
                    <div class="col-md-4">
                        <div class="portfolio-item" style="height: 100%;">
                            <a class="portfolio-link" href="/earsip/index.php">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('landing/assets/img/portfolio/1.png') }}" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Digitalisasi Dokumen</div>
                                <div class="portfolio-caption-subheading text-muted">Aplikasi digitalisasi dan repositori dokumen</div>
                                <a class="btn btn-warning text-uppercase" style="margin-top: 10px;" href="#">Kunjungi</a><br>
                                <a class="btn btn-info text-uppercase" style="margin-top: 10px;" href="#">Monitoring</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item" style="height: 100%;">
                            <a class="portfolio-link" href="/earsip/index.php">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('landing/assets/img/portfolio/1.png') }}" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Digitalisasi Dokumen</div>
                                <div class="portfolio-caption-subheading text-muted">Aplikasi digitalisasi dan repositori dokumen</div>
                                <a class="btn btn-warning text-uppercase" style="margin-top: 10px;" href="#">Kunjungi</a><br>
                                <a class="btn btn-info text-uppercase" style="margin-top: 10px;" href="#">Monitoring</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item" style="height: 100%;">
                            <a class="portfolio-link" href="/earsip/index.php">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('landing/assets/img/portfolio/1.png') }}" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Digitalisasi Dokumen</div>
                                <div class="portfolio-caption-subheading text-muted">Aplikasi digitalisasi dan repositori dokumen</div>
                                <a class="btn btn-warning text-uppercase" style="margin-top: 10px;" href="#">Kunjungi</a><br>
                                <a class="btn btn-info text-uppercase" style="margin-top: 10px;" href="#">Monitoring</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item" style="height: 100%;">
                            <a class="portfolio-link" href="/earsip/index.php">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('landing/assets/img/portfolio/1.png') }}" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Digitalisasi Dokumen</div>
                                <div class="portfolio-caption-subheading text-muted">Aplikasi digitalisasi dan repositori dokumen</div>
                                <a class="btn btn-warning text-uppercase" style="margin-top: 10px;" href="#">Kunjungi</a><br>
                                <a class="btn btn-info text-uppercase" style="margin-top: 10px;" href="#">Monitoring</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tim JAMC</h2>
                    <h3 class="section-subheading text-muted">Para personil terbaik dan berkompeten di Bidangnya.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('landing/assets/img/team/1.png') }}" alt="..." />
                            <h4>Riswan Sentosa</h4>
                            <p class="text-muted">Direktur JAMC</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('landing/assets/img/team/2.jpg') }}" alt="..." />
                            <h4>Laila Latifah</h4>
                            <p class="text-muted">Kepala Sub Bagian Tata Usaha</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('landing/assets/img/team/2.png') }}" alt="..." />
                            <h4>Achmad Tarisi</h4>
                            <p class="text-muted">Kepala Satuan Pelaksana Pengembangan Usaha, Komunikasi, dan Kemitraan</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('landing/assets/img/team/3.jpg') }}" alt="..." />
                            <h4>Helmi Nourman Aditya</h4>
                            <p class="text-muted">Kepala Satuan Pelaksana Riset, Konsultasi, dan Manajemen Resiko</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">-tagline JAMC-</p></div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Kontak</h2>
                    <h3 class="section-subheading text-muted">Hubungi kami dimanapun kapanpun.</h3>
                </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; JAMC 2022</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </footer>        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('landing/js/scripts.js') }}"></script>
    </body>
</html>
