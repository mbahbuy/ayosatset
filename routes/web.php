<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/product', ['as' => 'product', 'uses' => 'HomeController@product']);
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

    Route::resource('/shop', 'ShopController');
    Route::resource('/product', 'ProductController');
});