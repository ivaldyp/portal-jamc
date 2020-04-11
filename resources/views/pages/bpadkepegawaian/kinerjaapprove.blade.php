@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- Menu CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- animation CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/colors/purple-dark.css') }}" id="theme" rel="stylesheet">

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
				<div class="col-md-12">
					<!-- <div class="white-box"> -->
					<div class="panel panel-default">
						<div class="panel-heading"> Approve Kinerja </div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="row" style="margin-bottom: 10px">
									<form method="GET" action="/bpadwebs/kepegawaian/laporan kinerja">
										<div class="col-md-3">
											<select class="form-control select2" name="now_id_emp" id="now_id_emp" onchange="this.form.submit()">
												@forelse($pegawais as $pegawai)
												<option <?php if ($now_id_emp == $pegawai['id_emp']): ?> selected <?php endif ?> value="{{ $pegawai['id_emp'] }}">{{ ucwords(strtolower($pegawai['nm_emp'])) }}-{{ $pegawai['nrk_emp'] }}</option>
												@empty
												<option value="{{ $_SESSION['user_data']['id_emp'] }}">{{ ucwords(strtolower($_SESSION['user_data']['nm_emp'])) }}-{{ $_SESSION['user_data']['nrk_emp'] }}</option>
												@endforelse
											</select>
										</div>
									</form>
								</div>
								<div class="row ">
									<h3 class="text-center">tabel kinerja belum tervalidasi</h3>
									<div class="table-responsive">
										<table class=" table table-hover color-table primary-table" >
											<thead>
												<tr>
													<th></th>
													<th></th>
													<th class="col-md-2">Nama</th>
													<th>Tanggal</th>
													<th class="col-md-6">Kehadiran</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<form method="POST" action="/bpadwebs/kepegawaian/form/approvekinerja">
												@foreach($laporans as $key => $laporan)
												
													<?php 
														if ($laporan['tipe_hadir'] == 1) {
															$tipe_hadir = 'Hadir';
														} elseif ($laporan['tipe_hadir'] == 2) {
															$tipe_hadir = 'Tidak Hadir';
														} elseif ($laporan['tipe_hadir'] == 3) {
															$tipe_hadir = 'DL Full';
														}

														if ($laporan['tipe_hadir_app']) {
															if ($laporan['tipe_hadir_app'] == 1) {
																$tipe_hadir_app = 'Hadir';
															} elseif ($laporan['tipe_hadir_app'] == 2) {
																$tipe_hadir_app = 'Tidak Hadir';
															} elseif ($laporan['tipe_hadir_app'] == 3) {
																$tipe_hadir_app = 'DL Full';
															}
														}
													?>

													<tr>
														<td>
															<button type="submit" class="btn btn-info btn-outline btn-circle m-r-5 btn_update_kinerja"><i class='fa fa-edit'></i></button>
														</td>
														<td style="vertical-align: middle;">
															<input type="checkbox" name="laporan[]" id="checkbox-{{$key}}" value="{{ $laporan['idemp'] }}||{{ $laporan['tgl_trans'] }}">
														</td>
														<td>
															{{ ucwords(strtolower($laporan['nm_emp'])) }}
															<br>
															<span class="text-muted">{{ $laporan['idemp'] }}</span>
														</td>
														<td>{{ date('d-m-Y', strtotime( $laporan['tgl_trans'])) }}</td>
														<td>
															{{ $tipe_hadir }}
															@if($laporan['tipe_hadir_app'])
															-> {{ $tipe_hadir_app }}
															@endif
															<br>
															<span class="text-muted">
																{{ $laporan['jns_hadir'] }}
																@if($laporan['jns_hadir_app'])
																-> {{ $laporan['jns_hadir_app'] }}
																@endif
															</span>
														</td>
														<td>
															@if($laporan['stat'] == 'Y')
															Approved
															@else
															Not Approved
															@endif
														</td>
													</tr>
												
												@endforeach
												</form>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
					</div>
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
	<script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>

	<script>
		$(function () {
			$('.myTable').DataTable({
				"paging":   false,
				"ordering": false,
				"info":     false,
			});
		});
	</script>
@endsection