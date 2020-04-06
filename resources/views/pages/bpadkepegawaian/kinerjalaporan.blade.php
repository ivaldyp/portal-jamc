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
                        <div class="panel-heading"> Laporan Kinerja </div>
                    	<div class="panel-wrapper collapse in">
                            <div class="panel-body">
                            	<div class="row" style="margin-bottom: 10px">
                        			<form method="GET" action="/bpadwebs/kepegawaian/laporan kinerja">
                        				<div class="col-sm-3">
                        					<select class="form-control" name="now_id_emp" id="now_id_emp" onchange="this.form.submit()">
                        						@forelse($pegawais as $pegawai)
                        						<option <?php if ($now_id_emp == $pegawai['id_emp']): ?> selected <?php endif ?> value="{{ $pegawai['id_emp'] }}">{{ ucwords(strtolower($pegawai['nm_emp'])) }}-{{ $pegawai['nrk_emp'] }}</option>
                        						@empty
                        						<option value="{{ $_SESSION['user_data']['id_emp'] }}">{{ ucwords(strtolower($_SESSION['user_data']['nm_emp'])) }}-{{ $_SESSION['user_data']['nrk_emp'] }}</option>
                        						@endforelse
                        					</select>
                        				</div>
				                      	<div class="col-sm-2">
				                        	<select class="form-control" name="now_month" id="now_month" onchange="this.form.submit()">
				                          		<option <?php if ($now_month == 1): ?> selected <?php endif ?> value="1">Januari</option>
				                          		<option <?php if ($now_month == 2): ?> selected <?php endif ?> value="2">Februari</option>
				                          		<option <?php if ($now_month == 3): ?> selected <?php endif ?> value="3">Maret</option>
				                          		<option <?php if ($now_month == 4): ?> selected <?php endif ?> value="4">April</option>
				                          		<option <?php if ($now_month == 5): ?> selected <?php endif ?> value="5">Mei</option>
				                          		<option <?php if ($now_month == 6): ?> selected <?php endif ?> value="6">Juni</option>
				                          		<option <?php if ($now_month == 7): ?> selected <?php endif ?> value="7">Juli</option>
				                          		<option <?php if ($now_month == 8): ?> selected <?php endif ?> value="8">Agustus</option>
				                          		<option <?php if ($now_month == 9): ?> selected <?php endif ?> value="9">September</option>
				                          		<option <?php if ($now_month == 10): ?> selected <?php endif ?> value="10">Oktober</option>
				                          		<option <?php if ($now_month == 11): ?> selected <?php endif ?> value="11">November</option>
				                          		<option <?php if ($now_month == 12): ?> selected <?php endif ?> value="12">Desember</option>
				                        	</select>
			                      		</div>
			                      		<div class=" col-sm-2">
				                        	<select class="form-control" name="now_year" id="now_year" onchange="this.form.submit()">
				                            	<option <?php if ($now_year == (int)date('Y')): ?> selected <?php endif ?> value="{{ (int)date('Y') }}">{{ (int)date('Y') }}</option>
				                          		<option <?php if ($now_year == (int)date('Y') - 1): ?> selected <?php endif ?> value="{{ (int)date('Y') - 1 }}">{{ (int)date('Y') - 1 }}</option>
				                          		<option <?php if ($now_year == (int)date('Y') - 2): ?> selected <?php endif ?> value="{{ (int)date('Y') - 2 }}">{{ (int)date('Y') - 2 }}</option>
				                        	</select>
			                      		</div>
					                </form>
                            	</div>
								<div class="row">
									<div class="table-responsive">
										<table class="myTable table table-hover table-striped color-table primary-table" >
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
												
												@if($nowdate != $laporan['tgl_trans'])
													@php $nowdate = $laporan['tgl_trans'] @endphp
													<tr>
														<td colspan="5"><b>TANGGAL: {{ date('D, d-M-Y',strtotime($laporan['tgl_trans'])) }}</b></td>
														<td style="display: none;"></td>
														<td style="display: none;"></td>
														<td style="display: none;"></td>
														<td style="display: none;"></td>
													</tr>
													<tr>
														<td>{{ date('d-M-Y',strtotime($laporan['tgl_trans'])) }}</td>
														<td>{{ date('H:i',strtotime($laporan['time1'])) }}</td>
														<td>{{ date('H:i',strtotime($laporan['time2'])) }}</td>
														<td>{{ $laporan['uraian'] }}</td>
														<td>{{ $laporan['keterangan'] }}</td>
													</tr>
												@else
													<tr>
														<td>{{ date('d-M-Y',strtotime($laporan['tgl_trans'])) }}</td>
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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <!-- end - This is for export functionality only -->

	<script>
		$(function () {
			$('.myTable').DataTable({
				"paging":   false,
		        "ordering": false,
		        "info":     false,
		        dom: 'Bfrtip'
	            ,buttons: [
		            {
		                extend: 'excelHtml5',
		                title: 'Laporan Kinerja'
		            },
		            {
		                extend: 'pdfHtml5',
		                title: 'Laporan Kinerja'
		            }
		        ]
			});
		});
	</script>
@endsection