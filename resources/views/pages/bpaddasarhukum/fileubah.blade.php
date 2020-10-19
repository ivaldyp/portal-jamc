@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/produkhukum/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="{{ ('/produkhukum/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- animation CSS -->
	<link href="{{ ('/produkhukum/public/ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ ('/produkhukum/public/ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ ('/produkhukum/public/ample/css/colors/purple-dark.css') }}" id="theme" rel="stylesheet">
	<!-- Date picker plugins css -->
	<link href="{{ ('/produkhukum/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- page CSS -->
	<link href="{{ ('/produkhukum/public/ample/plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
@endsection

<!-- /////////////////////////////////////////////////////////////// -->

@section('content')

	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row bg-title">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h4 class="page-title"><?php 
												$link = explode("/", url()->full());    
												echo str_replace('%20', ' ', ucwords(explode("?", $link[4])[0]));
											?> </h4> </div>
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
					<ol class="breadcrumb">
						<li>{{config('app.name')}}</li>
						<?php 
							if (count($link) == 5) {
								?> 
									<li class="active"> {{ str_replace('%20', ' ', ucwords(explode("?", $link[4])[0])) }} </li>
								<?php
							} elseif (count($link) > 5) {
								?> 
									<li class="active"> {{ str_replace('%20', ' ', ucwords(explode("?", $link[4])[0])) }} </li>
									<li class="active"> {{ str_replace('%20', ' ', ucwords(explode("?", $link[5])[0])) }} </li>
								<?php
							} 
						?>
					</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-sm-12">
					@if(Session::has('message'))
						<div class="alert <?php if(Session::get('msg_num') == 1) { ?>alert-success<?php } else { ?>alert-danger<?php } ?> alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: white;">&times;</button>{{ Session::get('message') }}</div>
					@endif
				</div>
			</div>
			<div class="row ">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form class="form-horizontal" method="POST" action="/produkhukum/setup/form/ubahfile" data-toggle="validator" enctype="multipart/form-data">
					@csrf
						<div class="panel panel-info">
							<div class="panel-heading"> Ubah Produk Hukum </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">

									<input type="hidden" name="ids" value="{{ $file['ids'] }}">

									<div class="form-group">
										<label for="created_at" class="col-md-2 control-label"> Tanggal Dibuat </label>
										<div class="col-md-8">
											<input type="text" name="created_at" class="form-control" id="datepicker-autoclose" autocomplete="off" placeholder="dd/mm/yyyy" value="{{ date('d/m/Y', strtotime(str_replace('/', '-', $file['created_at'] ))) }}" required="">
										</div>
									</div>

									<div class="form-group">
										<label for="hukum" class="col-md-2 control-label"> Produk Hukum? </label>
										<div class="col-md-4">
											<select class="form-control select2" name="hukum" id="hukum">
												<option value="1" <?php if($file['hukum'] == 1): ?> selected <?php endif ?> > Ya </option>
												<option value="0" <?php if($file['hukum'] == 0): ?> selected <?php endif ?> > Bukan </option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="id_kat" class="col-md-2 control-label"> Kategori </label>
										<div class="col-md-8">
											<select class="form-control select2" name="id_kat" id="id_kat">
												@foreach($kategoris as $kat)
													<option  <?php if($kat['ids'] == $file['id_kat']): ?> selected <?php endif ?> value="{{ $kat['ids'] }}" > {{ $kat['singkatan'] ? '['. strtoupper($kat['singkatan'])  .'] - ' : '' }} {{ ucwords(strtolower($kat['nm_kat'])) }} </option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="tgl_masuk" class="col-md-2 control-label"> Nomor & Tahun </label>
										<div class="col-md-4">
											<input type="text" name="nomor" class="form-control" autocomplete="off" placeholder="Nomor" value="{{ $file['nomor'] }}">
										</div>
										<div class="col-md-4">
											<input type="text" name="tahun" class="form-control" autocomplete="off" placeholder="Tahun" value="{{ $file['tahun'] }}">
										</div>
									</div>

									<div class="form-group">
										<label for="tentang" class="col-md-2 control-label"> Tentang </label>
										<div class="col-md-8">
											<input autocomplete="off" type="text" name="tentang" class="form-control" id="tentang" required="" value="{{ $file['tentang'] }}">
										</div>
									</div>

									<div class="form-group">
										<label for="url" class="col-lg-2 control-label"> URL <br> </label>
										<div class="col-lg-8">
											<input type="text" class="form-control" id="url" name="url" required="" value="{{ $file['url'] }}">
										</div>
									</div>

									<div class="form-group">
										<label for="status" class="col-md-2 control-label"> Issued By </label>
										<div class="col-md-8">
											<select class="form-control select2" name="status" id="status">
												<option <?php if($file['status'] == "BPAD"): ?> selected <?php endif ?> value="BPAD"> BPAD </option>
												<option <?php if($file['status'] == "NON-BPAD"): ?> selected <?php endif ?> value="NON-BPAD"> NON-BPAD </option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="jenis" class="col-md-2 control-label"> Jenis </label>
										<div class="col-md-8">
											<select class="form-control select2" name="jenis" id="jenis">
												@foreach($jenises as $jns)
													<option  <?php if($jns['ids'] == $file['id_jns']): ?> selected <?php endif ?> value="{{ $jns['ids'] }}"> {{ $jns['nm_jenis'] }} </option>
												@endforeach
											</select>
										</div>
									</div>

									<?php 
										if ($file['img_file']) {

											$fullpath = config('app.openfilehukum') . date('Y', strtotime( $file['tgl'] ));
											$fullpath .= "/da" . date('YmdHis', strtotime( $file['tgl'] ));
											$fullpath .= "/" . $file['img_file'];
										} else {
											$fullpath = "";
										}
									?>

									<div class="form-group">
										<label for="filefoto" class="col-lg-2 control-label"> Upload Foto <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
										<div class="col-lg-8">
											<input type="file" class="form-control" id="filefoto" name="filefoto">
											<br>
											<p><a href="{{ $fullpath }}" target="_blank">{{$file['img_file']}}</a></p>
										</div>
									</div>

									<div class="form-group">
										<label for="suspend" class="col-md-2 control-label"> Suspend? </label>
										<div class="col-md-4">
											<select class="form-control select2" name="suspend" id="suspend">
												<option value="0" <?php if($file['suspend'] == 0): ?> selected <?php endif ?> > Tidak </option>
												<option value="1" <?php if($file['suspend'] == 1): ?> selected <?php endif ?> > Ya </option>
											</select>
										</div>
									</div>

								</div>
							</div>
							<div class="panel-footer">
								<button type="submit" class="btn btn-success pull-right">Simpan</button>
								<!-- <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Kembali</button> -->
								<a href="{{ url('setup/file') }}"><button type="button" class="btn btn-default pull-right m-r-10">Kembali</button></a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-heading">  
								
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection

<!-- /////////////////////////////////////////////////////////////// -->

@section('js')
	<script src="{{ ('/produkhukum/public/ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ ('/produkhukum/public/ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="{{ ('/produkhukum/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
	<!--slimscroll JavaScript -->
	<script src="{{ ('/produkhukum/public/ample/js/jquery.slimscroll.js') }}"></script>
	<!--Wave Effects -->
	<script src="{{ ('/produkhukum/public/ample/js/waves.js') }}"></script>
	<!-- Custom Theme JavaScript -->
	<script src="{{ ('/produkhukum/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/produkhukum/public/ample/js/validator.js') }}"></script>
	<script src="{{ ('/produkhukum/public/ample/plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="{{ ('/produkhukum/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

	<script>
		function goBack() {
		  window.history.back();
		}
		
		$(function () {
			$(".select2").select2();

			jQuery('#datepicker-autoclose').datepicker({
				autoclose: true
				, todayHighlight: true
				, format: 'dd/mm/yyyy'
			});
		});
	</script>
@endsection