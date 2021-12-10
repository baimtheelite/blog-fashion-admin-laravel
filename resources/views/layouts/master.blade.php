<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Helpdesk | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }} ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    {{-- Grocery CRUD --}}
    <link rel="stylesheet" href="{{ asset('assets/grocery-crud/css/bootstrap/v4/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/grocery-crud/css/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/grocery-crud/css/grocery-crud-v2.7.4.ae70528.css') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- File Manager --}}
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">


    @yield('header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>


        @include('layouts._navbar')

        @include('layouts._sidebar')

        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>

        @include('layouts._footer')


        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>


</body>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- BlockUI --}}
<script src="{{ asset('js/jquery.blockUI.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/8.8.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.8.0/firebase-messaging.js"></script>




{{-- GROCERY CRUD --}}
{{-- <script src="{{ asset('/assets/grocery-crud/js/jquery/jquery.js') }}"></script> --}}
<script src="{{ asset('/assets/grocery-crud/js/libraries/jquery-ui.js') }}"></script>
<script src="{{ asset('/assets/grocery-crud/js/libraries/modernizr-custom.js') }}"></script>
<script src="{{ asset('/assets/grocery-crud/js/build/grocery-crud-v2.7.4.ae70528.js') }}"></script>
<script src="{{ asset('/assets/grocery-crud/js/libraries/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/assets/grocery-crud/js/libraries/ckeditor/ckeditor.adapter-jquery.js') }}"></script>

{{-- File Manager --}}
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>



<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>

{{-- swal toast --}}
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

</script>

{{-- Block UI Proses Loading --}}
<script>
    function prosesLoading() {
        $.blockUI({
            message: '<img id="loading-gif" src="{{ asset('images/load-1.png') }}" style="width:75px;" class="mx-auto"/>',
            overlayCSS: {
                backgroundColor: '#333',
                opacity: 0.5,
                cursor: 'wait',
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });
    }
</script>

{{-- Ajax Toast Error --}}
<script>
    $(document).ajaxError(function (e, xhr, options, exc) {
        console.log(e, xhr, options, exc);
        if(exc != 'abort'){
            $.unblockUI()
            if (xhr.status == 422) {
                var json = $.parseJSON(xhr.responseText);
                var errorsHtml = '';
                $('*[id*=error]').html('');
                $.each(json.errors, function (key, value) {
                    errorsHtml += '<li class="ml-2">' + value + '</li>';
                    $(`#${key}_error`).html(value).show();
                });
            } else {
                var errorsHtml = xhr.responseText;
            }
            // Command: toastr["error"](errorsHtml);
            Toast.fire({
                icon: 'error',
                html: `<ul>${errorsHtml}</ul>`
            });
        }
    });
</script>

{{-- button modal file manager --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

    // set file link
        function fmSetLink($url) {
            document.getElementById('image_label').value = $url;
        }
</script>
@include('custom.fcm')

@include('custom.my-scripts')

@stack('scripts')


</html>
