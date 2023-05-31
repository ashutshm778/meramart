<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @isset($page_title)
            {{ $page_title }}
        @endisset
    </title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
        rel="stylesheet" media="all">
    <link rel="stylesheet"
        href="{{ asset('public/dashboard_css/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/dashboard_css/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/dashboard_css/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard_css/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/dashboard_css/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/img_css/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('public/img_css/css/aiz-core.css') }}">
    <script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        var AIZ = AIZ || {};
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">
        @include('backend.include.navbar')
        @include('backend.include.sidebar')
        @yield('content')
        @include('backend.include.footer')
    </div>
    <script src="{{ asset('public/img_css/js/vendors.js') }}"></script>
    <script src="{{ asset('public/img_css/js/aiz-core.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('public/dashboard_css/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/sparklines/sparkline.js') }}"></script>
    {{-- <script src="{{ asset('dashboard_css/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard_css/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <script src="{{ asset('public/dashboard_css/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script
        src="{{ asset('public/dashboard_css/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ asset('public/dashboard_css/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <script src="{{ asset('public/dashboard_css/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/dist/js/pages/dashboard.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('public/dashboard_css/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('public/dashboard_css/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/dashboard_css/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(function() {
            $('.select2').select2();
            $('.summernote').summernote();


            $('#reservation').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            })

            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + '-' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $(document).ready(function() {
                var success_message = "{{ Session::get('success') }}";
                var info_message = "{{ Session::get('info') }}";
                var error_message = "{{ Session::get('error') }}";
                var warning_message = "{{ Session::get('warning') }}";
                if (success_message != "") {
                    success_alert(success_message);
                }
                if (info_message != "") {
                    info_alert(info_message);
                }
                if (error_message != "") {
                    error_alert(error_message)
                }
                if (warning_message != "") {
                    warning_alert(warning_message)
                }
            });

            function success_alert(success_message) {
                toastr.success(success_message)
            }

            function info_alert(info_message) {
                toastr.info(info_message)
            }

            function error_alert(error_message) {
                toastr.error(error_message)
            }

            function warning_alert(warning_message) {
                toastr.warning(warning_message)
            }
        });

        $('.form-example').validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>

</body>

</html>
