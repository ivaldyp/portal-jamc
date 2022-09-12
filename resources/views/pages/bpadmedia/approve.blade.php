@extends('layouts.master')

@section('css')
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

    <style>
        .ver-align-mid{
            vertical-align: middle !important;
        }
    </style>
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
            <h1>Approval Content</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Media</a></li>
              <li class="breadcrumb-item active">Setup Approval</li>
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
              <!-- /.card-header -->
              <div class="card-body" >
                <p style="color: red">Approved By: 
                @if(!(is_null($approveds)))
                {{ $approveds }}
                @endif
                </p>
                <form method="POST" action="{{ url('/media/form/approve') }}" class="form-horizontal">
                @csrf
                    <div class="form-group">
                        <label for="approvepeg" class="col-md-12 control-label"> Pegawai<br><span class="text-muted">*Refresh halaman apabila yang dicari tidak ditemukan</span> </label>
                        <div class="">
                            <select class="col-md-12 select2 m-b-10 select2-multiple" multiple="multiple" name="approve[]" id="approvepeg">
                                @foreach($pegawai1 as $key => $peg)
                                    <option value="{{ $peg['id_emp'] }}"> {{ $peg['id_emp'] }} - {{ $peg['nm_emp'] }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-info">
                        Simpan
                    </button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
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
    <!-- Select2 -->
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
	<!-- bs-custom-file-input -->
	<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
    @include('layouts.komponen.activate-menu')

    <script>
        $(function () {
            $('.select2').select2()
        });
    </script>
@endsection