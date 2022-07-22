@extends('layouts.master')

@section('css')
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminLTE 3 | General Form Elements</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
@endsection
@section('content')
	<input type="hidden" id="activemenus" value="{{ $activemenus }}">
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Form Ubah User</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Security</a></li>
							<li class="breadcrumb-item active">Ubah User</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-md-8 offset-md-2" >
						<!-- general form elements -->
					
						<!-- Horizontal Form -->
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Ubah User</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form class="form-horizontal" method="POST" action="/{{ config('app.name') }}/security/form/ubahuser" data-toggle="validator">
								@csrf
                                <input type="hidden" name="ids" value="{{ $nowlogins['ids'] }}">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label"><span style="color: red">*</span> Nama </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="name" name="nama_user" autocomplete="off" required value="{{ $nowlogins['nama_user'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deskripsi_user" class="col-md-2 col-form-label"> Deskripsi </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="deskripsi_user" name="deskripsi_user" autocomplete="off" value="{{ $nowlogins['deskripsi_user'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email_user" class="col-md-2 col-form-label"> Email </label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" id="email_user" name="email_user" autocomplete="off" value="{{ $nowlogins['email_user'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="idgroup" class="col-md-2 col-form-label"><span style="color: red">*</span> Grup User </label>
                                        <div class="col-md-10">
                                            <select class="form-control select2" name="idgroup" id="idgroup" required>
                                                @foreach($idgroup as $group)
                                                    <option <?php if($group['idgroup'] == $nowlogins['idgroup']): ?> selected <?php endif ?> value="{{ $group['idgroup'] }}"> {{ $group['idgroup'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-md-2 col-form-label"><span style="color: red">*</span> Username </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="username" name="usname" autocomplete="off" data-error="Masukkan username" required value="{{ $nowlogins['usname'] }}">
                                        </div>
                                    </div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
                                    <a href="{{ url()->previous() }}">
									    <button type="button" class="btn btn-default float-right">Cancel</button>
                                    </a>
									<button type="submit" class="btn btn-primary float-right" style="margin-right: 10px;">Simpan</button>
								</div>
								<!-- /.card-footer -->
							</form>
						</div>
						<!-- /.card -->

					</div>
					
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
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
    <!-- Select2 -->
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
	<!-- bs-custom-file-input -->
	<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
	<!-- Page specific script -->
	@include('layouts.komponen.activate-menu')
	<script>
	$(function () {
        $('.select2').select2()
        
		bsCustomFileInput.init();
	});
	</script>
	@endsection
