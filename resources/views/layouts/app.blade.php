<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title','Home Page')</title>
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('/css/custom-styles.css') }}" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('home') }}">DeliveryApp</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            @guest
            @else
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('user.show', ['id'=>Auth::user()->getId()]) }}">Edit Profile</a>
                        @if(Auth::user()->getRole()=="company_admin")
                        <a class="dropdown-item" href="{{ route('company.show', ['id'=>Auth::user()->getCompanyId()]) }}">Edit Company Info</a> <!-- solo para company admin -->
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-tachometer-alt"></i> {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
            @endguest
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            @guest
                            <a class="nav-link" href="{{ route('login') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                {{ __('Login') }}
                            </a>
                            @else
                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('user.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i> {{ __('Register') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('user.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('user.title_list2') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif
                            @if(Auth::user()->getRole()=="super_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('company.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('company.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('company.title_create') }}</div>

                                    </a>
                                    <a class="dropdown-item" href="{{ route('company.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('company.title_list2') }}</div>
                                    </a> 
                                </div>
                            </li>
                            @endif
                            @if(Auth::user()->getRole() != "courier")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('warehouse.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('warehouse.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('warehouse.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('warehouse.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('warehouse.title_list2') }}</div>
                                    </a> 
                                </div>
                            </li>
                            @endif

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endguest
                        </div>
                    </div>

                    @guest

                    @else
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                    @endguest
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="{{ asset('/js/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('/js/scripts.js') }}"></script>
        <script src="{{ asset('/js/all.min.js') }}" crossorigin="anonymous"></script>
    </body>
</html>