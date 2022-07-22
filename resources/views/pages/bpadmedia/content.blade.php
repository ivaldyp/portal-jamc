@extends('layouts.master')

@section('css')
	<!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
  <input type="hidden" id="activemenus" value="{{ $activemenus }}">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Content</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Media</a></li>
              <li class="breadcrumb-item active">Content</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @include('layouts.komponen.flash-message')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if ($access['zadd'] == 'y')
                <div class="">
                    <button class="btn btn-info btn-href-tambah" type="button" data-toggle="modal" data-target="#modal-insert">Tambah</button>
                    <button class="float-right btn btn-danger btn-href-rekap" type="button" data-toggle="modal" data-target="#modal-rekap" style="margin-left: 10px;">Rekap PDF</button>
                    <button class="float-right btn btn-success btn-href-excel" type="button" data-toggle="modal" data-target="#modal-excel" style="margin-left: 10px;">Rekap Excel</button>
                </div>
                @endif
                <div class="row" style="margin-top: 10px;">
                    <form class="form-horizontal col-12" method="GET" action="{{ url('/media/content') }}">
                        <div class="row col-6 p-10" style="padding-top: 10px;">
                            <div class="col-6 p-t-10">
                                <label for="katnow" class="control-label" style="justify-content: left;"> Tipe </label>
                                <select class="form-control" name="katnow" id="katnow" required onchange="this.form.submit()">
                                <?php foreach ($kategoris as $key => $kategori) { ?>
                                    <option value="{{ $kategori['ids'] }}" 
                                    <?php 
                                        if ($katnow == $kategori['ids']) {
                                            echo "selected";
                                        }
                                    ?>
                                    >{{ $kategori['nmkat'] }} ({{ $kategori['total'] }})</option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-6 p-t-10">
                                <label for="suspnow" class="control-label"> Suspend </label>
                                <select class="form-control" name="suspnow" id="suspnow" onchange="this.form.submit()">
                                    <option value="N" <?php if ($suspnow == 'N') { echo "selected"; } ?> >Tidak</option>
                                    <option value="Y" <?php if ($suspnow == 'Y') { echo "selected"; } ?> >Ya</option>
                                </select>
                            </div>
                        </div>
                        <div class="row col-6 p-10" style="padding-top: 10px;">
                            <div class="col-4">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <label for="yearnow" class="control-label"> Tahun </label>
                                <select class="form-control" name="yearnow" id="yearnow" onchange="this.form.submit()">
                                    <option <?php if ($yearnow == (int)date('Y')): ?> selected <?php endif ?> value="{{ (int)date('Y') }}">{{ (int)date('Y') }}</option>
                                    <option <?php if ($yearnow == (int)date('Y') - 1): ?> selected <?php endif ?> value="{{ (int)date('Y') - 1 }}">{{ (int)date('Y') - 1 }}</option>
                                    <option <?php if ($yearnow == (int)date('Y') - 2): ?> selected <?php endif ?> value="{{ (int)date('Y') - 2 }}">{{ (int)date('Y') - 2 }}</option>
                                    <option <?php if ($yearnow == (int)date('Y') - 3): ?> selected <?php endif ?> value="{{ (int)date('Y') - 3 }}">{{ (int)date('Y') - 3 }}</option>
                                    <option <?php if ($yearnow == (int)date('Y') - 4): ?> selected <?php endif ?> value="{{ (int)date('Y') - 4 }}">{{ (int)date('Y') - 4 }}</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="signnow" class="control-label"> Sign </label>
                                <select class="form-control" name="signnow" id="signnow" onchange="this.form.submit()">
                                    <option <?php if ($signnow == "="): ?> selected <?php endif ?> value="=">=</option>
                                    <option <?php if ($signnow == ">="): ?> selected <?php endif ?> value=">=">>=</option>
                                    <option <?php if ($signnow == "<="): ?> selected <?php endif ?> value="<="><=</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="monthnow" class="control-label"> Bulan </label>
                                <select class="form-control" name="monthnow" id="monthnow" onchange="this.form.submit()">
                                    @php
                                    $months = 1
                                    @endphp

                                    @for($i=$months; $i<=12; $i++)
                                        @php
                                            $dateObj   = DateTime::createFromFormat('!m', $i);
                                            $monthname = $dateObj->format('F');
                                        @endphp
                                        <option <?php if ($monthnow == $i): ?> selected <?php endif ?> value="{{ $i }}">{{ $monthname }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <table id="datatable" class="table table-sm">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Suspend</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Editor</th>
                        <th>File</th>
                        {{-- @if($katnowdetail['nama'] == 'berita' || $katnowdetail['nama'] == 'lelang' )
                        <th>Headline</th>
                        @endif --}}
                        <th>Approved</th>
                        <th>Create Date</th>
                        @if($access['zupd'] == 'y' || $access['zdel'] == 'y')
                        <th class="col-md-1">Action</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($contents as $key => $content)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{!! ($content['suspend']) == 'Y' ? '<i style="color:green;" class="fa fa-check"></i>' : '<i style="color:red;" class="fa fa-times"></i>' !!}</td>
                        <td>
                            {{ date('d/M/Y', strtotime(str_replace('/', '-', $content['tanggal']))) }}
                            <!-- <br>
                            <span class="text-muted">{{ date('H:i:s', strtotime($content['tanggal'])) }}</span> -->
                        </td>
                        <td>{{ $content['subkat'] }}</td>
                        <td>{{ $content['judul'] }}</td>
                        <td>{{ $content['editor'] }}</td>
                        <td>
                            @if(strtolower($content['nmkat']) == 'berita')
                                <?php if (file_exists(config('app.openfileimgberita') . $content['tfile'])) { ?>
                                <a target="_blank" href="{{ config('app.openfileimgberitafull') }}/{{ $content['tfile'] }}"> {{ $content['tfile'] }}</a>
                                <?php } else { echo "[Gambar tidak ditemukan]"; } ?>
                            @elseif(strtolower($content['nmkat']) == 'galeri foto')
                                <?php if (file_exists(config('app.openfileimggambar') . $content['tfile'])) { ?>
                                <a target="_blank" href="{{ config('app.openfileimggambarfull') }}/{{ $content['tfile'] }}"> {{ $content['tfile'] }}</a>
                                <?php } else { echo "[Gambar tidak ditemukan]"; } ?>
                            @elseif(strtolower($content['nmkat']) == 'lelang')
                                <?php if (file_exists(config('app.openfileimglelang') . $content['tfile'])) { ?>
                                <a target="_blank" href="{{ config('app.openfileimglelangfull') }}/{{ $content['tfile'] }}"> {{ $content['tfile'] }}</a>
                                <?php } else { echo "[Gambar tidak ditemukan]"; } ?>
                            @elseif(strtolower($content['nmkat']) == 'infografik')
                                <?php if (file_exists(config('app.openfileimginfografik') . $content['tfile'])) { ?>
                                <a target="_blank" href="{{ config('app.openfileimginfografikfull') }}/{{ $content['tfile'] }}"> {{ $content['tfile'] }}</a>	
                                <?php } else { echo "[Gambar tidak ditemukan]"; } ?>
                            @endif
                        </td>
                        {{-- @if($katnowdetail['nama'] == 'berita' || $katnowdetail['nama'] == 'lelang' )
                        <td>
                            @if($content['tipe'] == 'H,')
                            <i style="color:green;" class="fa fa-check"></i><br><span style="color: white;">1</span>
                            @else
                            <i style="color:red;" class="fa fa-times"></i><br><span style="color: white;">0</span>
                            @endif
                        </td>
                        @endif --}}
                        <td>
                            {!! ($content['appr']) == 'Y' ? 
                                '<i style="color:green;" class="fa fa-check"></i><br><span style="color: white;">1</span>' : 
                                '<i style="color:red;" class="fa fa-times"></i><br><span style="color: white;">0</span>' !!}
                        </td>
                        <td>
                            {{ date('d/M/Y', strtotime(str_replace('/', '-', $content['tgl']))) }}
                        </td>
                        @if($access['zupd'] == 'y' || $access['zdel'] == 'y')
                            <td>
                                <div class="btn-group">
                                    <form method="POST" action="{{ url('/media/ubah content') }}" target="_blank">
                                        @csrf
                                        @if($access['zupd'] == 'y')
                                            
                                            <input type="hidden" name="ids" value="{{ $content['ids'] }}">
                                            <input type="hidden" name="idkat" value="{{ $content['idkat'] }}">
                                            <button type="submit" class="btn btn-info btn-update"><i class="fa fa-pen"></i></button>
                                            
                                        @endif
                                        @if($access['zdel'] == 'y')
                                            <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-ids="{{ $content['ids'] }}" data-judul="{{ $content['judul'] }}" data-idkat="{{ $content['idkat'] }}"><i class="fa fa-trash"></i></button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        <div id="modal-insert" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="GET" action="{{ url('/media/tambah content') }}" class="form-horizontal" data-toggle="validator">
                    @csrf
                        <div class="modal-header">
                            <h4 class="modal-title"><b>Pilih Kategori</b></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kat" class="col-md-2 control-label"><span style="color: red">*</span> Tipe </label>
                                <div class="col-md-12">
                                    <select class="form-control select2" name="kat" id="kat" required>
                                        @foreach($kategoris as $kategori)
                                            <option <?php if ($kategori['ids'] == $katnow ): ?> selected <?php endif ?> value="{{ $kategori['ids'] }}">{{ $kategori['nmkat'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success pull-right">Pilih</button>
                            <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
  
  @section('js')
	<!-- jQuery -->
	<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
  @include('layouts.komponen.activate-menu')

  <script>
		$(function () {

			$('.btn-delete').on('click', function () {
				var $el = $(this);

				$("#label_delete").append('Apakah anda yakin ingin menghapus group user <b>' + $el.data('usname') + '</b>?');
				$("#modal_delete_usname").val($el.data('usname'));
				$("#modal_delete_ids").val($el.data('ids'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

            $('#datatable').DataTable();
		});
	</script>
@endsection