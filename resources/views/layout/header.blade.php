<div class="backdrop"></div>
<a class="backtop fas fa-arrow-up" href="#"></a>
<div class="header-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-5">
        <div class="header-top-welcome">
          <p>Welcome to Ecomart in Your Dream Online Store!</p>
        </div>
      </div>
      {{-- <div class="col-md-5 col-lg-3">
        <div class="header-top-select">
          <div class="header-select">
            <i class="icofont-world"></i>
            <select class="select">
              <option value="english" selected>english</option>
              <option value="bangali">bangali</option>
              <option value="arabic">arabic</option>
            </select>
          </div>
          <div class="header-select">
            <i class="icofont-money"></i>
            <select class="select">
              <option value="english" selected>doller</option>
              <option value="bangali">pound</option>
              <option value="arabic">taka</option>
            </select>
          </div>
        </div>
      </div> --}}
      {{-- <div class="col-md-7 col-lg-4">
        <ul class="header-top-list">
          <li>
            <a href="offer.html">offers</a>
          </li>
          <li>
            <a href="faq.html">need help</a>
          </li>
          <li>
            <a href="contact.html">contact us</a>
          </li>
        </ul>
      </div> --}}
    </div>
  </div>
</div>
<header class="header-part">
  <div class="container">
    <div class="header-content">
      <div class="header-media-group">
        <button class="header-user">
          <i class="fa fa-bars"></i>
        </button>
        <a href="{{ route('home') }}">
          <img src="{{ asset('images/logoipsum-221.svg') }}" alt="logo">
        </a>
        <button class="header-src">
          <i class="fas fa-search"></i>
        </button>
      </div>
      <a href="{{ route('home') }}" class="header-logo">
        <img src="{{ asset('images/logoipsum-221.svg') }}" alt="logo">
      </a>
      @if (sizeof($categories))          
        <div class="header-widget dropdown-megamenu">
          <a class="navbar-link dropdown-arrow" href="#">category</a>
          <div class="megamenu">
            <div class="container megamenu-scroll">
              <div class="row row-cols-5">
                @foreach ($categories as $item)
                  <div class="col">
                    <div class="megamenu-wrap">
                      <h5 class="megamenu-title">{{ $item->name }}</h5>
                    </div>
                  </div>
                @endforeach
                {{-- <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">vegetables</h5>
                      <ul class="megamenu-list">
                        <li>
                          <a href="#">carrot</a>
                        </li>
                        <li>
                          <a href="#">broccoli</a>
                        </li>
                        <li>
                          <a href="#">asparagus</a>
                        </li>
                        <li>
                          <a href="#">cauliflower</a>
                        </li>
                        <li>
                          <a href="#">eggplant</a>
                        </li>
                      </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">fruits</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">Apple</a>
                      </li>
                      <li>
                        <a href="#">orange</a>
                      </li>
                      <li>
                        <a href="#">banana</a>
                      </li>
                      <li>
                        <a href="#">strawberrie</a>
                      </li>
                      <li>
                        <a href="#">watermelon</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">dairy farms</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">Butter</a>
                      </li>
                      <li>
                        <a href="#">Cheese</a>
                      </li>
                      <li>
                        <a href="#">Milk</a>
                      </li>
                      <li>
                        <a href="#">Eggs</a>
                      </li>
                      <li>
                        <a href="#">cream</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">seafoods</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">Lobster</a>
                      </li>
                      <li>
                        <a href="#">Octopus</a>
                      </li>
                      <li>
                        <a href="#">Shrimp</a>
                      </li>
                      <li>
                        <a href="#">Halabos</a>
                      </li>
                      <li>
                        <a href="#">Maeuntang</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">diet foods</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">Salmon</a>
                      </li>
                      <li>
                        <a href="#">Avocados</a>
                      </li>
                      <li>
                        <a href="#">Leafy Greens</a>
                      </li>
                      <li>
                        <a href="#">Boiled Potatoes</a>
                      </li>
                      <li>
                        <a href="#">Cottage Cheese</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">fast foods</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">burger</a>
                      </li>
                      <li>
                        <a href="#">milkshake</a>
                      </li>
                      <li>
                        <a href="#">sandwich</a>
                      </li>
                      <li>
                        <a href="#">doughnut</a>
                      </li>
                      <li>
                        <a href="#">pizza</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">drinks</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">cocktail</a>
                      </li>
                      <li>
                        <a href="#">hard soda</a>
                      </li>
                      <li>
                        <a href="#">shampain</a>
                      </li>
                      <li>
                        <a href="#">Wine</a>
                      </li>
                      <li>
                        <a href="#">barley</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">meats</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">Meatball</a>
                      </li>
                      <li>
                        <a href="#">Sausage</a>
                      </li>
                      <li>
                        <a href="#">Poultry</a>
                      </li>
                      <li>
                        <a href="#">chicken</a>
                      </li>
                      <li>
                        <a href="#">Cows</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">fishes</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">scads</a>
                      </li>
                      <li>
                        <a href="#">pomfret</a>
                      </li>
                      <li>
                        <a href="#">groupers</a>
                      </li>
                      <li>
                        <a href="#">anchovy</a>
                      </li>
                      <li>
                        <a href="#">mackerel</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col">
                  <div class="megamenu-wrap">
                    <h5 class="megamenu-title">dry foods</h5>
                    <ul class="megamenu-list">
                      <li>
                        <a href="#">noodles</a>
                      </li>
                      <li>
                        <a href="#">Powdered milk</a>
                      </li>
                      <li>
                        <a href="#">nut & yeast</a>
                      </li>
                      <li>
                        <a href="#">almonds</a>
                      </li>
                      <li>
                        <a href="#">pumpkin</a>
                      </li>
                    </ul>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      @endif
      <form class="header-form">
        <input type="text" placeholder="Search anything...">
        <button>
          <i class="fas fa-search"></i>
        </button>
      </form>
      <div class="header-widget-group">
        {{-- <a href="compare.html" class="header-widget" title="Compare List">
          <i class="fas fa-random"></i>
          <sup>0</sup>
        </a> --}}
        <button class="header-widget header-wish" title="Wishlist">
          <i class="fas fa-heart"></i>
          <div id="wish-value-reload">
            <sup>{{ (sizeof($wishs)) ? $wishs->count() : 0 }}</sup>
          </div>
        </button>
        <button class="header-widget header-cart" title="Cartlist">
          <i class="fas fa-shopping-basket"></i>
          <div id="cart-value-reload">
            <sup>{{ (sizeof($carts)) ? $carts->count() : 0 }}</sup>
          </div>
          </span>
        </button>
      </div>
      @auth
          <div class="header-widget">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <img src="{{ (auth()->user()->image) ? asset( 'assets' . '/' . auth()->user()->image) : asset('images/user.png') }}">
              <span>{{ auth()->user()->name }}</span>
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('profile.index') }}">
                  <i class="bi bi-person"></i>
                  My profile
                </a>
              </li>
              @if (auth()->user()->shop == true)
                <li>
                  <a class="dropdown-item" href="{{ route('shop.index') }}">
                    <i class="bi bi-shop"></i>
                    My shop
                  </a>
                </li>
              @endif
              @can(['admin', 'editor'])
                <li>
                  <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                    <i class="bi bi-columns-gap"></i>
                    My Dashboard
                  </a>
                </li>
              @endcan
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                  </button>
                </form>
              </li>
            </ul>   
          </div>
      @else
        <div class="header-widget px-3">
          <a href="{{ route('login') }}" class="login">Masuk</a>
          <a href="{{ route('register') }}" class="daftar">Daftar</a>
        </div>
      @endauth
    </div>
  </div>
