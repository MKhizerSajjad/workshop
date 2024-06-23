<div class="vertical-menu">


    {{-- <div class="d-flex"> --}}
        {{-- <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
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
                    <a href="home" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

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
                    <a href="{{ route('employee.index') }}" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Employee</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('customer.index') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">Customers</span>
                    </a>
                    {{-- <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html" key="t-login">Login</a></li>
                        <li><a href="auth-login-2.html" key="t-login-2">Login 2</a></li>
                        <li><a href="auth-register.html" key="t-register">Register</a></li>
                        <li><a href="auth-register-2.html" key="t-register-2">Register 2</a></li>
                        <li><a href="auth-recoverpw.html" key="t-recover-password">Recover Password</a></li>
                        <li><a href="auth-recoverpw-2.html" key="t-recover-password-2">Recover Password 2</a></li>
                        <li><a href="auth-lock-screen.html" key="t-lock-screen">Lock Screen</a></li>
                        <li><a href="auth-lock-screen-2.html" key="t-lock-screen-2">Lock Screen 2</a></li>
                        <li><a href="auth-confirm-mail.html" key="t-confirm-mail">Confirm Email</a></li>
                        <li><a href="auth-confirm-mail-2.html" key="t-confirm-mail-2">Confirm Email 2</a></li>
                        <li><a href="auth-email-verification.html" key="t-email-verification">Email verification</a></li>
                        <li><a href="auth-email-verification-2.html" key="t-email-verification-2">Email Verification 2</a></li>
                        <li><a href="auth-two-step-verification.html" key="t-two-step-verification">Two Step Verification</a></li>
                        <li><a href="auth-two-step-verification-2.html" key="t-two-step-verification-2">Two Step Verification 2</a></li>
                    </ul> --}}
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
