@extends('layouts.masterhome' )

@section('css')
    <!-- Bootstrap Core CSS -->
    <link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ ('/bpadwebs/public/ample/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css') }}" />
    <!-- animation CSS -->
    <link href="{{ ('/bpadwebs/public/ample/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ ('/bpadwebs/public/ample/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ ('/bpadwebs/public/ample/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
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
                                                echo ucwords($link[4]);
                                            ?> </h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                    <ol class="breadcrumb">
                        <li>{{config('app.name')}}</li>
                        <?php 
                            $link = explode("/", url()->full());
                            if (count($link) == 5) {
                                ?> 
                                    <li class="active"> {{ ucwords($link[4]) }} </li>
                                <?php
                            } elseif (count($link) == 6) {
                                ?> 
                                    <li class="active"> {{ ucwords($link[4]) }} </li>
                                    <?php 
                                        $backlink = explode("?", $link[5]);
                                    ?>
                                    <li class="active"> {{ str_replace('%20', ' ', ucwords($backlink[0])) }} </li>
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
            <div class="row ">
                <div class="col-md-12">
                    <!-- <div class="white-box"> -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Tambah Konten</div>
                            <form class="form-horizontal" method="POST" action="/bpadwebs/cms/form/tambahcontent" data-toggle="validator" enctype="multipart/form-data">
                            @csrf   
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <input type="hidden" name="idkat" value="{{ $idkat }}">
                                        <input type="hidden" name="contentnew" value="1">
                                        <input type="hidden" name="thits" value="0">
                                        <input type="hidden" name="likes" value="0">
                                        <input type="hidden" name="kd_cms" value="1.20.512">
                                        <input type="hidden" name="appr" value="N">
                                        <input type="hidden" name="usrinput" value="{{ isset(Auth::user()->id_emp) ? Auth::user()->id_emp : Auth::user()->usname }}">

                                        <div class="form-group">
                                            <label for="subkat" class="col-md-2 control-label"><span style="color: red">*</span> Subkategori </label>
                                            <div class="col-md-8">
                                                <select class="form-control select2" name="subkat" id="subkat" required>
                                                    @foreach($subkats as $subkat)
                                                        <option value="{{ $subkat['subkat'] }}"> {{ $subkat['subkat'] }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="berita">
                                            <div class="form-group">
                                                <label for="tanggal" class="col-md-2 control-label"> Waktu </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off" data-error="Masukkan tanggal" value="{{ now('Asia/Jakarta') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="judul" class="col-md-2 control-label"><span style="color: red">*</span> Judul </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="judul" name="judul" autocomplete="off" data-error="Masukkan judul" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tfile" class="col-lg-2 control-label"><span style="color: red">*</span> Upload Foto <br> <span style="font-size: 10px">Hanya berupa PDF, JPG, JPEG, dan PNG</span> </label>
                                                <div class="col-lg-8">
                                                    <input type="file" class="form-control" id="tfile" name="tfile" required>
                                                </div>
                                            </div>
                                            @if($idkat == 1)
                                            <div class="form-group">
                                                <label for="isi1" class="col-md-2 control-label"> Ringkasan </label>
                                                <div class="col-md-8">
                                                    <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..." name="isi1"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="isi2" class="col-md-2 control-label"> Isi </label>
                                                <div class="col-md-8">
                                                    <textarea class="textarea_editor2 form-control" rows="15" placeholder="Enter text ..." name="isi2"></textarea>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="editor" class="col-md-2 control-label"> Editor </label>
                                                <div class="col-md-8">
                                                    <input disabled type="text" class="form-control" id="editor" name="editor" autocomplete="off" value="{{ isset($_SESSION['user_data']['nm_emp']) ? $_SESSION['user_data']['nm_emp'] : (isset($_SESSION['user_data']['nama_user']) ? $_SESSION['user_data']['nama_user'] : $_SESSION['user_data']['usname']) }}">
                                                    <input type="hidden" class="form-control" id="editor" name="editor" autocomplete="off" value="{{ isset($_SESSION['user_data']['nm_emp']) ? $_SESSION['user_data']['nm_emp'] : (isset($_SESSION['user_data']['nama_user']) ? $_SESSION['user_data']['nama_user'] : $_SESSION['user_data']['usname']) }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"> Suspend? </label>
                                                <div class="radio-list col-md-8">
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="sts" id="sts1" value="0" data-error="Pilih salah satu">
                                                            <label for="sts1">Ya</label> 
                                                        </div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="sts" id="sts2" value="1" checked>
                                                            <label for="sts2">Tidak</label>
                                                        </div>
                                                    </label>
                                                    <div class="help-block with-errors"></div>  
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <input type="hidden" name="contentnew" value="1">
                                    </div>
                                    <div class="panel-footer">
                                        <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                        <!-- <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Kembali</button> -->
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </form>
                        </div>

                        
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- jQuery -->
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
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ ('/bpadwebs/public/ample/js/validator.js') }}"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
            $('.textarea_editor2').wysihtml5();
        });
    </script>


    <script>
        $(document).ready(function() {
            $(".select2").select2();

            $( "#idgroup" ).click(function() {
                var idkat = $( this ).val();
                $(".subkat-"+idkat).attr('display', 'none');
                // $('.subkat-'+idkat).hide();
            });


        });
    </script>
@endsection