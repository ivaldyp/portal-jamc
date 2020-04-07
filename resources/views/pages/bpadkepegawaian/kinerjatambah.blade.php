@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- Menu CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- Page plugins css -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
	<!-- Date picker plugins css -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
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
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form class="form-horizontal" method="POST" action="/bpadwebs/internal/form/tambahagenda" data-toggle="validator" enctype="multipart/form-data">
					@csrf
						<div class="panel panel-info">
							<div class="panel-heading"> Input Kinerja </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
									<input type="hidden" name="idemp" value="{{ Auth::user()->id_emp }}" id="idemp">

									<div class="form-group">
										<label for="tgl_masuk" class="col-md-2 control-label"> Tanggal </label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="datepicker-autoclose" name="tgl_trans" autocomplete="off" value="{{ date('d/m/Y', strtotime(str_replace('/', '-', now('Asia/Jakarta')))) }}">
										</div>
									</div>

									<div class="form-group">
										<label for="tipe" class="col-md-2 control-label"> Kehadiran </label>
										<div class="col-md-4">
											<select class="form-control" name="tipe_hadir" id="tipe_hadir" onchange="getval(this);">
												<option value="1"> Hadir </option>
												<option value="2"> Tidak Hadir </option>
												<option value="3"> DL Full </option>
											</select>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="jns_hadir" id="jns_hadir">
												<option class="select_jns_hadir tipe-1" id="1-first" value="Tepat Waktu (8,5 jam/hari)"> Tepat Waktu (8,5 jam/hari) </option>
												<option class="select_jns_hadir tipe-1" value="Dinas Luar Awal"> Dinas Luar Awal </option>
												<option class="select_jns_hadir tipe-1" value="Dinas Luar Akhir"> Dinas Luar Akhir </option>
												<option class="select_jns_hadir tipe-1" value="Terlambat"> Terlambat </option>
												<option class="select_jns_hadir tipe-1" value="Pulang Cepat"> Pulang Cepat </option>
												<option class="select_jns_hadir tipe-2" id="2-first" value="Sakit"> Sakit </option>
												<option class="select_jns_hadir tipe-2" value="Izin"> Izin </option>
												<option class="select_jns_hadir tipe-2" value="Cuti"> Cuti </option>
												<option class="select_jns_hadir tipe-2" value="Alpa"> Alpa </option>
												<option class="select_jns_hadir tipe-2 lainnya" value="Lainnya (sebutkan)"> Lainnya (sebutkan) </option>
												<option class="select_jns_hadir tipe-3" id="3-first" value="Rapat"> Rapat </option>
												<option class="select_jns_hadir tipe-3" value="Peninjauan Lapangan"> Peninjauan Lapangan </option>
												<option class="select_jns_hadir tipe-3 lainnya" value="Lainnya (sebutkan)"> Lainnya (sebutkan) </option>
											</select>
										</div>
									</div>

									<div class="form-group" id="input_lainnya">
										<label for="lainnya" class="col-md-2 control-label"> Lainnya </label>
										<div class="col-md-8">
											<textarea class="form-control" name="lainnya" id="lainnya"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="tgl_masuk" class="col-md-2 control-label"> Awal </label>
										<div class="col-md-2">
											<div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
												<input type="text" class="form-control" value="" name="time1"> <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
											</div>
										</div>
										<label for="tgl_masuk" class="col-md-2 control-label"> Akhir </label>
										<div class="col-md-2">
											<div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
												<input type="text" class="form-control" value="" name="time2"> <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
											</div>
										</div>
									</div>

									<div class="form-group" id="input_lainnya">
										<label for="uraian" class="col-md-2 control-label"> Uraian </label>
										<div class="col-md-8">
											<textarea class="form-control" name="uraian" id="uraian"></textarea>
										</div>
									</div>

									<div class="form-group" id="input_lainnya">
										<label for="kegiatan" class="col-md-2 control-label"> Kegiatan </label>
										<div class="col-md-8">
											<textarea class="form-control" name="kegiatan" id="kegiatan"></textarea>
										</div>
									</div>

								</div>
								<hr>
								<button type="button" class="btn btn-info m-b-20 m-l-20 btn-delete" data-toggle="modal" data-target="#modal-delete">Tambah Kegiatan</button>
								<div class="table-responsive" style="padding: 10px">
									<table class="color-table primary-table table table-hover table-striped">
										<thead>
											<tr>
												<th>Awal</th>
												<th>Akhir</th>
												<th>Uraian</th>
												<th>Keterangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody id="body_tabel">
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="panel-footer">
								<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-tambah">Simpan</button>
								<div class="clearfix"></div>
							</div>
						</div>	
						<!-- <div class="panel panel-info">
							<div class="panel-heading">  
								
							</div>
						</div> -->
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
	<script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>
	<!-- Clock Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

	<script>
		// alert($("#jns_hadir option").hasClass("lainnya"));

		$('.select_jns_hadir').hide();
		$('.tipe-1').show();
		$('#input_lainnya').hide();

		$('#tipe_hadir').on('change', function() {
			var value = this.value;
			$('.select_jns_hadir').hide();
			$('.tipe-'+value).show();
			$("#jns_hadir > #"+value+"-first").attr("selected", true);
		});

		$('#jns_hadir').on('change', function() {
			if($('select[id="jns_hadir"] :selected').hasClass('lainnya')){
				$('#input_lainnya').show();
			} else {
				$('#lainnya').val("");
				$('#input_lainnya').hide();
			}
		});

		$('.clockpicker').clockpicker({
			donetext: 'Done'
			, }).find('input').change(function () {
			console.log(this.value);
		});


		$(function () {
			jQuery('#datepicker-autoclose').datepicker({
				autoclose: true
				, todayHighlight: true
				, format: 'dd/mm/yyyy'
			});

			$.ajax({ 
           	method: "GET", 
           	url: "/bpadwebs/kepegawaian/getaktivitas",
			}).done(function( data ) { 
				console.log(data);
				var idemp = $('#idemp').val();
				var csrf_js_var = "{{ csrf_token() }}"
				$('#body_tabel').empty();
				for (var i = 0; i < data.length; i++) {
					var splittime1 = (data[i].time1).split(":");
					var time1 = splittime1[0] + ":" + splittime1[1];

					var splittime2 = (data[i].time2).split(":");
					var time2 = splittime2[0] + ":" + splittime2[1];

					$('#body_tabel').append("<tr>"+
												"<td>"+time1+"</td>"+
												"<td>"+time2+"</td>"+
												"<td>"+data[i].uraian+"</td>"+
												"<td>"+data[i].keterangan+"</td>"+
												"<td>"+
													"<form method='POST' action='/bpadwebs/kepegawaian/form/hapusaktivitas'>"+
														"<input type='hidden' name='idemp' value="+idemp+">"+
														"<input type='hidden' name='tgl_trans' value="+data[i].detail_tgl_trans+">"+
														"<input type='hidden' name='time1' value="+data[i].time1+">"+
														"<input name='_token' value='"+csrf_js_var+"' type='hidden'>"+
														"<button type='submit' class='btn btn-danger btn-outline btn-circle m-r-5 btn-update'><i class='fa fa-trash'></i></button></td>"+
													"</form>"+
												"</tr>");
				}
			}); 

			$('.myTable').DataTable({
				"paging":   false,
		        "ordering": false,
		        "info":     false,
			});

		});
	</script>
@endsection