</header>
@if (sizeof($categories))
  <aside class="category-sidebar">
    <div class="category-header">
      <h4 class="category-title">
        <i class="fas fa-align-left"></i>
        <span>categories</span>
      </h4>
      <button class="category-close">
        <i class="icofont-close"></i>
      </button>
    </div>
    <ul class="category-list">
      @foreach ($categories as $item)        
        <li class="category-item">
          {{ $item->name }}
        </li>
      @endforeach
    </ul>
    {{-- <ul class="category-list">
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-vegetable"></i>
          <span>vegetables</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">asparagus</a>
          </li>
          <li>
            <a href="#">broccoli</a>
          </li>
          <li>
            <a href="#">carrot</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-groceries"></i>
          <span>groceries</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Grains & Bread</a>
          </li>
          <li>
            <a href="#">Dairy & Eggs</a>
          </li>
          <li>
            <a href="#">Oil & Fat</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-fruit"></i>
          <span>fruits</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Apple</a>
          </li>
          <li>
            <a href="#">Orange</a>
          </li>
          <li>
            <a href="#">Strawberry</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-dairy-products"></i>
          <span>dairy farm</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Egg</a>
          </li>
          <li>
            <a href="#">milk</a>
          </li>
          <li>
            <a href="#">butter</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-crab"></i>
          <span>sea foods</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Lobster</a>
          </li>
          <li>
            <a href="#">Octopus</a>
          </li>
          <li>
            <a href="#">Shrimp</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-salad"></i>
          <span>diet foods</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Salmon</a>
          </li>
          <li>
            <a href="#">Potatoes</a>
          </li>
          <li>
            <a href="#">Greens</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-dried-fruit"></i>
          <span>dry foods</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">noodles</a>
          </li>
          <li>
            <a href="#">Powdered milk</a>
          </li>
          <li>
            <a href="#">nut & yeast</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-fast-food"></i>
          <span>fast foods</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">mango</a>
          </li>
          <li>
            <a href="#">plumsor</a>
          </li>
          <li>
            <a href="#">raisins</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-cheers"></i>
          <span>drinks</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Wine</a>
          </li>
          <li>
            <a href="#">Juice</a>
          </li>
          <li>
            <a href="#">Water</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-beverage"></i>
          <span>coffee</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Cappuchino</a>
          </li>
          <li>
            <a href="#">Espresso</a>
          </li>
          <li>
            <a href="#">Latte</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-barbecue"></i>
          <span>meats</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Meatball</a>
          </li>
          <li>
            <a href="#">Sausage</a>
          </li>
          <li>
            <a href="#">Poultry</a>
          </li>
        </ul>
      </li>
      <li class="category-item">
        <a class="category-link dropdown-link" href="#">
          <i class="flaticon-fish"></i>
          <span>fishes</span>
        </a>
        <ul class="dropdown-list">
          <li>
            <a href="#">Agujjim</a>
          </li>
          <li>
            <a href="#">saltfish</a>
          </li>
          <li>
            <a href="#">pazza</a>
          </li>
        </ul>
      </li>
    </ul> --}}
  </aside>
