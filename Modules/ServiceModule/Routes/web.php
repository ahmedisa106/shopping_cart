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

        /*categories*/
        Route::resource('servicesCategories', 'ServiceController')->except('show');
        Route::get('/servicesCategories/delete/{id}', 'ServiceController@destroy')->name('serviceCat.delete');
        Route::get('/servicesCategories/dataTable', 'ServiceController@datatable')->name('cats.dataTable');
        Route::post('/servicesCategories/changeActive', 'ServiceController@changeActive')->name('cat.changeActive');

        /*services*/

        Route::resource('services', 'servicesController')->except('show');
        Route::get('/services/delete/{id}', 'ServicesController@destroy')->name('service.delete');

        Route::get('/services/dataTable', 'ServicesController@datatable')->name('services.dataTable');
        Route::post('/services/changeActive', 'ServicesController@changeActive')->name('services.changeActive');


    });
});
