@extends('layout.main')

@section('container')

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
                                    <input class="form-control" type="text" value="{{ auth()->user()->name }}" disabled readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="email" value="{{ auth()->user()->email }}" disabled readonly>
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
                <div class="account-card" id="address-refresh">
                    <div class="account-title">
                        <h4>Alamat</h4>
                        <button data-bs-toggle="modal" data-bs-target="#address-add" onclick="provinsi(this)" data-provinsi="0" data-modal="0">add address</button>
                    </div>
                    <div class="account-content">
                        @if ( auth()->user()->alamats && sizeof(auth()->user()->alamats))
                            <div class="row">
                                @foreach (auth()->user()->alamats as $item)
                                    <div class="col-md-6 col-lg-4 alert fade show">
                                        <div class="profile-card address {{ $item->use == true ? 'active' : '' }}" onclick="toggleDefault(this)" data-toggle="{{ $item->id }}">
                                            <h6>
                                                @switch($item->status)
                                                    @case(1)
                                                        Home
                                                        @break
                                                    @case(2)
                                                        Office
                                                        @break
                                                    @case(3)
                                                        Bussiness
                                                        @break
                                                    @case(4)
                                                        Academy
                                                        @break
                                                    @default
                                                        Others
                                                @endswitch
                                            </h6>
                                            <p>{{ $item->address }}</p>
                                            <p>{{ $item->phone }}</p>
                                            <ul class="user-action">
                                                <li>
                                                    <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit-{{ $item->id }}" onclick="provinsi(this)" data-provinsi="{{ $item->province_id }}" data-modal="{{ $item->id }}"></button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('profile.address.delete', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="trash icofont-ui-delete" title="Remove This" onclick="confirm('Anda akan menghapus alamat ini?')"></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="row col-lg-12">
                                <p>Anda belum menambahkan alamat pengiriman</p>
                            </div>
                        @endif
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama barang</th>
                                        <th scope="col">Categori produk</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>Rp. {{ number_format($item->price,0,',','.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p class="text-center">Belum ada produk</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-12" id="order-pesanan">
                <div class="account-card">
                    <div class="account-title">
                        <h4>Pesanan anda</h4>
                    </div>
                    <div class="account-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Toko</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Sub total</th>
                                    <th scope="col">Ongkir</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($orders))
                                    @foreach ($orders as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->shop->name }}</td>
                                            <td>
                                                
                                                <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#detail-{{ $item->order_hash }}">
                                                    <span>Detail produk</span>
                                                </button>
                                                <div class="modal fade" id="detail-{{ $item->order_hash }}">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
                                                            <div class="product-view">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Nama produk</th>
                                                                            <th scope="col">Harga produk</th>
                                                                            <th scope="col">Pcs</th>
                                                                            <th scope="col">Total Harga</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse (json_decode($item->products) as $produk)
                                                                            @php
                                                                                $product = \App\Models\Product::where('product_hash', $produk->product_hash)->first();
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $product->name }}</td>
                                                                                <td>Rp. {{ number_format($product->price,0,',','.') }}</td>
                                                                                <td>{{ $produk->pcs }}</td>
                                                                                <td>Rp. {{ number_format($product->price * $produk->pcs,0,',','.') }}</td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td>G ada produk</td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>Rp. {{ number_format($item->sub_total,0,',','.') }}</td>
                                            <td>Rp. {{ number_format($item->ongkir,0,',','.') }}</td>
                                            <td>Rp. {{ number_format($item->payment,0,',','.') }}</td>
                                            <td>
                                                @switch($item->status)
                                                    @case(2)
                                                        <span>Menunggu konfirmasi payment</span>
                                                        @break
                                                    @case(3)
                                                        <span>Proses pengemasan</span>
                                                        @break
                                                    @case(4)
                                                        <span>Proses Pengiriman</span>
                                                        @break
                                                    @case(5)
                                                        <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#rating-{{ $item->order_hash }}">
                                                            <span>konfirmasi barang sampai</span>
                                                        </button>
                                                        <div class="modal fade" id="rating-{{ $item->order_hash }}">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
                                                                    <div class="product-view">
                                                                        <div class="container p-3">
                                                                            @php
                                                                                $products = json_decode($item->products);
                                                                            @endphp
                                                                            @foreach ($products as $p)
                                                                                @php
                                                                                    $img = \App\Models\Product::select('image')->where('product_hash', $p->product_hash)->first();
                                                                                @endphp
                                                                                <div class="row m-3 border border-black form-rating" data-product="{{ $p->product_hash }}">
                                                                                    <div class="col-lg-3">
                                                                                        <img src="{{ asset('assets') . '/' . $img['image'] }}" class="img-fluid">
                                                                                    </div>
                                                                                    <div class="col-lg-9">
                                                                                        <div class="form-group">
                                                                                            <input type="file" class="form-control image" placeholder="image" name="image" onchange="reviewPreview(this)" value="">
                                                                                        </div>
                                                                                        <img src="" class="img-fluid">
                                                                                        <div class="form-group">
                                                                                            <i class="bi bi-star-fill" style="color:yellow" data-rating="1" onclick="rating(this)" role="button" ></i>
                                                                                            <i class="bi bi-star-fill" data-rating="2" onclick="rating(this)" role="button"></i>
                                                                                            <i class="bi bi-star-fill" data-rating="3" onclick="rating(this)" role="button"></i>
                                                                                            <i class="bi bi-star-fill" data-rating="4" onclick="rating(this)" role="button"></i>
                                                                                            <i class="bi bi-star-fill" data-rating="5" onclick="rating(this)" role="button"></i>
                                                                                            <input type="number" class="visually-hidden rating" name="rating" min="1" max="5" value="1">
                                                                                        </div>
                                                                                        <!-- Input Field -->
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control message" placeholder="Pesan....." rows="3" name="message"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                            <div class="row col-md-12">
                                                                                <div class="form-button">
                                                                                    <button type="button" onclick="ratingProduct(this)" data-order="{{ $item->order_hash }}" data-bs-dismiss="modal">konfirmasi</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @break
                                                    @case(6)
                                                        <span>-</span>
                                                        @break
                                                    @default
                                                        

                                                        <button type="button" class="btn btn-outline" onclick="payment(this)" data-code-payment="{{ $item->code }}">Pilih pembayaran</button>

                                                        {{-- <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#order-{{ $item->order_hash }}">
                                                            <span>Upload bukti pembayaran</span>
                                                        </button>

                                                        <div class="modal fade" id="order-{{ $item->order_hash }}">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <button class="modal-close" data-bs-dismiss="modal">
                                                                        <i class="icofont-close"></i>
                                                                    </button>
                                                                    <form class="modal-form" action="{{ route('order.user.payment', $item->order_hash) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('put')
                                                                        <div class="form-title">
                                                                            <h3>Upload bukti pembayaran</h3>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="payment">payment</label>
                                                                            <input class="form-control " type="file" name="payment" id="payment" onchange="imagePreview(this)">
                                                                            <img src="" class="img-fluid">
                                                                        </div>
                                                                        <button class="form-btn" type="submit">upload</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-12">
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
            </div> --}}

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
        <form class="modal-form" action="{{ route('profile.address') }}" method="POST">
            @csrf
            <div class="form-title">
                <h3>add new address</h3>
            </div>
            <div class="form-group">
                <label class="form-label" for="add-status">title</label>
                <select class="form-select" id="add-status" name="status">
                    <option value="1">home</option>
                    <option value="2">office</option>
                    <option value="3">Bussiness</option>
                    <option value="4">academy</option>
                    <option value="5">others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="add-provinsi">Provinsi</label>
                <select class="form-select" id="add-provinsi" onchange="getCity(this)" name="province_id">
                <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="add-kota">Kota</label>
                <select class="form-select" id="add-kota" name="city_id" data-selected="0">
                <option value="">Pilih Kota</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="add-address">address</label>
                <textarea class="form-control" id="add-address" name="address" placeholder="Enter your address"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="add-phone">No HP</label>
                <input type="text" class="form-control" id="add-phone" name="phone">
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
                <label class="form-label" for="profile-image">profile image</label>
                <input class="form-control {{ $img_class_profile }}" type="file" name="image" id="profile-image" value="{{ $img_value_profile }}" onchange="imagePreview(this)">
                <img class="img-fluid" src="">
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
                    <button type="button" onclick="showPassword(this)" class="input-group-text" id="addon-wrapping"><i class="bi bi-eye-slash"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="pass">New Password</label>
                <div class="input-group flex-nowrap">
                    <input class="form-control {{ $newpass_class_profile }}" name="new_password" id="pass" type="password" value="{{ $newpass_value_profile }}">
                    <button type="button" onclick="showPassword(this)" class="input-group-text" id="addon-wrapping"><i class="bi bi-eye-slash"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="pass_conf">Confirm Password</label>
                <div class="input-group flex-nowrap">
                    <input type="password" class="form-control {{ $passconf_class_profile }}" id="pass_conf" name="password_confirmation" value="{{ $passconf_value_profile }}">
                    <button type="button" onclick="showPassword(this)" class="input-group-text" id="addon-wrapping"><i class="bi bi-eye-slash"></i></button>
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

