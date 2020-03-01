@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- Menu CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ ('/bpadwebs/public/ample/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css') }}" />
	<!-- animation CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ ('/bpadwebs/public/ample/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">

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
					<!-- <div class="white-box"> -->
					<div class="panel panel-default">
                        <div class="panel-heading"> Pegawai </div>
                    	<div class="panel-wrapper collapse in">
                            <div class="panel-body">
                            	<div class="row " style="margin-bottom: 10px">
                            		<div class="col-md-1">
                            			@if ($access['zadd'] == 'y')
				                      	<a href="/bpadwebs/kepegawaian/tambah pegawai"><button class="btn btn-info" type="button">Tambah</button></a>
									  	@endif
                            		</div>
                            		<div class="col-md-6">
                            			<form method="GET" action="/bpadwebs/kepegawaian/pegawai">
					                      	<div class=" col-md-3">
					                        	<select class="form-control" name="kednow" id="kednow" required>
					                          	<?php foreach ($kedudukans as $key => $kedudukan) { ?>
					                            	<option value="{{ $kedudukan['ked_emp'] }}" 
					                              	<?php 
					                                	if ($kednow == $kedudukan['ked_emp']) {
						                                 	echo "selected";
						                                }
					                              	?>
					                            	>{{ $kedudukan['ked_emp'] }}</option>
					                          	<?php } ?>
					                        	</select>
				                      		</div>
				                      		<button type="submit" class="btn btn-primary">Cari</button>
						                </form>
                            		</div>
                            		
                            		
                            	</div>
								<div class="row">
									<div class="table-responsive">
										<table class="myTable table table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Id</th>
													<th>NIP</th>
													<th>NRK</th>
													<th>Nama</th>
													<th>Group</th>
													<th>Tgl Lahir</th>
													<th>Jns Kel</th>
													<th>TMT</th>
													<th>Status</th>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<th class="col-md-1">Aksi</th>
													@endif
												</tr>
											</thead>
											<tbody>
												@foreach($employees as $key => $employee)
												<tr>
													<?php
														$tgl_lahir = explode(" ", $employee['tgl_lahir']);
														$tgl_join = explode(" ", $employee['tgl_join']);
													?>

													<td>{{ $key + 1 }}</td>
													<td>{{ $employee['id_emp'] }}</td>
													<td>{{ $employee['nip_emp'] ? $employee['nip_emp'] :' -' }}</td>
													<td>{{ $employee['nrk_emp'] ? $employee['nrk_emp'] :' -' }}</td>
													<td>{{ $employee['nm_emp'] }}</td>
													<td>{{ $employee['idgroup'] }}</td>
													<td>{{ $tgl_lahir[0] }}</td>
													<td>{{ $employee['jnkel_emp'] }}</td>
													<td>{{ $tgl_join[0] }}</td>
													<td>{{ $employee['status_emp'] }}</td>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
														<td>
															@if($access['zupd'] == 'y')
																<button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-edit"></i></button>
															@endif
															@if($access['zdel'] == 'y')
																<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-id_emp="{{ $employee['id_emp'] }}" data-nm_emp="{{ $employee['nm_emp'] }}"><i class="fa fa-trash"></i></button>
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
			<div id="modal-delete" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" action="/bpadwebs/kepegawaian/form/hapuspegawai" class="form-horizontal">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b>Hapus Pegawai</b></h4>
							</div>
							<div class="modal-body">
								<h4 id="label_delete"></h4>
								<input type="hidden" name="id_emp" id="modal_delete_id_emp" value="">
								<input type="hidden" name="nm_emp" id="modal_delete_nm_emp" value="">
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
	<script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>
	<!-- wysuhtml5 Plugin JavaScript -->
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
            $('.textarea_editor2').wysihtml5();
        });
    </script>


	<script>
		$(function () {

			$('.btn-update').on('click', function () {
				var $el = $(this);

				if ($el.data('idkat') != 1) {
					$("#cekidkat").hide();
				} else {
					$("#cekidkat").show();
				}

				if ($el.data('sts') == 0) {
					$("#modal_update_sts1").attr('checked', true);
				} else {
					$("#modal_update_sts2").attr('checked', true);
				}

				$("#modal_update_ids").val($el.data('ids'));
				$("#modal_update_idkat").val($el.data('idkat'));
				$("#modal_update_subkat").val($el.data('subkat'));
				$("#modal_update_waktu").val($el.data('waktu'));
				$("#modal_update_judul").val($el.data('judul'));
				$("#modal_update_isi1").data("wysihtml5").editor.setValue($el.data('isi1'));
				$("#modal_update_isi2").data("wysihtml5").editor.setValue($el.data('isi2'));

				$('.textarea_editor').contents().find('.wysihtml5-editor').html($el.data('isi1'));
				$('.textarea_editor2').contents().find('.wysihtml5-editor').html($el.data('isi2'));

				var ids = $el.data('ids');
				var idkat = $el.data('idkat');
				var appr = $el.data('appr');
				var judul = $el.data('judul');
				
				if (appr == 'Y') {
					$("#btn_update_href").html('Batal Setuju');
				} else if (appr == 'N') {
					$("#btn_update_href").html('Setuju');
				}
				$("#modal_update_href").attr("href", "/bpadwebs/cms/form/apprcontent?ids=" + ids + "&idkat=" + idkat + "&appr=" + appr + "&judul=" + judul );

			});

			$('.btn-delete').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus pegawai <b>' + $el.data('nm_emp') + '</b>?');
				$("#modal_delete_id_emp").val($el.data('id_emp'));
				$("#modal_delete_nm_emp").val($el.data('nm_emp'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

			$('.myTable').DataTable();
		});
	</script>
@endsection