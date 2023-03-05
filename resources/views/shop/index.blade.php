@extends('layout.main')

@section('container')

<div class="modal fade" id="add-product-card">
    @php
        $img_class_product_add = ($errors->product_store->has('image')) ? 'is-invalid' : '' ;
        $img_value_product_add = ($errors->product_store->any()) ? old('image') : '';
        $name_class_product_add = ($errors->product_store->has('name')) ? 'is-invalid' : '' ;
        $name_value_product_add = ($errors->product_store->any()) ? old('name') : '';
        $price_class_product_add = ($errors->product_store->has('price')) ? 'is-invalid' : '' ;
        $price_value_product_add = ($errors->product_store->any()) ? old('price') : '';
        $desc_class_product_add = ($errors->product_store->has('description')) ? 'is-invalid' : '' ;
        $desc_value_product_add = ($errors->product_store->any()) ? old('description') : '';
        $ctg_class_product_add = ($errors->product_store->has('categories')) ? 'is-invalid' : '' ;
        $ctg_value_product_add = ($errors->product_store->any()) ? old('categories') : '';
    @endphp
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
            @if ($categories->count())                
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="product-view">
                        <div class="m-4 p-4">
                            @if ($errors->product_store->any())
                                <div class="mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->product_store->all() as $item)
                                        {{ $item }} <br>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row clearfix">
                                <div class="col-lg-6 float-start">
                                    <div class="mb-3">
                                        <input type="file" class="form-control {{ $img_class_product_add }}" placeholder="image" name="image" id="product-img" onchange="productPreview()" value="{{ $img_value_product_add }}">
                                    </div>
                                    <img src="" class="product-preview img-fluid">
                                </div>
                                <div class="col-lg-6 float-end">
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" class="form-control {{ $name_class_product_add }}" id="productName" name="name" placeholder="Enter product name" value="{{ $name_value_product_add }}">
                                    </div>
                                    @if (sizeof($categories))
                                        <div class="form-group">
                                            <label for="productCategory">Category</label>
                                            <select class="form-select {{ $ctg_class_product_add }}" id="productCategory" name="categories">
                                                @foreach ($categories as $category)
                                                @if ($ctg_value_product_add == $category->slug)
                                                    <option value="{{ $category->slug }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="productPrice">Price</label>
                                        <input type="number" class="form-control {{ $price_class_product_add }}" id="productPrice" name="price" placeholder="Enter price" value="{{ $price_value_product_add }}">
                                    </div>
                                    <!-- Input Field -->
                                    <div class="form-group">
                                        <label for="productDescription">Description</label>
                                        <textarea class="form-control {{ $desc_class_product_add }}" id="productDescription" rows="3" name="description">{{ $desc_value_product_add }}</textarea>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="product-view">
                    <h4 class="text-center m-4">
                        Maaf, fiture tambah produk belum ada, karena admin belum menambahkan category
                    </h4>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="settings">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        @php
            $banner_class_shop = ($errors->shop_update->has('banner')) ? 'is-invalid' : '' ;
            $banner_value_shop = ($errors->shop_update->any()) ? old('banner') : auth()->user()->shop->banner;
            $name_class_shop = ($errors->shop_update->has('name')) ? 'is-invalid' : '' ;
            $name_value_shop = ($errors->shop_update->any()) ? old('name') : auth()->user()->shop->name;
            $img_class_shop = ($errors->shop_update->has('image')) ? 'is-invalid' : '';
            $img_value_shop = ($errors->shop_update->any()) ? old('image') : ((auth()->user()->shop->image) ? auth()->user()->shop->image : '') ;
            $desc_class_shop = ($errors->shop_update->has('description')) ? 'is-invalid' : '';
            $desc_value_shop = ($errors->shop_update->any()) ? old('description') : ((auth()->user()->shop->description) ? auth()->user()->shop->description : '');
            $des_class_shop = ($errors->shop_update->has('description')) ? 'is-invalid' : '';
            $des_value_shop = ($errors->shop_update->any()) ? old('description') : auth()->user()->shop->description;
        @endphp
        <button class="modal-close" data-bs-dismiss="modal">
            <i class="icofont-close"></i>
        </button>
        <form class="modal-form" method="POST" action="{{ route('shop.update', auth()->user()->shop->shop_hash) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-title mb-3">
                <h3>Settings Shop</h3>
            </div>
            @if ($errors->shop_update->any())
                <div class="mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->shop_update->all() as $item)
                        {{ $item }} <br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group">
                <label class="form-label" for="banner">Banner</label>
                <input class="form-control {{ $banner_class_shop }}" type="file" name="banner" id="banner" value="{{ $banner_value_shop }}" onchange="bannerPreview()">
                <img class="img-fluid banner-preview" src="{{ (auth()->user()->shop->banner) ? asset( 'assets' . '/' . auth()->user()->shop->banner ) : 'images/single-banner.jpg' }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="shop-img">shop image</label>
                <input class="form-control {{ $img_class_shop }}" type="file" name="image" id="shop-img" value="{{ $img_value_shop }}" onchange="shopPreview()">
                <img class="img-fluid shop-preview" src="{{ (auth()->user()->shop->image) ? asset('assets' . '/' . auth()->user()->shop->image ) : 'images/brand/02.jpg' }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="name">name</label>
                <input class="form-control {{ $name_class_shop }}" name="name" id="name" type="text" value="{{ $name_value_shop }}">
            </div>
            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea class="form-control {{ $des_class_shop }}" id="productDescription" rows="3" name="description">{{ $des_value_shop }}</textarea>
            </div>
            <button class="form-btn" type="submit">save profile info</button>
        </form>
    </div>
    </div>
