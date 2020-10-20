@extends('layouts.master')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<!-- <h1 class="title"><span style="background: linear-gradient(to right, #8C0606 0%, #FF0000 50%, #8C0606 100%); -webkit-background-clip: text;-webkit-text-fill-color: transparent; font-size: 64px">BERITA BPAD</span></h1> -->
			<h1 class="title" style="font-family: 'Century Gothic'; font-size: 64px"><span style="color: #006cb8; font-weight: bold">PRODUK</span> HUKUM</h1>
		</div>
	</div>
</div>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<!-- <div class="row">
			<div class="col-md-12" style="padding: 20px">
				<form class="form-horizontal" action="" method="get">
					<div class="form-group">
						<label class="control-label col-md-2" style="text-align: left;">Cari Berita</label>
						<div class="col-md-6">
							<i class="fa fa-search"></i><input type="text" class="input" name="" placeholder="cari">
						</div>
					</div>
				</form>
			</div>
		</div> -->
		<div class="row container" style="padding-bottom: 10px">
			<form method="GET" action="/produkhukum">
				<!-- <div class="col-xs-2"></div> -->
				<div class=" col-md-2">
					<input type="text" name="year" class="form-control" placeholder="Tahun" value="{{ $yearnow }}" autocomplete="off">
				</div>
				<div class=" col-md-3">
					<input type="text" name="tentang" class="form-control" placeholder="Tentang" value="{{ $tentangnow }}" autocomplete="off">
				</div>
          		<div class=" col-md-3">
                	<select class="form-control select2" name="kat" id="katnow">
            		<option value="<?php echo null; ?>">--SEMUA KATEGORI--</option>
                  	<?php foreach ($kategoris as $key => $kat) { ?>
                    	<option value="{{ $kat['nama'] }}" 
                      	<?php 
                        	if ($katnow == $kat['nama']) {
                             	echo "selected";
                            }
                      	?>
                    	>{{ $kat['singkatan'] ? '['. strtoupper($kat['singkatan'])  .'] - ' : '' }} {{ ucwords(strtolower($kat['nama'])) }}</option>
                  	<?php } ?>
                	</select>
          		</div>
          		<button type="submit" class="btn btn-info">Cari</button>
          		<div class="pull-right col-md-2 form-inline">
          			<label>Show</label>
                	<select class="form-control select2" name="show" id="shownow" onchange="this.form.submit()">
                  		<option value="10" <?php if($shownow == 10): ?> selected <?php endif ?> >10</option>
                  		<option value="25" <?php if($shownow == 25): ?> selected <?php endif ?>>25</option>
                  		<option value="50" <?php if($shownow == 50): ?> selected <?php endif ?>>50</option>
                  		<option value="100" <?php if($shownow == 100): ?> selected <?php endif ?>>100</option>
                	</select>
          		</div>

			</form>
		</div>
		<hr>
		<!-- <hr> -->
		Total {{ $files->total() }} Results
		{{ $files->appends(Request::all())->links() }}
		<div class="row ">
			<!-- MAIN -->
			<!-- <div class="col-md-2"></div> -->
			<main id="main" class="col-md-12">
				<div class="row">
					<!-- article -->

					@if($files->isEmpty())
					<h2><center> Data Tidak Ditemukan </center></h2>
					@else
					<table>
						<tbody>
							<?php $count = 1 ?>
							@foreach($files as $key => $file)

							<div class="col-md-6">
								<div class="event">
									<div class="event-img">
										<?php 
											if ($file['img_file']) {
	                                    		$fullpath = config('app.openfilehukum') . date('Y', strtotime( $file['tgl'] ));
	                                    		$fullpath .= "/da" . date('YmdHis', strtotime( $file['tgl'] ));
	                                    		$fullpath .= "/" . $file['img_file'];

	                                    		$width = "350px";
	                                    	} else {
	                                    		$fullpath = config('app.openfileimgdefault')."32";

	                                    		$width = "120px";
	                                    	}
										?>
										<center><a href="{{ $file['url'] }}"><img src="{{ $fullpath }}" alt="" style="max-width: {{ $width }}"></a>
											</center>
									</div>
									<div class="event-content">
										<h2><a href="{{ $file['url'] }}">{{ ucwords(strtolower($file['nm_kat'])) }} 
										@if($file['hukum'] == 1 or $file['hukum'] == null)
											Nomor {{ $file['nomor'] }}
											Tahun {{ $file['tahun'] }}
										@endif
										 
										</a></h2>
										<h4 class="text-muted"> {{ $file['tentang'] }}</h4>
										<ul style="list-style: none; padding: 0;" class="event-meta">
											<!-- <i class="fa fa-eye"></i> {{ $file['views'] }} Views -->
											<i class="fa fa-calendar"></i> {{ date('d M Y', strtotime(str_replace('/', '-', $file['created_at'] ))) }}
											<span class="pull-right"><a href="{{ $file['url'] }}"> <i class="fa fa-download"></i> Download</a>  <br></span><br>

										</ul>
									</div>
								</div>
							</div>

							@if ($count%2 == 0)

								<div class="clearfix visible-md visible-lg"></div>

							@endif

							<?php $count++; ?>

							@endforeach
						</tbody>
					</table>
					@endif
				</div>
			</main>
		</div>
		<!-- /row -->
		{{ $files->appends(Request::all())->links() }}
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection