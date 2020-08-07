<!-- Bootstrap Core CSS -->
<link href="{{ ('/portal/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

<div class="container jumbotron">
	<div class="col-md-6">
		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr>
						<td>No Form</td>
						<td>{{ $dispmaster['no_form'] }}</td>
					</tr>
					<tr>
						<td>Kode Surat</td>
						<td>{{ $dispmaster['kd_surat'] }}</td>
					</tr>
					<tr>
						<td>Tipe</td>
						<td>{{ $dispmaster['catatan_final'] ?? 'Surat' }}</td>
					</tr>
					<tr>
						<td>Tanggal Masuk</td>
						<td>{{ date('d-M-Y', strtotime($dispmaster['tgl_masuk'])) }}</td>
					</tr>
					<tr>
						<td>No Index</td>
						<td>{{ $dispmaster['no_index'] ?? '-' }}</td>
					</tr>
					<tr>
						<td>Kode Disposisi</td>
						<td>{{ $dispmaster['kode_disposisi'] }}</td>
					</tr>
					<tr>
						<td>Nomor & Tgl Surat</td>
						<td>{{ $dispmaster['no_surat'] ?? '-' }} <br>
						{{ $dispmaster['tgl_surat'] ?? '-' }}</td>
					</tr>
					<tr>
						<td>Perihal</td>
						<td>{{ $dispmaster['perihal'] }}</td>
					</tr>
					<tr>
						<td>Dari</td>
						<td>{{ $dispmaster['asal_surat'] }}</td>
					</tr>
					<tr>
						<td>Kepada</td>
						<td>{{ $dispmaster['kepada_surat'] }}</td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>{{ $dispmaster['no_form'] }}</td>
					</tr>
					<tr>
						<td>Sifat</td>
						<td>{{ $dispmaster['sifat1_surat'] }} {{ $dispmaster['sifat2_surat'] ? ' - '.$dispmaster['sifat2_surat'] : '' }}</td>
					</tr>
					<tr>
						<td>Keterangan</td>
						<td>{{ $dispmaster['ket_lain'] }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<div class="table-responsive">
			<table>
				<tbody>
					{!! $treedisp !!}
				</tbody>
			</table>
		</div>
	</div>
</div>