</div>

<section class="single-banner" style="background: url({{ (auth()->user()->shop->banner) ? asset( 'assets' . '/' . auth()->user()->shop->banner ) : asset('images/single-banner.jpg') }}) no-repeat center;"></section>
<div class="brand-single">
    <a>
        <img class="img-fluid" src="{{ (auth()->user()->shop->image) ? asset('assets' . '/' . auth()->user()->shop->image ) : asset('images/brand/02.jpg') }}" alt="brand">
    </a>
    <a>
        <h3>{{ auth()->user()->shop->name }}</h3>
    </a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#settings">
        Settings
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
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5">
            @if ($product->count())
                @foreach ($product as $item)
                    <div class="col">
                        <div class="product-card">
                            <div class="product-media">
                                {{-- <div class="product-label">
                                    <label class="label-text new">new</label>
                                </div>
                                <button class="product-wish wish">
                                    <i class="fas fa-heart"></i>
                                </button> --}}
                                <div class="product-image">
                                    <img src="{{ asset('assets') . '/' . $item->image }}" alt="product">
                                </div>
                                <div class="product-widget">
                                    <a title="Product View" href="{{ route('product.show', $item->product_hash) }}" class="fas fa-eye"></a>
                                    <button title="Edit Product" class="bi bi-wrench"data-bs-toggle="modal" data-bs-target="#updateProduct-{{ $item->product_hash }}"></button>
                                    <form action="{{ route('product.destroy', $item->product_hash) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button title="Hapus Product" class="bi bi-trash" onclick="return confirm('Anda mau menghapus product(`{{ $item->name }}`)?')"></button>
                                    </form>
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
                                <span>Rp {{ number_format($item->price,0,',','.') }}</span>
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

