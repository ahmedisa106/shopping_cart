<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/')->group(function () {
    Route::get('/', 'FrontController@index');
    Route::post('/addToCart/{product_id}', 'FrontController@addToCart')->name('front.addToCart');
    Route::get('/addToWishlist/{product_id}', 'FrontController@addToWishList')->name('wishlist.add')->middleware('auth');
    Route::get('/showWishList/{id}', 'FrontController@showWishList')->name('wishList.view');
    Route::post('/makeOrder', 'FrontController@makeOrder')->name('order.make');
});
