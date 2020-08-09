<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--====================favicon=======================-->
    <link rel="icon" type="image/png" href="{{ asset('admin_panel/assets/img/logo/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('admin_panel/assets/css/login-form.css') }}">
    <script src="{{ asset('vendor/sweetalert/sweetalert2.js') }}"></script>

</head>
<body>
    @yield('content')
    @include('alert_message.alert')
</body>
</html>
