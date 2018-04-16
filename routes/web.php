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


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/view', 'SearchController@view')->name('details');

Route::group(['prefix' => 'admin','middleware' => 'IsAdmin'], function () {
   Route::get('/', 'Admin\IndexController@index')->name('admin');
   Route::resource('users', 'Admin\UserController');
   Route::post('users/status', 'Admin\UserController@userStatus')->name('users-status');
   Route::get('products', 'Admin\ProductController@index')->name('products.index');
   Route::post('products', 'Admin\ProductController@import')->name('products.import');
});
