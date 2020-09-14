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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::prefix('admin-panel')->middleware('auth:admin')->group(function () {


        Route::resource('categories', 'CategoriesController')->except('show');
        Route::get('/categories/filter', 'CategoriesController@filter');
        Route::get('/delete/{id}', 'CategoriesController@destroy')->name('cat.delete');

        Route::get('/categories/activate/{id}', 'CategoriesController@active')->name('cat.active');
        Route::get('/categories/unactivate/{id}', 'CategoriesController@unactive')->name('cat.unactive');


        Route::resource('products', 'ProductsController')->except(['show', 'delete']);
        Route::get('/products/ajax', 'ProductsController@dataTable');
        Route::get('/products/{id}/unActive', 'ProductsController@unActive')->name('product.unActive');
        Route::get('/products/{id}/active', 'ProductsController@active')->name('product.active');
        Route::get('/products/delete/{id}', 'ProductsController@destroy')->name('products.delete');

        Route::get('/products/actived', 'ProductsController@actived')->name('products.actived');
        Route::get('/products/showAlbum/{id}', 'ProductsController@showAlbum')->name('products.showAlbum');
        Route::post('/products/addToAlbum', 'ProductsController@addToAlbum')->name('products.addToAlbum');
        Route::get('/products/deletePhoto/{id}', 'ProductsController@deletePhoto')->name('products.deletePhoto');


    });
});
