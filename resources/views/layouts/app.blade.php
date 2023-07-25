<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SR6CRNLL5Y"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-SR6CRNLL5Y');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">

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
<noscript><div><img src="https://mc.yandex.ru/watch/94438576" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

    <div id="app">

        @yield('content')



</div>

    <script src="https://kinobox.tv/kinobox.min.js"></script>

</body>

</html>
