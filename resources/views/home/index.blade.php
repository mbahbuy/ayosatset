@extends('layout.main')

@section('container')

<section class="home-index-slider slider-arrow slider-dots">
    <div class="banner-part banner-1">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-6 col-lg-6">
            <div class="banner-content">
            <h1>Coming soon</h1>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="banner-img">
            <img src="images/coming-soon.png" alt="index">
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<section class="section recent-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Products</h2>
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
                                    @if (Carbon\Carbon::parse($item->created_at)->diffInWeeks(now()) <= 1)
                                        <label class="details-label new">new</label>
                                    @else
                                        <label class="label-text sale">sale</label>
                                    @endif
                                </div>
                                <button class="product-wish wish {{ ($item->wish) ? 'active' : '' }}" target-wish="{{ $item->product_hash }}" onclick="wishToggle(this)">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <a class="product-image" href="{{ route('product.show', $item->product_hash) }}">
                                    <img src="{{ asset('assets' . '/' . $item->image) }}" alt="product">
                                </a>
                                <div class="product-widget">
                                    <a title="Product View" href="{{ route('product.show', $item->product_hash) }}" class="fas fa-eye"></a>
                                    <button class="fas fa-shopping-basket" onclick="cartAdd('{{ $item->product_hash }}')"></button>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-rating">
                                    @php
                                        $rating = $item->ratings ? $item->ratings->average('rating') : 0;
                                    @endphp
                                    <i class="{{ $rating >= 1 ? 'active' : '' }} icofont-star"></i>
                                    <i class="{{ $rating >= 2 ? 'active' : ''  }} icofont-star"></i>
                                    <i class="{{ $rating >= 3 ? 'active' : ''  }} icofont-star"></i>
                                    <i class="{{ $rating >= 4 ? 'active' : ''  }} icofont-star"></i>
                                    <i class="{{ $rating >= 5 ? 'active' : ''  }} icofont-star"></i>
                                    <a href="#">({{ $item->ratings ? $item->ratings->count() : 0 }})</a>
                                </div>
                                <h6 class="product-name">
                                    <a href="{{ route('product.show', $item->product_hash) }}">{{ $item->name }}</a>
                                </h6>
                                <h6 class="product-price">
                                    {{-- <del>$34</del> --}}
                                    <span>Rp. {{ number_format($item->price,0,',','.') }}</span>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        {{-- <a href="#" class="btn btn-outline">
                            <i class="fas fa-eye"></i>
                            <span>show more</span>
                        </a> --}}
                        {{ $products->links() }}
                    </div>
                </div>
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