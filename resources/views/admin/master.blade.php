<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin</title>
        <base href="{{asset('')}}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="css/admins/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="library/admins/bower_9/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="library/admins/Ionicons/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="library/admins/bower_9/jvectormap/jquery-jvectormap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="library/admins/bower_9/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="library/admins/bower_9/_all-skins.min.css">
        @yield('style')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        {{-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> --}}
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            {{-- Header --}}
            @include('admin.layouts.header')
            {{-- End header --}}
            <!-- Left side column. contains the logo and sidebar -->
            {{-- Sidebar --}}
            @include('admin.layouts.sidebar')
            {{-- End Sidebar --}}
            <!-- Content Wrapper. Contains page content -->
            {{-- @yield('content') --}}
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Version 2.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- End Footer --}}
            <!-- Control Sidebar -->
            @include('admin.layouts.controlSidebar')
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
            {{-- 
            <canvas id="salesChart" style="height: 180px;"></canvas>
            --}}
            {{-- 
            <canvas id="pieChart" height="150"></canvas>
            --}}
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="js/admins/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="css/admins/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="library/admins/bower_9/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="library/admins/bower_9/adminlte.min.js"></script>
        <!-- Sparkline -->
        <script src="library/admins/bower_9/jquery.sparkline.min.js"></script>
        <!-- jvectormap  -->
        <script src="library/admins/bower_9/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="library/admins/bower_9/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll -->
        <script src="library/admins/bower_9/jquery.slimscroll.min.js"></script>
        <!-- ChartJS -->
        <script src="library/admins/bower_9/Chart.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{-- <script src="js/admins/dashboard2.js"></script> --}}
        <!-- AdminLTE for demo purposes -->
        <script src="library/admins/bower_9/demo.js"></script>
        @yield('script')
    </body>
</html>
