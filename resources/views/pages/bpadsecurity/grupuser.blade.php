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
            <h1>Grup User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Setup</a></li>
              <li class="breadcrumb-item active">Grup User</li>
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
                <button class="btn btn-info btn-sm btn-insert" data-toggle="modal" data-target="#modal-insert">Tambah Grup User</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <table id="datatable" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Grup User</th>
                        @if($access['zupd'] == 'y' || $access['zdel'] == 'y')
                        <th>Action</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($groups as $key => $group)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $group['idgroup'] }}</td>
                        @if($access['zupd'] == 'y' || $access['zdel'] == 'y')
                        <th>
                            @if($access['zupd'] == 'y')
                            <a href="/{{ config('app.name') }}/security/group user/ubah?name={{ $group['idgroup'] }}">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i></button>
                            </a>
                            @endif
                            @if($access['zdel'] == 'y')
                            <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-idgroup="{{ $group['idgroup'] }}"><i class="fa fa-trash"></i></button>
                            @endif    
                        </th>
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

          <div id="modal-insert" class="modal fade" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <form method="POST" action="{{ url('security/form/tambahgrup') }}" class="form-horizontal" data-toggle="validator">
                @csrf
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah Grup User</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <label for="idgroup" class="col-md-3 control-label"><span style="color: red">*</span> Nama Grup User </label>
                      <div class="col-md-9">
                        <input type="text" name="idgroup" id="modal_insert_idgroup" class="form-control" data-error="Masukkan idgroup" autocomplete="off" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                    <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div id="modal-delete" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="POST" action="{{ url('security/form/hapusgrup') }}" class="form-horizontal">
                @csrf
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Grup User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p id="label_delete"></p>
                    <input type="hidden" name="idgroup" id="modal_delete_idgroup" value="">
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

				$("#label_delete").append('Apakah anda yakin ingin menghapus group user <b>' + $el.data('idgroup') + '</b>?');
				$("#modal_delete_idgroup").val($el.data('idgroup'));
			});

			$("#modal-delete").on("hidden.bs.modal", function () {
				$("#label_delete").empty();
			});

            $('#datatable').DataTable();
		});
	</script>
@endsection