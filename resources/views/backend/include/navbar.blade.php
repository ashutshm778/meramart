<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-image: linear-gradient(to right,#0a0b0d,#e60f22)!important">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('index')}}" target="_blank"><i class="fas fa-globe"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-success float-right" href="{{route('admin.products.create')}}">Add Product <i class="fas fa-plus"></i></a>
        </li>
    </ul>
    <div class="header-item">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a data-toggle="dropdown" href="#" aria-expanded="false" aria-haspopup="true">
            <span class="d-flex align-items-center p-2">
                <img class="rounded-circle header-profile-user" src="{{asset('public/dashboard_css/img/user.png')}}" alt="{{Auth::user()->name}}">
                <span class="text-center ms-xl-2">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->name}}</span>
                    <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{auth()->user()->roles[0]['name']}}</span>
                </span>
            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <a href="#" class="dropdown-item">
            <i class="far fa-user mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off mr-2"></i> Logout
            </a>
            </div>
        </li>

    </ul>
</div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
