<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{$this->asset("plugins/fontawesome-free/css/all.min.css")}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{$this->asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{$this->asset("dist/css/adminlte.min.css")}}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{$this->asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include($this->getComponents("nav"))
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include($this->getComponents("aside"))

  <!-- Content Wrapper. Contains page content -->
  @include($this->getComponents("wrapper"))
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include($this->getComponents("footer"))
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{$this->asset("plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap -->
<script src="{{$this->asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{$this->asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{$this->asset("dist/js/adminlte.js")}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{$this->asset("plugins/jquery-mousewheel/jquery.mousewheel.js")}}"></script>
<script src="{{$this->asset("plugins/raphael/raphael.min.js")}}"></script>
<script src="{{$this->asset("plugins/jquery-mapael/jquery.mapael.min.js")}}"></script>
<script src="{{$this->asset("plugins/jquery-mapael/maps/usa_states.min.js")}}"></script>
<!-- ChartJS -->
<script src="{{$this->asset("plugins/chart.js/Chart.min.js")}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{$this->asset("dist/js/demo.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{$this->asset("dist/js/pages/dashboard2.js")}}"></script>
</body>
</html>
