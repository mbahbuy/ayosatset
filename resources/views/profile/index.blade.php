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

@if (auth()->user()->shop == false)    
    <div class="modal fade" id="add-shop">
        @php
            $name_class_shop = ($errors->create_shop->has('name')) ? 'is-invalid' : '' ;
            $name_value_shop = ($errors->create_shop->any()) ? old('name') : '';
            $des_class_shop = ($errors->create_shop->has('description')) ? 'is-invalid' : '';
            $des_value_shop = ($errors->create_shop->any()) ? old('description') : '';
        @endphp
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
                <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="product-view">
                        <div class="m-4 p-4">
                            @if ($errors->create_shop->any())
                                <div class="mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->create_shop->all() as $item)
                                        {{ $item }} <br>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="productName">Shop Name</label>
                                <input type="text" class="form-control {{ $name_class_shop }}" id="productName" name="name" placeholder="Enter product name" value="{{ $name_value_shop }}">
                            </div>
                            <!-- Input Field -->
                            <div class="form-group">
                                <label for="productDescription">Description</label>
                                <textarea class="form-control {{ $des_class_shop }}" id="productDescription" rows="3" name="description">{{ $des_value_shop }}</textarea>
                            </div>
                            <div class="form-button">
                                <button type="submit">Buka Toko</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;"></section>
<section class="inner-section profile-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h4>Your Profile</h4>
                        <button data-bs-toggle="modal" data-bs-target="#profile-edit">edit profile</button>
                    </div>
                    <div class="account-content">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="profile-image">
                                    <a href="#">
                                        <img class="img-fluid" src="{{ (auth()->user()->image) ? asset( 'assets' . '/' . auth()->user()->image) : 'images/user.png' }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">name</label>
                                    <input class="form-control" type="text" value="Miron Mahmud" disabled readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="email" value="mironcoder@gmail.com" disabled readonly>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="profile-btn">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#pass-change">change pass.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        @if (auth()->user()->shop == true)
                            <h4>Toko</h4>
                            <a href="{{ route('shop.index') }}">kunjungi</a>
                        @else                            
                            <h4>Buka toko gratis</h4>
                            <button button data-bs-toggle="modal" class="btn btn-outline-success" data-bs-target="#add-shop">Daftar</button>
                        @endif
                    </div>
                    @if ( sizeof($product))
                        <div class="account-content">
                            <div class="row">
                                @foreach ($product as $item)
                                    <div class="col-md-6 col-lg-4 alert fade show">
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
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p class="text-center">Belum ada produk</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h4>contact number</h4>
                        <button data-bs-toggle="modal" data-bs-target="#contact-add">add contact</button>
                    </div>
                    <div class="account-content">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="profile-card contact active">
                                    <h6>primary</h6>
                                    <p>+8801838288389</p>
                                    <ul>
                                        <li>
                                            <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#contact-edit"></button>
                                        </li>
                                        <li>
                                            <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="profile-card contact">
                                    <h6>secondary</h6>
                                    <p>+8801941101915</p>
                                    <ul>
                                        <li>
                                            <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#contact-edit"></button>
                                        </li>
                                        <li>
                                            <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="profile-card contact">
                                    <h6>secondary</h6>
                                    <p>+8801747875727</p>
                                    <ul>
                                        <li>
                                            <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#contact-edit"></button>
                                        </li>
                                        <li>
                                            <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h4>delivery address</h4>
                        <button data-bs-toggle="modal" data-bs-target="#address-add">add address</button>
                    </div>
                    <div class="account-content">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="profile-card address active">
                                    <h6>Home</h6>
                                    <p>jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A</p>
                                    <ul class="user-action">
                                        <li>
                                            <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit"></button>
                                        </li>
                                        <li>
                                            <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="profile-card address">
                                    <h6>Office</h6>
                                    <p>east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b</p>
                                    <ul class="user-action">
                                        <li>
                                            <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit"></button>
                                        </li>
                                        <li>
                                            <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="profile-card address">
                                    <h6>Bussiness</h6>
                                    <p>kawran bazar, dhaka-1100. word no-02, road no-13/d, house no-7/m</p>
                                    <ul class="user-action">
                                        <li>
                                            <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit"></button>
                                        </li>
                                        <li>
                                            <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="account-card mb-0">
                    <div class="account-title">
                        <h4>payment option</h4>
                        <button data-bs-toggle="modal" data-bs-target="#payment-add">add card</button>
                    </div>
                    <div class="account-content">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="payment-card payment active">
                                    <img src="images/payment/png/01.png" alt="payment">
                                    <h4>card number</h4>
                                    <p>
                                    <span>****</span>
                                    <span>****</span>
                                    <span>****</span>
                                    <sup>1876</sup>
                                    </p>
                                    <h5>miron mahmud</h5>
                                    <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="payment-card payment">
                                    <img src="images/payment/png/02.png" alt="payment">
                                    <h4>card number</h4>
                                    <p>
                                    <span>****</span>
                                    <span>****</span>
                                    <span>****</span>
                                    <sup>1876</sup>
                                    </p>
                                    <h5>miron mahmud</h5>
                                    <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 alert fade show">
                                <div class="payment-card payment">
                                    <img src="images/payment/png/03.png" alt="payment">
                                    <h4>card number</h4>
                                    <p>
                                    <span>****</span>
                                    <span>****</span>
                                    <span>****</span>
                                    <sup>1876</sup>
                                    </p>
                                    <h5>miron mahmud</h5>
                                    <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<div class="modal fade" id="contact-add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
        <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
        <div class="form-title">
            <h3>add new contact</h3>
        </div>
        <div class="form-group">
            <label class="form-label">title</label>
            <select class="form-select">
            <option selected>choose title</option>
            <option value="primary">primary</option>
            <option value="secondary">secondary</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">number</label>
            <input class="form-control" type="text" placeholder="Enter your number">
        </div>
        <button class="form-btn" type="submit">save contact info</button>
        </form>
    </div>
    </div>
