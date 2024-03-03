<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Soft Giant BD" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/daterangepicker/daterangepicker.css') }}">

    <!-- Vector Map css -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"> --}}

    <!-- Theme Config Js -->
    <script src="{{ asset('backend/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('common/css/custom.css') }}" rel="stylesheet" type="text/css" />


    <!-- Icons css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />



    <!-- Datatables css -->
    <link href="{{ asset('backend/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    {{-- <link href="{{ asset('backend/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('backend/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" /> --}}


</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        @include('admin.layouts.includes.header')
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.includes.navigation')
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('admin.layouts.includes.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    @include('admin.layouts.includes.theme-settings')
    @include('admin.layouts.includes.alert')

    <!-- Vendor js -->
    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>

    {{-- Sweet alert --}}
    <script src="{{ asset('common/plugins/sweet-alert/sweetalert-2.min.js') }}"></script>
    {{-- Cute alert --}}
    <link href="{{ asset('common/plugins/cute-alert/cute-alert.css') }}" rel="stylesheet" >
    <script src="{{ asset('common/plugins/cute-alert/cute-alert.js') }}"></script>
    {{-- Select 2 --}}
    <link src="{{ asset('common/plugins/select2/css/select2.min.css') }}">
    <script src="{{ asset('common/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('common/js/http.js') }}"></script>
    <script src="{{ asset('common/js/custom.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ asset('backend/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script> --}}

    <!-- Datatable Demo Aapp js -->
    {{-- <script src="{{ asset('backend/js/pages/demo.datatable-init.js') }}"></script> --}}

    <!-- Daterangepicker js -->
    <script src="{{ asset('backend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Apex Charts js -->
    {{-- <script src="{{ asset('backend/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}

    <!-- Vector Map js -->
    {{-- <script src="{{ asset('backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script> --}}

    <!-- Dashboard App js -->
    {{-- <script src="{{ asset('backend/js/pages/demo.dashboard.js') }}"></script> --}}

    <!-- App js -->
    <script src="{{ asset('backend/js/app.min.js') }}"></script>

    @stack('scripts')
    <div id="ajax_modal_container"></div>
</body>

</html>
