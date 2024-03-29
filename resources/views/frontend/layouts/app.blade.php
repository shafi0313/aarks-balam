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

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Theme Config Js -->
    <script src="{{ asset('backend/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('common/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Datatables css -->
    <link href="{{ asset('backend/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Topbar Start ========== -->
        @include('frontend.layouts.includes.header')
        <!-- ========== Topbar End ========== -->
        <!-- ========== Left Sidebar Start ========== -->
        @include('frontend.layouts.includes.navigation')
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
            @include('frontend.layouts.includes.footer')
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    @include('sweetalert::alert')
    <!-- Theme Settings -->
    @include('frontend.layouts.includes.theme-settings')
    @include('frontend.layouts.includes.alert')

    <!-- Vendor js -->
    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('common/plugins/sweet-alert/sweetalert-2.min.js') }}"></script>
    {{-- Cute alert --}}
    <link href="{{ asset('common/plugins/cute-alert/cute-alert.css') }}" rel="stylesheet">
    <script src="{{ asset('common/plugins/cute-alert/cute-alert.js') }}"></script>
    {{-- Select 2 --}}
    <link src="{{ asset('common/plugins/select2/css/select2.min.css') }}">
    <script src="{{ asset('common/plugins/select2/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('common/js/http.js') }}"></script>
    <script src="{{ asset('common/js/custom.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Datatables js -->
    <script src="{{ asset('backend/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('backend/js/app.min.js') }}"></script>

    @include('frontend.layouts.includes.cart_wishlist_js')
    @include('frontend.layouts.includes.login-modal')
    
    @stack('scripts')
    <div id="ajax_modal_container"></div>
    <script>
        function toast(status, header, msg) {
            Command: toastr[status](header, msg);
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "2000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
            };
        }
    </script>
</body>

</html>
