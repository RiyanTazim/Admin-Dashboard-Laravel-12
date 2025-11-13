<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="bdCalling IT Ltd.">
    <meta name="keywords" content="pure_water_innovation">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @include('backend.partials.styles')
    {{-- @vite('resources/js/echo.js') --}}
</head>

<body class="ltr app sidebar-mini">
    {{-- Switcher --}}
    @include('backend.partials.switcher')
    {{-- Switcher --}}


    {{-- LOADER --}}
    <div id="global-loader">
        <img src="{{ asset('backend/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    {{-- LOADER --}}


    {{-- PAGE --}}
    <div class="page">
        <div class="page-main">
            {{-- Header --}}
            @include('backend.partials.header')
            {{-- Header --}}

            {{-- SIDEBAR --}}
            @include('backend.partials.sidebar')
            {{-- SIDEBAR --}}


            <div class="app-content main-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- page --}}


    {{-- BACK-TO-TOP --}}
    <a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

    @include('backend.partials.scripts')
</body>

</html>
