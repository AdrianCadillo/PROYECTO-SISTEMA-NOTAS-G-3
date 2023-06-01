<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo')</title>

    {{-- CSS PARA DATA TABLES --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
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

{{-- JS PARA DATATABLES--}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

@yield('js')
</body>
</html>
