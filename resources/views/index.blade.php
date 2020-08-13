@extends('layouts.master')

@section('content')

@php
	$webname = config('app.webname');
@endphp

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<!-- <h1 class="title"><span style="background: linear-gradient(to right, #8C0606 0%, #FF0000 50%, #8C0606 100%); -webkit-background-clip: text;-webkit-text-fill-color: transparent; font-size: 64px">BERITA BPAD</span></h1> -->
			<h1 class="title" style="font-family: 'Century Gothic'; font-size: 64px"><span style="color: #006cb8; font-weight: bold">DASAR</span> HUKUM</h1>
		</div>
	</div>
</div>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<!-- <div class="row">
			<div class="col-md-12" style="padding: 20px">
				<form class="form-horizontal" action="" method="get">
					<div class="form-group">
						<label class="control-label col-md-2" style="text-align: left;">Cari Berita</label>
						<div class="col-md-6">
							<i class="fa fa-search"></i><input type="text" class="input" name="" placeholder="cari">
						</div>
					</div>
				</form>
			</div>
		</div> -->
		<div class="row" style="padding-bottom: 30px">
			<form method="GET" action="/dasarhukum">
				<div class="col-xs-6 col-sm-4">
					<input type="text" name="cari" autocomplete="off" class="form-control" >
				</div>
				<div class="col-xs-1">
					<button class="btn btn-info">Cari</button>
				</div>
			</form>
		</div>
		<!-- <hr> -->
		<div class="row ">
			<!-- MAIN -->
			<main id="main" class="col-md-9" style="border-right: 2px solid #eee;">
				<div class="row">
					<!-- article -->

					

					<!-- /article -->

				</div>
			</main>
			<!-- /MAIN -->

			
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection