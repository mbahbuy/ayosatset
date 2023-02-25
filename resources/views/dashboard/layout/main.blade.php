<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Dashboard - NiceAdmin Bootstrap Template</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('images') }}/favicon.png" rel="icon">
        <link href="{{ asset('images') }}/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link rel="stylesheet" href="{{ asset('vendor') }}/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('vendor') }}/bootstrap-icons/bootstrap-icons.css">

        <!-- Template Main CSS File -->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    </head>

    <body>

        @include('dashboard.layout.header')

        @include('dashboard.layout.sidebar')

        <main id="main" class="main">
            @yield('content')
        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('vendor') }}/bootstrap/jquery-1.12.4.min.js"></script>
        <script src="{{ asset('vendor') }}/bootstrap/bootstrap.min.js"></script>
        <script src="{{ asset('vendor') }}/bootstrap/bootstrap.bundle.min.js"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('js/dashboard.js') }}"></script>

        @yield('script')

    </body>
  
</html>