<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/find', ['as' => 'find', 'uses' => 'HomeController@product']);
Route::get('/p/{product:product_hash}', ['as' => 'product.show', 'uses' => 'ProductController@show']);
Route::get('/s/{shop:shop_hash}', ['as' => 'shop.show', 'uses' => 'ShopController@show']);
Route::view('/checkemail', 'profile.checkemail');

Auth::routes([
    'verify' => true,
    'resend' => false
]);
Route::group(['middleware' => ['auth','verified']], function ()
{
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

    // Product
    Route::post('/product/store', ['as' => 'product.store', 'uses' => 'ProductController@store']);
    Route::put('/product/{product:product_hash}/update', ['as' => 'product.update', 'uses' => 'ProductController@update']);

    // Editor
    Route::group(['middleware' => 'editor'], function()
    {

    });

    // Admin
    Route::group(['middleware' => 'admin'], function()
    {
        
    });
});