@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- xeditable css -->
    <link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
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
				<div class="col-md-4">
					<div class="white-box">
						<div class="user-bg bg-default"> 
							<div class="overlay-box">
								<div class="user-content">
									<?php if ($emp_data	['foto'] && $emp_data['foto'] != '') : ?>
										<?php if ($emp_data['tampilnew'] == 1) : ?>
											<img src="/bpadwebs/public/publicimg/{{ $emp_data['foto'] }}" style="height: 150%" class="thumb-lg img-circle" alt="img">
										<?php else : ?>
											<img src="http://bpad.jakarta.go.id/images/emp/{{ $emp_data['foto'] }}" style="height: 150%" class="thumb-lg img-circle" alt="img">
										<?php endif ?>
									<?php endif ?>
								</div>
							</div>
						</div>
						<div class="user-btm-box" style="text-align: center;">
							<h1>
								{{ ucwords(strtolower($_SESSION['user_data']['nm_emp'])) }}
							</h1>
							<h3><strong>
								{{ ucwords(strtolower($emp_jab[0]['unit']['nm_unit'])) }}
							</strong></h3>
						</div>
						<div class="user-btm-box" style="text-align: center;">
							<div class="col-md-6 text-center row-in-br">
                                <p class="text-blue"><i style="font-size: 30px;" class="mdi mdi-phone"></i></p>
                                <h4>{{ $emp_data['tlp_emp'] }}</h4> </div>
                            <div class="col-md-6 text-center">
                                <p class="text-blue"><i style="font-size: 30px;" class="mdi mdi-email-outline"></i></p>
                                <h4>{{ $emp_data['email_emp'] }}</h4> </div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="white-box">
						<ul class="nav customtab nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tabs1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs">Id</span><span class="hidden-xs"> Identitas </span></a></li>
							<li role="presentation" class=""><a href="#tabs2" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Dik</span> <span class="hidden-xs"> Pendidikan </span></a></li>
							<li role="presentation" class=""><a href="#tabs3" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Gol</i></span> <span class="hidden-xs">Golongan</span></a></li>
							<li role="presentation" class=""><a href="#tabs4" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Jab</span> <span class="hidden-xs">Jabatan</span></a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tabs1">
								<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
									<div class="panel">
										<div class="panel-heading" style="background-color: #edf1f5" id="exampleHeadingDefaultOne" role="tab"> <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultOne"> Nomor ID </a> </div>
										<div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel">
											<div class="table-responsive">
												<table class="table table-hover">
													<tr>
														<td class="col-md-1"><h4>ID</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['id_emp'] }}</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>NIP</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['nip_emp'] }}</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>NRK</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['nrk_emp'] }}</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>Status</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['ked_emp'] }}</h4></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="panel">
										<div class="panel-heading" style="background-color: #edf1f5" id="exampleHeadingDefaultTwo" role="tab"> <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo"> Data Diri </a> </div>
										<div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
											<div class="table-responsive">
												<table class="table table-hover">
													<tr>
														<td class="col-md-1 p-l-30"><h4>Nama</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['gelar_dpn']) : ?>
																{{ $emp_data['gelar_dpn'] }}
															<?php endif ?>
															<span class="inline_edit_id" id="inline-nm_emp" data-type="text" data-id="{{ $emp_data['id_emp'] }}" data-title="Enter username">{{ ucwords(strtolower($emp_data['nm_emp'])) }}</span>
															<!-- {{ ucwords(strtolower($emp_data['nm_emp'])) }} -->

															<?php if ($emp_data['gelar_blk']) : ?>
																<span class="inline_edit_id" id="inline-gelar_blk" data-type="text" data-id="{{ $emp_data['id_emp'] }}" data-title="Enter username">{{ $emp_data['gelar_blk'] }}</span>
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1 p-l-30"><h4>Jenis Kelamin</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['jnkel_emp'] == 'L') : ?>
																Laki-Laki
															<?php else : ?>
																Perempuan
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1 p-l-30"><h4>Tempat, Tgl Lahir</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['tempat_lahir'] }}, {{ date('d-M-Y',strtotime($emp_data['tgl_lahir'])) }}</h4></td>
													</tr>
													<tr>
														<td class="col-md-1 p-l-30"><h4>Alamat</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['alamat_emp'] }}</h4></td>
													</tr>
													<tr>
														<td class="col-md-1 p-l-30"><h4>Status Perkawinan</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['status_nikah'] }}</h4></td>
													</tr>
													<tr>
														<td class="col-md-1 p-l-30"><h4>Golongan Darah</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">{{ $emp_data['gol_darah'] }}</h4></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="panel">
										<div class="panel-heading" style="background-color: #edf1f5" id="exampleHeadingDefaultThree" role="tab"> <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree"> Nomor Penting </a> </div>
										<div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
											<div class="table-responsive">
												<table class="table table-hover">
													<tr>
														<td class="col-md-1"><h4>Bank</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if (($emp_data['nm_bank'] && $emp_data['nm_bank'] != '') && ($emp_data['cb_bank'] && $emp_data['cb_bank'] != '')) : ?>
																{{ $emp_data['nm_bank'] }}, {{ $emp_data['cb_bank'] }}
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>Nama Rekening</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['an_bank'] && $emp_data['an_bank'] != '') : ?>
																$emp_data['an_bank']
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>Nomor Rekening</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['nr_bank'] && $emp_data['nr_bank'] != '') : ?>
																$emp_data['nr_bank']
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>Nomor Taspen</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['no_taspen'] && $emp_data['no_taspen'] != '') : ?>
																$emp_data['no_taspen']
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>NPWP</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['npwp'] && $emp_data['npwp'] != '') : ?>
																$emp_data['npwp']
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>Nomor Askes</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['no_askes'] && $emp_data['no_askes'] != '') : ?>
																$emp_data['no_askes']
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
													<tr>
														<td class="col-md-1"><h4>Nomor Jamsostek</h4></td>
														<td class="col-md-1" style="vertical-align: middle;"><h4 class="text-muted">
															<?php if ($emp_data['no_jamsos'] && $emp_data['no_jamsos'] != '') : ?>
																$emp_data['no_jamsos']
															<?php else : ?>
																-
															<?php endif ?>
														</h4></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabs2">
								@if ($accessdik['zadd'] == 'y')
								<button class="btn btn-info m-b-20" type="button" data-toggle="modal" data-target="#modal-insert-dik">Tambah</button>
								@endif
								<div class="table-responsive">
									<table class="table table-hover manage-u-table">
										<tbody>
											@foreach($emp_dik as $key => $dik)
												@if ($dik['iddik'] != 'NA')
												<tr>
													<td>
														<h1>{{ $dik['iddik'] }}</h1>
															
													</td>
													<td style="vertical-align: middle;">
														<strong>{{ $dik['prog_sek'] }}</strong>
														<br>{{ $dik['nm_sek'] }} <b>{{ $dik['th_sek'] }}</b>
													</td>

													<td style="vertical-align: middle;">
														<?php if ($dik['no_sek']) : ?>
															<strong>No. {{ $dik['no_sek'] }}</strong>
														<?php endif ?>
														
														<?php if ($dik['gambar'] && $dik['gambar'] != '') : ?> 
															<?php if ($dik['tampilnew'] == 1) : ?>
																<br><a target="_blank" href="/bpadwebs/public/publicimg/{{ $dik['gambar'] }}"></a>
															<?php else : ?>
																<br><a target="_blank" href="http://bpad.jakarta.go.id/images/emp/{{ Auth::user()->id_emp }}/{{ $dik['gambar'] }}">Link Ijazah</a>
															<?php endif ?>
														<?php endif ?>
													</td>

													@if ($accessdik['zupd'] == 'y' || $accessdik['zdel'] == 'y')
													<td style="vertical-align: middle;">
														@if ($accessdik['zupd'] == 'y')
														<button type="button" class="btn btn-info btn-outline btn-circle m-r-5"><i class="ti-pencil-alt"></i></button>
														@elseif ($accessdik['zdel'] == 'y')
                                                		<button type="button" class="btn btn-danger btn-outline btn-circle m-r-5"><i class="ti-trash"></i></button>
                                                		@endif
													</td>
													@endif
												</tr>
												@endif
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="clearfix"></div>	
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabs3">
								@if ($accessgol['zadd'] == 'y')
								<button class="btn btn-info m-b-20" type="button" data-toggle="modal" data-target="#modal-insert-gol">Tambah</button>
								@endif
								<div class="table-responsive">
									<table class="table table-hover manage-u-table">
										<tbody>
											@foreach($emp_gol as $key => $gol)
												<tr>
													@if (count($emp_gol) > 1)
													<td>
														<h1>{{ $key + 1 }}</h1>
													</td>
													@endif
													<td style="vertical-align: middle;">
														<strong>{{ $gol['idgol'] }}</strong>
														<br>{{ $gol['gol']['nm_pangkat'] }}
													</td>

													<?php if ($gol['tmt_gol']) : ?>
														<td style="vertical-align: middle;">
															<strong>TMT</strong>
															<br>{{ date('d-M-Y',strtotime($gol['tmt_gol'])) }}
														</td>
													<?php endif ?>

													<?php if ($gol['gambar'] && $gol['gambar'] != '') : ?> 
														<?php if ($gol['gambar'] == 1) : ?>
															<td style="vertical-align: middle;">
																<strong>File</strong>
																<br><a target="_blank" href="/bpadwebs/public/publicimg/{{ $gol['gambar'] }}"></a>
															</td>
														<?php else : ?>
															<td style="vertical-align: middle;">
																<strong>File</strong>
																<br><a target="_blank" href="http://bpad.jakarta.go.id/images/emp/{{ Auth::user()->id_emp }}/{{ $gol['gambar'] }}">Link SK Golongan</a>
															</td>
														<?php endif ?>
													<?php endif ?>

													@if ($accessgol['zupd'] == 'y' || $accessgol['zdel'] == 'y')
													<td style="vertical-align: middle;">
														@if ($accessgol['zupd'] == 'y')
														<button type="button" class="btn btn-info btn-outline btn-circle m-r-5"><i class="ti-pencil-alt"></i></button>
														@elseif ($accessgol['zdel'] == 'y')
                                                		<button type="button" class="btn btn-danger btn-outline btn-circle m-r-5"><i class="ti-trash"></i></button>
                                                		@endif
													</td>
													@endif
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="clearfix"></div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabs4">
								@if ($accessjab['zadd'] == 'y')
								<button class="btn btn-info m-b-20" type="button" data-toggle="modal" data-target="#modal-insert-jab">Tambah</button>
								@endif
								<div class="table-responsive">
									<table class="table table-hover manage-u-table">
										<tbody>
											@foreach($emp_jab as $key => $jab)
												<tr>
													@if (count($emp_jab) > 1)
													<td>
														<h1>{{ $key + 1 }}</h1>
													</td>
													@endif
													<td style="vertical-align: middle;">
														<strong>{{ ucwords(strtolower($jab['unit']['nm_unit'])) }}</strong>
														<br>{!! wordwrap($jab['idjab'], 50, "<br>\n", TRUE) !!}
													</td>

													<td style="vertical-align: middle;">
														<strong>Lokasi</strong>
														<br>{{ $jab['lokasi']['nm_lok'] }}
													</td>

													<?php if ($jab['tmt_jab']) : ?>
														<td style="vertical-align: middle;">
															<strong>TMT</strong>
															<br>{{ date('d-M-Y',strtotime($jab['tmt_jab'])) }}
														</td>
													<?php endif ?>

													<?php if ($jab['gambar'] && $jab['gambar'] != '') : ?> 
														<?php if ($jab['gambar'] == 1) : ?>
															<td style="vertical-align: middle;">
																<strong>File</strong>
																<br><a target="_blank" href="/bpadwebs/public/publicimg/{{ $jab['gambar'] }}"></a>
															</td>
														<?php else : ?>
															<td style="vertical-align: middle;">
																<strong>File</strong>
																<br><a target="_blank" href="http://bpad.jakarta.go.id/images/emp/{{ Auth::user()->id_emp }}/{{ $jab['gambar'] }}">Link SK Jabatan</a>
															</td>
														<?php endif ?>
													<?php endif ?>

													@if ($accessjab['zupd'] == 'y' || $accessjab['zdel'] == 'y')
													<td style="vertical-align: middle;">
														@if ($accessjab['zupd'] == 'y')
														<button type="button" class="btn btn-info btn-outline btn-circle m-r-5"><i class="ti-pencil-alt"></i></button>
														@elseif ($accessjab['zdel'] == 'y')
                                                		<button type="button" class="btn btn-danger btn-outline btn-circle m-r-5"><i class="ti-trash"></i></button>
                                                		@endif
													</td>
													@endif
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="clearfix"></div>
								<div class="clearfix"></div>
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
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>
	<!-- jQuery x-editable -->
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ ('/bpadwebs/public/ample/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
    <script type="text/javascript">
        $('#inline-nm_emp ').editable({
            type: 'text'
            , name: 'nm_emp'
            , mode: 'inline'
        });

        $('#inline-gelar_blk').editable({
            type: 'text'
            , name: 'gelar_blk'
            , mode: 'inline'
            , url: '/post'
            , success: function(response, newValue) {
		        $.ajax({
		        	method: "POST",
					url: "/bpadwebs/post",
					success: function(html){
						alert(html);
					}
				});
		    }
        });
    </script>


	<script>
		$(function () {

			$(".editable-submit").on('click', function () {
				alert("WAA");
			});

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
		});
	</script>
@endsection