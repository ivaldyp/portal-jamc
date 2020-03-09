@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- animation CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
	<!-- Date picker plugins css -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- page CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />


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
												echo ucwords($link[4]);
											?> </h4> </div>
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
					<ol class="breadcrumb">
						<li>{{config('app.name')}}</li>
						<?php 
							if (count($link) == 5) {
								?> 
									<li class="active"> {{ ucwords($link[4]) }} </li>
								<?php
							} elseif (count($link) > 5) {
								?> 
									<li class="active"> {{ ucwords($link[4]) }} </li>
									<li class="active"> {{ ucwords($link[5]) }} </li>
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
				<div class="col-md-12">
					<form class="form-horizontal" method="POST" action="/bpadwebs/kepegawaian/form/ubahpegawai" data-toggle="validator" enctype="multipart/form-data">
					@csrf
						<div class="panel panel-info">
							<div class="panel-heading"> Disposisi </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
									<div class="col-md-6">
										<div class="form-group">
										<label for="tgl_join" class="col-md-2 control-label"> TMT </label>
										<div class="col-md-4">
											<input type="text" name="tgl_join" class="form-control" id="datepicker-autoclose" autocomplete="off" placeholder="mm/dd/yyyy">
										</div>
									</div>

									<div class="form-group">
										<label for="nip_emp" class="col-md-2 control-label"> NIP </label>
										<div class="col-md-4">
											<input autocomplete="off" type="text" name="nip_emp" class="form-control" id="nip_emp">
										</div>
									</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<label for="tgl_join" class="col-md-2 control-label"> TMT </label>
										<div class="col-md-4">
											<input type="text" name="tgl_join" class="form-control" id="datepicker-autoclose" autocomplete="off" placeholder="mm/dd/yyyy">
										</div>
									</div>

									<div class="form-group">
										<label for="nip_emp" class="col-md-2 control-label"> NIP </label>
										<div class="col-md-4">
											<input autocomplete="off" type="text" name="nip_emp" class="form-control" id="nip_emp">
										</div>
									</div>
									</div>
									<!-- <div class="sttabs tabs-style-underline">
										<nav>
											<ul>
												<li><a href="#section-underline-1" class="sticon ti-book"><span>Identitas</span></a></li>
												<li><a href="#section-underline-2" class="sticon ti-camera"><span>Pendidikan</span></a></li>
											</ul>
										</nav>
										<div class="content-wrap">
											<section id="section-underline-1">
											</section>
											<section id="section-underline-2">
											</section>
										</div>
									</div> -->
									
								</div>
							</div>
						</div>	
						<div class="panel panel-info">
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
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
	<!--slimscroll JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/js/jquery.slimscroll.js') }}"></script>
	<!--Wave Effects -->
	<script src="{{ ('/bpadwebs/public/ample/js/waves.js') }}"></script>
	<!-- Custom Theme JavaScript -->
	<!-- Custom Theme JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/js/cbpFWTabs.js') }}"></script>
	<script type="text/javascript">
		(function () {
				[].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
				new CBPFWTabs(el);
			});
		})();
	</script>
	<script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

	<script>
		$(function () {
			jQuery('#datepicker-autoclose').datepicker({
				autoclose: true
				, todayHighlight: false
				, format: 'dd/mm/yyyy'
			});

			$('.btn-update-dik').on('click', function () {
				var $el = $(this);

				$("#modal_update_dik_ids").val($el.data('ids'));
				$("#modal_update_dik_noid").val($el.data('noid'));
				$("#modal_update_dik_iddik").val($el.data('iddik'));
				$("#modal_update_dik_prog_sek").val($el.data('prog_sek'));
				$("#modal_update_dik_no_sek").val($el.data('no_sek'));
				$("#modal_update_dik_th_sek").val($el.data('th_sek'));
				$("#modal_update_dik_nm_sek").val($el.data('nm_sek'));
				$("#modal_update_dik_gelar_blk_sek").val($el.data('gelar_blk_sek'));
				$("#modal_update_dik_gelar_dpn_sek").val($el.data('gelar_dpn_sek'));
				$("#modal_update_dik_ijz_cpns").val($el.data('ijz_cpns'));
			});

			$('.btn-delete-dik').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus <b>' + $el.data('iddik') + '</b>?');
				$("#modal_delete_dik_ids").val($el.data('ids'));
				$("#modal_delete_dik_noid").val($el.data('noid'));
				$("#modal_delete_dik_iddik").val($el.data('iddik'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});
		});
	</script>
@endsection