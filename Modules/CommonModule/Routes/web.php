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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::prefix('admin-panel')->middleware(['auth:admin'])->group(function() {
//    Route::get('/', 'CommonModuleController@index');

        Route::resource('languages','LanguagesController')->except('show');

        Route::get('/languages/ajax','LanguagesController@dataTables')->name('languages.ajax');

        Route::get('/languages/desactive/{id}','LanguagesController@desactiveLang')->name('language.disactive');
        Route::get('/languages/active/{id}','LanguagesController@activeLang')->name('language.active');
        Route::get('/languages/delete/{id}','LanguagesController@destroy')->name('languages.delete');
    });

});


