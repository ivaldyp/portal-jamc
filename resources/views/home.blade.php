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
												echo ucwords(explode("?", $link[4])[0]);
											?> </h4> </div>
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
					<ol class="breadcrumb">
						<li>{{config('app.name')}}</li>
						<?php 
							$link = explode("/", url()->full());
							if (count($link) == 5) {
								?> 
									<li class="active"> {{ ucwords(explode("?", $link[4])[0]) }} </li>
								<?php
							} elseif (count($link) == 6) {
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
				<div class="col-md-12">
					<div class="white-box">
						<div class="row row-in">
							<div class="col-md-3 col-sm-6 row-in-br">
								<ul class="col-in">
									<li>
										<span class="circle circle-md bg-info"><i class="ti-user"></i></span>
									</li>
									<li class="col-last"><h3 class="counter text-right m-t-15">{{ $countpegawai['total'] }}</h3></li>
									<li class="col-middle">
										<h4>Pegawai</h4>
									</li>
										
								</ul>
							</div>
						  	<div class="col-md-3 col-sm-6 row-in-br b-r-none">
								<ul class="col-in">
									<li>
										<span class="circle circle-md bg-danger"><i class="ti-email"></i></span>
									</li>
									<li class="col-last"><h3 class="counter text-right m-t-15">{{ $countdisp['total'] }}</h3></li>
									<li class="col-middle">
										<h4>Disposisi</h4>
									</li>
									
								</ul>
						  	</div>
						  	<div class="col-md-3 col-sm-6 row-in-br">
								<ul class="col-in">
									<li>
										<span class="circle circle-md bg-success"><i class="ti-comment"></i></span>
									</li>
									<li class="col-last">
										<h3 class="counter text-right m-t-15">{{ $countcontent['total'] }}</h3>
									</li>
									<li class="col-middle">
										<h4>Konten</h4>
									</li>
								</ul>
						  	</div>
						  	<div class="col-md-3 col-sm-6 b-0">
								<ul class="col-in">
									<li>
										<span class="circle circle-md bg-warning"><i class="fa fa-dollar"></i></span>
									</li>
									<li class="col-last"><h3 class="counter text-right m-t-15">83</h3></li>
									<li class="col-middle">
										<h4>Net Earnings</h4>
									</li>
								</ul>
						 	 </div> 
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-lg-8">
							<div class="panel panel-info">
								<div class="panel-heading">Isi 
									<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										- list pegawai di bidang / subbid yg sama<br>
										- ??? :)<br>
										- ??? :)<br>
										- ??? :)
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading">Info Sampingan
									<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<ul class="nav customtab nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#agenda" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Agenda</span></a></li>
											<li role="presentation" class=""><a href="#berita" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Berita</span></a></li>
											<li role="presentation" class=""><a href="#ulangtahun" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Ultah</span></a></li>
											<li role="presentation" class=""><a href="#pensiun" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Pensiun</span></a></li>
										</ul>
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane fade active in" id="agenda">
												@foreach($agendas as $agenda)
												{{ date('d-M-Y', strtotime(str_replace('/', '-', $agenda['dtanggal']))) }} oleh {{ $agenda['an'] }}
												<br>
												{{ $agenda['ddesk'] }}
												<br>
												<a target="_blank" href="{{ config('app.openfileagenda') }}/{{ $agenda['dfile'] }}"><i class="fa fa-download"></i> Download File </a>
												<hr>
												@endforeach
												{{ $agendas->onEachSide(2)->links() }}
												<div class="clearfix"></div>
											</div>
											<div role="tabpanel" class="tab-pane fade in" id="berita">
												@foreach($beritas as $berita)
												<div class="panel-heading panel-default">{{ date('d-M-Y', strtotime(str_replace('/', '-', $berita['tanggal']))) }} oleh {{ $berita['an'] }}</div>
												
												<br>
												{!! html_entity_decode($berita['isi']) !!}
												<br>
												<hr>
												@endforeach
												{{ $beritas->onEachSide(2)->links() }}
												<div class="clearfix"></div>
											</div>
											<div role="tabpanel" class="tab-pane fade in" id="ulangtahun"></div>
											<div role="tabpanel" class="tab-pane fade in" id="pensiun"></div>
										</div>
										
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
		<footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
	</div>
@endsection

<!-- /////////////////////////////////////////////////////////////// -->

@section('js')
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="{{ ('/bpadwebs/public/ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
	<!--slimscroll JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/js/jquery.slimscroll.js') }}"></script>
	<!--Wave Effects -->
	<script src="{{ ('/bpadwebs/public/ample/js/waves.js') }}"></script>
	<!-- Custom Theme JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
	<!--Style Switcher -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection
