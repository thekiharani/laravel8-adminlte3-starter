<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="keywords here">
    <meta name="description" content="description here">
    <meta name="robots" content="noindex,nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') | {{ config('app.name', 'The Contenty') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box" is="app">

        <div class="login-logo">
            <b>{{ config('app.name') }}</b>
        </div>

        @yield('content')

    </div>

    <!-- JQuery, Bootstrap, & Popper JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        //
    </script>
    @stack('js')
</body>

</html>
