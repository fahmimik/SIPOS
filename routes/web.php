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

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => '/dashboard',
        'namespace' => 'Dashboard',
        'as' => 'dashboard.'
    ],
    function () {
        Route::get('/', 'DashboardController@index')->name('index');

        Route::group(['middleware' => 'role:admin'], function () {
            // Route yang bisa diakses admin
            Route::resource('users', 'UserController');
        });

        Route::group(['middleware' => 'role:bidan'], function () {
            // Route yang bisa diakses bidan
        });

        Route::group(['middleware' => 'role:kader'], function () {
            // Route yang bisa diakses kader
        });


        Route::group(['prefix' => '/ajax/dashboard', 'as' => 'ajax.'], function(){

        });
    }
);
