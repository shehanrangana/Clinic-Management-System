<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>
    <title>@yield('title')</title>

    <!-- App Icons -->
    <!-- <link rel="shortcut icon" href="/images/favicon.ico"> -->

    <!-- App css -->
    <!-- <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed:400,700|Yantramanav" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head> 
<body>
    <!-- Loader --> 
    <!-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> -->

    <!-- Navigation Bar-->
    <header id="topnav">
        @include('./layouts/topbar')
        @include('./layouts/navbar')
    </header>
    <!-- End Navigation Bar-->

    <!-- Wrapper -->
    <div class="wrapper" id="app">
        <div class="container">
            <!-- <div class="inner-div"> -->
                @yield('content')
            <!-- </div> -->
        </div>
    </div>
    <!-- End wrapper -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    CLINIC MANAGEMENT SYSTEM
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <script type="text/javascript" src="/js/app.js"></script>
</body>
</html>