</div>
<div class="modal fade" id="address-add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
        <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
        <div class="form-title">
            <h3>add new address</h3>
        </div>
        <div class="form-group">
            <label class="form-label">title</label>
            <select class="form-select">
            <option selected>choose title</option>
            <option value="home">home</option>
            <option value="office">office</option>
            <option value="Bussiness">Bussiness</option>
            <option value="academy">academy</option>
            <option value="others">others</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">address</label>
            <textarea class="form-control" placeholder="Enter your address"></textarea>
        </div>
        <button class="form-btn" type="submit">save address info</button>
        </form>
    </div>
    </div>
</div>
{{-- <div class="modal fade" id="payment-add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
        <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
        <div class="form-title">
            <h3>add new payment</h3>
        </div>
        <div class="form-group">
            <label class="form-label">card number</label>
            <input class="form-control" type="text" placeholder="Enter your card number">
        </div>
        <button class="form-btn" type="submit">save card info</button>
        </form>
    </div>
    </div>
</div> --}}
<div class="modal fade" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        @php
            $name_class_profile = ($errors->profile_update->has('name')) ? 'is-invalid' : '' ;
            $name_value_profile = ($errors->profile_update->any()) ? old('name') : auth()->user()->name;
            $img_class_profile = ($errors->profile_update->has('image')) ? 'is-invalid' : '';
            $img_value_profile = ($errors->profile_update->any()) ? old('image') : '';
        @endphp
        <button class="modal-close" data-bs-dismiss="modal">
            <i class="icofont-close"></i>
        </button>
        <form class="modal-form" method="POST" action="{{ route('profile.update', auth()->user()->user_hash) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-title mb-3">
                <h3>edit profile info</h3>
            </div>
            @if ($errors->profile_update->any())
                <div class="mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->profile_update->all() as $item)
                        {{ $item }} <br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group">
                <label class="form-label">profile image</label>
                <input class="form-control {{ $img_class_profile }}" type="file" name="image" id="image" value="{{ $img_value_profile }}" onchange="imagePreview()">
                <img class="img-fluid img-preview" src="">
            </div>
            <div class="form-group">
                <label class="form-label" for="name">name</label>
                <input class="form-control {{ $name_class_profile }}" name="name" id="name" type="text" value="{{ $name_value_profile }}">
            </div>
            <button class="form-btn" type="submit">save profile info</button>
        </form>
    </div>
    </div>
