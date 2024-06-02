<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/img/medicine.png') }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">

    @yield('form_themsanpham_head')
    @yield('form_suasanpham_head')
    @yield('form_themphieuNK_head')
    @yield('form_themphieuKK_head')
    @yield('form_themphieuXK_head')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')
        @include('layouts.sidebar')
        @yield('content')
        @include('layouts.footer')

    </div>
</body>
</html>
