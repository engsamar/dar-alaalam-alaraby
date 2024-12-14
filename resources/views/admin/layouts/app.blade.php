<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ $setting->title ?? '' }} | @yield('tab_name')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/panel/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('/panel/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/panel/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/panel/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/panel/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/panel/libs/select2/css/select2.min.css') }}">


</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('admin.layouts.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.menu')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    {{-- @include('flash::message') --}}

                    <!-- start page title -->
                    @yield('title')
                    <!-- end page title -->

                    @yield('content')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('panel/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('panel/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('panel/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('panel/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/panel/libs/select2/js/select2.min.js') }}"></script>

    <!-- apexcharts -->
    {{-- <script src="{{ asset('panel/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
    <!-- Saas dashboard init -->
    {{-- <script src="{{ asset('panel/js/pages/saas-dashboard.init.js') }}"></script> --}}
    <script src="{{ asset('panel/js/app.js') }}"></script>
    @yield('scripts')
    <script>
        $('.select2').select2();
    </script>
    @yield('js')

    <script src="{{ asset('/panel/libs/toastr.js') }}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif


        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif


        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>

</body>

</html>
