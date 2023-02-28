@extends('layouts.jamcportal')

@section('content')

<!--========== PROMO BLOCK ==========-->
<div class="g-bg-position--center js__parallax-window" style="background: url({{ asset('landing/assets/img/header-bg.jpg') }}) 50% 0 no-repeat fixed;">
    <div class="container g-padding-y-125--xs">
        <div class="g-padding-y-50--xs">
            <h1 class="g-color--white g-font-size-30--xs g-font-size-50--sm g-font-size-65--lg">Jakarta Asset Management Center</h1>
            <p class="g-color--white g-font-size-22--xs g-font-size-24--md g-margin-b-0--xs">Jaga Amanah, Berikan yang Terbaik</p>
        </div>
    </div>
</div>
<!--========== END PROMO BLOCK ==========-->

<!--========== PAGE CONTENT ==========-->
<!-- Visi Misi -->
<div id="section-visimisi" class="g-bg-color--white">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-80--xs">
            {{-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Tujuan Kami</p> --}}
            <h2 class="g-font-size-32--xs g-font-size-36--md">Visi & Misi</h2>
        </div>
        <div class="row g-hor-centered-row--md g-row-col--5 g-margin-b-60--xs g-margin-b-100--md">
            <div class="col-sm-6 col-xs-6 g-hor-centered-row__col">
                <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".1s">
                    <img class="img-responsive" src="{{ asset('publicimg/images/media/1/file/cms2006220204431469.jpeg') }}" alt="Image">
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5 g-hor-centered-row__col">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Visi</p>
                <h2 class="g-font-size-30--xs g-font-size-26--sm g-margin-b-20--xs">Menjadi Pengelola Pemanfaatan Aset Daerah Yang Memberikan Manfaat Optimal Untuk Kepentingan Pemerintah Provinsi DKI Jakarta</h2>
                <!-- <p class="g-font-size-18--sm">We aim high at being focused on building relationships with our clients and community. Using our creative gifts drives this foundation.</p> -->
            </div>
        </div>

        <div class="row g-hor-centered-row--md g-row-col--5">
            <div class="col-sm-6 col-xs-6 col-sm-push-6 g-hor-centered-row__col g-margin-b-60--xs g-margin-b-0--md">
                <div class="wow fadeInRight" data-wow-duration=".3" data-wow-delay=".1s">
                    <img class="img-responsive" src="{{ asset('publicimg/images/media/5/file/cms07012022083707171966.jpeg') }}" alt="Image">
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5 col-sm-pull-7 g-hor-centered-row__col g-text-left--xs g-text-right--md">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Misi</p>
                <!-- <h2 class="g-font-size-32--xs g-font-size-36--sm g-margin-b-25--xs">Keynote Speakers</h2> -->
                <ul>
                    <li>
                        <p class="g-font-size-18--sm">Mengelola aset kelolaan untuk menghasilkan manfaat bagi Pemerintah Provinsi DKI Jakarta.</p>
                    </li>
                    <li>
                        <p class="g-font-size-18--sm">Mengoptimalisasi pendayagunaan aset Pengguna Barang untuk meningkatkan nilai tambah dan manfaat finansial bagi Pemerintah Provinsi DKI Jakarta.</p>
                    </li>
                    <li>
                        <p class="g-font-size-18--sm">Optimalisasi aset yang berorientasi pada peningkatan ekonomi Usaha Mikro, Kecil, dan Menengah (UMKM).</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Visi Misi -->

<!-- Sejarah -->
<div id="section-sejarah" class="g-bg-color--sky-light">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-80--xs">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Tentang Kami</p>
            <h2 class="g-font-size-32--xs g-font-size-36--md">Sejarah Singkat</h2>
        </div>
        <div class="row">
            <div class="" style="text-align: justify;">
                &emsp;&emsp;&emsp;&emsp;Badan Pengelolaan Aset Daerah Provinsi DKI Jakarta 
                merespon isu peningkatan Pendapatan Asli Daerah (PAD) 
                yang bersumber dari pemanfaatan aset adalah dengan memberikan pelayanan pemanfaatan aset 
                secara professional yang menjaga tingkat kualitas, kecepatan, dan akurasi terbaik. 
            </div><br>
            <div class="" style="text-align: justify;">
                &emsp;&emsp;&emsp;&emsp;Untuk memberikan pelayanan pemanfaatan aset yang professional, 
                Provinsi DKI Jakarta melakukan perubahan Organisasi dan Tata Kerja Badan Pengelolaan Aset Daerah 
                dalam menyelenggarakan fungsi penunjang urusan pemerintahan bidang keuangan pada sub bidang aset, 
                yang ditetapkan dengan Peraturan Gubernur No. 59 Tahun 2021 
                Tentang Organisasi dan Tata Kerja Badan Pengelolaan Aset Daerah. 
            </div><br>
            <div class="" style="text-align: justify;">
                &emsp;&emsp;&emsp;&emsp;Dalam Peraturan Gubernur No. 59 Tahun 2021, 
                dibentuk Unit Pelaksana Teknis (UPT) Unit Pengelola Manajemen Aset 
                yang menyelenggarakan kegiatan teknis operasional optimalisasi pendayagunaan barang milik daerah, 
                termasuk pemanfaatan barang milik daerah yang bersifat komersil, pengelolaan properti, 
                pelaksanaan jasa konsultasi solusi aset (asset solution), rekomendasi Hak Guna Bangunan diatas hak pengelolaan lahan, 
                pemanfaatan infrastruktur, kerja sama operasi, penyelenggaraan reklame, dan optimalisasi pemanfaatan aset lainnya.
            </div>
        </div>
    </div>
</div>
<!-- End Sejarah -->

<!-- Leaders -->
<div id="section-leader" class="container g-padding-y-80--xs g-padding-y-100--sm">
    <div class="g-text-center--xs g-margin-b-80--xs">
        {{-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Hanya yang terbaik</p> --}}
        <h2 class="g-font-size-32--xs g-font-size-36--md">Struktur Organisasi</h2>
    </div>
    <div class="row g-overflow--hidden">
        <div class="col-xs-6 g-full-width--xs">
            <!-- Leader -->
            <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing/assets/img/team/JAMC/IFAN MOHAMMAD FIRMANSYAH.jpg') }}" alt="Image" style="border-radius: 10%;">
                <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                    <div class="g-bg-color--primary g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                        <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">Ifan Mohammad Firmansyah</h4>
                    </div>
                    <p class="g-font-weight--700">Plt. Direktur JAMC</p>
                    
                </div>
            </div>
            <!-- End Leader -->
        </div>
        <div class="col-xs-6 g-full-width--xs g-margin-b-30--xs g-margin-b-0--lg g-padding-y-70--xs">
            <!-- Leader -->
            <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing/assets/img/team/JAMC/LAILA LATIFAH.jpg') }}" alt="Image" style="border-radius: 10%;">
                <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                    <div class="g-bg-color--primary g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                        <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">LAILA LATIFAH</h4>
                    </div>
                    <p class="g-font-weight--700">Kepala Sub Bagian Tata Usaha</p>
                    
                </div>
            </div>
            <!-- End Leader -->
        </div>
        
    </div>
</div>
<!-- End Leaders -->

<!-- Team -->
<div id="section-team" class="row g-row-col--0">
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
@endsection