@if (sizeof($product))
    @foreach ($product as $item)
        <div class="modal fade" id="updateProduct-{{ $item->product_hash }}">
            @php
                $keyerror[$item->product_hash] = 'product_update_' . $item->product_hash;
                
                $img_class_product[$item->product_hash] = $errors->first('image', $keyerror[$item->product_hash]) ? 'is-invalid' : '' ;
                $img_value_product[$item->product_hash] = $errors->get($keyerror[$item->product_hash]) ? old('image') != '' ? old('image') : $item->image : $item->image;
                $name_class_product[$item->product_hash] = $errors->first('name', $keyerror[$item->product_hash]) ? 'is-invalid' : '' ;
                $name_value_product[$item->product_hash] = $errors->get($keyerror[$item->product_hash]) ? old('name') != '' ? old('image') : $item->name : $item->name;
                $price_class_product[$item->product_hash] = $errors->first('price', $keyerror[$item->product_hash]) ? 'is-invalid' : '' ;
                $price_value_product[$item->product_hash] = $errors->get($keyerror[$item->product_hash]) ? old('price') != '' ? old('price') : $item->price : $item->price;
                $desc_class_product[$item->product_hash] = $errors->first('description', $keyerror[$item->product_hash]) ? 'is-invalid' : '' ;
                $desc_value_product[$item->product_hash] = $errors->get($keyerror[$item->product_hash]) ? old('description') != '' ? old('description') : $item->description : $item->description;
                $ctg_class_product[$item->product_hash] = $errors->first('categories', $keyerror[$item->product_hash]) ? 'is-invalid' : '' ;
                $ctg_value_product[$item->product_hash] = $errors->get($keyerror[$item->product_hash]) ? old('categories') != '' ? old('categories') : $item->categories : $item->categories;
            @endphp
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
                    <form action="{{ route('product.update', $item->product_hash) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="product-view">
                            <div class="m-4 p-4">
                                @if ($errors->get($keyerror[$item->product_hash]))
                                    <div class="mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->get($keyerror[$item->product_hash]) as $item)
                                            {{ $item }} <br>
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="row clearfix">
                                    <div class="col-lg-6 float-start">
                                        <div class="mb-3">
                                            <input type="file" class="form-control {{ $img_class_product[$item->product_hash] }}" placeholder="image" name="image" id="product-img-update-{{ $item->product_hash }}" onchange="productUpdatePreview('{{ $item->product_hash }}')" value="">
                                        </div>
                                        <input type="hidden" name="old_image" value="{{ $img_value_product[$item->product_hash] }}">
                                        <img src="{{ asset('assets') . '/' . $img_value_product[$item->product_hash] }}" class="product-preview-{{ $item->product_hash }} img-fluid">
                                    </div>
                                    <div class="col-lg-6 float-end">
                                        <div class="form-group">
                                            <label for="productName">Product Name</label>
                                            <input type="text" class="form-control {{ $name_class_product[$item->product_hash] }}" id="productName" name="name" placeholder="Enter product name" value="{{ $name_value_product[$item->product_hash] }}">
                                        </div>
                                        @if (sizeof($categories))
                                            <div class="form-group">
                                                <label for="productCategory">Category</label>
                                                <select class="form-select {{ $ctg_class_product[$item->product_hash] }}" id="productCategory" name="categories">
                                                    @foreach ($categories as $category)
                                                    @if ($ctg_value_product[$item->product_hash] == $category->slug)
                                                        <option value="{{ $category->slug }}" selected>{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="productPrice">Price</label>
                                            <input type="number" class="form-control {{ $price_class_product[$item->product_hash] }}" id="productPrice" name="price" placeholder="Enter price" value="{{ $price_value_product[$item->product_hash] }}">
                                        </div>
                                        <!-- Input Field -->
                                        <div class="form-group">
                                            <label for="productDescription">Description</label>
                                            <textarea class="form-control {{ $desc_class_product[$item->product_hash] }}" id="productDescription" rows="3" name="description">{{ $desc_value_product[$item->product_hash] }}</textarea>
                                        </div>
                                        <div class="form-button">
                                            <button type="submit">Rubah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection

@section('script')
<script>
    // Produk input preview
    const productImg = document.querySelector('#product-img');
    const productImgPreview = document.querySelector('.product-preview');
    function productPreview()
    {
      productImgPreview.style.display = 'block';
    
      const oFReader = new FileReader();
      oFReader.readAsDataURL(productImg.files[0]);
    
      oFReader.onload = function(oFREvent)
      {
        productImgPreview.src = oFREvent.target.result;
      }
    };

    // banner preview
    const bannerImg = document.querySelector('#banner');
    const bannerImgPreview = document.querySelector('.banner-preview');
    function bannerPreview()
    {
      bannerImgPreview.style.display = 'block';
    
      const oFReader = new FileReader();
      oFReader.readAsDataURL(bannerImg.files[0]);
    
      oFReader.onload = function(oFREvent)
      {
        bannerImgPreview.src = oFREvent.target.result;
      }
    };

    // image shop preview
    const shopImg = document.querySelector('#shop-img');
    shopImg.defaultValue = "{{ asset( 'assets' . '/' . $img_value_shop) }}";
    const shopImgPreview = document.querySelector('.shop-preview');
    function shopPreview()
    {
      shopImgPreview.style.display = 'block';
    
      const oFReader = new FileReader();
      oFReader.readAsDataURL(shopImg.files[0]);
    
      oFReader.onload = function(oFREvent)
      {
        shopImgPreview.src = oFREvent.target.result;
      }
    };

    @if ($errors->shop_update->any())
            var myModal = new bootstrap.Modal(document.getElementById("settings"), {});
            document.onreadystatechange = function () {
                myModal.show();
            };
    @endif
    
    @if ($errors->product_store->any())
            var myModal = new bootstrap.Modal(document.getElementById("add-product-card"), {});
            document.onreadystatechange = function () {
                myModal.show();
            };
    @endif

    @if (sizeof($product))    
        @foreach ($product as $item)
            @if ($errors->has('product_update_' . $item->product_hash))
                var myModal = new bootstrap.Modal(document.getElementById("productUpdate-{{ $item->product_hash }}"), {});
                document.onreadystatechange = function () {
                    myModal.show();
                };
            @endif
        @endforeach
    @endif


    function productUpdatePreview(hash) {
        const productImg = document.querySelector('#product-img-update-' + hash);
        const productImgPreview = document.querySelector('.product-preview-' + hash);

        productImgPreview.style.display = 'block';
    
        const oFReader = new FileReader();
        oFReader.readAsDataURL(productImg.files[0]);
    
        oFReader.onload = function(oFREvent)
        {
        productImgPreview.src = oFREvent.target.result;
        }
    }
    
</script>
@endsection