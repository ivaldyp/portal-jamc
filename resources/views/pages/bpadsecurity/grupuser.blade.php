@extends('layouts.masterhome', [$sec_menu, $sec_menu_child])

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
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title"></h3> </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <div class="right-sidebar">
                <div class="slimscrollright">
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
    </div>
@endsection
