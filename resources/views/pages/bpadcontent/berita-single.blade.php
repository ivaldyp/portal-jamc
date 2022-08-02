@extends('layouts.jamcportal')

@section('content')

<!--========== PAGE CONTENT ==========-->
<!-- Sejarah -->
<div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
    <div class="col-md-9">
        <div class="row">
            <div class="g-text-center--xs g-margin-b-30--xs">
                <h2 class="g-font-size-30--xs g-font-size-30--md" style="text-align: left;">
                    {{ $thiscontent['judul'] }}
                </h2>       
            </div>
            <hr>
            <span class="pull-right"><i class="fa fa-eye" style="color: rgb(19, 98, 146);"></i>&ensp;{{ $thiscontent['thits'] }} views</span>
            <i class="fa fa-user" style="color: rgb(19, 98, 146);"></i>&ensp;oleh {{ strtoupper($thiscontent['editor']) }}, {{ date('d M Y', strtotime($thiscontent['tanggal'])) }} | {{ date('H:i:s', strtotime($thiscontent['tanggal'])) }}
            <hr>
            <div>
                @if (file_exists(config('app.openfileimgberita') . $thiscontent['tfile'])) 
                <img class="img-responsive" src="{{ asset('publicimg/images/media/1/file') }}/{{ $thiscontent['tfile'] }}" alt="Image" style="border-radius: 10px;"/>
                @else
                <img class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" style="border-radius: 10px;"/>
                @endif
                <div style="text-align:justify;">
                    <p>{!! html_entity_decode($thiscontent['isi2']) !!}</p>
                </div>
            </div>
        </div>
        <div class="row g-padding-y-20--xs">
            <a href="{{ url('/konten/berita') }}">
                <p style="font-weight: bold;" class="blue-on-hover"><i class="ti-arrow-left"></i> Kembali ke halaman berita</p>
            </a>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="row">
            <div class="g-text-center--xs g-margin-b-16--xs">
                <h2 class="g-font-size-20--xs g-font-size-20--md" style="text-align: left;">
                    &emsp;Berita Terbaru
                </h2>       
                @foreach($aside_recent as $reckey => $rec)
                <a class="" href="{{ url('/konten/berita/view?ids=') }}{{ $rec['ids'] }}">
                    <div class="aside_top col-md-12">
                        <div class="col-md-4">
                            @if (file_exists(config('app.openfileimgberita') . $rec['tfile'])) 
                            <img class="img-responsive" src="{{ asset('publicimg/images/media/1/file') }}/{{ $rec['tfile'] }}" alt="Image" style="border-radius: 10px;"/>
                            @else
                            <img class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" style="border-radius: 10px;"/>
                            @endif
                        </div>
                        <div class="col-md-8" style="text-align: left; font-size: 10px; ">
                            <p class="p-aside-text blue-on-hover">{{ $rec['judul'] }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="g-text-center--xs g-margin-b-16--xs">
                <h2 class="g-font-size-20--xs g-font-size-20--md" style="text-align: left;">
                    &emsp;Paling Banyak Dilihat
                </h2>       
                @foreach($aside_top_view as $topkey => $top)
                <a class="" href="{{ url('/konten/berita/view?ids=') }}{{ $top['ids'] }}">
                    <div class="aside_top col-md-12">
                        <div class="col-md-4">
                            @if (file_exists(config('app.openfileimgberita') . $top['tfile'])) 
                            <img class="img-responsive" src="{{ asset('publicimg/images/media/1/file') }}/{{ $top['tfile'] }}" alt="Image" style="border-radius: 10px;"/>
                            @else
                            <img class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" style="border-radius: 10px;"/>
                            @endif
                        </div>
                        <div class="col-md-8" style="text-align: left; font-size: 10px; ">
                            <p class="p-aside-text blue-on-hover">{{ $top['judul'] }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Sejarah -->

<!--========== END PAGE CONTENT ==========-->

@endsection