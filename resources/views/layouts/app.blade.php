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
                        <a class="dropdown-item" href="{{ route('user.show', ['id'=>Auth::user()->getId()]) }}">{{ __('pagination.edit_profile') }}</a>
                        @if(Auth::user()->getRole()=="company_admin")
                        <a class="dropdown-item" href="{{ route('company.show', ['id'=>Auth::user()->getCompanyId()]) }}">{{ __('pagination.edit_company_info') }}</a> <!-- solo para company admin -->
                        @endif
                        @if(Auth::user()->getRole()=="warehouse_admin")
                        <a class="dropdown-item" href="{{ route('warehouse.show', ['id'=>Auth::user()->getWarehouseId()]) }}">{{ __('pagination.edit_warehouse_info') }}</a> <!-- solo para warehouse admin -->
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
                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('user.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i> {{ __('pagination.title_create') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('user.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
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
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>

                                    </a>
                                    <a class="dropdown-item" href="{{ route('company.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('company.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif
                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('warehouse.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('warehouse.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('warehouse.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('warehouse.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif

                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || 
                            Auth::user()->getRole()=="warehouse_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('vehicle.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('vehicle.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('vehicle.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('vehicle.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif

                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || 
                            Auth::user()->getRole()=="warehouse_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('vehicle_type.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('vehicle_type.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('vehicle_type.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('vehicle_type.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('delivery_route.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
                                    <a class="dropdown-item" href="{{ route('delivery_route.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i> {{ __('pagination.title_create') }}</div>
                                    </a> 
                                @endif
                                    <a class="dropdown-item" href="{{ route('delivery_route.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('delivery_route.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>

                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('customer.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('customer.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('customer.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('customer.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif

                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('vendor.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('vendor.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('vendor.list') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i> {{ __('pagination.title_list') }}</div>
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('vendor.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif

                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('service.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('service.create') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-plus"></i> {{ __('pagination.title_create') }}</div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('service.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
                                    </a>
                                </div>
                            </li>
                            @endif

                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>
                                    {{ __('bill.title_list') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('bill.import_export') }}">
                                        <div class="sb-nav-link-icon"><i class="fa fa-cloud"></i> {{ __('pagination.title_import_export') }}</div>
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
                        <div class="small">{{ __('pagination.logged_in') }}</div>
                        {{ Auth::user()->getName() }}
                    </div>
                    @endguest
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <!-- display breadcrumb -->
                    @if(!empty($data["breadlist"]))
                        <div class="container-fluid padding-top-20">
                            <ol class="breadcrumb">
                                @foreach ($data["breadlist"] as $bread)
                                    @if ($bread[3] == "1")
                                        <li class="breadcrumb-item active" aria-current="page">{{$bread[0]}}</li>
                                    @else
                                        <li class="breadcrumb-item"><a href="{{route($bread[1],$bread[2])}}">{{$bread[0]}}</a></li>
                                    @endif
                            @endforeach
                            </ol>
                        </div>
                    @endif

                    <!-- display errors -->
                    @if($errors->any())
                        <div class="container-fluid">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-block margin-0">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $error }}</strong>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- display main content -->
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2021</div>
                            <div>
                                <a href="#">{{ __('pagination.privacy_policy') }}</a>
                                &middot;
                                <a href="#">{{ __('pagination.terms_conditions') }}</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="{{ asset('/js/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="{{ asset('/js/jquery-3.6.0.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('/js/scripts.js') }}"></script>
        <script src="{{ asset('/js/all.min.js') }}" crossorigin="anonymous"></script>
    </body>
</html>