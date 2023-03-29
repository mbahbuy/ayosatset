<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/find', ['as' => 'find', 'uses' => 'HomeController@product']);
Route::get('/p/{product:product_hash}', ['as' => 'product.show', 'uses' => 'ProductController@show']);
Route::get('/s/{shop:shop_hash}', ['as' => 'shop.show', 'uses' => 'ShopController@show']);
Route::view('/checkemail', 'profile.checkemail');

// Cart
// Route::get('/cart/data', ['as' => 'cart.data', 'uses' => 'CartController@data']);
// Route::get('/cart', ['as' => 'cart.show', 'uses' => 'CartController@show']);
// Route::get('/cart/checkout', ['as' => 'checkout', 'uses' => 'CartController@checkout']);

Route::post('/cart', ['as' => 'cart.store', 'uses' => 'CartController@store']); // Cart
Route::post('/wish', ['as' => 'wish.store', 'uses' => 'CartController@wish']); // Wish
Route::delete('/cart/{cart:cart_hash}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);

Route::get('/data_produk', ['as' => 'produk.json', 'uses' => 'ProductController@productJson']);

// order
Route::post('/order', ['as' => 'order.store', 'uses' => 'OrderController@store']);
Route::get('/data/provinsi', ['as' => 'data.provinsi', 'uses' => 'OrderController@provinsi']);
Route::post('/data/kota', ['as' => 'data.kota', 'uses' => 'OrderController@kota']);
Route::post('/data/ongkir', ['as' => 'data.ongkir', 'uses' => 'OrderController@ongkir']);

Auth::routes([
    'verify' => true,
    'resend' => false
]);
Route::group(['middleware' => ['auth', 'verified']], function () {
    // Profile
    Route::get('/profile', ['as' => 'profile.index', 'uses' => 'UserController@index']);
    Route::put('/profile/{user:user_hash}', ['as' => 'profile.update', 'uses' => 'UserController@update']);
    Route::post('/profile/password/{user:user_hash}', ['as' => 'profile.password', 'uses' => 'UserController@password']);
    Route::get('/profile/data/user', ['as' => 'profile.form.verify', 'uses' => 'UserController@afterVerifyForm']);
    Route::post('/profile/data/user', ['as' => 'profile.post.verify', 'uses' => 'UserController@afterVerifyPost']);

    // Shop
    Route::get('/myshop', ['as' => 'shop.index', 'uses' => 'ShopController@index']);
    Route::post('/shop/store', ['as' => 'shop.store', 'uses' => 'ShopController@store']);
    Route::put('/shop/{shop:shop_hash}/update', ['as' => 'shop.update', 'uses' => 'ShopController@update']);

    // Address
    Route::post('/profile/address', ['as' => 'profile.address', 'uses' => 'AddressController@storeProfile']);
    Route::put('/profile/address/{user:user_hash}/update', ['as' => 'profile.address.update', 'uses' => 'AddressController@updateProfile']);
    Route::delete('/profile/address/{user:user_hash}', ['as' => 'profile.address.delete', 'uses' => 'AddressController@deleteProfile']);
    Route::post('/shop/address', ['as' => 'shop.address', 'uses' => 'AddressController@storeShop']);
    Route::put('/shop/address/{shop:shop_hash}/update', ['as' => 'shop.address.update', 'uses' => 'AddressController@updateShop']);
    Route::delete('/shop/address/{shop:shop_hash}', ['as' => 'shop.address.delete', 'uses' => 'AddressController@deleteSHop']);

    // Product
    Route::post('/product/store', ['as' => 'product.store', 'uses' => 'ProductController@store']);
    Route::put('/product/{product:product_hash}/update', ['as' => 'product.update', 'uses' => 'ProductController@update']);
    Route::delete('/product/{product:product_hash}', ['as' => 'product.destroy', 'uses' => 'ProductController@destroy']);

    // Order
    Route::put('/order/{order:order_hash}/midtrans', ['as' => 'order.user.midtrans', 'uses' => 'OrderController@midtrans']);
    Route::put('/order/{order:order_hash}/resi', ['as' => 'payment.resi', 'uses' => 'OrderController@resi']);
    Route::put('/order/{order:order_hash}/kurir', ['as' => 'order.kurir', 'uses' => 'OrderController@kurir']);
    Route::put('/order/{order:order_hash}/product_confirm', ['as' => 'product.confirm', 'uses' => 'OrderController@productConfirm']);

    Route::get('/dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    // Editor
    Route::group(['middleware' => 'editor'], function () {
    });

    // Admin
    Route::group(['middleware' => 'admin'], function () {
        // Category Control
        Route::get('/a/category', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
        Route::post('/a/category/store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
        Route::put('/a/category/{category:slug}/update', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
        Route::delete('/a/category/{category:slug}', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);

        // User Control
        Route::get('/a/userlist', ['as' => 'users.index', 'uses' => 'UserController@users']);
        Route::put('/a/userlist/{user:user_hash}/suspense', ['as' => 'user.suspense', 'uses' => 'UserController@suspense']);
        Route::get('/a/blacklist', ['as' => 'users.black', 'uses' => 'UserController@black']);
        Route::put('/a/blacklist/{user:user_hash}/calm', ['as' => 'user.calm', 'uses' => 'UserController@calm']);
        Route::get('/a/orderlist', ['as' => 'order.index', 'uses' => 'OrderController@index']);

        // Shop Rating Controll
        Route::get('/a/shoprating', ['as' => 'shop.rating', 'uses' => 'SettingController@shopRating']);
    });
});
