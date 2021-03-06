<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth', 'level:costumer']], function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('/dashboard');

    Route::get('/dashboard', 'ThumbnailController@product');

});

Route::group(['middleware' => ['auth', 'level:admin']], function(){
    Route::get('/admin', function () {
        return view('/admin');
    })->name('admin');

    Route::get('/admin', 'ProductController@tampildata');

    Route::get('/admin/add', 'ProductController@tambahdata');

    Route::get('/admin/delete/{product_id}','ProductController@destroy');

    Route::get('/admin/edit/{product_id}', 'ProductController@editdata');
});


