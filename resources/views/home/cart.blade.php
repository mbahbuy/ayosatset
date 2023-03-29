@extends('layout.main')

@section('container')

<section class="inner-section shop-part">
    <div class="container">
      <div class="row content-reverse">
        <div class="col-lg-9">
            
            @if (sizeof($carts))
                <div class="cart-list">
                <div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="pilih-semua" onchange="pilihSemua(this)">
                    <label class="form-check-label" for="pilih-semua">
                        Pilih semua
                    </label>
                    </div>
                </div>
                </div>
                <ul class="cart-list">
                @foreach ($carts as $item)  
                    <li>
                    <div class="form-check">
                        <input class="form-check-input cart-shop" type="checkbox" id="pilih-shop-{{ $item->shop_hash }}" onchange="pilihShop(this)">
                        <label class="form-check-label" for="pilih-shop-{{ $item->shop_hash }}">
                        {{ $item->name }}
                        </label>
                    </div>
                    <ul>
    
                        @foreach ($item->product as $p)           
                        <li class="cart-item">
                            <div class="form-check">
                            <input type="checkbox" class="cart-checkbox form-check-input" onchange="cartCheck()" name="checkbox_order[]" value="{{ $p->product_hash }}" harga="{{ $p->price }}" data-pcs="1">
                            </div>
                            <div class="cart-media">
                            <a href="#" onclick="cartDelete('{{ $p->product_hash }}')">
                                <img src="{{ asset('assets') . '/' . $p->image }}" alt="product" class="img-fluid">
                            </a>
                            <button class="cart-delete" onclick="cartDelete('{{ $p->product_hash }}')">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            </div>
                            <div class="cart-info-group">
                            <div class="cart-info">
                                <h6>
                                <a href="{{ route('product.show', $p->product_hash) }}">{{ $p->name }}</a>
                                </h6>
                                <p>Rp. {{ number_format($p->price,0,',','.') }}</p>
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
                    </li>
                    <li class="border border-primary border-3 opacity-75 mb-3 mt-5"></li>
                @endforeach
                </ul>
                <div class="cart-footer">
                <button class="btn btn-success cart-footer-submit" data-bs-toggle="modal" data-bs-target="#get-ongkir" onclick="provinsi();$('#cart-to-order').carousel('next');" disabled>
                    <span class="checkout-label">Beli (<span class="checkout-data">0</span>)</span>
                    <span class="checkout-price">Rp 0</span>
                </button>
                </div>
            @else
                <div class="cart-list">
                    Wah, Keranjang belanjaanmu kosong!
                </div>
            @endif

        </div>
        <div class="col-lg-3">
          <div class="shop-widget">
            <h6 class="shop-widget-title">Filter by Rating</h6>
            <form>
              <ul class="shop-widget-list">
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="feat1">
                    <label for="feat1">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                    </label>
                  </div>
                  <span class="shop-widget-number">(13)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="feat2">
                    <label for="feat2">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star"></i>
                    </label>
                  </div>
                  <span class="shop-widget-number">(28)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="feat3">
                    <label for="feat3">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </label>
                  </div>
                  <span class="shop-widget-number">(35)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="feat4">
                    <label for="feat4">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </label>
                  </div>
                  <span class="shop-widget-number">(47)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="feat5">
                    <label for="feat5">
                      <i class="fas fa-star active"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    </label>
                  </div>
                  <span class="shop-widget-number">(59)</span>
                </li>
              </ul>
              <button class="shop-widget-btn">
                <i class="far fa-trash-alt"></i>
                <span>clear filter</span>
              </button>
            </form>
          </div>
          <div class="shop-widget">
            <h6 class="shop-widget-title">Filter by Tag</h6>
            <form>
              <ul class="shop-widget-list">
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="tag1">
                    <label for="tag1">new items</label>
                  </div>
                  <span class="shop-widget-number">(13)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="tag2">
                    <label for="tag2">sale items</label>
                  </div>
                  <span class="shop-widget-number">(28)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="tag3">
                    <label for="tag3">rating items</label>
                  </div>
                  <span class="shop-widget-number">(35)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="tag4">
                    <label for="tag4">feature items</label>
                  </div>
                  <span class="shop-widget-number">(47)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="tag5">
                    <label for="tag5">discount items</label>
                  </div>
                  <span class="shop-widget-number">(59)</span>
                </li>
              </ul>
              <button class="shop-widget-btn">
                <i class="far fa-trash-alt"></i>
                <span>clear filter</span>
              </button>
            </form>
          </div>
          <div class="shop-widget">
            <h6 class="shop-widget-title">Filter by Brand</h6>
            <form>
              <input class="shop-widget-search" type="text" placeholder="Search...">
              <ul class="shop-widget-list shop-widget-scroll">
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand1">
                    <label for="brand1">mari gold</label>
                  </div>
                  <span class="shop-widget-number">(13)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand2">
                    <label for="brand2">tredar</label>
                  </div>
                  <span class="shop-widget-number">(28)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand3">
                    <label for="brand3">keya</label>
                  </div>
                  <span class="shop-widget-number">(35)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand4">
                    <label for="brand4">diamond</label>
                  </div>
                  <span class="shop-widget-number">(47)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand5">
                    <label for="brand5">lilly's</label>
                  </div>
                  <span class="shop-widget-number">(59)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand6">
                    <label for="brand6">fremant</label>
                  </div>
                  <span class="shop-widget-number">(64)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand7">
                    <label for="brand7">avocads</label>
                  </div>
                  <span class="shop-widget-number">(77)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="brand8">
                    <label for="brand8">boroclas</label>
                  </div>
                  <span class="shop-widget-number">(85)</span>
                </li>
              </ul>
              <button class="shop-widget-btn">
                <i class="far fa-trash-alt"></i>
                <span>clear filter</span>
              </button>
            </form>
          </div>
          <div class="shop-widget">
            <h6 class="shop-widget-title">Filter by Category</h6>
            <form>
              <input class="shop-widget-search" type="text" placeholder="Search...">
              <ul class="shop-widget-list shop-widget-scroll">
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate1">
                    <label for="cate1">vegetables</label>
                  </div>
                  <span class="shop-widget-number">(13)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate2">
                    <label for="cate2">groceries</label>
                  </div>
                  <span class="shop-widget-number">(28)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate3">
                    <label for="cate3">fruits</label>
                  </div>
                  <span class="shop-widget-number">(35)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate4">
                    <label for="cate4">dairy farm</label>
                  </div>
                  <span class="shop-widget-number">(47)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate5">
                    <label for="cate5">sea foods</label>
                  </div>
                  <span class="shop-widget-number">(59)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate6">
                    <label for="cate6">diet foods</label>
                  </div>
                  <span class="shop-widget-number">(64)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate7">
                    <label for="cate7">dry foods</label>
                  </div>
                  <span class="shop-widget-number">(77)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate8">
                    <label for="cate8">fast foods</label>
                  </div>
                  <span class="shop-widget-number">(85)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate9">
                    <label for="cate9">drinks</label>
                  </div>
                  <span class="shop-widget-number">(92)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate10">
                    <label for="cate10">coffee</label>
                  </div>
                  <span class="shop-widget-number">(21)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate11">
                    <label for="cate11">meats</label>
                  </div>
                  <span class="shop-widget-number">(14)</span>
                </li>
                <li>
                  <div class="shop-widget-content">
                    <input type="checkbox" id="cate12">
                    <label for="cate12">fishes</label>
                  </div>
                  <span class="shop-widget-number">(56)</span>
                </li>
              </ul>
              <button class="shop-widget-btn">
                <i class="far fa-trash-alt"></i>
                <span>clear filter</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
@section('script')
    
@endsection