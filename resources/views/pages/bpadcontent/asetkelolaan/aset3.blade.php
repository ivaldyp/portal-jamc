@extends('layouts.jamcportal')

@section('content')

<!--========== PAGE CONTENT ==========-->
<div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
    <div class="col-md-12">
        <div class="row">
            <div class="g-text-center--xs g-margin-b-30--xs">
                <h2 class="g-font-size-30--xs g-font-size-30--md" style="text-align: left;">
                    Tanah Kalideres
                </h2>       
            </div>
            <hr>
            {{-- <span class="pull-right"><i class="fa fa-eye" style="color: rgb(19, 98, 146);"></i>&ensp;{{ $thiscontent['thits'] }} views</span> --}}
            <i class="fa fa-user" style="color: rgb(19, 98, 146);"></i>&ensp;oleh JAMC, 25 Sep 2023 | 08:30:00
            <hr>
            <div>
                <div style="text-align: center;">
                    <img width="100%" src="{{ asset('img/info-kelolaan/info-kelolaan-3.jpg') }}" alt="Image" style="border-radius: 10px; margin: 10px;"/>
                </div>
                <div style="text-align:left">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="border-top: 0px;">Jenis</td>
                                <td style="border-top: 0px;">Tanah</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>Jl. Perumahan Kalideres Permai Blok C8, No.5, Kel. Kalideres, Kec. Kalideres, Jakarta Barat</td>
                            </tr>
                            <tr>
                                <td>Tautan Lokasi</td>
                                <td><a target="_blank" href="https://www.google.com/maps/place/6%C2%B008'51.6%22S+106%C2%B042'24.0%22E/@-6.1475874,106.7064806,19.73z/data=!4m4!3m3!8m2!3d-6.1476533!4d106.7066782?entry=ttu">Kunjungi Google Maps</a> </td>
                            </tr>
                            <tr>
                                <td>Titik Koordinat</td>
                                <td>-6.147653292367355, 106.7066782378243</td>
                            </tr>
                            <tr>
                                <td>Luas Tanah</td>
                                <td>390 m2</td>
                            </tr>
                            <tr>
                                <td>Luas Bangunan</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Zonasi dan Peruntukan</td>
                                <td><a target="_blank" href="https://jakartasatu.jakarta.go.id/portal/apps/experiencebuilder/experience/?id=be77dd30a600425e9a76d11c6b6b0272&page=page_5">Kunjungi Jakarta Satu</a> </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-6"><img src="{{ asset('img/info-kelolaan/info-kelolaan-3a.jpg') }}" alt="Image" width="100%"/></div>
                        <div class="col-sm-6"><img src="{{ asset('img/info-kelolaan/info-kelolaan-3b.jpg') }}" alt="Image" width="100%"/></div>
                    </div>
                    <div class="row" style="padding: 20px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d991.7185607586597!2d106.7064806!3d-6.1475874!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMDgnNTEuNiJTIDEwNsKwNDInMjQuMCJF!5e0!3m2!1sen!2sid!4v1695630059318!5m2!1sen!2sid" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="g-font-size-16--xs g-font-weight--500" style="color: black; text-align: justify; margin-top: 20px;">
                        Apabila Saudara berminat untuk melakukan pemanfaatan atas aset milik Pemerintah Provinsi DKI Jakarta, surat permohonan dapat disampaikan kepada Unit Pengelola Jakarta Asset Management Centre yang beralamat di Jl. Prof. DR. Satrio No.7, Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12940 atau melalui email dki.manajemenaset@gmail.com.
                    </p>
                </div>
            </div>
        </div>
        <div class="row g-padding-y-20--xs">
            <a href="{{ url('/') }}">
                <p style="font-weight: bold;" class="blue-on-hover"><i class="ti-arrow-left"></i> Kembali ke halaman utama</p>
            </a>
        </div>
    </div>
</div>

<!--========== END PAGE CONTENT ==========-->

@endsection