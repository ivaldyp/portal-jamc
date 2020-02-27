@extends('layouts.masterhome')

@section('css')
	<!-- Bootstrap Core CSS -->
	<link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
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
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<form class="form-horizontal" method="POST" action="/bpadwebs/cms/form/tambahcontent" data-toggle="validator">
					@csrf
						<div class="panel panel-info">
							<div class="panel-heading"> IDENTITAS </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
									<div class="form-group">
                                        <label for="id_emp" class="col-md-2 control-label"> ID </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="id_emp" value="{{ $id_emp[0] .'.'. $id_emp[1] .'.'. $id_emp[2] .'.'. ($id_emp[3] + 1) }}" disabled>
                                            <input type="hidden" class="form-control" name="id_emp" value="{{ $id_emp[0] .'.'. $id_emp[1] .'.'. $id_emp[2] .'.'. ($id_emp[3] + 1) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_emp" class="col-md-2 control-label"> TMT </label>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" id="id_emp" >
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading"> PENDIDIKAN </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading"> GOLONGAN </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
								</div>
							</div>
						</div>
						<div class="panel panel-info">
							<div class="panel-heading"> JABATAN  </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
								</div>
							</div>
						</div>
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
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>

	
@endsection