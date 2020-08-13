@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/dasarhukum/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="{{ ('/dasarhukum/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- animation CSS -->
	<link href="{{ ('/dasarhukum/public/ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ ('/dasarhukum/public/ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ ('/dasarhukum/public/ample/css/colors/purple-dark.css') }}" id="theme" rel="stylesheet">
	<!-- Date picker plugins css -->
	<link href="{{ ('/dasarhukum/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- page CSS -->
	<link href="{{ ('/dasarhukum/public/ample/plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />


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
					<form class="form-horizontal" method="POST" action="/dasarhukum/setup/form/ubahfile" data-toggle="validator" enctype="multipart/form-data">
					@csrf
						<div class="panel panel-info">
							<div class="panel-heading"> Dasar Hukum Baru </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">

									<input type="hidden" name="ids" value="{{ $file['ids'] }}">

									<div class="form-group">
										<label for="updated_at" class="col-md-2 control-label"> Tanggal Dibuat </label>
										<div class="col-md-8">
											<input type="text" name="updated_at" class="form-control" id="datepicker-autoclose" autocomplete="off" placeholder="dd/mm/yyyy" value="{{ date(' d/m/Y',strtotime($file['created_at'])) }}">
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
											<input type="text" name="nomor" class="form-control" autocomplete="off" required="" placeholder="Nomor" value="{{ $file['nomor'] }}">
										</div>
										<div class="col-md-4">
											<input type="text" name="tahun" class="form-control" autocomplete="off" required="" placeholder="Tahun" value="{{ $file['tahun'] }}">
										</div>
									</div>

									<div class="form-group">
										<label for="tentang" class="col-md-2 control-label"> Tentang </label>
										<div class="col-md-8">
											<input autocomplete="off" type="text" name="tentang" class="form-control" id="tentang" required="">
										</div>
									</div>

									<div class="form-group">
                                        <label for="url" class="col-lg-2 control-label"> URL <br> </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="url" name="url" required="">
                                        </div>
                                    </div>
								</div>
							</div>
							<div class="panel-footer">
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                <!-- <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Kembali</button> -->
                                <button type="button" class="btn btn-default pull-right m-r-10" onclick="goBack()">Kembali</button>
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
	<script src="{{ ('/dasarhukum/public/ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ ('/dasarhukum/public/ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="{{ ('/dasarhukum/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
	<!--slimscroll JavaScript -->
	<script src="{{ ('/dasarhukum/public/ample/js/jquery.slimscroll.js') }}"></script>
	<!--Wave Effects -->
	<script src="{{ ('/dasarhukum/public/ample/js/waves.js') }}"></script>
	<!-- Custom Theme JavaScript -->
	<script src="{{ ('/dasarhukum/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/dasarhukum/public/ample/js/validator.js') }}"></script>
	<script src="{{ ('/dasarhukum/public/ample/plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="{{ ('/dasarhukum/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

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