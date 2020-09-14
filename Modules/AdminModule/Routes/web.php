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
    Route::prefix('admin-panel')->middleware(['auth:admin'])->group(function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
    });

    Route::prefix('admin-panel')->group(function () {

        Route::get('/login', 'AdminLoginController@loginForm')->name('loginForm');

        Route::post('/login', 'AdminLoginController@AdminLogin')->name('AdminLogin');

        Route::get('/logout', 'AdminLoginController@AdminLogout')->name('AdminLogout');


    });
});


