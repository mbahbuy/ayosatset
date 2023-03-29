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
      @php
        $cartData = [];
        if (auth()->check()) {
          $data = \App\Models\Cart::with(['product.shop' => function ($query) {
              $query->select('shop_hash', 'name')->with('alamat');
          }])->where([
              ['user_hash', '=', auth()->user()->user_hash],
              ['parent_id', '=', 1]
          ])->get();
          $cartData = $data->groupBy(function ($item) {
              return $item->product->shop->shop_hash;
          })->map(function ($items, $shop_hash) {
              return [
                  'shop_hash' => $shop_hash,
                  'name' => $items[0]->product->shop->name,
                  'address' => $items[0]->product->shop->alamat->city_id,
                  'products' => $items->map(function ($item) {
                      return [
                          'product_hash' => $item->product->product_hash,
                          'name' => $item->product->name,
                          'image' => $item->product->image,
                          'price' => $item->product->price,
                      ];
                  })
              ];
          })->values();
        }
      @endphp
      @include('layout.header',[
        'categories' => \App\Models\Category::all(),
        'carts' => $cartData,
        'cart_products' => auth()->check() ? \App\Models\Cart::where([
          ['user_hash', '=', auth()->user()->user_hash],
          ['parent_id', '=', 1]
        ])->with('product')->get() : [],
        'wishs' => auth()->check() ? \App\Models\Cart::where([
          ['user_hash', '=', auth()->user()->user_hash],
          ['parent_id', '=', 2]
        ])->with('product')->get() : []
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
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-_2oyz8XTlPKSmPBt"></script>
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
        @if (auth()->check())
          $(wish).toggleClass("active");
        @endif
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
        if ($(ph).is(':checked')) {
          // Set semua checkbox menjadi checked
          $("input.cart-checkbox:checkbox").prop("checked", true);
          // $("input.cart-shop:checkbox").prop("checked", true);
        } else {
          // Set semua checkbox menjadi checked
          $("input.cart-checkbox:checkbox").prop("checked", false);
          // $("input.cart-shop:checkbox").prop("checked", false);
        }
        cartCheck();
      }
      function pilihShop(sh) {
        if ($(sh).is(':checked')) {
          // Set semua checkbox menjadi checked
          $(sh).parent().next('ul').find("input.cart-checkbox:checkbox").prop("checked", true);
        } else {
          // Set semua checkbox menjadi checked
          $(sh).parent().next('ul').find("input.cart-checkbox:checkbox").prop("checked", false);
        }
        cartCheck();
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
        $('.sub-total').html('Rp ' + totalHarga.toLocaleString('id-ID'));

        const shop = $("#pilih-semua").closest('.cart-list').parent().find('input.cart-shop:checkbox');
        const targetOngkir = $('#pemilihan-jasa');
        shop.each(function(){
          let checkboxChildren = $(this).parent().next('ul').find("input.cart-checkbox:checkbox");
          let checkboxChildrenChecked = $(this).parent().next('ul').find("input.cart-checkbox:checkbox:checked");
          if (checkboxChildren.length == checkboxChildrenChecked.length) {
            $(this).prop("checked", true);
          } else {
            $(this).prop("checked", false);
          }
          if (checkboxChildrenChecked.length > 0) {
            let targetPemilihan = targetOngkir.find('#jasa-' + $(this).val());
            if (targetPemilihan.length == 0) {
              targetOngkir.append("<div class='cart-item'><div class='form-group'><label for='jasa-" + $(this).val() + "'>" + $(this).attr('data-name') + "</label><select class='form-select jasa-pilihan-ongkir' id='jasa-" + $(this).val() + "' data-shop='" + $(this).val() + "' data-address='" + $(this).attr('data-address') + "' data-name='" + $(this).attr('data-name') + "' ><option value='jne'>JNE</option><option value='tiki'>TIKI</option><option value='pos'>POS Indonesia</option></select></div></div>");
            }
          }
          
        });
      }
      if ($("input.cart-checkbox:checkbox:checked").length > 0) {
        cartCheck();
      }

      function cariOngkir(){
        const kota = $('input.alamat-pengiriman:checkbox:checked');
        const jasa = $('#pemilihan-jasa').find('.jasa-pilihan-ongkir');
        jasa.each(function() {
          let nameShop = $(this).attr('data-name');
          let shopHash = $(this).attr('data-shop');
          $.ajax({
            type: "POST",
            url: "{{ route('data.ongkir') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'origin': $(this).attr('data-address'),
              'tujuan': kota.val(),
              'jasa': $(this).val()
            },
            dataType: "JSON",
            success: function (response) {
              var ongkir = response[0].costs;
              var detail = '';
              for (let i = 0; i < ongkir.length; i++) {
                detail += "<div class='cart-item'><div class='form-check'><input class='visually-hidden harga-ongkir' id='pilihan-ongkir-" + shopHash + "-" + ongkir[i].service + "' type='checkbox' onchange='pilihOngkir(this)' data-shop='" + shopHash + "' value='" + ongkir[i].cost[0].value + "' ><label class='form-check-label' for='pilihan-ongkir-" + shopHash + "-" + ongkir[i].service + "'><div class='card'><div class='card-body'><h5 class='card-title'>" + ongkir[i].description + "</h5><p class='card-text'>Rp " + ongkir[i].cost[0].value.toLocaleString('id-ID') + "</p></div></div></label></div></div>";
              }
              $('#jasa-ongkir').append( "<div><div class='form-check'>Pilih ongkir untuk: " + nameShop + "</div>" + detail + "</div>");
              // console.log(ongkir);
            },
            error: function (response) {
              console.log(response);
            }
          });
        });
      }

      if ($('.alamat-pengiriman').is(':checked')) {
        pilihAlamat($('.alamat-pengiriman:checkbox:checked'));
      }

      function pilihAlamat(pa) {
        $(pa).closest('cart-list').find('input:checkbox').prop("checked", false);
        $(pa).closest('cart-list').find('.form-check-label').children('.card').removeClass("border border-success");
        $(pa).prop("checked", true);
        $(pa).next().children(".card").addClass("border border-success");
        $('.cart-footer-pemilihan-alamat').prop("disabled", false);
      }

      function pilihOngkir(hayu) {
        let totalOngkir = 0;
        const shopParent = $(hayu).closest('.cart-item').parent();
        shopParent.find('input:checkbox').prop("checked", false);
        shopParent.find('.form-check-label').children('.card').removeClass("border border-success");
        $(hayu).prop("checked", true);
        $(hayu).next().children(".card").addClass("border border-success");
        $('#jasa-ongkir').find('input.harga-ongkir:checkbox:checked').each(function () { 
          totalOngkir += parseInt($(this).val());
        });
        let toggle = true;
        $('#jasa-ongkir').children().each(function(){
          let prm = $(this).find('input.harga-ongkir:checkbox:checked');
          if (prm.length > 0) {
            toggle = false;
          } else {
            toggle = true;
          }
          $('.cart-footer-check-out').prop("disabled", toggle);
        });
        $('.biaya-ongkir').html('Rp ' + parseInt(totalOngkir).toLocaleString('id-ID'));
      }

      function totalCost(){
        var totalHarga = 0;
        $("input.cart-checkbox:checkbox:checked").each(function() {
            totalHarga += parseInt($(this).attr('harga')) * parseInt($(this).attr('data-pcs'));
        });
        $('#jasa-ongkir').find('input.harga-ongkir:checkbox:checked').each(function () { 
            totalHarga += parseInt($(this).val());
        });
        $('.total-check-out').html('Rp ' + parseInt( parseInt(totalHarga)).toLocaleString('id-ID'));
      }

      function submitCartToOrder() {
        // Ambil nilai checkbox yang dicek
        var checkedValues = $("input.cart-checkbox:checkbox:checked");
        var data = [];
        checkedValues.each(function() {
          var shopHash = $(this).closest('.cart-item').parent().prev('.form-check').children('input.cart-shop:checkbox').attr('value');
          var value = $(this).val();
          var pcs = parseInt($(this).data('pcs'));
          var ongkirShop = $("#jasa-ongkir").find("input.harga-ongkir[type='checkbox'][data-shop='" + shopHash + "']:checked");

          // Cek apakah toko sudah ada dalam array
          var checkIndex = data.findIndex(function(check) {
              return check.shop_hash === shopHash;
          });

          // Jika toko belum ada, tambahkan ke array
          if (checkIndex === -1) {
              data.push({
                  shop_hash: shopHash,
                  products: [{ 'product_hash': value, 'pcs': pcs }],
                  ongkir: ongkirShop.val()
              });
          } else {
              // Jika toko sudah ada, tambahkan ID produk ke array products
              data[checkIndex].products.push({ 'product_hash': value, 'pcs': pcs });
          }
        });

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: "{{ route('order.store') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'data': data,
            },
            success: function(response) {
                // Jika berhasil, tampilkan pesan sukses
                $( "#cart-value-reload" ).load(window.location.href + " #cart-value-reload>" );
                $( ".cart-total" ).load(window.location.href + " .cart-total>" );
                $('#cart-to-order').load(window.location.href + " #cart-to-order>" );
                showAlertPopUp(response.data);
            },
            error: function(response) {
                // Jika terjadi kesalahan, tampilkan pesan error
                showAlertPopUp(response.responseText);
            }
        });
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
        $('.sub-total').html('Rp ' + totalHarga.toLocaleString('id-ID'));
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
        $('.sub-total').html('Rp ' + totalHarga.toLocaleString('id-ID'));
      }
      @if (session()->has('success'))
        showAlertPopUp("{{ session('success') }}");
      @endif
    </script>
    @yield('script')
    </body>
</html>