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
        <style>
            .alert-pop-up {
                position: fixed;
                top: -100px;
                left: 50%;
                transform: translateX(-50%);
                background-color: black;
                color: white;
                padding: 10px;
                border: 1px solid black;
                border-radius: 15px;
                animation: alert-pop-up 3s ease forwards;
                z-index: 99999999999999999999999999999999;
            }
          
            @keyframes alert-pop-up {
                0% {
                    top: -100px;
                }
                50% {
                    top: 50%;
                }
                100% {
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
            }
        </style>
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
        <script>
            function showAlertPopUp(data) {
                // Membuat element pop-up alert
                var alertDiv = document.createElement("div");
                alertDiv.className = "alert-pop-up";
                alertDiv.innerHTML = data;

                // Menambahkan element pop-up alert ke dalam body
                document.body.appendChild(alertDiv);

                // Mengatur waktu untuk menghapus element pop-up alert setelah 5 detik
                setTimeout(function() {
                document.body.removeChild(alertDiv);
                }, 3000);
            }
            @if (session()->has('success'))
                showAlertPopUp("{{ session('success') }}");
            @endif
        </script>

        @yield('script')

    </body>
  
</html>