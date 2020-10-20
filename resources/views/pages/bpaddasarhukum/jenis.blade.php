@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/produkhukum/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ ('/produkhukum/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- Menu CSS -->
	<link href="{{ ('/produkhukum/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- animation CSS -->
	<link href="{{ ('/produkhukum/public/ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ ('/produkhukum/public/ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ ('/produkhukum/public/ample/css/colors/purple-dark.css') }}" id="theme" rel="stylesheet">

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
				<div class="col-sm-2"></div>
				<div class="col-md-8">
					<!-- <div class="white-box"> -->
					<div class="panel panel-info">
                        <div class="panel-heading"> Jenis </div>
                    	<div class="panel-wrapper collapse in">
                            <div class="panel-body">
                            	<div class="row " style="margin-bottom: 10px">
                            		@if ($access['zadd'] == 'y')
                            		<button data-toggle="modal" data-target="#modal-insert" class="btn btn-info" style="margin-bottom: 10px">Tambah</button>
                            		@endif                            		
                            	</div>
								<div class="row">
									<div class="table-responsive">
										<table class="myTable table table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Create date</th>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<th class="col-md-2">Action</th>
													@endif
												</tr>
											</thead>
											<tbody style="vertical-align: middle;">
												@foreach($jenises as $key => $jen)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{{ strtoupper($jen['nm_jenis']) }}</td>
													<td>{{ $jen['tgl'] }}</td>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<td>
														@if($access['zupd'] == 'y')
															<button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#modal-update" data-ids="{{ $jen['ids'] }}" data-nm_jenis="{{ $jen['nm_jenis'] }}"><i class="fa fa-edit"></i></button>
														@endif
														@if($access['zdel'] == 'y')
															<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-ids="{{ $jen['ids'] }}" data-nm_jenis="{{ $jen['nm_jenis'] }}"><i class="fa fa-trash"></i></button>
														@endif
													</td>
													@endif
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
                            	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-insert" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" action="/produkhukum/setup/form/tambahjenis" class="form-horizontal">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b> Jenis Baru </b></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="nm_jenis" class="col-sm-2 control-label"> jenis </label>
									<div class="col-sm-8">
										<input type="text" name="nm_jenis" id="nm_jenis" class="form-control" autocomplete="off" required="">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-danger pull-right">Tambah</button>
								<button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="modal-update" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" action="/produkhukum/setup/form/ubahjenis" class="form-horizontal">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b> Ubah Jenis </b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="ids" id="modal_update_ids">
								<div class="form-group">
									<label for="nm_jenis" class="col-sm-2 control-label"> Jenis </label>
									<div class="col-sm-8">
										<input type="text" name="nm_jenis" id="modal_update_nm_jenis" class="form-control" autocomplete="off" required="">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-danger pull-right">Simpan</button>
								<button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="modal-delete" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" action="/produkhukum/setup/form/hapusjenis" class="form-horizontal">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b>Hapus Jenis</b></h4>
							</div>
							<div class="modal-body">
								<h4 id="label_delete"></h4>
								<input type="hidden" name="ids" id="modal_delete_ids" value="">
								<input type="hidden" name="nm_jenis" id="modal_delete_nm_jenis" value="">
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
	<script src="{{ ('/produkhukum/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ ('/produkhukum/public/ample/js/validator.js') }}"></script>

	<script>
		$(function () {

			$('.btn-update').on('click', function () {
				var $el = $(this);

				$("#modal_update_ids").val($el.data('ids'));
				$("#modal_update_nm_jenis").val($el.data('nm_jenis'));
			});

			$('.btn-delete').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus jenis <b>' + $el.data('nm_jenis') + '</b>?');
				$("#modal_delete_ids").val($el.data('ids'));
				$("#modal_delete_nm_jenis").val($el.data('nm_jenis'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

			$('.myTable').DataTable();
		});
	</script>
@endsection