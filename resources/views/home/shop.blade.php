@extends('layout.main')

@section('container')

<section class="single-banner" style="background: url({{ ($shop->banner) ? asset( 'assets' . '/' . $shop->banner ) : asset('images/single-banner.jpg') }}) no-repeat center;"></section>
<div class="brand-single">
    <a>
        <img class="img-fluid" src="{{ ($shop->image) ? asset('assets' . '/' . $shop->image ) : asset('images/brand/02.jpg') }}" alt="brand">
    </a>
    <a>
        <h3>{{ $shop->name }}</h3>
    </a>
</div>
<section class="inner-section shop-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="top-filter">
                <div class="filter-show">
                <label class="filter-label">Show :</label>
                <select class="form-select filter-select">
                    <option value="1">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                </select>
                </div>
                <div class="filter-short">
                <label class="filter-label">Short by :</label>
                <select class="form-select filter-select">
                    <option selected>default</option>
                    <option value="3">trending</option>
                    <option value="1">featured</option>
                    <option value="2">recommend</option>
                </select>
                </div>
            </div>
            </div>
        </div>
        @if (sizeof($products))            
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                @foreach ($products as $item)                    
                    <div class="col">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-label">
                                    <label class="label-text sale">sale</label>
                                </div>
                                <button class="product-wish wish">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <a class="product-image" href="{{ route('product.show', $item->product_hash) }}">
                                    <img src="{{ asset('assets' . '/' . $item->image) }}" alt="product">
                                </a>
                                <div class="product-widget">
                                    <a title="Product View" href="{{ route('product.show', $item->product_hash) }}" class="fas fa-eye"></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-rating">
                                    <i class="active icofont-star"></i>
                                    <i class="active icofont-star"></i>
                                    <i class="active icofont-star"></i>
                                    <i class="active icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <a href="#">(3)</a>
                                </div>
                                <h6 class="product-name">
                                    <a href="{{ route('product.show', $item->product_hash) }}">{{ $item->name }}</a>
                                </h6>
                                <h6 class="product-price">
                                    <del>$34</del>
                                    <span>$28 <small>/piece</small>
                                    </span>
                                </h6>
                                {{-- <button class="product-add" title="Add to Cart">
                                    <i class="fas fa-shopping-basket"></i>
                                    <span>add</span>
                                </button>
                                <div class="product-action">
                                    <button class="action-minus" title="Quantity Minus">
                                    <i class="icofont-minus"></i>
                                    </button>
                                    <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                                    <button class="action-plus" title="Quantity Plus">
                                    <i class="icofont-plus"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <p>Belum ada produk</p>
                    </div>
                </div>
            </div>            
        @endif
    </div>
</section>

@endsection
@section('script')



@endsection