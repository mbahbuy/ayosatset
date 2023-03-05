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
    <link rel="stylesheet" href="{{ asset('css') }}/profile.css">
    <link rel="stylesheet" href="{{ asset('css') }}/checkout.css">
    <link rel="stylesheet" href="{{ asset('css') }}/index.css">
    <link rel="stylesheet" href="{{ asset('css') }}/product-details.css">
    <link rel="stylesheet" href="{{ asset('css') }}/main.css">
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
      @include('layout.header',[
        'categories' => \App\Models\Category::all(),
        'carts' => auth()->check() ? \App\Models\Cart::where([
          ['user_hash', '=', auth()->user()->user_hash],
          ['parent_id', '=', 1]
        ])->get() : [],
        'wishs' => auth()->check() ? \App\Models\Cart::where([
          ['user_hash', '=', auth()->user()->user_hash],
          ['parent_id', '=', 2]
        ])->get() : []
      ])
    
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
    <script>
      // alert pop up
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
      // wish
      function wishToggle(wish) {
        if (window.Laravel && window.Laravel.authenticated) {
            // User is authenticated
            $(wish).toggleClass("active");
        }
        var target = $(wish).attr('target-wish');
        $.ajax({
          url:"{{ route('wish.store') }}",
          method: 'POST',
          dataType: 'json',
          data: {
            '_token': '{{ csrf_token() }}',
            target: target,
          },
          success: function (response) {
            $( "#wish-value-reload" ).load(window.location.href + " #wish-value-reload>" );
            $( ".wish-sidebar" ).load(window.location.href + " .wish-sidebar>" );
            showAlertPopUp(response.data);
          }
        });
      }
      // cart
      function cartAdd(cart) {
        $.ajax({
          url:"{{ route('cart.store') }}",
          method: 'POST',
          dataType: 'json',
          data: {
            '_token': '{{ csrf_token() }}',
            target: cart,
          },
          success: function (response) {
            $( "#cart-value-reload" ).load(window.location.href + " #cart-value-reload>" );
            $( ".cart-sidebar" ).load(window.location.href + " .cart-sidebar>" );
            showAlertPopUp(response.data);
          }
        });
      }
      function cartDelete(cart) {
        $.ajax({
          url: "{{ route('home') }}" + "/cart/" + cart,
          method: 'POST',
          dataType: 'json',
          data: {
            '_token': '{{ csrf_token() }}',
            '_method': 'delete'
          },
          success: function (response) {
            $( "#cart-value-reload" ).load(window.location.href + " #cart-value-reload>" );
            $( ".cart-sidebar" ).load(window.location.href + " .cart-sidebar>" );
            showAlertPopUp(response.data);
          }
        });
      }
      function pilihSemua(ph) {
        var totalHarga = 0;
        if ($(ph).is(':checked')) {
          // Set semua checkbox menjadi checked
          $("input.cart-checkbox:checkbox").prop("checked", true);
          $('.checkout-data').html($("input.cart-checkbox:checkbox:checked").length);
          // Aktifkan tombol Submit
          $(".cart-footer-submit").prop("disabled", false);
          $("input.cart-checkbox:checkbox:checked").each(function() {
            totalHarga += parseInt($(this).attr('harga')) * parseInt($(this).attr('data-pcs'));
          });
        } else {
          // Set semua checkbox menjadi checked
          $("input.cart-checkbox:checkbox").prop("checked", false);
          $('.checkout-data').html(0);
          // Aktifkan tombol Submit
          $(".cart-footer-submit").prop("disabled", true);
        }
        $('.checkout-price').html('Rp ' + totalHarga.toLocaleString('id-ID'));
      }
      function cartCheck() {        
        var totalHarga = 0;
        var checkboxChecked = $("input.cart-checkbox:checkbox:checked");
        // Cek apakah setidaknya satu checkbox telah dicentang
        if (checkboxChecked.length > 0) {
          // Jika ya, aktifkan tombol Submit
          $(".cart-footer-submit").prop("disabled", false);
          $('.checkout-data').html(checkboxChecked.length);
          checkboxChecked.each(function() {
            totalHarga += parseInt($(this).attr('harga')) * parseInt($(this).attr('data-pcs'));
          });
        } else {
          // Jika tidak, nonaktifkan tombol Submit
          $(".cart-footer-submit").prop("disabled", true);
          $('.checkout-data').html(0);
        }
        if (checkboxChecked.length == $("input.cart-checkbox:checkbox").length) {
          $("#pilih-semua").prop("checked", true);
        } else {
          $("#pilih-semua").prop("checked", false);
        }
        $('.checkout-price').html('Rp ' + totalHarga.toLocaleString('id-ID'));
      }
      if ($("input.cart-checkbox:checkbox:checked").length > 0) {
        cartCheck();
      }
      function submitCartToOrder() {
        // Ambil nilai checkbox yang dicek
        var checkedValues = $("input.cart-checkbox:checkbox:checked");
        var data = [];
        checkedValues.each(function() {
            var value = $(this).val();
            var pcs = parseInt($(this).data('pcs'));
            if (!isNaN(pcs)) {
              data.push({ 'value': value, 'pcs': pcs });
            } else {
              showAlertPopUp('Jangan aneh-aneh');
            }
        });

        if (checkedValues.length > 0) {
          // Kirim data ke server menggunakan AJAX
          $.ajax({
              type: 'POST',
              url: "{{ route('order.store') }}",
              data: {
                  '_token': '{{ csrf_token() }}',
                  'data': data
              },
              success: function(response) {
                  // Jika berhasil, tampilkan pesan sukses
                  $( "#cart-value-reload" ).load(window.location.href + " #cart-value-reload>" );
                  $( ".cart-total" ).load(window.location.href + " .cart-total>" );
                  $( ".cart-list" ).load(window.location.href + " .cart-list>" );
                  showAlertPopUp(response.data);
              },
              error: function(response) {
                  // Jika terjadi kesalahan, tampilkan pesan error
                  showAlertPopUp(response.responseText);
              }
          });
        }
      }
      function pcsPlus(plus) {
        var totalHarga = 0;
        var checkboxChecked = $("input.cart-checkbox:checkbox:checked");
        var e = $(plus).closest(".product-action").children(".action-input").get(0).value++,
          c = $(plus).closest(".product-action").children(".action-minus");
        e > 0 && c.removeAttr("disabled");
        var dataPcs = $(plus).closest(".cart-item").children(".form-check").children(".cart-checkbox");
        var pcsValue = parseInt(dataPcs.attr("data-pcs"));
        dataPcs.attr("data-pcs", pcsValue + 1);
        checkboxChecked.each(function() {
            totalHarga += parseInt($(this).attr('harga')) * parseInt($(this).attr('data-pcs'));
        });
        $('.checkout-price').html('Rp ' + totalHarga.toLocaleString('id-ID'));
      }
      function pcsMinus(minus) {
        var totalHarga = 0;
        var checkboxChecked = $("input.cart-checkbox:checkbox:checked");
        var m = $(minus).closest(".product-action").children(".action-input").get(0);
        if (m.value == 1) {
          m.value = 1;
          $(minus).attr("disabled", "disabled");
        } else {
          m.value--;
        }
        var dataPcs = $(minus).closest(".cart-item").children(".form-check").children(".cart-checkbox");
        var pcsValue = parseInt(dataPcs.attr("data-pcs")) == 1 ? 2 : parseInt(dataPcs.attr("data-pcs"));
        dataPcs.attr("data-pcs", pcsValue - 1);
        checkboxChecked.each(function() {
            totalHarga += parseInt($(this).attr('harga')) * parseInt($(this).attr('data-pcs'));
        });
        $('.checkout-price').html('Rp ' + totalHarga.toLocaleString('id-ID'));
      }
      @if (session()->has('success'))
        showAlertPopUp("{{ session('success') }}");
      @endif
    </script>
    @yield('script')
    </body>
</html>