<div class="vertical-menu" style="background-color: {{config('app.main_color')}} !important;">
    @php
        $userType = auth()->user()->user_type ?? null;
    @endphp

    {{-- <div class="d-flex"> --}}
        {{-- <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">\
                    <img src="{{ asset('images/logo.png') }}" alt="" height="17">
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="19">
                </span>
            </a>
        </div> --}}

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                @if (in_array(auth()->user()->user_type , [1, 2, 3]))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span key="t-ecommerce">Shop</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('item.index') }}" key="t-products">Items</a></li>
                            <li><a href="{{ route('product.index') }}" key="t-product-detail">Products</a></li>
                            <li><a href="{{ route('service.index') }}" key="t-orders">Services</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-users">Employees</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            {{-- @if (in_array(auth()->user()->user_type , [1, 2]))
                                <li><a href="{{ route('employee.index') }}" key="t-products">Employees</a></li>
                            @endif| --}}
                            @if (in_array(auth()->user()->user_type , [1]))
                                <li><a href="{{ route('manager.index') }}" key="t-products">Manager</a></li>
                            @endif
                            @if (in_array(auth()->user()->user_type , [1, 2]))
                                <li><a href="{{ route('technician.index') }}" key="t-products">Technician</a></li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-settings">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('settingBusiness') }}" key="t-products">Business</a></li>
                            <li><a href="{{ route('platform.index') }}" key="t-products">General</a></li>
                            <li><a href="{{ route('pickup-point.index') }}" key="t-products">Cases Settings</a></li>
                            <li><a href="{{ route('settingPayment') }}" key="t-products">Payment & Integration</a></li>
                            <li><a href="{{ route('settingEmail') }}" key="t-products">Email Setting</a></li>
                            <li><a href="{{ route('translations') }}" key="t-products">Translation</a></li>

                            {{-- <li><a href="{{ route('setting.index') }}" key="t-products">General <span class="badge badge-success">Old</span></a></li>
                            <li><a href="{{ route('priority.index') }}" key="t-products">Priority <span class="badge badge-success">Old</span></a></li>
                            <li><a href="{{ route('pickup-point.index') }}" key="t-orders">Pickup Points  <span class="badge badge-success">Old</span></a></li>
                            <li><a href="{{ route('platform.index') }}" key="t-products">Social Platform</a></li>
                            <li><a href="{{ route('service-location.index') }}" key="t-orders">Service Location</a></li> --}}
                            @if (in_array(auth()->user()->user_type , [1]))
                                <li><a href="{{ route('access.index') }}" key="t-orders">Access Control</a></li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-file"></i>
                            <span key="t-report">Reporting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (in_array(auth()->user()->user_type , [1]))
                                <li><a href="{{ route('log.index') }}" key="t-logs">Logs</a></li>
                            @endif
                            <li><a href="{{ route('service.report') }}" key="t-service">Services</a></li>
                            <li><a href="{{ route('product.report') }}" key="t-products">Products</a></li>
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->user_type , [1, 2]))
                    <li>
                        <a href="{{ route('customer.index') }}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-authentication">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('newsletter.index') }}" class="waves-effect">
                            <i class="bx bx-envelope"></i>
                            <span key="t-authentication">News Letter</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('case.index') }}" class="waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span key="t-authentication">Cases</span>
                        </a>
                    </li>
                @endif

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-cog"></i>
                        <span key="t-settings">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('platform.index') }}" key="t-products">General</a></li>
                        <li><a href="{{ route('priority.index') }}" key="t-products">Cases Settings</a></li>
                        <li><a href="{{ route('setting.index') }}" key="t-products">General <span class="badge badge-success">Old</span></a></li>
                        <li><a href="{{ route('priority.index') }}" key="t-products">Cases Settings <span class="badge badge-success">Old</span></a></li>
                        <li><a href="{{ route('pickup-point.index') }}" key="t-orders">Payments & Integrations</a></li>
                        <li><a href="{{ route('platform.index') }}" key="t-products">Email settings</a></li>
                        <li><a href="{{ route('service-location.index') }}" key="t-orders">Business information</a></li>
                        <li><a href="{{ route('service-location.index') }}" key="t-orders">Access control</a></li>
                        <li><a href="{{ route('service-location.index') }}" key="t-orders">Language</a></li>
                    </ul>
                </li>

                <li class="mm-active">
                    <a class="has-arrow" href="#">
                        <i class="bx bx-share-alt"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" style="">
                        <li><a href="#">Level 1.1</a></li>
                        <li class="mm-active"><a class="has-arrow" href="#">General</a>
                            <ul class="sub-menu mm-collapse mm-show" style="">
                                <li><a href="#">Recommended place</a></li>
                                <li><a href="#">Terms</a></li>
                                <li><a href="#">Select main language</a></li>
                            </ul>
                        </li>
                        <li class="mm-active"><a class="has-arrow" href="#">Cases Settings</a>
                            <ul class="sub-menu mm-collapse mm-show" style="">
                                <li><a href="#">Case priority</a></li>
                                <li><a href="#">Pickup points for service</a></li>
                                <li><a href="#">Terms</a></li>
                                <li><a href="#">Select main language</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
