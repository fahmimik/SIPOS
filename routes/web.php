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

        Route::resource('users', 'UserController')->middleware('role:admin');

        Route::get('parents', 'ParentsController@index')->name('parents.index')->middleware('role:all');
        Route::post('parents', 'ParentsController@store')->name('parents.store')->middleware('role:admin|bidan');
        Route::get('parents/create', 'ParentsController@create')->name('parents.create')->middleware('role:admin|bidan');
        Route::get('parents/{parents}', 'ParentsController@show')->name('parents.show')->middleware('role:all');
        Route::get('parents/{parents}/edit', 'ParentsController@edit')->name('parents.edit')->middleware('role:admin|bidan');
        Route::put('parents/{parents}', 'ParentsController@update')->name('parents.update')->middleware('role:admin|bidan');
        Route::delete('parents/{parents}', 'ParentsController@delete')->name('parents.delete')->middleware('role:admin|bidan');

        Route::group(['prefix' => '/ajax/dashboard', 'as' => 'ajax.'], function(){

        });
    }
);
