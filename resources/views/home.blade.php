@extends('layouts.master')

@section('css')
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

    @include('layouts.komponen.full-loading')
@endsection

@section('content')
    <div class="loading">Loading&#8230;</div>

    <!-- Content Wrapper. Contains page content -->
	<input type="hidden" id="activemenus" value="{{ $activemenus }}">
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Dashboard</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Welcome, {{ Auth::user()->usname ? $_SESSION['user_jamcportal']['usname'] : $_SESSION['user_jamcportal']['nm_emp'] }}
                                </h3>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <img src="{{ asset('landing/assets/img/portfolio/1.png') }}" width="100%">
                            </div>
                            <div class="card-body text-center">
                                <h2 class="lead">Digitalisasi<br>Dokumen</h2>
                                <a target="_blank" href="https://simaster.jakarta.go.id/digidok/start">
                                    <button class="btn btn-info btn-block">MASUK</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <img src="{{ asset('landing/assets/img/portfolio/2.png') }}" width="100%">
                            </div>
                            <div class="card-body text-center">
                                <h2 class="lead">HGB<br>Diatas HPL</h2>
                                <a target="_blank" href="https://aset.jakarta.go.id/hgb/">
                                    <button class="btn btn-info btn-block">MASUK</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <img src="{{ asset('landing/assets/img/portfolio/3.png') }}" width="100%">
                            </div>
                            <div class="card-body text-center">
                                <h2 class="lead">Pelayanan<br>Pemanfaatan</h2>
                                <a target="_blank" href="https://simaster.jakarta.go.id/lpb/start?lpb_id=0">
                                    <button class="btn btn-info btn-block">MASUK</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
			<!-- /.card -->
            
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection

@section('js')
	<!-- jQuery -->
	<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
	@include('layouts.komponen.activate-menu')

    <script>
        $(".loading").hide();

        $(function () {
            $(".page-form").change(function() { 
                $(".loading").show();
            });
        });
    </script>
@endsection