@endif
<aside class="cart-sidebar">
  <div class="cart-header">
    <div class="cart-total">
      <i class="fas fa-shopping-basket"></i>
      <span>Keranjang ({{ (sizeof($carts)) ? $carts->count() : 0 }})</span>
    </div>
    <button class="cart-close">
      <i class="icofont-close"></i>
    </button>
  </div>
  @if (sizeof($carts))
    <ul class="cart-list">
      <li>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="pilih-semua" onchange="pilihSemua(this)">
          <label class="form-check-label" for="pilih-semua">
            Pilih semua
          </label>
        </div>
      </li>
      @foreach ($carts as $item)          
        <li class="cart-item">
          <div class="form-check">
            <input type="checkbox" class="cart-checkbox form-check-input" onchange="cartCheck()" name="checkbox_order[]" value="{{ $item->cart_hash }}" harga="{{ $item->product->price }}" data-pcs="1">
          </div>
          <div class="cart-media">
            <a href="#" onclick="cartDelete('{{ $item->cart_hash }}')">
              <img src="{{ asset('assets') . '/' . $item->product->image }}" alt="product" class="img-fluid">
            </a>
            <button class="cart-delete" onclick="cartDelete('{{ $item->cart_hash }}')">
              <i class="far fa-trash-alt"></i>
            </button>
          </div>
          <div class="cart-info-group">
            <div class="cart-info">
              <h6>
                <a href="{{ route('product.show', $item->product->product_hash) }}">{{ $item->product->name }}</a>
              </h6>
              <p>Rp. {{ number_format($item->product->price,0,',','.') }}</p>
            </div>
            <div class="cart-action-group">
              <div class="product-action">
                <button class="action-minus" title="Quantity Minus" onclick="pcsMinus(this)">
                  <i class="icofont-minus"></i>
                </button>
                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus" onclick="pcsPlus(this)">
                  <i class="icofont-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    <div class="cart-footer">
      <button class="btn btn-success cart-footer-submit" onclick="submitCartToOrder()" disabled>
        <span class="checkout-label">Beli (<span class="checkout-data">0</span>)</span>
        <span class="checkout-price">Rp 0</span>
        
      </button>
    </div>
  @else
      <div class="cart-list">
        Wah, Keranjang belanjaanmu kosong!
      </div>
  @endif
