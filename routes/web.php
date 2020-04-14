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
        Route::patch('family/{family}', 'FamilyController@update')->name('family.update')->middleware('role:admin|bidan');
        Route::delete('family/{family}', 'FamilyController@destroy')->name('family.destroy')->middleware('role:admin|bidan');

        Route::get('pregnant', 'PregnantController@index')->name('pregnant.index')->middleware('role:admin|bidan');
        Route::post('pregnant', 'PregnantController@store')->name('pregnant.store')->middleware('role:admin|bidan');
        Route::get('pregnant/create', 'PregnantController@create')->name('pregnant.create')->middleware('role:admin|bidan');
        Route::get('pregnant/{pregnant}', 'PregnantController@show')->name('pregnant.show')->middleware('role:admin|bidan');
        Route::get('pregnant/{pregnant}/edit', 'PregnantController@edit')->name('pregnant.edit')->middleware('role:admin|bidan');
        Route::patch('pregnant/{pregnant}', 'PregnantController@update')->name('pregnant.update')->middleware('role:admin|bidan');
        Route::delete('pregnant/{pregnant}', 'PregnantController@destroy')->name('pregnant.destroy')->middleware('role:admin|bidan');

        Route::get('children', 'ChildrenController@index')->name('children.index')->middleware('role:all');
        Route::post('children', 'ChildrenController@store')->name('children.store')->middleware('role:all');
        Route::get('children/create', 'ChildrenController@create')->name('children.create')->middleware('role:all');
        Route::get('children/{children}', 'ChildrenController@show')->name('children.show')->middleware('role:all');
        Route::get('children/{children}/edit', 'ChildrenController@edit')->name('children.edit')->middleware('role:all');
        Route::patch('children/{children}', 'ChildrenController@update')->name('children.update')->middleware('role:all');
        Route::delete('children/{children}', 'ChildrenController@destroy')->name('children.destroy')->middleware('role:all');

        Route::group(['prefix' => '/ajax/dashboard', 'as' => 'ajax.'], function(){

        });
    }
);
