<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
//use Carbon\Carbon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

use App\Models\cart;
use App\Models\user;
use App\Models\bill;

class CartController extends Controller
{

    public function index() {
    	return view('page.cart.index');
    }

    // add product to cart
    public function add(Request $request) {
    	
    	$carts = cart::where('user_code',Auth::user()->code)->get();
    	$amount = $carts->count();
    	if ($carts){
    		foreach ($carts as $cart) {
    			if ($cart->product_code == $request->codeProduct){
    				$cart->amount++;
    				$cart->save();
    				return $amount;
    				//return 'trung';
    			} 
    		}

    		$cart = new cart();
    		$cart->product_code = $request->codeProduct;
    		$cart->user_code = Auth::user()->code;
    		$cart->amount = 1;
    		$cart->save();
    		return $amount + 1;
    		//return "k trung";
    		
    	} else {
    		$cart = new cart();
    		$cart->product_code = $request->codeProduct;
    		$cart->user_code = Auth::user()->code;
    		$cart->amount = 1;
    		$cart->save();
    		return 1;
    	}
    	
    	//$codeProduct = $request->codeProduct;
    	//$cart = new cart();
  		//$cart->product_code = 1;
    	// $cart->save();	

    	return 'ok';
    }

    // cart of user
    public function cart(){

    	$cart_detail = cart::where('user_code',Auth::user()->code)->get();

    	return view('page.cart.user',['cart_detail'=>$cart_detail,'amount_product'=>$cart_detail->count()]);
    }

    // Remove Product From Cart
    public function removeProductFormCart(Request $request){
    	$product_code = $request->product_code;
    	
    	$user_code = Auth::user()->code;
    	
    	$cart = cart::where('user_code',$user_code)->where('product_code',$product_code)->get();
    	
    	// return $cart[0];
    	$cart[0]->delete();

    	return back();
    	// return view('page.cart.user');
    	
    }
    // Pay
    public function getPay(){

    	$cart_detail = cart::where('user_code',Auth::user()->code)->get();

    	return view('page.cart.pay',['amount_product'=>$cart_detail->count()]);
    }
    public function postPay(Request $request){
    	// $array['a']=1;
    	// $array['b']=2;
    	// $array['c']=3;

    	// foreach ($array as $key => $arr)
    	// 	echo $key;
    	// return 0;

    	// Add to bill
    	$productFormCart= cart::where('user_code',Auth::user()->code)->get();
    	foreach( $productFormCart as $product)
    		// $arrayProduct[$product->amount] = $product->code;
    		$arrayProduct[$product->product_code] = $product->amount;

    	$array = Collect($arrayProduct);

    	$array->toArray();
    	return $array[0];
    	$code = Str::random(5);
    	$date = Carbon::now();
    	$user_code = Auth::id();
		
		$bill = new bill();    	
		$bill->code = $code;
		$bill->name = $request->name;
		$bill->date = $date;
		$bill->phone = $request->phone;
		$bill->address = $request->address;
		$bill->product = json_encode($arrayProduct);
		$bill->note = $request->note ? $request->note : '';
		$bill->save();

    	//return $date['day'];
    	//return Carbon::now()->toArray().day();
    	//return 'ok';


		//$name = Str::random(5)
		$carts = cart::where('user_code',Auth::user()->code)->get();
		foreach ($carts as $index => $cart)
			$carts[$index]->delete();

    	return view('page.cart.select');
    }
    public function test(Request $request) {
    	return $request->id;
    	//return back();
    }
}
