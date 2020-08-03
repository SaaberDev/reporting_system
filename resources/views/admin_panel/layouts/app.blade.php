<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin_panel.includes.header')
</head>
<body id="content">
<header class="header-nav ctm-nav">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Nav Section Start -->
                @include('admin_panel.includes.navbar')
                <!-- Nav Section End -->
            </div>
        </div>
    </div>
</header>
@yield('content')
<!-- Js Link -->
@include('admin_panel.assets.scripts')
@stack('scripts')
@include('alert_message.alert')
</body>
</html>
