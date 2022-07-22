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
            <h1>Manage User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Security</a></li>
              <li class="breadcrumb-item active">Manage User</li>
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
                <a href="/{{ config('app.name') }}/security/tambah user">
                    <button class="btn btn-info btn-sm btn-insert">Tambah User</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <table id="datatable" class="table table-sm">
                  <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Email</th>
                        <th>Idgroup</th>
                        <th>Created At</th>
                        @if($access['zupd'] == 'y' || $access['zdel'] == 'y')
                        <th class="col-md-2">Action</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user['usname'] }}</td>
                            <td>{{ (!($user['nama_user']) ? '-' : $user['nama_user']) }}</td>
                            <td>{{ (!($user['deskripsi_user']) ? '-' : $user['deskripsi_user']) }}</td>
                            <td>{{ (!($user['email_user']) ? '-' : $user['email_user']) }}</td>
                            <td>{{ $user['idgroup'] }}</td>
                            <td>{{ (!($user['createdate']) ? '-' : date('d/M/Y', strtotime(str_replace('/', '-', $user['createdate'])))) }}</td>
                            @if($access['zupd'] == 'y' || $access['zdel'] == 'y')
                            <td>
                                @if($access['zupd'] == 'y')
                                <a href="/{{ config('app.name') }}/security/ubah user?ids={{ $user['ids'] }}">
                                    <button type="button" class="btn btn-info btn-update" data-toggle="modal" data-target="#modal-update" data-ids="{{ $user['ids'] }}" data-usname="{{ $user['usname'] }}" data-idgroup="{{ $user['idgroup'] }}" data-nama_user="{{ $user['nama_user'] }}" data-deskripsi_user="{{ $user['deskripsi_user'] }}" data-email_user="{{ $user['email_user'] }}"><i class="fa fa-edit"></i></button>
                                </a>
                                <button type="button" class="btn btn-warning btn-password" data-toggle="modal" data-target="#modal-password-{{$key}}"><i class="fa fa-key"></i></button>
                                @endif
                                @if($access['zdel'] == 'y')
                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-usname="{{ $user['usname'] }}" data-ids="{{ $user['ids'] }}"><i class="fa fa-trash"></i></button>
                                @endif
                                <div id="modal-password-{{$key}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg ">
                                        <div class="modal-content">
                                            <form method="POST" action="/{{ config('app.name') }}/security/form/ubahpassuser" class="form-horizontal">
                                            @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><b>Ubah Password</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Masukkan password baru  </h4>

                                                    <input type="hidden" name="ids" value="{{ $user['ids'] }}">
                                                    <input type="hidden" name="usname" value="{{ $user['usname'] }}">

                                                    <div class="form-group row col-md-12">
                                                        <label for="idunit" class="col-md-2 col-form-label"> Password </label>
                                                        <div class="col-md-8">
                                                            <input autocomplete="off" type="text" name="passmd5" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
                                                    <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

          <div id="modal-delete" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="POST" action="{{ url('security/form/hapususer') }}" class="form-horizontal">
                @csrf
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Grup User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p id="label_delete"></p>
                    <input type="hidden" name="usname" id="modal_delete_usname" value="">
                    <input type="hidden" name="ids" id="modal_delete_ids" value="">
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
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