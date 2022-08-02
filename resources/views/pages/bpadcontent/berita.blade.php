@extends('layouts.jamcportal')

@section('content')

<!--========== PROMO BLOCK ==========-->
<div class="g-bg-position--center js__parallax-window" style="background: url({{ asset('landing/assets/img/header-bg.jpg') }}) 50% 0 no-repeat fixed;">
    <div class="container g-padding-y-125--xs">
        <div class="g-padding-y-50--xs">
            <h1 class="g-color--white g-font-size-30--xs g-font-size-50--sm g-font-size-65--lg">Jakarta Asset Management Center</h1>
            <p class="g-color--white g-font-size-22--xs g-font-size-24--md g-margin-b-0--xs">Selalu Menjaga Amanah, Selalu Berikan Yang Terbaik</p>
        </div>
    </div>
</div>
<!--========== END PROMO BLOCK ==========-->

<!--========== PAGE CONTENT ==========-->
<!-- Berita -->
<div id="js__scroll-to-section" class="container g-padding-y-80--xs g-padding-y-125--sm">
    <div class="row g-text-center--xs">
        <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">HEADLINE</p>
        <h2 class="g-font-size-32--xs g-font-size-36--md"><span style="font-weight: bold;">BERITA</span> TERKINI</h2>
    </div>
    <div class="row g-padding-y-40--xs" style="padding-bottom: 30px">
        <form method="GET" action="{{ url('/konten/berita') }}">
            <div class="col-xs-6 col-sm-4">
                <input type="text" name="cari" autocomplete="off" class="form-control" <?php if ($cari != '' && !(is_null($cari))) : ?> value="{{ $cari }}" <?php endif ?> >
            </div>
            <div class="col-xs-1">
                <button class="btn btn-info">Cari</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-9">
            @foreach($beritas as $berkey => $news)
            @if(($berkey)%2 == 0)
            <div class="row">
            @endif

            <div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
                <!-- Berita -->
                <article style="padding-top: 20px;">
                    @if (file_exists(config('app.openfileimgberita') . $news['tfile'])) 
                    <img style=" border-radius: 10px 10px 0 0;" class="img-responsive" src="{{ asset('publicimg/images/media/1/file') }}/{{ $news['tfile'] }}" alt="Image" />
                    @else
                    <img style=" border-radius: 10px 10px 0 0;" class="img-responsive" src="{{ asset('publicimg/imgnotfound.jpg') }}" alt="Image" />
                    @endif
                    <div class="g-box-shadow__dark-lightest-v2 g-padding-x-40--xs g-padding-y-40--xs" style=" border-radius: 0 0 10px 10px;">
                        <!-- <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2">News</p> -->
                        <h3 class="g-font-size-22--xs g-letter-spacing--1"><a href="{{ url('/konten/berita/view?ids=') }}{{ $news['ids'] }}">{{ $news['judul'] }}</a></h3>
                        <p style="text-align:center; ">{!! html_entity_decode($news['isi1']) !!}</p>
                    </div>
                </article>
                <!-- End Berita -->
            </div>


            @if(($berkey+1)%2 == 0 || $loop->last)
            </div>
            @endif
            @endforeach
            {{-- <div class="g-text-center--xs g-margin-b-30--xs">
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
            </div> --}}
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
    {{ $beritas->links() }}
    Showing total of {{ $beritas->total() }} data
</div>
<!-- End Berita -->


<!--========== END PAGE CONTENT ==========-->

@endsection