</aside>
<aside class="wish-sidebar">
  <div class="wish-header">
    <div class="wish-total">
      <i class="fas fas fa-heart"></i>
      <span>Barang disimpan ({{ (sizeof($wishs)) ? $wishs->count() : 0 }})</span>
    </div>
    <button class="wish-close">
      <i class="icofont-close"></i>
    </button>
  </div>
  @if (sizeof($wishs))
  <ul class="wish-list">
    @foreach ($wishs as $item)          
      <li class="wish-item">
        <div class="wish-media">
          <a href="{{ route('product.show', $item->product->product_hash) }}">
            <img src="{{ asset('assets') . '/' . $item->product->image }}" alt="product" class="img-fluid">
          </a>
          {{-- <button class="wish-delete" onclick="wishToggle('{{ $item->cart_hash }}')">
            <i class="far fa-trash-alt"></i>
          </button> --}}
        </div>
        <div class="wish-info-group">
          <div class="wish-info">
            <h6>
              <a href="{{ route('product.show', $item->product->product_hash) }}">{{ $item->product->name }}</a>
            </h6>
            <p>Rp. {{ number_format($item->product->price,0,',','.'); }}</p>
          </div>
          {{-- <div class="wish-action-group">
            <div class="product-action">
              <button class="action-minus" title="Quantity Minus">
                <i class="icofont-minus"></i>
              </button>
              <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
              <button class="action-plus" title="Quantity Plus">
                <i class="icofont-plus"></i>
              </button>
            </div>
            <h6>$56.98</h6>
          </div> --}}
        </div>
      </li>
    @endforeach
  </ul>
  @else      
    <div class="wish-list">
      belum ada produk tersimpan
    </div>
  @endif
</aside>
<aside class="nav-sidebar">
  <div class="nav-header">
    <a href="{{ route('home') }}">
      <img src="{{ asset('images/logoipsum-221.svg') }}" alt="logo">
    </a>
    <button class="nav-close">
      <i class="icofont-close"></i>
    </button>
  </div>
  <div class="nav-content">
    <div class="nav-btn align-items-center align-items-center flex-column">
      @auth
        <a href="{{ route('profile.index') }}" class="btn btn-inlane">
          <span>My profile</span>
        </a>
        @if (auth()->user()->shop == true)
          <a class="btn btn-inlane" href="{{ route('shop.index') }}">
            <span>My shop</span> 
          </a>
        @endif
        @can('admin')
          <a class="btn btn-inlane" href="{{ route('dashboard.index') }}">
            <span>My Dashboard</span> 
          </a>
        @endcan
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger">
            <span>Logout</span> 
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="login">
          <span>Log in</span>
        </a>
        <br>
        <a href="{{ route('register') }}" class="daftar">
          <span>Daftar</span>
        </a>
      @endauth
    </div>
  </div>
</aside>
<div class="mobile-menu">
  <a href="{{ route('home') }}" title="Home Page">
    <i class="fas fa-home"></i>
    <span>Home</span>
  </a>
  <button class="cate-btn" title="Category List">
    <i class="fas fa-list"></i>
    <span>category</span>
  </button>
  <button class="cart-btn" title="Cartlist">
    <i class="fas fa-shopping-basket"></i>
    <span>cartlist</span>
    <sup>{{ (sizeof($carts)) ? $carts->count() : 0 }}</sup>
  </button>
  <button class="wish-btn" title="Wishlist">
    <i class="fas fa-heart"></i>
    <span>wishlist</span>
    <sup>{{ (sizeof($wishs)) ? $wishs->count() : 0 }}</sup>
  </button>
  {{-- <a href="compare.html" title="Compare List">
    <i class="fas fa-random"></i>
    <span>compare</span>
    <sup>0</sup>
  </a> --}}
</div>