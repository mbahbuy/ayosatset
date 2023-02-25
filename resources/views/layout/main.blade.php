<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from mironmahmud.com/greeny/assets/ltr/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jul 2022 05:24:23 GMT -->
  <!-- Added by HTTrack -->
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!-- /Added by HTTrack -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="greeny">
    <meta name="title" content="greeny - Ecommerce Food Store HTML Template">
    <meta name="keywords" content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Index Home - Greeny</title>
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('fonts') }}/flaticon/flaticon.css">
    <link rel="stylesheet" href="{{ asset('fonts') }}/icofont/icofont.min.css">
    <link rel="stylesheet" href="{{ asset('fonts') }}/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/venobox/venobox.min.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/slickslider/slick.min.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/niceselect/nice-select.min.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css') }}/brand-single.css">
    <link rel="stylesheet" href="{{ asset('css') }}/user-auth.css">
    <link rel="stylesheet" href="{{ asset('css') }}/error.css">
    <link rel="stylesheet" href="{{ asset('css') }}/index.css">
    <link rel="stylesheet" href="{{ asset('css') }}/product-details.css">
    <link rel="stylesheet" href="{{ asset('css') }}/main.css">
  </head>
  <body>
    
    @include('layout.header')
    
    @yield('container')
    
    @include('layout.footer')
    <script src="{{ asset('vendor') }}/bootstrap/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('vendor') }}/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('vendor') }}/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor') }}/bootstrap/popper.min.js"></script>
    <script src="{{ asset('vendor') }}/countdown/countdown.min.js"></script>
    <script src="{{ asset('vendor') }}/niceselect/nice-select.min.js"></script>
    <script src="{{ asset('vendor') }}/slickslider/slick.min.js"></script>
    <script src="{{ asset('vendor') }}/venobox/venobox.min.js"></script>
    <script src="{{ asset('js') }}/nice-select.js"></script>
    <script src="{{ asset('js') }}/countdown.js"></script>
    <script src="{{ asset('js') }}/accordion.js"></script>
    <script src="{{ asset('js') }}/venobox.js"></script>
    <script src="{{ asset('js') }}/slick.js"></script>
    <script src="{{ asset('js') }}/main.js"></script>
    @yield('script')
    </body>
</html>