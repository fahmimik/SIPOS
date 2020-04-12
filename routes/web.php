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

        Route::get('family', 'FamilyController@index')->name('family.index')->middleware('role:all');
        Route::post('family', 'FamilyController@store')->name('family.store')->middleware('role:admin|bidan');
        Route::get('family/create', 'FamilyController@create')->name('family.create')->middleware('role:admin|bidan');
        Route::get('family/{family}', 'FamilyController@show')->name('family.show')->middleware('role:all');
        Route::get('family/{family}/edit', 'FamilyController@edit')->name('family.edit')->middleware('role:admin|bidan');
        Route::post('family/{family}', 'FamilyController@update')->name('family.update')->middleware('role:admin|bidan');
        Route::delete('family/{family}', 'FamilyController@destroy')->name('family.destroy')->middleware('role:admin|bidan');

        Route::group(['prefix' => '/ajax/dashboard', 'as' => 'ajax.'], function(){

        });
    }
);
