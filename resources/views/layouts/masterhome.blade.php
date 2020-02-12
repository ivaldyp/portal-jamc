<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.komponen.head')
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.html">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="../plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="../plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="../plugins/images/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="../plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    @include('layouts.komponen.profilepic')
                </ul>
                <ul class="nav navbar-top-links navbar-left pull-right">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                    @include('layouts.komponen.notification')
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menu</span></h3> 
                </div>
                <ul class="nav ulmenu" id="side-menu">
                    <!-- @include('layouts.komponen.menu', [$sec_menu, $sec_menu_child]) -->
                    <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-checkbox-multiple-marked-outline fa-fw"></i> <span class="hide-menu">Multi-Level Dropdown<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="javascript:void(0)"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Second Level Item</span></a> </li>
                            <li> <a href="javascript:void(0)"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Second Level Item</span></a> </li>
                            <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Third Level </span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">T</i><span class="hide-menu">Third Level Item</span></a> </li>
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">M</i><span class="hide-menu">Third Level Item</span></a> </li>
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">R</i><span class="hide-menu">Third Level Item</span></a> </li>
                                    <li> <a href="javascript:void(0)"><i class=" fa-fw">G</i><span class="hide-menu">Third Level Item</span></a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <li class="devider"></li>


                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        
        @yield('content')

        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    @include('layouts.komponen.js')
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="{{ ('/bpadwebs/public/ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ ('/bpadwebs/public/ample/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ ('/bpadwebs/public/ample/js/waves.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ ('/bpadwebs/public/ample/js/custom.min.js') }}"></script>
    <!--Style Switcher -->
    <script src="{{ ('/bpadwebs/public/ample/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>

    <script>
        $(document).ready(function() {
            var menus = <?php echo json_encode($sec_menu) ?>;
            var menus_child = <?php echo json_encode($sec_menu_child) ?>;

            var third_child = [];
            
            $.each( menus, function( i, menu ) {
                // $('.ulmenu').append( "<li> <a href='#' class='waves-effect'><i class=''></i> <span class='hide-menu'>menu</span></a> </li>");
                if (menu['child'] == 0) {
                    $('.ulmenu').append( '<li class="'+ menu['ids'] +'"> <a href="javascript:void(0)" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'+ menu['desk'] +'</span></a> </li>');
                } else  {
                    $('.ulmenu').append( 
                        '<li class="'+ menu['ids'] +'"> <a href="javascript:void(0)" class="waves-effect"><i class="fa fa-check fa-fw"></i> <span class="hide-menu">'+ menu['desk'] +'<span class="fa arrow"></span></span></a>'+
                        '<ul class="nav nav-second-level second'+ menu['ids'] +'">'
                        );
                }
            });

            $.each (menus_child, function(i, child) {
                if ($(".ulmenu li .nav-second-level").hasClass('second' + child['sao'])) {
                    if (child['child'] == 0) {
                        $('.second' + child['sao']).append( '<li class="'+ child['ids'] +'"> <a href="javascript:void(0)" class="waves-effect"><i class="fa-fw"></i> <span class="hide-menu">'+ child['desk'] +'</span></a></li>');
                    } else  {
                        $('.second' + child['sao']).append( 
                            '<li class="'+ child['ids'] +'"> <a href="javascript:void(0)" class="waves-effect"><i class="fa-fw"></i> <span class="hide-menu">'+ child['desk'] +'<span class="fa arrow"></span></span></a>' +
                            '<ul class="nav nav-third-level third'+child['ids']+'">');
                    }
                } else {
                    third_child.push(child['ids']);
                }
                
            });

            $.each (menus_child, function(i, child) {
                if ($.inArray(child['ids'], third_child) >= 0) {
                    $('.third' + child['sao']).append( '<li class="'+ child['ids'] +'"> <a href="javascript:void(0)" class="waves-effect"><i class="fa-fw"></i> <span class="hide-menu">'+ child['desk'] +'</span></a>');
                }    
            });

            // if ($(".ulmenu li .nav-second-level li .nav-third-level").hasClass("third334")) {
            //     console.log("WAW");
            // }
        });
    </script>

</body>

</html>