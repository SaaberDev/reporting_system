<nav class="navbar navbar-expand-md navbar-dark">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
            </li>
        </ul>
        <a class="navbar-brand mx-auto md-Device" href="#">
            <img class="img-fluid img-ctm" src="{{ asset('admin_panel/assets/img/logo/White.png') }}" alt="white-logo">
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    More
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <p class="dropdown-item">{{ Auth::user()->name }}</p>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-right" href="{{ route('admin.change.password') }}">Settings</a>
                    <a href="{{ route('logout') }}" class="dropdown-item text-right"
                       onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf @method('POST')
                    </form>
                </div>
            </li>
            <li class="nav-item logoutBtn">

            </li>
        </ul>
    </div>
    <!-- Main Menu Section End -->
    <a class="navbar-brand sm-Device d-none" href="#">
        <img class="img-fluid" src="{{ asset('admin_panel/assets/img/logo/logo.png') }}" alt="logo">
    </a>
</nav>
