@extends('layout.main')

@section('container')

<div class="modal fade" id="product-view">
    <div class="modal-dialog">
    <div class="modal-content">
        <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
        <div class="product-view">
        <div class="row">
            <div class="col-md-6 col-lg-6">
            <div class="view-gallery">
                <div class="view-label-group">
                <label class="view-label new">new</label>
                <label class="view-label off">-10%</label>
                </div>
                <ul class="preview-slider slider-arrow">
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                </ul>
                <ul class="thumb-slider">
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                <li>
                    <img src="images/product/01.jpg" alt="product">
                </li>
                </ul>
            </div>
            </div>
            <div class="col-md-6 col-lg-6">
            <div class="view-details">
                <h3 class="view-name">
                <a href="product-video.html">existing product name</a>
                </h3>
                <div class="view-meta">
                <p>SKU: <span>1234567</span>
                </p>
                <p>BRAND: <a href="#">radhuni</a>
                </p>
                </div>
                <div class="view-rating">
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="icofont-star"></i>
                <a href="product-video.html">(3 reviews)</a>
                </div>
                <h3 class="view-price">
                <del>$38.00</del>
                <span>$24.00 <small>/per kilo</small>
                </span>
                </h3>
                <p class="view-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit non tempora magni repudiandae sint suscipit tempore quis maxime explicabo veniam eos reprehenderit fuga</p>
                <div class="view-list-group">
                <label class="view-list-title">tags:</label>
                <ul class="view-tag-list">
                    <li>
                    <a href="#">organic</a>
                    </li>
                    <li>
                    <a href="#">vegetable</a>
                    </li>
                    <li>
                    <a href="#">chilis</a>
                    </li>
                </ul>
                </div>
                <div class="view-list-group">
                <label class="view-list-title">Share:</label>
                <ul class="view-share-list">
                    <li>
                    <a href="#" class="icofont-facebook" title="Facebook"></a>
                    </li>
                    <li>
                    <a href="#" class="icofont-twitter" title="Twitter"></a>
                    </li>
                    <li>
                    <a href="#" class="icofont-linkedin" title="Linkedin"></a>
                    </li>
                    <li>
                    <a href="#" class="icofont-instagram" title="Instagram"></a>
                    </li>
                </ul>
                </div>
                <div class="view-add-group">
                <button class="product-add" title="Add to Cart">
                    <i class="fas fa-shopping-basket"></i>
                    <span>add to cart</span>
                </button>
                <div class="product-action">
                    <button class="action-minus" title="Quantity Minus">
                    <i class="icofont-minus"></i>
                    </button>
                    <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                    <button class="action-plus" title="Quantity Plus">
                    <i class="icofont-plus"></i>
                    </button>
                </div>
                </div>
                <div class="view-action-group">
                <a class="view-wish wish" href="#" title="Add Your Wishlist">
                    <i class="icofont-heart"></i>
                    <span>add to wish</span>
                </a>
                <a class="view-compare" href="compare.html" title="Compare This Item">
                    <i class="fas fa-random"></i>
                    <span>Compare This</span>
                </a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="add-product-card">
    <div class="modal-dialog modal-xl">
        @if ($errors->any())
            <div class="mt-n1 mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
            {{ implode('', $errors->all(':message')) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="modal-content">
            <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="product-view">
                    <div class="m-4 p-4">
                        <div class="row clearfix">
                            <div class="col-lg-6 float-start">
                                <div class="mb-3">
                                    <input type="file" class="form-control" placeholder="image" name="image" id="image" onchange="imagePreview()">
                                </div>
                                <img src="" class="img-preview img-fluid">
                            </div>
                            <div class="col-lg-6 float-end">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="productName" name="name" placeholder="Enter product name" value="{{ old('name') }}">
                                </div>
                                <!-- Input Field -->
                                <div class="form-group">
                                    <label for="productPrice">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="productPrice" name="price" placeholder="Enter price" value="{{ old('price') }}">
                                </div>
                                <!-- Input Field -->
                                <div class="form-group">
                                    <label for="productDescription">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="productDescription" rows="3" name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-button">
                                    <button type="submit">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<section class="single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
    <h2>Brand Single</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item">
        <a href="brand-list.html">brand-list</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">brand-single</li>
    </ol>
    </div>
</section>
<div class="brand-single">
    <a href="#">
    <img src="images/brand/02.jpg" alt="brand">
    </a>
    <a href="#">
    <h3>vegan lovers</h3>
    </a>
    <ul>
    <li class="fas fa-star active"></li>
    <li class="fas fa-star active"></li>
    <li class="fas fa-star active"></li>
    <li class="fas fa-star active"></li>
    <li class="fas fa-star"></li>
    <li class="total">(163 ratings)</li>
    </ul>
    <p>(45 items)</p>
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
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5">
            @if ($product->count())
                @foreach ($product as $item)
                    <div class="col">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-label">
                                    <label class="label-text new">new</label>
                                </div>
                                <button class="product-wish wish">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <a class="product-image" href="#">
                                    <img src="{{ asset('assets') . '/' . $item->image }}" alt="product">
                                </a>
                                <div class="product-widget">
                                    <a title="Product Compare" href="compare.html" class="fas fa-random"></a>
                                    <a title="Product Video" href="https://youtu.be/9xzcVxSBbG8" class="venobox fas fa-play" data-autoplay="true" data-vbtype="video"></a>
                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view"></a>
                                </div>
                            </div>
                            <div class="product-content">
                            <div class="product-rating">
                                <i class="active icofont-star"></i>
                                <i class="active icofont-star"></i>
                                <i class="active icofont-star"></i>
                                <i class="active icofont-star"></i>
                                <i class="icofont-star"></i>
                            </div>
                            <h6 class="product-name">
                                <a href="#">{{ $item->name }}</a>
                            </h6>
                            <h6 class="product-price">
                                <span>Rp {{ $item->price }}</span>
                            </h6>
                            <button class="product-add" title="Add to Cart">
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
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12">
                    <p class="text-center">Belum ada produk</p>
                </div>
            @endif
        </div>
        <div class="row col-lg-12">
            <button data-bs-toggle="modal" class="btn btn-outline-success" data-bs-target="#add-product-card">
                <i class="fas fa-box"></i>
                <span>add product</span>
            </button>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="bottom-paginate">
                <p class="page-info">Showing 12 of 60 Results</p>
                <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link active" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">...</li>
                <li class="page-item">
                    <a class="page-link" href="#">60</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                    <i class="fas fa-long-arrow-alt-right"></i>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</section>


<script>

function imagePreview()
{
  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview');
  
  imgPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent)
  {
    imgPreview.src = oFREvent.target.result;
  }

};

</script>

@endsection

@section('script')

@if ($errors->any())
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("add-product-card"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
    </script>
@endif

@endsection