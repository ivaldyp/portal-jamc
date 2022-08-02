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
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Form Tambah {{ $kat['nmkat'] }} Baru</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">Media</li>
							<li class="breadcrumb-item">Content</li>
                            <li class="breadcrumb-item active">New</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
                @include('layouts.komponen.flash-message')
				<div class="row">
					<!-- left column -->
					<div class="col-md-8 offset-md-2" >
						<!-- general form elements -->
					
						<!-- Horizontal Form -->
						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title">Tambah User</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form class="form-horizontal" method="POST" action="{{ url('/media/form/tambahcontent') }}" data-toggle="validator" enctype="multipart/form-data">
								@csrf
                                <div class="card-body">
                                    <input type="hidden" name="idkat" value="{{ $idkat }}">
									<input type="hidden" name="contentnew" value="1">
									<input type="hidden" name="appr" value="N">
									<input type="hidden" name="usrinput" value="{{ isset(Auth::user()->id_emp) ? Auth::user()->id_emp : Auth::user()->usname }}">
									<input type="hidden" name="kode_kat" value="{{ $kat['kode_kat'] }}">

                                    @if($kat['kode_kat'] == 'INF')

										<?php 

										date_default_timezone_set('Asia/Jakarta');
										$datetanggal = date('d-m-Y H:i:s');
										?>

										<div class="form-group">
											<label for="tanggal" class="control-label"> Waktu </label>
											<div class="">
												<input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off" data-error="Masukkan tanggal" value="{{ $datetanggal }}">
											</div>
										</div>

										<div class="form-group">
											<label for="judul" class="control-label"><span style="color: red">*</span> Judul </label>
											<div class="">
												<input type="text" class="form-control" id="judul" name="judul" autocomplete="off" data-error="Masukkan judul" required>
												<div class="help-block with-errors"></div>
											</div>
										</div>

										<div class="form-group">
											<label for="url" class="control-label"> URL </label>
											<div class="">
												<input type="text" class="form-control" id="url" name="url" autocomplete="off">
												<div class="help-block with-errors"></div>
											</div>
										</div>

										<div class="form-group">
                                            <label for="exampleInputFile"> Upload Foto <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="tfile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                              </div>
                                            </div>
                                          </div>

									@elseif($kat['kode_kat'] == 'VID')

										<div class="form-group">
											<label for="subkat" class="control-label"><span style="color: red">*</span> Subkategori </label>
											<div class="">
												<select class="form-control" name="subkat" id="subkat">
													@foreach($subkats as $subkat)
														<option value="{{ $subkat['subkat'] }}"> {{ $subkat['subkat'] }} </option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="tanggal" class="control-label"> Waktu </label>
											<div class="">
												<input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off" data-error="Masukkan tanggal" value="{{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', now('Asia/Jakarta')))) }}">
											</div>
										</div>

										<div class="form-group">
											<label for="judul" class="control-label"><span style="color: red">*</span> Judul </label>
											<div class="">
												<input type="text" class="form-control" id="judul" name="judul" autocomplete="off" data-error="Masukkan judul" required>
												<div class="help-block with-errors"></div>
											</div>
										</div>

										<div class="form-group">
											<label for="url" class="control-label"> URL<br><span style="color: red; font-size: 14px">Masukkan kode youtube video ID</span> </label>
											<div class=" input-group">
												<span class="input-group-addon" id="basic-addon3">youtube.com/watch?v=</span>
												<input type="text" class="form-control" id="url" name="url" autocomplete="off">
												<div class="help-block with-errors"></div>
											</div>
										</div>

										<div class="form-group">
											<label for="isi2" class="control-label"> Embed </label>
											<div class="">
												<textarea class="form-control" id="isi2" name="isi2" autocomplete="off"></textarea>
												<div class="help-block with-errors"></div>
											</div>
										</div>

									@else

										@if($idkat != 14 && $idkat != 6 && $idkat != 19 && $idkat != 4 && $idkat != 11)
										<div class="form-group">
											<label for="subkat" class="control-label"><span style="color: red">*</span> Subkategori </label>
											<div class="">
												<select class="form-control" name="subkat" id="subkat">
													@foreach($subkats as $subkat)
														<option value="{{ $subkat['subkat'] }}"> {{ $subkat['subkat'] }} </option>
													@endforeach
												</select>
											</div>
										</div>
										@endif

										<div class="form-group">
											<label for="tanggal" class="control-label"> Waktu </label>
											<div class="">
												<input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off" data-error="Masukkan tanggal" value="{{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', now('Asia/Jakarta')))) }}">
											</div>
										</div>

										<div class="form-group">
											<label for="judul" class="control-label"><span style="color: red">*</span> Judul </label>
											<div class="">
												<input type="text" class="form-control" id="judul" name="judul" autocomplete="off" data-error="Masukkan judul" required>
												<div class="help-block with-errors"></div>
											</div>
										</div>

										{{-- <div class="form-group">
											<label class="control-label"> Jadikan headline? </label>
                                            <div class="form-check">
                                                <input name="headline" id="headline1" value="H," data-error="Pilih salah satu" class="form-check-input" type="radio">
                                                <label class="form-check-label" for="headline1">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="headline" id="headline2" value="" class="form-check-input" type="radio">
                                                <label class="form-check-label" for="headline2">Tidak</label>
                                            </div>
										</div> --}}

										@if($idkat != 14 && $idkat != 6 && $idkat != 19 && $idkat != 4 && $idkat != 11)
										<div class="form-group">
                                            <label for="exampleInputFile"> Upload Foto <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="tfile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                              </div>
                                            </div>
                                          </div>
										@endif

										@if($idkat == 6)
										<div class="form-group">
                                            <label for="exampleInputFile">Upload File <br> <span style="font-size: 10px">Berupa .pdf, .xls, .doc, .xlxs, .docx, .zip, .rar, .txt, .csv</span> </label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="tfiledownload">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                              </div>
                                            </div>
                                          </div>
										@endif

										@if($idkat == 4)
										<div class="form-group">
											<label for="url" class="control-label"> URL </label>
											<div class="">
												<input type="text" class="form-control" id="url" name="url" autocomplete="off">
												<div class="help-block with-errors"></div>
											</div>
										</div>
										@endif

										@if($idkat != 6 && $idkat != 4)
										<div class="form-group">
											<label for="isi1" class="control-label"> Ringkasan </label>
											<div class="">
												<div class="alert alert-warning">
													Ringkasan hanya berisi teks 1 paragraf, tidak dapat diisi gambar.
												</div>
												<textarea id="summernote-ringkasan" placeholder="Enter text ..." name="isi1"></textarea>
											</div>
										</div>
										@endif

										@if($idkat != 6 && $idkat != 5 && $idkat != 19 && $idkat != 4 && $idkat != 11)
										<div class="form-group">
											<label for="isi2" class="control-label"> Isi </label>
											<div class="">
												<textarea id="summernote-isi" placeholder="Enter text ..." name="isi2"></textarea>
											</div>
										</div>
										@endif

									@endif

									<div class="form-group">
										<label for="editor" class="control-label"> Editor </label>
										<div class="">
											<input disabled type="text" class="form-control" id="editor" name="editor" autocomplete="off" value="{{ isset($_SESSION['user_jamcportal']['nm_emp']) ? $_SESSION['user_jamcportal']['nm_emp'] : (isset($_SESSION['user_jamcportal']['nama_user']) ? $_SESSION['user_jamcportal']['nama_user'] : $_SESSION['user_jamcportal']['usname']) }}">
											<input type="hidden" class="form-control" id="editor" name="editor" autocomplete="off" value="{{ isset($_SESSION['user_jamcportal']['nm_emp']) ? $_SESSION['user_jamcportal']['nm_emp'] : (isset($_SESSION['user_jamcportal']['nama_user']) ? $_SESSION['user_jamcportal']['nama_user'] : $_SESSION['user_jamcportal']['usname']) }}">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label"> Suspend? </label>
										<div class="form-check">
                                            <input name="suspend" id="suspend1" value="Y" data-error="Pilih salah satu" class="form-check-input" type="radio">
                                            <label class="form-check-label" for="suspend1">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input name="suspend" id="suspend2" value="" class="form-check-input" type="radio" checked>
                                            <label class="form-check-label" for="suspend2">Tidak</label>
                                        </div>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<a href="{{ url('/security/manage user') }}"><button type="button" class="btn btn-default float-right">Cancel</button></a>
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
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
	<!-- Page specific script -->
	<script>
	$(function () {
        $('.select2').select2()

        $('#summernote-ringkasan').summernote()
        $('#summernote-isi').summernote()
        
		bsCustomFileInput.init();
	});
	</script>
	@endsection
