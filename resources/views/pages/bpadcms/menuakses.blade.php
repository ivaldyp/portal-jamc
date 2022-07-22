@extends('layouts.master')

@section('css')
	<!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Setup</a></li>
              <li class="breadcrumb-item active">Menu</li>
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
              <div class="card-body p-0" >
                <form action="{{ url('/cms/form/ubahaccess') }}" method="POST">
                @csrf
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12">
                            <button class="btn btn-info pull-right">Simpan</button>
                            <a href="{{ url('/cms/menu') }}"><button type="button" class="m-r-10 btn btn-default pull-right">Kembali</button></a>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                        <div class="col-md-12">
                            
                            <div class="">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>view</th>
                                            <th>insert</th>
                                            <th>update</th>
                                            <th>delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="idtop" value="{{ $now_idtop }}"> 
                                        <input type="hidden" name="desk" value="{{ $now_desk }}"> 
                                    @foreach($accesses as $acc)
                                        <tr>
                                            <td>{{ $acc['idgroup'] }}</td>
                                            <td><input type="checkbox" name="zviw[]" <?php if ($acc['zviw'] == 'y'): ?> checked <?php endif ?> value="{{ $acc['idgroup'] }}" ></td>
                                            <td><input type="checkbox" name="zadd[]" <?php if ($acc['zadd'] == 'y'): ?> checked <?php endif ?> value="{{ $acc['idgroup'] }}" ></td>
                                            <td><input type="checkbox" name="zupd[]" <?php if ($acc['zupd'] == 'y'): ?> checked <?php endif ?> value="{{ $acc['idgroup'] }}" ></td>
                                            <td><input type="checkbox" name="zdel[]" <?php if ($acc['zdel'] == 'y'): ?> checked <?php endif ?> value="{{ $acc['idgroup'] }}" ></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12">
                            <button class="btn btn-info pull-right">Simpan</button>
                            <a href="{{ url()->previous() }}"><button type="button" class="m-r-10 btn btn-default pull-right">Kembali</button></a>
                        </div>
                    </div>
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
	<!-- AdminLTE App -->
	<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('lte/dist/js/demo.js') }}"></script>

  <script>
		$(function () {
			
		});
	</script>
@endsection