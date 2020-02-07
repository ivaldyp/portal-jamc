@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<!-- <h1 class="title"><span style="background: linear-gradient(to right, #8C0606 0%, #FF0000 50%, #8C0606 100%); -webkit-background-clip: text;-webkit-text-fill-color: transparent; font-size: 64px">VIDEO BPAD</span></h1> -->
			<h1 class="title" style="font-family: 'Century Gothic'; font-size: 64px"><span style="color: #006cb8; font-weight: bold">VIDEO</span> BPAD</h1>
		</div>
	</div>
</div>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- MAIN -->
			<main id="main" class="col-md-9">
				<div class="row">
					<!-- article -->

					@foreach($video_list as $video)

						<?php 
							$fullpath = "http://bpad.jakarta.go.id/images/cms/1.20.512/1/file/" . $video['tfile']; 
							$originalDate = explode(" ", $video['tanggal']);
							$newTime = explode(":", $originalDate[1]);
							$newDate = date("d F Y", strtotime($originalDate[0]));
						?>

						<div class="col-md-12" >
							<div class="article">
								<div class="article-content">
									<h3 class="article-title"><a href="{{ url('/content/video/' . $video['ids']) }}"><i class="fa fa-caret-right"></i> {{ $video['judul'] }}</a></h3>
									<ul class="article-meta" style="list-style: none; padding: 0;">
										<i class="fa fa-user"></i> oleh {{ $video['editor'] }}
										<i class="fa fa-calendar"></i> {{ $newDate }} <br>
									</ul>
								</div>
							</div>
						</div>

					@endforeach

					<!-- /article -->

				</div>
			</main>
			<!-- /MAIN -->

			<!-- ASIDE -->
			<aside id="aside" class="col-md-3">

				<!-- top view widget -->
				<div class="widget">
					<h3 class="widget-title">Paling Banyak Dilihat</h3><hr>

					@foreach($aside_top_view as $aside)

						<?php 
							$originalDate = explode(" ", $aside['tanggal']);
							$asideDate = date("d F Y", strtotime($originalDate[0]));
						?>

						<!-- single post -->
						<div class="widget-post">
							<a href="{{ url('/content/video/' . $aside['ids']) }}">
								<i class="fa fa-caret-right"></i> {{ $aside['judul'] }}
							</a>
							<ul class="article-meta" style="list-style: none; padding: 0;">
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
		{{ $video_list->links() }}
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection