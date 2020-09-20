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


/*user do register and login*/
Route::post('/user/register', 'UserAuthController@doRegister')->name('user.register');
Route::post('/user/login', 'UserAuthController@doLogin')->name('user.login');
Route::get('/user/logout', 'UserAuthController@logout')->name('user.logout');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::prefix('admin-panel')->group(function () {

        Route::resource('users', 'UsersController')->except('show');
        Route::get('/users/ajax', 'UsersController@dataTable');
        Route::get('/users/delete/{id}', 'UsersController@destroy');
    });


});


