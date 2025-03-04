
<header id="page-topbar" style="background-color: {{config('app.main_color')}} !important;">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('images/'.config('app.logo')) }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/'.config('app.logo')) }}" alt="" height="50">
                    </span>
                </a>

                <a href="{{route('index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('images/'.config('app.logo')) }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/'.config('app.logo')) }}" alt="" height="50">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Search input">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>s
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect">
                    <i class="bx bx-envelope"></i>
                    {{ config('app.company_email') }}
                </button>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect">
                    <i class="bx bx-map"></i>
                    {{ config('app.company_address') }}
                </button>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect">
                    <i class="bx bx-phone"></i>
                    {{ config('app.company_phone') }}
                </button>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect">
                    <i class="bx bx-time"></i>
                    {{ config('app.working_hours_start') .' - '. config('app.working_hours_end') }}
                </button>
            </div>

        </div>
    </div>
</header>
<div class="topnav mt-0">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('bookingCreate')}}" id="topnav-dashboard" role="button">
                            {{-- <i class="bx bx-home-circle me-1"></i> --}}
                            <span key="t-dashboards">Registracija</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('bookingStatus')}}" id="topnav-dashboard" role="button">
                            {{-- <i class="bx bx-wrench me-1 text-danger"></i> --}}
                            <span key="t-aitool">Remonto informacija</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('takeBack')}}" id="topnav-dashboard" role="button">
                            {{-- <i class="bx bx-bot me-1"></i> take backk--}}
                            <span key="t-aitool">Atsiėmimas</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('servicesList') }}" id="topnav-dashboard" role="button">
                            {{-- <i class="bx bx-label me-1"></i> (Our Services) --}}
                            <span key="t-aitool">Mūsų paslaugos</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('productsList') }}" id="topnav-dashboard" role="button">
                            {{-- <i class="bx bx-label me-1"></i> Parts --}}
                            <span key="t-aitool">Dalys</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href=" {{ route('dashboard') }} " id="topnav-dashboard" role="button">
                            {{-- <i class="bx bx-label me-1"></i> --}}
                            <span key="t-aitool">Paskyra</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
