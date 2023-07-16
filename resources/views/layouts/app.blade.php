<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title id="document_title">{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Theme -->
    <meta name="description" id="document_description" content="">

    <link rel="icon" type="image/png" href="assets/img/logo-icon.png">


</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed" id="page-top">

    <div id="app">

        @yield('content')



</div>


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="assets/vendor/slick/slick.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/osahan.min.js"></script>
    <script src="https://kinobox.tv/kinobox.min.js"></script>

    <!-- AdminLTE App -->
    <!-- ChartJS -->
    <script src="assets/AdminLte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="assets/AdminLte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="assets/AdminLte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/AdminLte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/AdminLte/plugins/moment/moment.min.js"></script>
    <script src="assets/AdminLte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/AdminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="assets/AdminLte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/AdminLte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/AdminLte/dist/js/adminlte.js"></script>
    <!-- Select 2 -->
    <script src="assets/AdminLte/plugins/select2/js/select2.full.min.js"></script>
</body>

</html>
