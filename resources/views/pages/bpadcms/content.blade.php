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
                        <div class="panel-heading">Konten</div>
                    	<div class="panel-wrapper collapse in">
                            <div class="panel-body">
                            	<div class="row " style="margin-bottom: 10px">
                            		<div class="col-md-1">
                            			@if ($access['zadd'] == 'y')
                            			<label for="stsnow" class="control-label">  </label>
				                      	<button class="btn btn-info btn-href-tambah" type="button" data-toggle="modal" data-target="#modal-insert">Tambah</button>
									  	@endif
                            		</div>
                            		<div class="col-md-6">
                            			<form method="GET" action="/bpadwebs/cms/content">
					                      	<div class=" col-md-3">
					                      		<label for="katnow" class="control-label"> Tipe </label>
					                        	<select class="form-control" name="katnow" id="katnow" required>
					                          	<?php foreach ($kategoris as $key => $kategori) { ?>
					                            	<option value="{{ $kategori['ids'] }}" 
					                              	<?php 
					                                	if ($katnow == $kategori['ids']) {
						                                 	echo "selected";
						                                }
					                              	?>
					                            	>{{ $kategori['nmkat'] }}</option>
					                          	<?php } ?>
					                        	</select>
				                      		</div>
				                      		<div class=" col-md-3">
				                      			<label for="stsnow" class="control-label"> Suspend </label>
					                        	<select class="form-control" name="stsnow" id="stsnow">
					                          	
					                            	<option value="1" <?php if ($stsnow == 1) { echo "selected"; } ?> >Tidak</option>
					                            	<option value="0" <?php if ($stsnow == 0) { echo "selected"; } ?> >Ya</option>
					                            	<option value="2" <?php if ($stsnow == 2) { echo "selected"; } ?> >All</option>
					                          	
					                        	</select>
				                      		</div>
				                      		<div class=" col-md-3">
				                      			<label for="apprnow" class="control-label"> Approved </label>
					                        	<select class="form-control" name="apprnow" id="apprnow">
					                          	
					                            	<option value="1" <?php if ($apprnow == 'Y') { echo "selected"; } ?> >Ya</option>
					                            	<option value="0" <?php if ($apprnow == 'N') { echo "selected"; } ?> >Tidak</option>

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
													<th>Suspend</th>
													<th>Tanggal</th>
													<th>Judul</th>
													<th>Editor</th>
													<th>Approved</th>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<th>Aksi</th>
													@endif
												</tr>
											</thead>
											<tbody>
												@foreach($contents as $key => $content)
												<tr>
													<td>{{ $key + 1 }}</td>
													<td>{!! ($content['sts']) == 0 ? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>' !!}</td>
													<td>{{ $content['tanggal'] }}</td>
													<td>{{ $content['judul'] }}</td>
													<td>{{ $content['editor'] }}</td>
													<td>{!! ($content['appr']) == 'Y' ? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>' !!}</td>
													@if($access['zupd'] == 'y' || $access['zdel'] == 'y')
													<td></td>
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
						<form method="GET" action="/bpadwebs/cms/tambah content" class="form-horizontal" data-toggle="validator">
						@csrf
							<div class="modal-header">
								<h4 class="modal-title"><b>Pilih Kategori</b></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
                                    <label for="kat" class="col-md-2 control-label"><span style="color: red">*</span> Tipe </label>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="kat" id="kat" required>
                                            <option value="1"> Berita </option>
                                            <option value="5"> Foto </option>
                                            <option value="12"> Video </option>
                                        </select>
                                    </div>
                                </div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success pull-right">Simpan</button>
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
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>


	<script>
		$(function () {

			$('.btn-update').on('click', function () {
				var $el = $(this);

				$("#modal_update_ids").val($el.data('ids'));
				$("#modal_update_nmkat").val($el.data('nmkat'));

				if ($el.data('sts') == 0) {
					$("#update_sts1").attr('checked', true);
				} else {
					$("#update_sts2").attr('checked', true);
				}
			});

			$('.btn-delete').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus kategori <b>' + $el.data('nmkat') + '</b>?');
				$("#modal_delete_ids").val($el.data('ids'));
				$("#modal_delete_nmkat").val($el.data('nmkat'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

			$('.myTable').DataTable();
		});
	</script>
@endsection