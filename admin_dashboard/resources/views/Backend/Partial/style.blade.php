    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/switcher/demo.css') }}" rel="stylesheet"> --}}

{{-- <link rel="icon" type="image/png" href="{{ asset($setting->favicon ?? 'favicon.png') }}"> --}}

    {{-- <link rel="apple-touch-icon" href="{{ asset($setting->favicon ?? '') }}"> --}}
    
    
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/brand/favicon.ico') }}" /> --}}

    <!-- Bootstrap CSS -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap5.min.css') }}">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/switcher/demo.css') }}" rel="stylesheet">

    {{-- dropify --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

    <style>
        .app-content {
            margin-top: 0 !important;

        }

        .col-lg-12 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .app-content .side-app {
            padding: 0px !important;
        }

        .dropify-wrapper {
            height: inherit !important;
            font-size: 30px;
        }

        /* .dropify-wrapper .dropify-message p {
            font-size: 30px;
        } */

        {{-- CKEditor CDN --}} .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
    <style>
        .dashboard-date {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            background: #2c2f3e;
            padding: 8px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* .dashboard-date i {
            color: #007bff;
            font-size: 18px;
            padding-top: 2px;
        } */

        #timer {
            font-weight: bold;
            color: #d8473d;
        }
    </style>

    @stack('style')
