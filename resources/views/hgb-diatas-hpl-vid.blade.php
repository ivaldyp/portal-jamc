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
<div id="section-visimisi" class="g-bg-color--sky-light">
    <div class="container g-padding-y-80--xs g-padding-y-100--sm">
        <div class="col-md-12">
            <div class="row">
                <div class="g-text-center--xs g-margin-b-30--xs">    
                    <h3 class="">Video Alur Layanan Rekomendasi <br>Hak Guna Bangunan (HGB) diatas Hak Pengelolaan (HPL)</h3>
                </div>
                <br>
                <br>
                <div>
                    <div style="text-align: center;">
                        <iframe width="672" height="378" src="https://www.youtube.com/embed/h6LDxZGeEmE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div style="text-align:justify;" class="g-padding-y-50--xs g-padding-y-50--sm col-md-10 col-md-offset-1">
                        <p style="font-size: large;">
                            Rekomendasi HGB diatas HPL berarti hak untuk mendirikan/menguasai atas suatu bangunan yang sebagian wewenang pelaksanaan tanahnya dilimpahkan kepada pemegang Hak Pengelola Lahan.
                            <br>Jenis layanan rekomendasi HGB diatas HPL meliputi:
                            <br>
                            <ol>
                                <li>Perolehan</li>
                                <li>Perpanjangan</li>
                                <li>Peralihan</li>
                                <li>Penjaminan/Pertanggungan</li>
                            </ol>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Visi Misi -->

<!--========== END PAGE CONTENT ==========-->
@endsection