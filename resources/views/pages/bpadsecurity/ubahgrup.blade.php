@extends('layouts.masterhome')

@section('css')
    <!-- Bootstrap Core CSS -->
    <link href="{{ ('/bpadwebs/public/ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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
                            } elseif (count($link) > 5) {
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
            <div class="row ">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">Hak Akses: {{ $pagename }}</h3> 
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Nama</th>
                                        <th>zviw</th>
                                        <th>zadd</th>
                                        <th>zupd</th>
                                        <th>zdel</th>
                                        <th>zapr</th>
                                        <th>zket</th>
                                        @if($access['zupd'] == 'y' && $access['zdel'] == 'y')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                {!! $menus !!}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-update" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="/bpadwebs/security/form/ubahgrup" class="form-horizontal">
                        @csrf
                            <div class="modal-header">
                                <h4 class="modal-title"><b>Ubah Data</b></h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="idtop" id="modal_update_idtop">
                                <input type="hidden" name="idgroup" id="modal_update_idgroup">
                                <!-- <div class="form-group">
                                    <label for="modal_update_usertype_name" class="col-lg-3 control-label"> Jenis Pengguna </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="userType_name" id="modal_update_usertype_name" class="form-control" autocomplete="off">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label for="modal_update_zviw" class="col-sm-3 control-label"> View </label>
                                    <div class="col-sm-1">
                                        <label><input type="checkbox" name="zviw" value="1" id="modal_update_zviw" style="width: 30px; height: 30px; top: 0px"></label>
                                        <label><input type="hidden" name="zviw_hidden" value="0" id="modal_update_zviw_hidden" style="width: 30px; height: 30px; top: 0px"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modal_update_zadd" class="col-sm-3 control-label"> Add </label>
                                    <div class="col-sm-1">
                                        <label><input type="checkbox" name="zadd" value="1" id="modal_update_zadd" style="width: 30px; height: 30px; top: 0px"></label>
                                        <label><input type="hidden" name="zadd_hidden" value="0" id="modal_update_zadd_hidden" style="width: 30px; height: 30px; top: 0px"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modal_update_zupd" class="col-sm-3 control-label"> Update </label>
                                    <div class="col-sm-1">
                                        <label><input type="checkbox" name="zupd" value="1" id="modal_update_zupd" style="width: 30px; height: 30px; top: 0px"></label>
                                        <label><input type="hidden" name="zupd_hidden" value="0" id="modal_update_zupd_hidden" style="width: 30px; height: 30px; top: 0px"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modal_update_zdel" class="col-sm-3 control-label"> Delete </label>
                                    <div class="col-sm-1">
                                        <label><input type="checkbox" name="zdel" value="1" id="modal_update_zdel" style="width: 30px; height: 30px; top: 0px"></label>
                                        <label><input type="hidden" name="zdel_hidden" value="0" id="modal_update_zdel_hidden" style="width: 30px; height: 30px; top: 0px"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="modal_update_zapr" class="col-sm-3 control-label"> Special </label>
                                    <div class="col-sm-1">
                                        <label><input type="checkbox" name="zapr" value="1" id="modal_update_zapr" style="width: 30px; height: 30px; top: 0px"></label>
                                        <label><input type="hidden" name="zapr_hidden" value="0" id="modal_update_zapr_hidden" style="width: 30px; height: 30px; top: 0px"></label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 
            <span>&copy; Copyright <?php echo date('Y'); ?> BPAD DKI Jakarta.</span></span></a>
        </footer>
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
    <script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
        $(function () {
            $('.btn-update').on('click', function () {
                var $el = $(this);
                
                $("#modal_update_idtop").val($el.data('ids'));
                $("#modal_update_idgroup").val($el.data('idgroup'));

                if ($el.data('zviw') == 'y') {
                    $("#modal_update_zviw").prop("checked", true);
                }

                if ($el.data('zadd') == 'y') {
                    $("#modal_update_zadd").prop("checked", true);
                }

                if ($el.data('zupd') == 'y') {
                    $("#modal_update_zupd").prop("checked", true);
                }

                if ($el.data('zdel') == 'y') {
                    $("#modal_update_zdel").prop("checked", true);
                }

                if ($el.data('zapr') == 'y') {
                    $("#modal_update_zapr").prop("checked", true);
                }


                // alert($el.data('idgroup'));
            });
        });
    </script>
@endsection