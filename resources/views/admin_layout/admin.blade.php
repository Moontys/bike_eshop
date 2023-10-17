<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="backend/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- External CSS link from the 'all_categories/sliders/products.blade.php' template -->
    @yield('external CSS link')

    <!-- iCheck -->
    <link rel="stylesheet" href="backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="backend/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="backend/dist/css/adminlte.min.css">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="backend/plugins/daterangepicker/daterangepicker.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="backend/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

      {{-- Start header --}}
      @include('admin_layout.header')
      {{-- End header --}}

      {{-- Start left sidebar --}}
      @include('admin_layout.left_sidebar')
      {{-- End left sidebar --}}

      {{-- Start content --}}
      @yield('content')
      {{-- End content --}}

      {{-- Start footer --}}
      @include('admin_layout.footer')
      {{-- End footer --}}

  </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> -->
<!-- Bootstrap 4 -->
<script src="backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="backend/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="backend/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="backend/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="backend/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Daterangepicker -->
<script src="backend/plugins/moment/moment.min.js"></script>
<script src="backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="backend/plugins/summernote/summernote-bs4.min.js"></script>
<!-- OverlayScrollbars -->
<script src="backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="backend/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="backend/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="backend/dist/js/demo.js"></script>

{{-- Start scripts --}}
@yield('scripts')
{{-- End scripts --}}

</body>
</html>
