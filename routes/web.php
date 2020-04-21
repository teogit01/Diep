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

route::prefix('admin')->group(function() {
	route::get('/','Admin\ProductController@index')->name('admin.index');
	
	route::prefix('/product')->group(function() {
		route::get('/add','Admin\ProductController@getAddProduct')->name('admin.product.getadd');
	});

	route::prefix('/type')->group(function() {
		route::get('/','Admin\TypeProductController@index');
		route::post('/postAdd','Admin\TypeProductController@postAdd')->name('type.postAdd');
		route::post('/delete','Admin\TypeProductController@delete')->name('type.delete');
	});
});