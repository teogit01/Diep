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

// Route::get('/', function () {
//     return view('welcome');
// });

route::prefix('admin')->group(function() {
	route::get('/','Admin\ProductController@index')->name('admin.index');
	
	route::prefix('/product')->group(function() {
		route::get('/','Admin\ProductController@index')->name('admin.product.index');
		route::get('/add','Admin\ProductController@getAddProduct')->name('admin.product.getadd');
		route::post('/postAdd','Admin\ProductController@postAddProduct')->name('admin.product.postadd');

		// delete product
		route::post('/delete','Admin\ProductController@deleteProduct')->name('admin.product.delete');

		// detail
		route::get('/detail/{id}','Admin\ProductController@detail')->name('admin.product.detail');

		// edit
		route::post('/edit_product/{id}','Admin\ProductController@editProduct')->name('admin.product.edit');
		route::post('/edit/image','Admin\ProductController@editImage')->name('admin.product.edit.image');
		route::post('/edit/image/resetimagedel/','Admin\ProductController@resetImageDel')->name('admin.product.image.resetimagedel');

	});
	// Type
	route::prefix('/type')->group(function() {
		route::get('/','Admin\TypeProductController@index');
		route::post('/postAdd','Admin\TypeProductController@postAdd')->name('type.postAdd');
		route::post('/delete','Admin\TypeProductController@delete')->name('type.delete');
	});

	// User
	route::prefix('/user')->group(function() {
		route::get('/','Admin\UserController@index');
		route::get('/detail/{id}','Admin\UserController@detail')->name('admin.user.detail');
	});

	// Bill
	route::prefix('/bill')->group(function() {
		route::get('/','Admin\BillController@index');
		route::get('/detail/{id}','Admin\BillController@detail');
	});
});

// Page
route::get('/','User\PageController@index')->name('home');
route::get('/product/all','User\PageController@productAll')->name('product.all');

// end Page

//	Ajax Add To Cart
route::prefix('/cart')->group(function() {
	route::get('/','Cart\CartController@index')->name('cart.index');

	route::get('/{user_id}','Cart\CartController@cart')->name('cart.user');
	
	route::post('/add','Cart\CartController@add')->name('cart.add');
	// Remove product form cart
	route::post('/{user_id}/remove/{product_code}','Cart\CartController@removeProductFormCart')->name('cart.detail.remove');

	// Pay
	route::get('/{user_id}/pay','Cart\CartController@getPay')->name('cart.pay');
	route::post('/{user_id}/pay','Cart\CartController@postPay')->name('cart.post.pay');


	route::post('/test/{id}','Cart\CartController@test')->name('cart.test');

});

// end Cart
//Login Logout Register
route::get('/register','LoginController@getRegister')->name('register');
route::post('/register','LoginController@postRegister')->name('postRegister');

route::get('/login','LoginController@getLogin')->name('login');
route::post('/login','LoginController@postLogin');
route::get('/logout','LoginController@logout')->name('logout');
//end Login Logout

route::get('/test',function(){
	return view('test');
});
route::get('/test2',function(){
	return view('test2');
});