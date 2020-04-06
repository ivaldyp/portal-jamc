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
	<link href="{{ ('/bpadwebs/public/ample/css/colors/purple-dark.css') }}" id="theme" rel="stylesheet">
	<!-- Date picker plugins css -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- page CSS -->
	<link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />

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
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form class="form-horizontal" method="POST" action="/bpadwebs/kepegawaian/form/ubahpegawai" data-toggle="validator" enctype="multipart/form-data">
					@csrf
						<div class="panel panel-info">
							<div class="panel-heading"> Data Pegawai </div>
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel-body">
									<div class="sttabs tabs-style-underline">
									<nav>
										<ul>
											<li><a href="#section-underline-1" class="sticon ti-book"><span>Identitas</span></a></li>
											<li><a href="#section-underline-2" class="sticon ti-camera"><span>Pendidikan</span></a></li>
											<li><a href="#section-underline-3" class="sticon ti-book"><span>Golongan</span></a></li>
											<li><a href="#section-underline-4" class="sticon ti-camera"><span>Jabatan</span></a></li>
										</ul>
									</nav>
									<div class="content-wrap">
										<section id="section-underline-1">
											<div class="col-md-8">
												<input type="hidden" name="id_emp" value="{{ $id_emp }}">

												<div class="form-group">
													<label class="col-md-2 control-label"> ID </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" class="form-control" value="{{ $emp_data['id_emp'] }}" disabled>
													</div>
												</div>

												<div class="form-group">
													<label for="tgl_join" class="col-md-2 control-label"> TMT </label>
													<div class="col-md-8">
														<input type="text" name="tgl_join" class="form-control" id="datepicker-autoclose" autocomplete="off" placeholder="mm/dd/yyyy" value="{{ date('d/m/Y', strtotime($emp_data['tgl_join'])) }}">
													</div>
												</div>

												<div class="form-group">
													<label for="status_emp" class="col-md-2 control-label"> Status Pegawai </label>
													<div class="col-md-8">
														<select class="form-control" name="status_emp" id="status_emp">
															@foreach($statuses as $status)
																<option value="{{ $status['status_emp'] }}"  
																	<?php if ($emp_data['status_emp'] == $status['status_emp']): ?>
																		selected
																	<?php endif ?>
																> {{ $status['status_emp'] }} </option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="ked_emp" class="col-md-2 control-label"> Kedudukan Pegawai </label>
													<div class="col-md-8">
														<select class="form-control" name="ked_emp" id="ked_emp">
															@foreach($kedudukans as $kedudukan)
																<option value="{{ $kedudukan['ked_emp'] }}"
																	<?php if ($emp_data['ked_emp'] == $kedudukan['ked_emp']): ?>
																		selected
																	<?php endif ?>
																> {{ $kedudukan['ked_emp'] }} </option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="nip_emp" class="col-md-2 control-label"> NIP </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="nip_emp" class="form-control" id="nip_emp" value="{{ $emp_data['nip_emp'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="nrk_emp" class="col-md-2 control-label"> NRK </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="nrk_emp" class="form-control" id="nrk_emp" value="{{ $emp_data['nrk_emp'] }}">
													</div>
												</div>
												
												<div class="form-group">
													<label for="nm_emp" class="col-md-2 control-label"> Nama </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="nm_emp" class="form-control" id="nm_emp" value="{{ $emp_data['nm_emp'] }}">
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="form-group">
													<label for="gelar" class="col-md-2 control-label"> Gelar </label>
													<div class="col-md-4">
														<input autocomplete="off" type="text" name="gelar_dpn" class="form-control" id="gelar_dpn" placeholder="Depan" value="{{ $emp_data['gelar_dpn'] }}">
													</div>
													<div class="col-md-4">
														<input autocomplete="off" type="text" name="gelar_blk" class="form-control" id="gelar_blk" placeholder="Belakang" value="{{ $emp_data['gelar_blk'] }}">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 control-label"> Jenis Kelamin </label>
													<div class="radio-list col-md-8">
														<label class="radio-inline">
															<div class="radio radio-info">
																<input type="radio" name="jnkel_emp" id="kel1" value="L" data-error="Pilih salah satu" required checked>
																<label for="kel1">Laki-laki</label> 
															</div>
														</label>
														<label class="radio-inline">
															<div class="radio radio-info">
																<input type="radio" name="jnkel_emp" id="kel2" value="P" 
																	<?php if ($emp_data['jnkel_emp'] == "P"): ?>
																		checked
																	<?php endif ?>
																>
																<label for="kel2">Perempuan</label>
															</div>
														</label>
														<div class="help-block with-errors"></div>  
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 control-label"> Tempat / Tgl Lahir </label>
													<div class="col-md-4">
														<input autocomplete="off" type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat" value="{{ $emp_data['tempat_lahir'] }}">
													</div>
													<div class="col-md-4">
														<input autocomplete="off" type="text" name="tgl_lahir" class="form-control" id="datepicker-autoclose2" autocomplete="off" placeholder="mm/dd/yyyy" value="{{ date('d/m/Y', strtotime($emp_data['tgl_lahir'])) }}">
													</div>
												</div>

												<div class="form-group">
													<label for="idagama" class="col-md-2 control-label"> Agama </label>
													<div class="col-md-8">
														<select class="form-control" name="idagama" id="idagama">
															<option value="A" <?php if ($emp_data['idagama'] == "A"): ?> selected <?php endif ?> > Islam </option>
															<option value="B" <?php if ($emp_data['idagama'] == "B"): ?> selected <?php endif ?> > Katolik </option>
															<option value="C" <?php if ($emp_data['idagama'] == "C"): ?> selected <?php endif ?> > Protestan </option>
															<option value="D" <?php if ($emp_data['idagama'] == "D"): ?> selected <?php endif ?> > Budha </option>
															<option value="E" <?php if ($emp_data['idagama'] == "E"): ?> selected <?php endif ?> > Hindu </option>
															<option value="F" <?php if ($emp_data['idagama'] == "F"): ?> selected <?php endif ?> > Lainnya </option>
															<option value="G" <?php if ($emp_data['idagama'] == "G"): ?> selected <?php endif ?> > Konghucu </option>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="alamat_emp" class="col-md-2 control-label"> Alamat </label>
													<div class="col-md-8">
														<textarea name="alamat_emp" class="form-control" rows="3">{{ $emp_data['alamat_emp'] }}</textarea>
													</div>
												</div>

												<div class="form-group">
													<label for="tlp_emp" class="col-md-2 control-label"> Telepon / HP </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="tlp_emp" class="form-control" id="tlp_emp" value="{{ $emp_data['tlp_emp'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="email_emp" class="col-md-2 control-label"> Email </label>
													<div class="col-md-8">
														<input autocomplete="off" type="email" name="email_emp" class="form-control" id="email_emp" data-error="Masukkan alamat email yang valid" value="{{ $emp_data['tlp_emp'] }}">
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="form-group">
													<label for="status_nikah" class="col-md-2 control-label"> Status Nikah </label>
													<div class="col-md-8">
														<select class="form-control" name="status_nikah" id="status_nikah">
															<option value="Belum Kawin" <?php if ($emp_data['status_nikah'] == "Belum Kawin"): ?> selected <?php endif ?> > Belum Kawin </option>
															<option value="Kawin" <?php if ($emp_data['status_nikah'] == "Kawin"): ?> selected <?php endif ?> > Kawin </option>
															<option value="Cerai Hidup" <?php if ($emp_data['status_nikah'] == "Cerai Hidup"): ?> selected <?php endif ?> > Cerai Hidup </option>
															<option value="Cerai Mati" <?php if ($emp_data['status_nikah'] == "Cerai Mati"): ?> selected <?php endif ?> > Cerai Mati </option>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="gol_darah" class="col-md-2 control-label"> Golongan Darah </label>
													<div class="col-md-8">
														<select class="form-control" name="gol_darah" id="gol_darah">
															<option value="A" <?php if ($emp_data['gol_darah'] == "A"): ?> selected <?php endif ?> > A </option>
															<option value="B" <?php if ($emp_data['gol_darah'] == "B"): ?> selected <?php endif ?> > B </option>
															<option value="AB" <?php if ($emp_data['gol_darah'] == "AB"): ?> selected <?php endif ?> > AB </option>
															<option value="O" <?php if ($emp_data['gol_darah'] == "O"): ?> selected <?php endif ?> > O </option>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="nm_bank" class="col-md-2 control-label"> Nama Bank </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="nm_bank" class="form-control" id="nm_bank" value="{{ $emp_data['nm_bank'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="cb_bank" class="col-md-2 control-label"> Cabang Bank </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="cb_bank" class="form-control" id="cb_bank" value="{{ $emp_data['cb_bank'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="an_bank" class="col-md-2 control-label"> Nama Rekening </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="an_bank" class="form-control" id="an_bank" value="{{ $emp_data['an_bank'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="nr_bank" class="col-md-2 control-label"> Nomor Rekening </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="nr_bank" class="form-control" id="nr_bank" value="{{ $emp_data['nr_bank'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="no_taspen" class="col-md-2 control-label"> Nomor Taspen </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="no_taspen" class="form-control" id="no_taspen" value="{{ $emp_data['no_taspen'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="npwp" class="col-md-2 control-label"> NPWP </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="npwp" class="form-control" id="npwp" value="{{ $emp_data['npwp'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="no_askes" class="col-md-2 control-label"> Nomor Askes </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="no_askes" class="form-control" id="no_askes" value="{{ $emp_data['no_askes'] }}">
													</div>
												</div>

												<div class="form-group">
													<label for="no_jamsos" class="col-md-2 control-label"> Nomor Jamsostek </label>
													<div class="col-md-8">
														<input autocomplete="off" type="text" name="no_jamsos" class="form-control" id="no_jamsos" value="{{ $emp_data['no_jamsos'] }}">
													</div>
												</div>
												
												<div class="form-group">
													<label for="idgroup" class="col-md-2 control-label"> Grup User </label>
													<div class="col-md-8">
														<select class="form-control select2" name="idgroup" id="idgroup">
															@foreach($idgroups as $idgroup)
																<option value="{{ $idgroup['idgroup'] }}" <?php if ($emp_data['idgroup'] == $idgroup['idgroup']): ?> selected <?php endif ?> > {{ $idgroup['idgroup'] }} </option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="filefoto" class="col-lg-2 control-label"> Upload Foto <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
													<div class="col-lg-8">
														<input type="file" class="form-control" id="filefoto" name="filefoto">
													</div>
												</div>

												<div class="form-group">
													<label for="filettd" class="col-lg-2 control-label"> Upload Tandatangan <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
													<div class="col-lg-8">
														<input type="file" class="form-control" id="filettd" name="filettd">
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<?php if ($emp_data	['foto'] && $emp_data['foto'] != '') : ?>
													<?php if ($emp_data['tampilnew'] == 1) : ?>
														<img src="/bpadwebs/public/publicimg/{{ $emp_data['foto'] }}" style="width: 100%; height: 100%;">
													<?php else : ?>
														<img src="http://bpad.jakarta.go.id/images/emp/{{ $emp_data['foto'] }}" style="width: 100%; height: 100%;">
													<?php endif ?>
												<?php endif ?>
											</div>
												
										</section>
										<section id="section-underline-2">
											<div class="form-group">
												<label for="iddik" class="col-md-2 control-label"> Pendidikan Terakhir </label>
												<div class="col-md-4">
													<select class="form-control" name="iddik" id="iddik">
														@foreach($pendidikans as $pendidikan)
															<option value="{{ $pendidikan['dik'] }}" <?php if ($emp_dik['iddik'] == $pendidikan['dik']): ?> selected <?php endif ?> > {{ $pendidikan['nm_dik'] }} </option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="prog_sek" class="col-md-2 control-label"> Program Studi </label>
												<div class="col-md-4">
													<input autocomplete="off" type="text" name="prog_sek" class="form-control" id="prog_sek" value="{{ $emp_dik['prog_sek'] }}">
												</div>
											</div>

											<div class="form-group">
												<label for="nm_sek" class="col-md-2 control-label"> Nama Lembaga </label>
												<div class="col-md-4">
													<input autocomplete="off" type="text" name="nm_sek" class="form-control" id="nm_sek" value="{{ $emp_dik['nm_sek'] }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 control-label"> Nomor / Tahun Ijazah </label>
												<div class="col-md-3">
													<input autocomplete="off" type="text" name="no_sek" class="form-control" id="no_sek" placeholder="Nomor Ijazah" value="{{ $emp_dik['no_sek'] }}">
												</div>
												<div class="col-md-1">
													<input autocomplete="off" type="text" name="th_sek" class="form-control" id="th_sek" placeholder="Tahun" value="{{ $emp_dik['th_sek'] }}">
												</div>
											</div>

											<div class="form-group">
												<label for="gelar" class="col-md-2 control-label"> Gelar </label>
												<div class="col-md-2">
													<input autocomplete="off" type="text" name="gelar_dpn_sek" class="form-control" id="gelar_dpn_sek" placeholder="Depan" value="{{ $emp_dik['gelar_dpn_sek'] }}">
												</div>
												<div class="col-md-2">
													<input autocomplete="off" type="text" name="gelar_blk_sek" class="form-control" id="gelar_blk_sek" placeholder="Belakang" value="{{ $emp_dik['gelar_blk_sek'] }}">
												</div>
											</div>

											<div class="form-group">
												<label for="ijz_cpns" class="col-md-2 control-label"> Ijazah CPNS </label>
												<div class="col-md-4">
													<select class="form-control" name="ijz_cpns" id="ijz_cpns">
														<option value="Y" <?php if ($emp_dik['ijz_cpns'] == "Y" ): ?> selected <?php endif ?> > Ada </option>
														<option value="T" <?php if ($emp_dik['ijz_cpns'] == "T" ): ?> selected <?php endif ?> > Tidak </option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="fileijazah" class="col-lg-2 control-label"> Upload Ijazah <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
												<div class="col-lg-4">
													<input type="file" class="form-control" id="fileijazah" name="fileijazah">
												</div>
											</div>
										</section>
										<section id="section-underline-3">
											<div class="form-group">
												<label class="col-md-2 control-label"> TMT Golongan </label>
												<div class="col-md-4">
													<input type="text" name="tmt_gol" class="form-control" id="datepicker-autoclose3" autocomplete="off" placeholder="mm/dd/yyyy" value="{{ date('d/m/Y', strtotime($emp_gol['tmt_gol'])) }}">
												</div>
											</div>

											<div class="form-group">
												<label for="no_sk_gol" class="col-md-2 control-label"> Nomor SK </label>
												<div class="col-md-4">
													<input autocomplete="off" type="text" name="no_sk_gol" class="form-control" id="no_sk_gol" value="{{ $emp_gol['no_sk_gol'] }}">
												</div>
											</div>

											<div class="form-group">
												<label for="tmt_sk_gol" class="col-md-2 control-label"> Tanggal SK </label>
												<div class="col-md-4">
													<input type="text" name="tmt_sk_gol" class="form-control" id="datepicker-autoclose4" autocomplete="off" placeholder="mm/dd/yyyy" value="{{ date('d/m/Y', strtotime($emp_gol['tmt_sk_gol'])) }}">
												</div>
											</div>

											<div class="form-group">
												<label for="idgol" class="col-md-2 control-label"> Golongan </label>
												<div class="col-md-4">
													<select class="form-control select2" name="idgol" id="idgol">
														@foreach($golongans as $golongan)
															<option value="{{ $golongan['gol'] }}" <?php if ($emp_gol['idgol'] == $golongan['gol'] ): ?> selected <?php endif ?> > {{ $golongan['gol'] }} - {{ $golongan['nm_pangkat'] }} </option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="jns_kp" class="col-md-2 control-label"> Jenis KP <br> <span style="font-size: 10px">KP (Kenaikan Pangkat)</span> </label>
												<div class="col-md-4">
													<select class="form-control" name="jns_kp" id="jns_kp">
														<option value="Reguler" <?php if ($emp_gol['jns_kp'] == "Reguler" ): ?> selected <?php endif ?> > Reguler </option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 control-label"> Masa Kerja </label>
												<div class="col-md-1">
													<input autocomplete="off" type="text" name="mk_thn" class="form-control intLimitTextBox" id="mk_thn" placeholder="Tahun" value="{{ $emp_gol['mk_thn'] }}">
												</div>
												<label for="tmt_sk_gol" class="col-md-1 control-label"> Tahun </label>
												<div class="col-md-1">
													<input autocomplete="off" type="text" name="mk_bln" class="form-control intLimitTextBox" id="mk_bln" placeholder="Bulan" value="{{ $emp_gol['mk_bln'] }}">
												</div>
												<label for="tmt_sk_gol" class="col-md-1 control-label"> Bulan </label>
											</div>

											<div class="form-group">
												<label for="fileskgol" class="col-lg-2 control-label"> Upload SK <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
												<div class="col-lg-4">
													<input type="file" class="form-control" id="fileskgol" name="fileskgol">
												</div>
											</div>
										</section>
										<section id="section-underline-4">
											<div class="form-group">
												<label for="jabatan" class="col-md-2 control-label"> Jabatan </label>
												<div class="col-md-4">
													<select class="form-control select2" name="jabatan" id="jabatan">
														@foreach($jabatans as $jabatan)
															<option value="{{ $jabatan['jns_jab'] }}||{{ $jabatan['jabatan'] }}" <?php if ($emp_jab['jns_jab'] . "||" . $emp_jab['idjab'] == $jabatan['jns_jab'] . "||" . $jabatan['jabatan'] ): ?> selected <?php endif ?> > {{ $jabatan['jabatan'] }} </option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="idunit" class="col-md-2 control-label"> Unit Organisasi </label>
												<div class="col-md-4">
													<select class="form-control select2" name="idunit" id="idunit">
														@foreach($units as $unit)
															<option value="{{ $unit['kd_unit'] }}" <?php if ($emp_jab['idunit'] == $unit['kd_unit'] ): ?> selected <?php endif ?> > {{ $unit['kd_unit'] }} - {{ $unit['nm_unit'] }}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="idlok" class="col-md-2 control-label"> Lokasi </label>
												<div class="col-md-4">
													<select class="form-control" name="idlok" id="idlok">
														@foreach($lokasis as $lokasi)
															<option value="{{ $lokasi['kd_lok'] }}" <?php if ($emp_jab['idlok'] == $lokasi['kd_lok'] ): ?> selected <?php endif ?> > {{ $lokasi['nm_lok'] }}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="eselon" class="col-md-2 control-label"> Golongan </label>
												<div class="col-md-4">
													<select class="form-control select2" name="eselon" id="eselon">
														@foreach($golongans as $golongan)
															<option value="{{ $golongan['gol'] }}" <?php if ($emp_jab['eselon'] == $golongan['gol'] ): ?> selected <?php endif ?> > {{ $golongan['gol'] }} - {{ $golongan['nm_pangkat'] }} </option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 control-label"> TMT Jabatan </label>
												<div class="col-md-4">
													<input type="text" name="tmt_jab" class="form-control" id="datepicker-autoclose5" autocomplete="off" placeholder="mm/dd/yyyy" value="{{ date('d/m/Y', strtotime($emp_jab['tmt_jab'])) }}">
												</div>
											</div>

											<div class="form-group">
												<label for="no_sk_jab" class="col-md-2 control-label"> No SK Jabatan </label>
												<div class="col-md-4">
													<input autocomplete="off" type="text" name="no_sk_jab" class="form-control" id="no_sk_jab" value="{{ $emp_jab['no_sk_jab'] }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 control-label"> Tanggal SK </label>
												<div class="col-md-4">
													<input type="text" name="tmt_sk_jab" class="form-control" id="datepicker-autoclose6" autocomplete="off" placeholder="mm/dd/yyyy" value="{{ date('d/m/Y', strtotime($emp_jab['tmt_sk_jab'])) }}">
												</div>
											</div>

											<div class="form-group">
												<label for="fileskjab" class="col-lg-2 control-label"> Upload SK <br> <span style="font-size: 10px">Hanya berupa JPG, JPEG, dan PNG</span> </label>
												<div class="col-lg-4">
													<input type="file" class="form-control" id="fileskjab" name="fileskjab">
												</div>
											</div>
											<button type="submit" class="btn btn-success pull-right"> Simpan </button>
											<!-- <button type="submit" class="btn btn-default pull-right m-r-10"> Kembali </button> -->
										</section>

								</div>
							</div>
						</div>
	
						<div class="panel panel-info">
							<div class="panel-heading">  
								
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
	<script src="{{ ('/bpadwebs/public/ample/js/cbpFWTabs.js') }}"></script>
	<script type="text/javascript">
		(function () {
				[].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
				new CBPFWTabs(el);
			});
		})();
	</script>
	<script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script>

		$(".select2").select2();

		(function($) {
		  $.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
			  if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			  } else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			  } else {
				this.value = "";
			  }
			});
		  };
		}(jQuery));

		$(".intLimitTextBox").inputFilter(function(value) {
			return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 99); 
		});

		jQuery('#datepicker-autoclose').datepicker({
			autoclose: true
			, todayHighlight: false
			, format: 'dd/mm/yyyy'
		});

		jQuery('#datepicker-autoclose2').datepicker({
			autoclose: true
			, todayHighlight: false
			, format: 'dd/mm/yyyy'
		});

		jQuery('#datepicker-autoclose3').datepicker({
			autoclose: true
			, todayHighlight: false
			, format: 'dd/mm/yyyy'
		});

		jQuery('#datepicker-autoclose4').datepicker({
			autoclose: true
			, todayHighlight: false
			, format: 'dd/mm/yyyy'
		});

		jQuery('#datepicker-autoclose5').datepicker({
			autoclose: true
			, todayHighlight: false
			, format: 'dd/mm/yyyy'
		});

		jQuery('#datepicker-autoclose6').datepicker({
			autoclose: true
			, todayHighlight: false
			, format: 'dd/mm/yyyy'
		});
	</script>

	
@endsection