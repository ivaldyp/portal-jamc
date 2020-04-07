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

			<div class="row ">
				<div class="col-md-12">
					<!-- <div class="white-box"> -->
					<div class="panel panel-default">
                        <div class="panel-heading"> Entri Kinerja </div>
                    	<div class="panel-wrapper collapse in">
                            <div class="panel-body">
                            	<div class="row" style="margin-bottom: 10px">
                            		<div class="col-md-1">
										@if ($access['zadd'] == 'y')
										<a href="/bpadwebs/kepegawaian/kinerja tambah"><button class="btn btn-info" style="margin-bottom: 10px">Tambah</button></a> 
										@endif
									</div>
                            	</div>
								<div class="row container">
									<h3 class="text-center">tabel kinerja belum tervalidasi</h3>
									<div class="table-responsive">
										<table class="myTable table table-hover color-table primary-table" >
											<thead>
												<tr>
													<th class="col-md-1">Tanggal</th>
													<th class="col-md-1">Awal</th>
													<th class="col-md-1">Akhir</th>
													<th class="col-md-4">Uraian</th>
													<th class="col-md-4">Kegiatan</th>
												</tr>
											</thead>
											<tbody>
												@php
												$nowdate = 0
												@endphp

												@foreach($laporans as $laporan)
												
												@if($nowdate != $laporan['detail_tgl_trans'])
													@php $nowdate = $laporan['detail_tgl_trans'] @endphp
													<tr style="background-color: #f7fafc !important">
														<td colspan="5"><b>TANGGAL: {{ date('D, d-M-Y',strtotime($laporan['detail_tgl_trans'])) }} --- {{ $laporan['jns_hadir_app'] }}</b></td>
														<td style="display: none;"></td>
														<td style="display: none;"></td>
														<td style="display: none;"></td>
														<td style="display: none;"></td>
													</tr>
													<tr>
														<td>{{ date('d-M-Y',strtotime($laporan['detail_tgl_trans'])) }}</td>
														<td>{{ date('H:i',strtotime($laporan['time1'])) }}</td>
														<td>{{ date('H:i',strtotime($laporan['time2'])) }}</td>
														<td>{{ $laporan['uraian'] }}</td>
														<td>{{ $laporan['keterangan'] }}</td>
													</tr>
												@else
													<tr>
														<td>{{ date('d-M-Y',strtotime($laporan['detail_tgl_trans'])) }}</td>
														<td>{{ date('H:i',strtotime($laporan['time1'])) }}</td>
														<td>{{ date('H:i',strtotime($laporan['time2'])) }}</td>
														<td>{{ $laporan['uraian'] }}</td>
														<td>{{ $laporan['keterangan'] }}</td>
													</tr>
												@endif
												
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
	<!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

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