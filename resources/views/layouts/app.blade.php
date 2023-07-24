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

    <link rel="icon" type="image/png" href="{{asset('/img/logo-icon.png')}}">


</head>
<body class="sidebar-mini layout-fixed sidebar-closed sidebar-collapse m-0 p-0" id="page-top">

    <div id="app">

        @yield('content')



</div>

    <script src="https://kinobox.tv/kinobox.min.js"></script>

</body>

</html>