@if ( auth()->user()->alamats && sizeof(auth()->user()->alamats) )
    @foreach (auth()->user()->alamats as $item)
        <div class="modal fade" id="address-edit-{{ $item->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal">
                    <i class="icofont-close"></i>
                    </button>
                    <form class="modal-form" action="{{ route('profile.address.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-title">
                            <h3>edit address info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="status-{{ $item->id }}">title</label>
                            <select class="form-select" name="status" id="status-{{ $item->id }}">
                                <option value="1" {{ $item->status ==  1 ? 'selected' : '' }}>home</option>
                                <option value="2" {{ $item->status ==  2 ? 'selected' : '' }}>office</option>
                                <option value="3" {{ $item->status ==  3 ? 'selected' : '' }}>Bussiness</option>
                                <option value="4" {{ $item->status ==  4 ? 'selected' : '' }}>academy</option>
                                <option value="5" {{ $item->status ==  5 ? 'selected' : '' }}>others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="provinsi-{{ $item->id }}">Provinsi</label>
                            <select class="form-select" id="provinsi-{{ $item->id }}" name="province_id" onchange="getCity(this)">
                              <option value="">Pilih Provinsi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kota-{{ $item->id }}">Kota</label>
                            <select class="form-select" id="kota-{{ $item->id }}" name="city_id" data-selected="{{ $item->city_id }}">
                              <option value="">Pilih Kota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="address-{{ $item->id }}">address</label>
                            <textarea class="form-control" id="address-{{ $item->id }}" name="address">{{ $item->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone-{{ $item->id }}">No HP</label>
                            <input type="text" class="form-control" id="phone-{{ $item->id }}" name="phone" value="{{ $item->phone }}">
                        </div>
                        <button class="form-btn" type="submit">save address info</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection
@section('script')
<script>

    function imagePreview(img) {
        const imgPreview = $(img).closest(".form-group").children(".img-fluid");

        imgPreview.css('display', 'block');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(img.files[0]);

        oFReader.onload = function(oFREvent)
        {
            imgPreview.attr('src', oFREvent.target.result);
        }
    }
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

    @if (sizeof($orders))    
        @foreach ($orders as $item)
            @if ($errors->has('rating_' . $item->product_hash))
                var myModal = new bootstrap.Modal(document.getElementById("rating-{{ $item->order_hash }}"), {});
                document.onreadystatechange = function () {
                    myModal.show();
                };
            @endif
        @endforeach
    @endif

    function showPassword(pass) {
        const target = $(pass).closest('.input-group').children('.form-control');
        const target_icon = $(pass).children('.bi');
        if (target_icon.hasClass('bi-eye-slash')) {
        target.attr('type', 'text');
        target_icon.attr('class', 'bi bi-eye');
        } else {
        target.attr('type', 'password');
        target_icon.attr('class', 'bi bi-eye-slash');
        }
    }

    function reviewPreview(hash) {
        const productImgPreview = $(hash).parent().next(".img-fluid");

        productImgPreview.css( "display" , 'block');
    
        const oFReader = new FileReader();
        oFReader.readAsDataURL(hash.files[0]);
    
        oFReader.onload = function(oFREvent)
        {
            productImgPreview.attr('src', oFREvent.target.result);
        }
    }

    function rating(star) {
        const rating = $(star).attr('data-rating');
        const input = $(star).parent().children("input");
        const pSibling = $(star).prevAll();
        const nSibling = $(star).nextAll();
        input.attr('value', rating);
        pSibling.css('color', 'yellow');
        $(star).css('color', 'yellow');
        nSibling.css('color', '');
    }

    function payment(key){

        window.snap.pay($(key).attr('data-code-payment'), {
          onSuccess: function(result){
            /* You may add your own implementation here */
            showAlertPopUp("payment success!");
            $.ajax({
                url:"{{ route('home') }}/order/" + result.order_id + "/midtrans",
                method: 'POST',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'PUT'
                },
                success: function (response) {
                    $( "#order-pesanan" ).load(window.location.href + " #order-pesanan>" );
                    showAlertPopUp(response.data);

                }
            });
          },
          onPending: function(result){
            /* You may add your own implementation here */
            showAlertPopUp("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            showAlertPopUp("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            showAlertPopUp('you closed the popup without finishing the payment');
          }
        })
    }

    function provinsi(par) {
        $.ajax({
          type: "GET",
          url: "{{ route('data.provinsi') }}",
          data: null,
          dataType: "JSON",
          success: function (response) {
            const modal = $(par).attr('data-modal');
            const provinsiSelected = $(par).attr('data-provinsi');
            var data = '';
            if (modal == 0) {
                const provinsiSelect = $('#add-provinsi');
                for (let i = 0; i < response.length; i++) {
                  data += "<option value=" + response[i].province_id  + ">" + response[i].province + "</option>";
                };
                provinsiSelect.html(data);
                getCity(provinsiSelect);
            } else {
                const provinsiSelect = $('#address-edit-' + modal).find('#provinsi-' + modal);
                var data = '';
                for (let i = 0; i < response.length; i++) {
                    let selectedData = response[i].province_id == provinsiSelected ? 'selected' : '';
                  data += "<option value='" + response[i].province_id  + "' " + selectedData + ">" + response[i].province + "</option>";
                };
                provinsiSelect.html(data);
                getCity(provinsiSelect);
            }
          },
          error: function (response) {
            console.log(response);
          }
        });
      }

      function getCity(prov){
        $.ajax({
          type: "POST",
          url: "{{ route('data.kota') }}",
          data: {
            '_token': '{{ csrf_token() }}',
            'kota': $(prov).val()
          },
          dataType: "JSON",
          success: function (response) { 
            const kotaSelect = $(prov).parent().next().children('select.form-select');
            const kotaSelected = kotaSelect.attr('data-selected');
            var data = '';
            if (kotaSelected == 0) {
                for (let i = 0; i < response.length; i++) {
                    data += "<option value=" + response[i].city_id  + ">" + response[i].city_name + "</option>";
                };
            } else {               
                for (let i = 0; i < response.length; i++) {
                    let selectedData = response[i].city_id == kotaSelected ? 'Selected' : '';
                  data += "<option value='" + response[i].city_id  + "' " + selectedData + ">" + response[i].city_name + "</option>";
                };                
            }
            kotaSelect.html(data);
          },
          error: function (response) {
            console.log(response);
          }
        });
      }

      function toggleDefault(use) {
        const target = $(use).attr('data-toggle');
        $.ajax({
            url:"{{ route('home') }}/profile/address/" + target + "/default",
            method: 'POST',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                '_method': 'PUT'
            },
            success: function (response) {
                showAlertPopUp(response.data);
            }
        });
      }

      function ratingProduct(rp) {
        const formData = $(rp).closest('.container').find('.form-rating');
        const target = $(rp).attr('data-order');
        var data = [];
        formData.each(function () {
            const product = $(this).attr('data-product');
            const image = $(this).find('input.image:file');
            const rating = $(this).find('input.rating').val();
            const message = $(this).find('textarea.message').val();
            // Check if a file has been selected
            const hasFile = image[0].files.length > 0;
            data.push({
                product: product,
                image: hasFile ? image[0].files[0] : null,
                rating: rating,
                message: message
            });
        });
        $.ajax({
            url:"{{ route('home') }}/order/" + target + "/product_confirm",
            method: 'POST',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                '_method': 'PUT',
                data: data
            },
            success: function (response) {
                $( "#order-pesanan" ).load(window.location.href + " #order-pesanan>" );
                showAlertPopUp(response.data);
            }
        });
      }
    
</script>
@endsection