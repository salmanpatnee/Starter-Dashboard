<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/print.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div id="app">
        <!-- Site wrapper -->
        <div class="wrapper">
            @yield('content')
        </div> <!-- ./wrapper -->

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('admin/js/frame.js') }}"></script>
    <script src="{{ asset('admin/js/pace.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="{{ asset('admin/js/jstree.min.js') }}"></script>
</body>

</html>
