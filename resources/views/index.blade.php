@extends('layouts.jamcportal')

@section('content')
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
<!-- Tupoksi -->
<div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
    <div class="g-text-center--xs g-margin-b-100--xs">
        <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Tugas dan Fungsi <br> Jakarta Asset Management Center </p>
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
<!-- End Tupoksi -->

<!-- Testimonials -->
<div id="section-testimonial" class="" style="background: url({{asset('megakit/img/1920x1080/04.jpg')}}) 50% 0 no-repeat fixed;">
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

<!-- Layanan -->
<div id="section-layanan" class="g-bg-color--sky-light" style="padding-bottom: 40px;">
    <div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs">
            {{-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Dari kami, untuk anda, secara prima</p> --}}
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
                        <a target="_blank" href="https://jamc.jakarta.go.id/digidok">
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
                        <a target="_blank" href="https://jamc.jakarta.go.id/hgbhpl/">
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
                        <a target="_blank" href="https://jamc.jakarta.go.id/lpb">
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
<!-- End Layanan -->

<!-- Berita -->
<div id="section-berita" class="container g-padding-y-80--xs g-padding-y-125--sm">
    <div class="g-text-center--xs g-margin-b-80--xs">
        {{-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Hanya yang "terhangat"</p> --}}
        <h2 class="g-font-size-32--xs g-font-size-36--md">Berita Terkini</h2>
    </div>
    <div class="row">
        @foreach($beritas as $berkey => $news)
        @if(($berkey)%2 == 0)
        <div class="row">
        @endif

        <div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
            <!-- Berita -->
            <article style="padding-top: 20px;">
                @if (file_exists(config('app.openfileimgberita') . $news['tfile'])) 
                <img class="img-responsive" src="{{ asset('publicimg/images/media/1/file') }}/{{ $news['tfile'] }}" alt="Image" />
                @else
                <img class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" />
                @endif
                <div class="g-bg-color--white g-box-shadow__dark-lightest-v2 g-padding-x-40--xs g-padding-y-40--xs">
                    <!-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2">News</p> -->
                    <h3 class="g-font-size-22--xs g-letter-spacing--1"><a href="{{ url('/konten/berita/view?ids=') }}{{ $news['ids'] }}">{{ $news['judul'] }}</a></h3>
                    <p style="text-align:center; ">{!! html_entity_decode($news['isi1']) !!}</p>
                </div>
            </article>
            <!-- End Berita -->
        </div>

        @if(($berkey+1)%2 == 0)
        </div>
        @endif
        @endforeach
    </div>
</div>
<!-- End Berita -->

<!-- Galeri -->
<div id="section-galeri" class="g-bg-color--sky-light">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-80--xs">
            {{-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Langsung dari mata sang kamera</p> --}}
            <h2 class="g-font-size-32--xs g-font-size-36--md">Galeri Foto</h2>
        </div>
        <div class="row">
            @foreach($galeris as $fotkey => $foto)
            @if(($fotkey)%3 == 0)
            <div class="row">
            @endif

            
            <div class="col-sm-4 g-margin-b-30--xs g-margin-b-0--md">
                <!-- Galeri -->
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
                <!-- End Galeri -->
            </div>

            @if(($fotkey+1)%3 == 0)
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
<!-- End Galeri -->

<!-- Counter -->
<div id="section-counter" class="js__parallax-window" style="background: url({{ asset("megakit/img/1920x1080/06.jpg") }}) 50% 0 no-repeat fixed;">
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
<div id="section-feedback" class="g-bg-color--sky-light">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-80--xs">
            {{-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Feedback</p> --}}
            <h2 class="g-font-size-32--xs g-font-size-36--md">Bantuan dan Saran</h2>
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

@endsection
