
<!doctype html>
<html lang="en" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <link rel="icon" type="image/png" href="{{ asset($settings->favicon) }}">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

    <title>@yield('title')</title>

    @include('Backend.Partial.style')

</head>

<body class="ltr app sidebar-mini">

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('Backend.Partial.header')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('Backend.Partial.sidebar')
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            {{-- <div class="app-content main-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">


                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <div>
                                <h1 class="page-title">Dashboard</h1>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                    </div>
                </div>
            </div> --}}

            @yield('content')
            <!-- CONTAINER CLOSED -->
        </div>

        <!-- FOOTER -->
        @include('Backend.Partial.footer')
        <!-- FOOTER CLOSED -->

    </div>
    <!-- page -->
    @include('Backend.Partial.script')
    
    @include('Backend.Partial.sweetalert')

</body>

</html>