</div>
<div class="modal fade" id="pass-change">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        @php
            $oldpass_class_profile = ($errors->profile_password->has('old_password')) ? 'is-invalid' : '' ;
            $oldpass_value_profile = ($errors->profile_password->any()) ? old('old_password') : '';
            $newpass_class_profile = ($errors->profile_password->has('new_password')) ? 'is-invalid' : '';
            $newpass_value_profile = ($errors->profile_password->any()) ? old('new_password') : '';
            $passconf_class_profile = ($errors->profile_password->has('password_confirmation')) ? 'is-invalid' : '';
            $passconf_value_profile = ($errors->profile_password->any()) ? old('password_confirmation') : '';
        @endphp
        <button class="modal-close" data-bs-dismiss="modal">
            <i class="icofont-close"></i>
        </button>
        <form class="modal-form" method="POST" action="{{ route('profile.password', auth()->user()->user_hash) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-title mb-3">
                <h3>edit Password</h3>
            </div>
            @if ($errors->profile_password->any())
                <div class="mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->profile_password->all() as $item)
                        {{ $item }} <br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group mb-3">
                <label class="form-label">Old Password</label>
                <div class="input-group flex-nowrap">
                    <input class="form-control {{ $oldpass_class_profile }}" name="old_password" id="pass_old" type="password" value="{{ $oldpass_value_profile }}">
                    <button type="button" onclick="password_old_show()" class="input-group-text" id="addon-wrapping"><i id="pass_old_icon" class="fa fa-eye-slash"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="pass">New Password</label>
                <div class="input-group flex-nowrap">
                    <input class="form-control {{ $newpass_class_profile }}" name="new_password" id="pass" type="password" value="{{ $newpass_value_profile }}">
                    <button type="button" onclick="password_show()" class="input-group-text" id="addon-wrapping"><i id="pass_icon" class="fa fa-eye-slash"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="pass_conf">Confirm Password</label>
                <div class="input-group flex-nowrap">
                    <input type="password" class="form-control {{ $passconf_class_profile }}" id="pass_conf" name="password_confirmation" value="{{ $passconf_value_profile }}">
                    <button type="button" onclick="password_confirm_show()" class="input-group-text" id="addon-wrapping"><i id="pass_conf_icon" class="fa fa-eye-slash"></i></button>
                </div>
            </div>
            <button class="form-btn" type="submit">Change Password</button>
        </form>
    </div>
    </div>
</div>
<div class="modal fade" id="contact-edit">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
        <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
        <div class="form-title">
            <h3>edit contact info</h3>
        </div>
        <div class="form-group">
            <label class="form-label">title</label>
            <select class="form-select">
            <option value="primary" selected>primary</option>
            <option value="secondary">secondary</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">number</label>
            <input class="form-control" type="text" value="+8801838288389">
        </div>
        <button class="form-btn" type="submit">save contact info</button>
        </form>
    </div>
    </div>
</div>
<div class="modal fade" id="address-edit">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
        <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
        <div class="form-title">
            <h3>edit address info</h3>
        </div>
        <div class="form-group">
            <label class="form-label">title</label>
            <select class="form-select">
            <option value="home" selected>home</option>
            <option value="office">office</option>
            <option value="Bussiness">Bussiness</option>
            <option value="academy">academy</option>
            <option value="others">others</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">address</label>
            <textarea class="form-control" placeholder="jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A"></textarea>
        </div>
        <button class="form-btn" type="submit">save address info</button>
        </form>
    </div>
    </div>
</div>

@endsection
@section('script')
<script>

    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    function imagePreview()
    {
        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        
        oFReader.onload = function(oFREvent)
        {
            imgPreview.src = oFREvent.target.result;
        }
    };
    @if ($errors->create_shop->any())
        var myModal = new bootstrap.Modal(document.getElementById("add-shop"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
        image.defaultValue = "{{ $img_value_profile }}";
    @endif

    @if ($errors->profile_update->any())
        var myModal = new bootstrap.Modal(document.getElementById("profile-edit"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
    @endif

    @if ($errors->profile_password->any())
        var myModal = new bootstrap.Modal(document.getElementById("pass-change"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
    @endif

    const pass_old = document.getElementById('pass_old');
    const pass_old_icon = document.getElementById('pass_old_icon');
    function password_old_show(){
        if(pass_old_icon.classList.contains('fa-eye-slash')){
            pass_old_icon.className = 'fa fa-eye';
            pass_old.setAttribute('type', 'text');
        } else {
            pass_old_icon.className = 'fa fa-eye-slash';
            pass_old.setAttribute('type', 'password');
        }
    }

    const pass = document.getElementById('pass');
    const pass_icon = document.getElementById('pass_icon');
    function password_show(){
        if(pass_icon.classList.contains('fa-eye-slash')){
            pass_icon.className = 'fa fa-eye';
            pass.setAttribute('type', 'text');
        } else {
            pass_icon.className = 'fa fa-eye-slash';
            pass.setAttribute('type', 'password');
        }
    }

    const pass_conf = document.getElementById('pass_conf');
    const pass_conf_icon = document.getElementById('pass_conf_icon');
    function password_confirm_show(){
        if(pass_conf_icon.classList.contains('fa-eye-slash')){
            pass_conf_icon.className = 'fa fa-eye';
            pass_conf.setAttribute('type', 'text');
        } else {
            pass_conf_icon.className = 'fa fa-eye-slash';
            pass_conf.setAttribute('type', 'password');
        }
    }
    
</script>
@endsection