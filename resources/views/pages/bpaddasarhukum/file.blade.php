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
				<div class="col-md-12">
					<!-- <div class="white-box"> -->
					<div class="panel panel-info">
                        <div class="panel-heading"> File Produk Hukum </div>
                    	<div class="panel-wrapper collapse in">
                            <div class="panel-body">
                            	<div class="row " style="margin-bottom: 10px">
                            		@if ($access['zadd'] == 'y')
                        			<div class="col-md-1">
                        				<a href="/produkhukum/setup/tambah file"><button data-toggle="modal" data-target="#modal-insert" class="btn btn-info col-sm-12" style="margin-bottom: 10px">Tambah</button></a>
                        			</div>
                        			<div class="col-md-10">
                            			<form method="GET" action="/produkhukum/setup/file">
											<div class=" col-md-2">
												<input type="text" name="yearnow" class="form-control" placeholder="Tahun" value="{{ $yearnow }}" autocomplete="off">
											</div>
				                      		<div class=" col-md-4">
					                        	<select class="form-control select2" name="katnow" id="katnow">
				                        		<option value="<?php echo null; ?>">--SEMUA--</option>
					                          	<?php foreach ($kategoris as $key => $kat) { ?>
					                            	<option value="{{ $kat['nm_kat'] }}" 
					                              	<?php 
					                                	if ($katnow == $kat['nm_kat']) {
						                                 	echo "selected";
						                                }
					                              	?>
					                            	>{{ $kat['singkatan'] ? '['. strtoupper($kat['singkatan'])  .'] - ' : '' }} {{ ucwords(strtolower($kat['nm_kat'])) }}</option>
					                          	<?php } ?>
					                        	</select>
				                      		</div>
				                      		<button type="submit" class="btn btn-info">Cari</button>
										</form>
                            		</div>    
                            		@endif   
                            		                     		
                            	</div>
								<div class="row">
									<div class="table-responsive">
										<table class="myTable table table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Suspend?</th>
													<th>Tanggal Upload</th>
													<th>Kategori</th>
													<th>Nomor</th>
													<th>Tahun</th>
													<th>Tentang</th>
													<th>Download</th>
													<th>Issued By</th>
													<th>Produk Hukum?</th>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<th class="col-md-2">Action</th>
													@endif
												</tr>
											</thead>
											<tbody style="vertical-align: middle;">
												@foreach($files as $key => $file)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>
														@if($file['suspend'] == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else
															<i class="fa fa-close" style="color: red"></i>
														@endif
													</td>
													<td>{{ date('d M Y', strtotime(str_replace('/', '-', $file['created_at'] ))) }}</td>
													<td>{{ ucwords(strtolower($file['nm_kat'])) }}
														@if($file['id_jns'] != 0)
															<br><span class="text-muted">{{ $file['nm_jenis'] }}</span>
														@endif
													</td>
													<td>Nomor {{ $file['nomor'] ?? '-' }} </td>
													<td>{{ $file['tahun'] ?? '-' }}</td>
													<td>{{ $file['tentang'] }}</td>
													<td><a href="{{ $file['url'] }}"><i class="fa fa-download"></i> Download</a></td>
													<td>{{ $file['status'] }}</td>
													<td>
														@if($file['hukum'] == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else
															<i class="fa fa-close" style="color: red"></i>
														@endif
													</td>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<td>
														<form method="GET" action="/produkhukum/setup/ubah file">
														@if($access['zupd'] == 'y')
															<input type="hidden" name="ids" value="{{ $file['ids'] }}">
															<button type="submit" class="btn btn-info btn-update"><i class="fa fa-edit"></i></button>
														@endif
														@if($access['zdel'] == 'y')
															<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-ids="{{ $file['ids'] }}" data-nomor="{{ $file['nomor'] }}" data-tahun="{{ $file['tahun'] }}"><i class="fa fa-trash"></i></button>
														@endif
														</form>
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
			<div id="modal-delete" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" action="/produkhukum/setup/form/hapusfile" class="form-horizontal">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b>Hapus File</b></h4>
							</div>
							<div class="modal-body">
								<h4 id="label_delete"></h4>
								<input type="hidden" name="ids" id="modal_delete_ids" value="">
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
	<script src="{{ ('/produkhukum/public/ample/plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>

	<script>
		$(function () {

			$(".select2").select2();

			$('.btn-update').on('click', function () {
				var $el = $(this);

				$("#modal_update_ids").val($el.data('ids'));
				$("#modal_update_nm_kat").val($el.data('nm_kat'));
				$("#modal_update_singkatan").val($el.data('singkatan'));

			});

			$('.btn-delete').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus file <b>Nomor ' + $el.data('nomor') + ' Tahun '+ $el.data('tahun') +'</b>?');
				$("#modal_delete_ids").val($el.data('ids'));
				$("#modal_delete_nomor").val($el.data('nomor'));
				$("#modal_delete_tahun").val($el.data('tahun'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

			$('.myTable').DataTable();
		});
	</script>
@endsection