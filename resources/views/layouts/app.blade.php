<!doctype html>
<html lang="en">
    {{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Dashboard" name="description" />
        <meta name="author" content="The Tech Shelf, mkhizersajjad"/>
        <meta name="keywords" content="{{ config('app.name', 'Laravel') }}" />
        <meta name="description" content="{{ config('app.name', 'Laravel') }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

        @include('layouts/includes.css')
        <!-- APEX charts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>

    <body @if(Auth::check()) data-sidebar="dark" @else data-topbar="dark" data-layout="horizontal" @endif>

            @guest
                {{-- Not loggedIn then here --}}
                @yield('content');
            @else
                <div id="layout-wrapper">
                    @if(Auth::check())
                        @include('layouts.components.nav-header')
                        @include('layouts.components.left-sidebar')
                    @else

                    @endif

                    <div class="main-content">
                        <div class="page-content p-0">
                            @yield('content');
                        </div>


                        @include('layouts.components.footer')
                    </div>
                </div>

                @include('layouts.components.right-sidebar')
                @include('layouts.components.suggestion-modal')

            @endguest

        @include('layouts/includes.js')
    </body>
</html>
