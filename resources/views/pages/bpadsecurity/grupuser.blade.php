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
                            } elseif (count($link) == 6) {
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
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="white-box">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">No</th>
                                        <th>Grup User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $key => $group)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $group['idgroup'] }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
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
        $(document).ready(function() {
            var menus = <?php echo json_encode($sec_menu) ?>;
            var menus_child = <?php echo json_encode($sec_menu_child) ?>;

            var third_child = [];
            
            $.each( menus, function( i, menu ) {
                // $('.ulmenu').append( "<li> <a href='#' class='waves-effect'><i class=''></i> <span class='hide-menu'>menu</span></a> </li>");
                if (menu['child'] == 0) {
                    $('.ulmenu').append( '<li class="'+ menu['ids'] +'"> <a href="#" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'+ menu['desk'] +'</span></a> </li>');
                } else  {
                    $('.ulmenu').append( 
                        '<li class="'+ menu['ids'] +'"> <a href="'+ menu['urlnew'] +'" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'+ menu['desk'] +'<span class="fa arrow"></span></span></a>'+
                        '<ul class="nav nav-second-level second'+ menu['ids'] +'">'
                        );
                }
            });

            $.each (menus_child, function(i, child) {
                if ($(".ulmenu li .nav-second-level").hasClass('second' + child['sao'])) {
                    if (child['child'] == 0) {
                        $('.second' + child['sao']).append( '<li class="'+ child['ids'] +'"> <a href="'+ child['urlnew'] +'" class="waves-effect"><i class="fa-fw"></i> <span class="hide-menu">'+ child['desk'] +'</span></a></li>');
                    } else  {
                        $('.second' + child['sao']).append( 
                            '<li class="'+ child['ids'] +'"> <a href="'+ child['urlnew'] +'" class="waves-effect"><i class="fa-fw"></i> <span class="hide-menu">'+ child['desk'] +'<span class="fa arrow"></span></span></a>' +
                            '<ul class="nav nav-third-level third'+child['ids']+'">');
                    }
                } else {
                    third_child.push(child['ids']);
                }
                
            });

            $.each (menus_child, function(i, child) {
                if ($.inArray(child['ids'], third_child) >= 0) {
                    $('.third' + child['sao']).append( '<li class="'+ child['ids'] +'"> <a href="'+ child['urlnew'] +'" class="waves-effect"><i class="fa-fw"></i> <span class="hide-menu">'+ child['desk'] +'</span></a>');
                }    
            });

            // if ($(".ulmenu li .nav-second-level li .nav-third-level").hasClass("third334")) {
            //     console.log("WAW");
            // }
        });
    </script>
@endsection