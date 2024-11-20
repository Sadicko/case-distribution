<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/images/favicon/site.webmanifest') }}">

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/6-all.min.css') }}">
    <!-- plugin css file  -->
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('styles')
    @livewireStyles
</head>

<body class="bg-gray">
<div id="timetracker-layout" class="theme-mist">

    <!-- sidebar -->
    @include('dashboard.layouts.sidebar')

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4 position-relative">

        <!-- Body: Header -->
        @include('dashboard.layouts.header')


        <div id="loadingoverlay" style="display: none;">
            <x-loader />
        </div>


        <!-- Body: Body -->
        @yield('content')

        <footer class="main-footer clearfix">
            <div class="float-right d-none d-sm-block">
                <b>Powered by</b> Judicial Service ICT Department
            </div>
            &copy; Copyright {{ date('Y') }}  <strong><span>{{ config('app.name') }}</span></strong>
        </footer>

    </div>

</div>


<!-- Jquery Core Js -->
<script src="{{ asset('/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('/bundles/dataTables.bundle.js') }}"></script>
{{-- toastr --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
{{-- select2 --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
{{-- datepicker --}}
<script src="{{ asset('/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>

<!-- Jquery Page Js -->
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/page/dashboard.js') }}"></script>

@livewireScripts
@filepondScripts
{{--<script src="//unpkg.com/alpinejs" defer></script>--}}
@stack('scripts')
@yield('scripts')


<script>
    // alerts
    @if (session()->has('success'))
    toastr.success('{{ session()->get('success') }}');
    @endif
    @if (session()->has('info'))
    toastr.info('{{ session()->get('info') }}');
    @endif
    @if (session()->has('warning'))
    toastr.warning('{{ session()->get('warning') }}');
    @endif
    @if (session()->has('error'))
    toastr.error('{{ session()->get('error') }}');
    @endif
</script>
</body>

</html>
