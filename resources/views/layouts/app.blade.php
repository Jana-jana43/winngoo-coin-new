<!DOCTYPE html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="classic" data-theme-colors="default">

<head>

    <meta charset="utf-8" />

    <title>@yield('title', 'Winngoo Coin - Admin')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/coin-globe.png') }}" >
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- CSS -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />


   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css" rel="stylesheet">

<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @stack('styles')



</head>

<body>



    <div id="layout-wrapper">



        @if (!request()->routeIs('login'))
            @include('layouts.header')
        @endif



        {{-- SIDEBAR --}}

        @if (!request()->routeIs('login'))
            @include('layouts.sidebar')
        @endif





        {{-- MAIN CONTENT --}}

        <div class="main-content">

            @yield('content')



            {{-- FOOTER --}}

            @include('layouts.footer')

        </div>



    </div>




    
    
    
    <script src="{{ asset('/assets/js/layout.js') }}"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
    
    <script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>
    
    <script src="{{ asset('/assets/libs/feather-icons/feather.min.js') }}"></script>
    
    <script src="{{ asset('/assets/js/plugins.js') }}"></script>
    
    <script src="{{ asset('/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    
    <script src="{{ asset('/assets/libs/particles.js/particles.js') }}"></script>
    
    <script src="{{ asset('/assets/js/pages/particles.app.js') }}"></script>
    
    <script src="{{ asset('/assets/js/pages/password-addon.init.js') }}"></script>
    
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.js"></script>

   <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
 <script src="{{ asset('assets/js/pages/sweetalerts.init.js') }}"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    


    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>  
    
    
        <!--24-03-2026   datatable js--> 
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<!-- Buttons JS — must be AFTER jquery and dataTables core -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>



<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    
    
    
    
    
    
    <script>
setTimeout(function () {
    let alert = document.getElementById('success-alert');
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500); // remove after fade
    }
}, 2000);
</script>
    @stack('scripts')

</body>

</html>
