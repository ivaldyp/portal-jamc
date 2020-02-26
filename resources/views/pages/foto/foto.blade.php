@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<!-- <h1 class="title"><span style="background: linear-gradient(to right, #8C0606 0%, #FF0000 50%, #8C0606 100%); -webkit-background-clip: text;-webkit-text-fill-color: transparent; font-size: 64px">FOTO BPAD</span></h1> -->
			<h1 class="title" style="font-family: 'Century Gothic'; font-size: 64px"><span style="color: #006cb8; font-weight: bold">GALERI</span> FOTO</h1>
		</div>
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
				@if(!(empty($subkat)))
					<strong>Filtered By Kategori {{ $subkat }}</strong>
					<hr>
				@endif
				<div class="row">
					<!-- article -->

					<?php $count = 1 ?>
					@foreach($foto_list as $foto)

						<?php 
							if ($foto['contentnew'] == 1) {
								$fullpath = '/bpadwebs/public/imgpublic/' . $foto['tfile']; 
							} else {
								$fullpath = "http://bpad.jakarta.go.id/images/cms/1.20.512/5/file/" . $foto['tfile']; 
							}
							$originalDate = explode(" ", $foto['tanggal']);
							$newTime = explode(":", $originalDate[1]);
							$newDate = date("d F Y", strtotime($originalDate[0]));
						?>

						<div class="col-md-6">
							<div class="article">
								<div class="article-img">
									<img src="{{ $fullpath }}" alt="">
								</div>
								<div class="article-content">
									<h3 class="article-title">{{ $foto['judul'] }}</h3>
									<ul class="article-meta" style="list-style: none; padding: 0;">
										<i class="fa fa-user"></i> oleh {{ $foto['editor'] }}
										<span class="pull-right"><i class="fa fa-calendar"></i> {{ $newDate }} <br></span><br>
										{{ $foto['subkat'] }}
										<!-- <i class="fa fa-eye"></i> {{ $foto['thits'] }} views  -->
									</ul>
									<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
								</div>
							</div>
						</div>

						@if ($count%2 == 0)

							<div class="clearfix visible-md visible-lg"></div>

						@endif
						
						<?php $count++; ?>

					@endforeach

					<!-- /article -->

				</div>
			</main>
			<!-- /MAIN -->

			<!-- ASIDE -->
			<aside id="aside" class="col-md-3">
				<!-- category widget -->
				<div class="widget">
					<h3 class="widget-title">Kategori</h3>
					<div class="widget-category">
						<ul style="list-style: none; padding: 0;">
							<li><a href="{{ url('content/foto') }}"><i class="fa fa-caret-right"></i> TAMPILKAN SEMUA FOTO</a></li><hr>
							@foreach($foto_kategori as $kategori)
								
								<li><a href="{{ url('content/foto?subkategori='.$kategori['subkat']) }}"><i class="fa fa-caret-right"></i> {{ $kategori['subkat'] }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<!-- /category widget -->
				<hr>
				<!-- recent widget -->
				<div class="widget">
					<h3 class="widget-title">Foto Terbaru</h3>

					@foreach($aside_recent as $aside)

						<?php 
							if ($aside['contentnew'] == 1) {
								$asidePath = '/bpadwebs/public/imgpublic/' . $aside['tfile']; 
							} else {
								$asidePath = "http://bpad.jakarta.go.id/images/cms/1.20.512/5/file/" . $aside['tfile']; 
							}
							$originalDate = explode(" ", $aside['tanggal']);
							$asideDate = date("d F Y", strtotime($originalDate[0]));
						?>

						<!-- single post -->
						<div class="widget-post">
							<a href="JavaScript:void(0);" style="cursor: default;">
								<div class="foto-aside-img">
									<img src="{{ $asidePath }}" alt="">
								</div>
								<div class="widget-content">
									{{ $aside['judul'] }}
								</div>
							</a>
							<ul class="article-meta" style="list-style: none; padding: 0;">
								<li>{{ $aside['editor'] }}, </li>
								<li>{{ $asideDate }}</li>
								<!-- <li>{{ $aside['thits'] }} views</li> -->
							</ul>
						</div>
						<!-- /single post -->

					@endforeach
				
				</div>
				<!-- /recent widget -->

			</aside>
			<!-- /ASIDE -->
		</div>
		<!-- /row -->
		{{ $foto_list->links() }}
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection