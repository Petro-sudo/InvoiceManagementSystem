<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    @vite(['resources/js/app.js','resources/css/app.css'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('dashboard')}}" class="nav-link"></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!--<li class="nav-item">
                    <a class="nav-link">
                        <span> {{Auth::user()->name}}
                            {{Auth::user()->surname}}</span>
                    </a>
                </li>-->
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-sm">
                        <a class="nav-link" href="{{route('logout')}}">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                    </button>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link">
                <span class="brand-text font-weight-light" style="color: aliceblue;">Invoice Management System</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">

                        <a href="{{route('admin')}}"> <span> {{Auth::user()->name}}
                                {{Auth::user()->surname}}</span></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Manage Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('createuser')}}" class="nav-link">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>Create Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('viewusers')}}" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>View Users</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('register')}}" class="nav-link">
                                        <i class="nav-icon fas fa-receipt"></i>
                                        <p>
                                            Order Registers
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('capture')}}" class="nav-link">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>
                                            Invoice Capturers
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('authorizer')}}" class="nav-link">
                                        <i class="nav-icon fas fa-cash-register"></i>
                                        <p>
                                            Payment Authorizers
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('activitylogs')}}" class="nav-link">
                                <i class="nav-icon fas fa-thin fa-bomb"></i>
                                <p>
                                    Activity Logs
                                </p>
                            </a>
                        </li>


                        <!--<li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-duotone fa-xmark"></i>
                                <p>
                                    Sign Out
                                </p>
                            </a>
                        </li>-->
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <br>
                <div class="container-fluid">
                    @yield('content')

                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <!-- /.content -->

    <!-- /.content-wrapper -->
    <footer class="main-footer">

    </footer>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>


</body>

</html>