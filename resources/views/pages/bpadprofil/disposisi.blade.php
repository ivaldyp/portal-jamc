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
	<link href="{{ ('/bpadwebs/public/ample/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
	<!-- Date picker plugins css -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

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
					<div class="panel panel-default">
						<div class="panel-heading">Disposisi</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								@if($access['zadd'] == 'y')
								<a href="/bpadwebs/profil/tambah disposisi"><button data-toggle="modal" data-target="#modal-create" class="btn btn-info" style="margin-bottom: 10px">Tambah</button></a> 
								@endif
								@if($isEmployee == 1)
									<ul class="nav customtab nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#inbox" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Inbox</span></a></li>
										<li role="presentation" class=""><a href="#sent" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"> Sent</span></a></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade active in" id="inbox">
											<div class="table-responsive">
												<table id="myTable" class="table table-hover table-striped">
													<thead>
														<tr>
															<th>No. Form</th>
															<th class="col-md-1">Tanggal</th>
															<th>Kode</th>
															<th>No. Surat</th>
															<th>Perihal</th>
															<th>Asal</th>
															<th>Sifat</th>
															<th>Dari</th>
															<th>Untuk</th>
															<th>Diteruskan</th>
															<th>Penanganan</th>
															@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
															<th>Aksi</th>
															@endif
														</tr>
													</thead>
													<tbody>

														<?php if ($isEmployee == 1) {
															foreach ($disposisis as $key => $disp) {
																if ($disp['kode_disposisi']) {
																	$thisnoform = $disp['no_form'];
																	$thistanggal = $disp['tgl_masuk'];
																	$thiskode = $disp['kode_disposisi'];
																	$thisnosurat = $disp['no_surat'];
																	$thisperihal = $disp['perihal'];
																	$thisasal = $disp['asal_surat'];
																	$thissifat1 = $disp['sifat1_surat'];
																	$thissifat2 = $disp['sifat2_surat'];
																}

																if ($disp['to_id'] == $_SESSION['user_data']['id_emp']) { ?>
																	<tr>
																		<td>{{ $thisnoform }}</td>
																		<td>{{ date('d-M-Y',strtotime($thistanggal)) }}</td>
																		<td>{{ $thiskode }}</td>
																		<td>{{ $thisnosurat }}</td>
																		<td>{{ $thisperihal }}</td>
																		<td>{{ $thisasal }}</td>
																		<td>
																			<span class="label label-info">{{ $thissifat1 }}</span>
																			<br>
																			<span class="label label-info">{{ $thissifat2 }}</span>
																		</td>

																		<td>
																			<?php if (substr($disp['from_id'], 0, 4) == '1.20'): ?>
																				{{ $disp['from_pm'] }}
																			<?php else : ?>
																				{{ $disp['from_id'] }}
																			<?php endif ?>
																		</td>
																		<td>{{ $disp['to_pm'] }}</td>
																		<td></td>
																		<td>{{ $disp['penanganan'] }}</td>

																		@if ($access['zupd'] == 'y' || $access['zdel'] == 'y')
																		<td style="vertical-align: middle;">
																			@if ($access['zupd'] == 'y')
																			<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 btn-update" data-toggle="modal" data-target="#modal-update"
																			><i class="ti-pencil-alt"></i></button>
																			@endif
																			@if ($access['zdel'] == 'y')
																			<button type="button" class="btn btn-danger btn-delete btn-outline btn-circle m-r-5" data-toggle="modal" data-target="#modal-delete"
																			><i class="ti-trash" data-ids="{{ $disp['ids'] }}" data-no_form="{{ $disp['no_form'] }}"></i></button>
																			@endif
																		</td>
																		@endif
																	</tr>
																<?php }
															}
														} else { 
															foreach ($disposisis as $key => $disp) { ?>
																<tr>
																	<td>{{ $disp['no_form'] }}</td>
																	<td>{{ date('d-M-Y',strtotime($disp['tgl_masuk'])) }}</td>
																	<td>{{ $disp['kode_disposisi'] }}</td>
																	<td>{{ $disp['no_surat'] }}</td>
																	<td>{{ $disp['perihal'] }}</td>
																	<td>{{ $disp['asal_surat'] }}</td>
																	<td>
																		<span class="label label-info">{{ $disp['sifat1_surat'] }}</span>
																		<br>
																		<span class="label label-info">{{ $disp['sifat2_surat'] }}</span>
																	</td>

																	@if ($access['zupd'] == 'y' || $access['zdel'] == 'y')
																	<td style="vertical-align: middle;">
																		@if ($access['zupd'] == 'y')
																		<button type="button" class="btn btn-info btn-outline btn-circle m-r-5 btn-update" data-toggle="modal" data-target="#modal-update"
																		><i class="ti-pencil-alt"></i></button>
																		@endif
																		@if ($access['zdel'] == 'y')
																		<button type="button" class="btn btn-danger btn-delete btn-outline btn-circle m-r-5" data-toggle="modal" data-target="#modal-delete" data-ids="{{ $disp['ids'] }}" data-no_form="{{ $disp['no_form'] }}"
																		><i class="ti-trash"></i></button>
																		@endif
																	</td>
																	@endif
																</tr>
															<?php }
														} ?>
													</tbody>
												</table>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="sent">
											<div class="col-md-6">
												<h3>Lets check profile</h3>
												<h4>you can use it with the small code</h4> </div>
											<div class="col-md-5 pull-right">
												<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="modal-delete" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" action="/bpadwebs/profil/form/hapusdisposisi" class="form-horizontal">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b>Hapus Kategori</b></h4>
							</div>
							<div class="modal-body">
								<h4 id="label_delete"></h4>
								<input type="hidden" name="ids" id="modal_delete_ids" value="">
								<input type="hidden" name="no_form" id="modal_delete_no_form" value="">
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-danger pull-right">Hapus</button>
								<button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
							</div>
						</form>
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
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

	<script>
		$(function () {

			$(".data-input").hide();

			$('.btn-edit-id').on('click', function () {
				$(this).text(function(i, text){
					return text === "Ubah" ? "Kembali" : "Ubah";
				});
				$(".data-show").toggle();
				$(".data-input").toggle();
			});

			jQuery('#datepicker-autoclose').datepicker({
				autoclose: true
				, todayHighlight: false
				, format: 'dd/mm/yyyy'
			});

			jQuery('#datepicker-autoclose2').datepicker({
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

			$('.btn-delete').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus form nomor <b>' + $el.data('no_form') + '</b>?');
				$("#modal_delete_ids").val($el.data('ids'));
				$("#modal_delete_no_form").val($el.data('no_form'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

			$('#myTable').DataTable({
				"order": [ 0, "desc" ]
			});
		});
	</script>
@endsection