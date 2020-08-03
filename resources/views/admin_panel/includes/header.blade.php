<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link rel="icon" type="image/png" href="{{ asset('admin_panel/assets/img/logo/favicon.png') }}"/>
<!-- CSS Link -->
@include('admin_panel.assets.stylesheets')
@stack('styles')
