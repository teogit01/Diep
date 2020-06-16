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
		route::get('/','Admin\TypeProductController@index')->name('type.index');
		route::post('/postAdd','Admin\TypeProductController@postAdd')->name('type.postAdd');
		route::post('/delete','Admin\TypeProductController@delete')->name('type.delete');
	});

	// Distributor
	route::prefix('/distributor')->group(function() {
		route::get('/','Admin\DistributorController@index')->name('distributor.index');
		route::post('/postAdd','Admin\DistributorController@postAdd')->name('distributor.postAdd');
		route::post('/delete','Admin\DistributorController@delete')->name('distributor.delete');
	});

	// Producer
	route::prefix('/producer')->group(function() {
		route::get('/','Admin\ProducerController@index')->name('producer.index');
		route::post('/postAdd','Admin\ProducerController@postAdd')->name('producer.postAdd');
		route::post('/delete','Admin\ProducerController@delete')->name('producer.delete');
	});

	// User
	route::prefix('/user')->group(function() {
		route::get('/','Admin\UserController@index')->name('user.index');
		route::get('/detail/{id}','Admin\UserController@detail')->name('user.detail');
	});

	// Bill
	route::prefix('/bill')->group(function() {
		route::get('/','Admin\BillController@index')->name('bill');
		route::get('/detail/{id}','Admin\BillController@detail');

		//duyet
		route::post('/confirm','Admin\BillController@confirm');
		route::post('/cancel','Admin\BillController@cancel');
		route::get('/delete/{id}','Admin\BillController@delete');

	});

	//Discount
	route::prefix('/discount')->group(function() {
		route::get('/','Admin\DiscountController@index')->name('discount.index');
		route::post('/postAdd','Admin\DiscountController@postAdd')->name('discount.postAdd');
		route::post('/delete','Admin\DiscountController@delete')->name('discount.delete');
	});
	//statistic (thong ke)
	route::prefix('/statistic')->group(function(){
		route::get('/','Admin\StatisticController@index')->name('statistic');
		route::post('/month','Admin\StatisticController@month')->name('statistic.month');
		route::post('/quy','Admin\StatisticController@quy')->name('statistic.quy');
	});
});

// Page
route::get('/','User\PageController@index')->name('home');
route::get('/product/all','User\PageController@productAll')->name('product.all');
route::get('/product/nam','User\PageController@productnam')->name('product.nam');
route::get('/product/nu','User\PageController@productnu')->name('product.nu');

//comment
route::post('/product/comment','User\PageController@comment')->name('product.comment');
route::post('/product/comment/delete','User\PageController@delComment')->name('product.comment.delete');

route::get('/product/detail/{id}','User\PageController@detail')->name('product.detail');

route::get('/profile/{id}','User\PageController@profile')->name('profile');
route::post('/profile/{id}/edit','User\PageController@edit')->name('profile.edit');


/////////////// Rate ////////////////
route::post('/rate','User\RateController@rate')->name('rate');
//////////// End Rate //////////////
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

	//checkout
	route::post('/{user_id}/pay/checkout','Cart\CartController@postCheckout')->name('cart.post.checkout');
	route::post('/test/{id}','Cart\CartController@test')->name('cart.test');

	// Check Discount
	
	route::post('/discount/check','Cart\CartController@checkDiscount')->name('cart.discount.check');	
	//check quatity
	route::post('/check/quatity','Cart\CartController@checkQuatity')->name('cart.check.quatity');

	route::get('/check/amount/{quatity}/{id_cart}','Cart\CartController@checkAmount')->name('cart.check.amount');

});

// end Cart
//Login Logout Register
route::get('/register','LoginController@getRegister')->name('register');
route::post('/register','LoginController@postRegister')->name('postRegister');

route::get('/login','LoginController@getLogin')->name('login');
route::post('/login','LoginController@postLogin')->name('postLogin');
route::get('/logout','LoginController@logout')->name('logout');
//end Login Logout

route::get('/test',function(){
	return view('test');
});
route::get('/test2',function(){
	return view('test2');
});