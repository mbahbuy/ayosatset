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

    Route::get('/dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    // Editor
    Route::group(['middleware' => 'editor'], function()
    {

    });

    // Admin
    Route::group(['middleware' => 'admin'], function()
    {
        Route::get('/a/category', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
        Route::post('/a/category/store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
        Route::put('/a/category/{category:slug}/update', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
        Route::delete('/a/category/{category:slug}', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
        
        Route::get('/a/userlist', ['as' => 'users.index', 'uses' => 'UserController@users']);
    });
});