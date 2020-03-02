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
				<div class="col-md-4">
					<div class="white-box">
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
                                <div class="col-md-6">
                                    <h3>Best Clean Tab ever</h3>
                                    <h4>you can use it with the small code</h4> </div>
                                <div class="col-md-5 pull-right">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabs2">
                            	<button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-insert">Tambah</button>
                            	<div class="table-responsive">
                            		<table>
                            			<tbody>
                            				@foreach($emp_dik as $key => $dik)
                            				<tr><td>
                            					<div class="col-md-1"><h2>{{ $emp_dik[0]['iddik'] }}</h2></div>
                            				</td></tr>
                            				<tr><td>
                            					<div class="col-md-1"><h2>{{ $emp_dik[0]['iddik'] }}</h2></div>
                            				</td></tr>
                            				<tr><td>
                            					<div class="col-md-1"><h2>{{ $emp_dik[0]['iddik'] }}</h2></div>
                            				</td></tr>
                            				@endforeach
                            			</tbody>
                            		</table>
                            	</div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabs3">
                                <div class="col-md-6">
                                    <h3>Come on you have a lot message</h3>
                                    <h4>you can use it with the small code</h4> </div>
                                <div class="col-md-5 pull-right">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabs4">
                                <div class="col-md-6">
                                    <h3>Just do Settings</h3>
                                    <h4>you can use it with the small code</h4> </div>
                                <div class="col-md-5 pull-right">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                </div>
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