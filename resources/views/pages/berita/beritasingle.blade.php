@extends('layouts.master')

@section('content')

<?php 
	$fullpath = "http://bpad.jakarta.go.id/images/cms/1.20.512/1/file/" . $berita['tfile']; 
	$originalDate = explode(" ", $berita['tanggal']);
	$newTime = explode(":", $originalDate[1]);
	$newDate = date("d F Y", strtotime($originalDate[0]));
?>

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- MAIN -->
			<main id="main" class="col-md-9">
				<!-- article -->
				<div class="article">
					<!-- article title -->
					<h2 class="article-title ">{{ $berita['judul'] }}</h2><br>
					<!-- /article title -->
					<hr>
					<!-- article meta -->
					<ul style="list-style: none; padding: 0;" class="article-meta">
						<i class="fa fa-user"></i> oleh {{ $berita['editor'] }}, {{ $newDate }}
						<span class="pull-right">
							<i class="fa fa-eye"></i> {{ $berita['thits'] }} views
						</span>
					</ul>
					<!-- /article meta -->	
					<hr>
					<!-- article img -->
					<div class="article-img">
						<img src="{{ $fullpath }}" alt="">
					</div>
					<!-- article img -->

					<!-- article content -->
					<div class="article-content">
						<div>
							{!! $berita['isi2'] !!}
						</div>
					</div>
					<br>
					<!-- /article content -->
					<a href="{{ url('/content/berita') }}"><strong><i class="fa fa-arrow-left"></i> Kembali ke halaman berita</strong></a>
				</div>					
			</main>
			<!-- /MAIN -->

			<!-- ASIDE -->
			<aside id="aside" class="col-md-3">
				<!-- recent widget -->
				<div class="widget">
					<h3 class="widget-title">Berita Terbaru</h3>

					@foreach($aside_recent as $aside)

						<?php 
							$asidePath = "http://bpad.jakarta.go.id/images/cms/1.20.512/1/file/" . $aside['tfile']; 
							$originalDate = explode(" ", $aside['tanggal']);
							$asideDate = date("d F Y", strtotime($originalDate[0]));
						?>

						<!-- single post -->
						<div class="widget-post">
							<a href="{{ url('/content/berita/' . $aside['ids']) }}">
								<div class="widget-img">
									<img src="{{ $asidePath }}" alt="">
								</div>
								<div class="widget-content">
									{{ $aside['judul'] }}
								</div>
							</a>
							<ul style="list-style: none; padding: 0;" class="article-meta">
								<li>{{ $asideDate }}</li>
								<li>{{ $aside['thits'] }} views</li>
							</ul>
						</div>
						<!-- /single post -->

					@endforeach
				
				</div>
				<!-- /recent widget -->

				<hr>

				<!-- top view widget -->
				<div class="widget">
					<h3 class="widget-title">Paling Banyak Dilihat</h3>

					@foreach($aside_top_view as $aside)

						<?php 
							$asidePath = "http://bpad.jakarta.go.id/images/cms/1.20.512/1/file/" . $aside['tfile']; 
							$originalDate = explode(" ", $aside['tanggal']);
							$asideDate = date("d F Y", strtotime($originalDate[0]));
						?>

						<!-- single post -->
						<div class="widget-post">
							<a href="{{ url('/content/berita/' . $aside['ids']) }}">
								<div class="widget-img">
									<img src="{{ $asidePath }}" alt="">
								</div>
								<div class="widget-content">
									{{ $aside['judul'] }}
								</div>
							</a>
							<ul style="list-style: none; padding: 0;" class="article-meta">
								<li>{{ $asideDate }}</li>
								<li>{{ $aside['thits'] }} views</li>
							</ul>
						</div>
						<!-- /single post -->

					@endforeach
				
				</div>
				<!-- /top view widget -->
			</aside>
			<!-- /ASIDE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection