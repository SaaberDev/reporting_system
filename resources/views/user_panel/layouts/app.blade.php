<!DOCTYPE html>
<html lang="en">
<head>
    @include('user_panel.includes.header')
    <!-- CSS Link -->
    @include('user_panel.assets.stylesheets')
    @stack('styles')
</head>

<body class="main-scrollbar">
    @include('user_panel.includes.navbar')
    @yield('content')
<!-- Js Link -->
    @include('user_panel.assets.scripts')
    @stack('scripts')
</body>
</html>
