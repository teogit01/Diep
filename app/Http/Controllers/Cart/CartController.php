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
use App\Models\product;
use App\Models\discount;
use App\Models\bill_detail;

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
                    if ($cart->size == $request->size and $cart->color == $request->color){
                        $cart->amount = $cart->amount + $request->amount;
                        $cart->save();
                        return $amount;
                    }
    			}
    		}
    		$cart = new cart();
    		$cart->product_code = $request->codeProduct;
    		$cart->user_code = Auth::user()->code;
    		$cart->amount = (isset($request->amount)) ? $request->amount : 1;
            $cart->size = $request->size;
            $cart->color = $request->color;
            //$cart->total = $request->;
    		$cart->save();
    		return $amount + 1;
    		//return "k trung";
    		
    	} else {
    		$cart = new cart();
    		$cart->product_code = $request->codeProduct;
    		$cart->user_code = Auth::user()->code;
    		$cart->amount = 1;
            $cart->size = $request->size;
            $cart->color = $request->color;
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
        $total = 0;
    	$cart_detail = cart::where('user_code',Auth::user()->code)->get();
        foreach ($cart_detail as $item){
            //echo $item->product_code;
            $products[] = product::where('code',$item->product_code)->get();
            if (!empty($products)){
                foreach ($products as $pro){
                    foreach ($pro as $item1){
                        $colors[] = $item1->color;
                        $sizes[] = $item1->size;
                    }
                }
            } 
            $total = $total + ($item->amount * $item1->price);
            $detail_total[] = $item->amount * $item1->price;
        }
        // return $detail_total;
        // return $total;

    	return view('page.cart.user',['cart_detail'=>$cart_detail,
                                    'amount_product'=>$cart_detail->count(),
                                    'colors'=>isset($colors) ? $colors : '',
                                    'sizes'=>isset($sizes) ? $sizes : '',
                                    'total'=>$total,
                                    'detail_total'=>$detail_total
                                ]);
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
    // public function getPay(){

    // 	$cart_detail = cart::where('user_code',Auth::user()->code)->get();

    // 	return view('page.cart.pay',['amount_product'=>$cart_detail->count()]);
    // }
    public function postPay(Request $request){
        //return $request ;

        $products = cart::where('user_code','=',Auth::user()->code)->get(['product_code','amount']);
        //return $products;
    	// Add to bill
    	$code = Str::random(5);
    	$user_code = Auth::id();
        $today = Carbon::now();
        $day = $today->day;
        if ($day < 10){
            $day = '0'.$day;
        }
        $month = $today->month;
        if($month < 10){
            $month = '0'.$month;
        }
        $year = $today->year;
        $date =  $year.'-'.$month.'-'.$day;
        
        
        //return $products;
		//return $request;
		$bill = new bill();    	
		$bill->code = $code;
        $bill->date = $date;
        $bill->user_code =Auth::user()->code;
		$bill->name = $request->name;
		$bill->phone = $request->phone;
		$bill->address = $request->address;
		$bill->discount = $request->precent;
        $bill->total = $request->total;
        $bill->status = 0;
		$bill->note = $request->note ? $request->note : '';
		$bill->save();


        //return $bill->id;
        foreach ($products as $item){
            $bill_detail = new bill_detail();
            $bill_detail->product_code = $item->product_code;
            $bill_detail->product_amount = $item->amount;
            $bill_detail->bill_id = $bill->id;
            $bill_detail->save();
        }
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

    // Check Discount
    public function checkDiscount(Request $request){
        $discount = discount::where('code','=',$request->discount)->get();
        if (count($discount) == 0 )
            return 0;
         else 
            return $discount[0]->percent;
        //return $request->discount;
    }
    //post checkout
    public function postCheckout(Request $request){
        //return $request;
        return view('page.cart.pay',['total'=>$request->total,'precent'=>$request->precent]);
    }

    // check quatity
    public function checkQuatity(Request $request){        
        
        $cart = cart::find($request->id_cart);

        if ($cart->amount < $request->quatity){
            $cart->amount++;
        } else {
            $cart->amount--;
        }
        $cart->save();
        //return Auth::user()->code;
        $total = 0;
        $cart_detail = cart::where('user_code','=',Auth::user()->code)->get();
        //$cart_detail = cart::all();
        foreach ($cart_detail as $item){
            //echo $item->product_code;
            $products[] = product::where('code',$item->product_code)->get();
            if (!empty($products)){
                foreach ($products as $pro){
                    foreach ($pro as $item1){
                        $colors[] = $item1->color;
                        $sizes[] = $item1->size;
                    }
                }
            } 
            $total = $total + ($item->amount * $item1->price);
            $detail_total[] = $item->amount * $item1->price;
        }   

        // return $cart_detail[0];
        // return $cart_detail;

        return view('page.cart.user-load',['cart_detail'=>$cart_detail,
                                    'amount_product'=>$cart_detail->count(),
                                    'colors'=>isset($colors) ? $colors : '',
                                    'sizes'=>isset($sizes) ? $sizes : '',
                                    'total'=>$total,
                                    'detail_total'=>$detail_total
                                ]);    
    }
    // check amount
    public function checkAmount(Request $request){        
        
        $cart = cart::find($request->id_cart);

        if ($cart->amount < $request->quatity){
            $cart->amount++;
        } else {
            $cart->amount--;
        }
        $cart->save();
        //return Auth::user()->code;
        $total = 0;
        $cart_detail = cart::where('user_code','=',Auth::user()->code)->get();
        //$cart_detail = cart::all();
        foreach ($cart_detail as $item){
            //echo $item->product_code;
            $products[] = product::where('code',$item->product_code)->get();
            if (!empty($products)){
                foreach ($products as $pro){
                    foreach ($pro as $item1){
                        $colors[] = $item1->color;
                        $sizes[] = $item1->size;
                    }
                }
            } 
            $total = $total + ($item->amount * $item1->price);
            $detail_total[] = $item->amount * $item1->price;
        }   

        // return $cart_detail[0];
        // return $cart_detail;

        // return view('page.cart.user-load',['cart_detail'=>$cart_detail,
        //                             'amount_product'=>$cart_detail->count(),
        //                             'colors'=>isset($colors) ? $colors : '',
        //                             'sizes'=>isset($sizes) ? $sizes : '',
        //                             'total'=>$total,
        //                             'detail_total'=>$detail_total
        //                         ]);    
        return back();
    }
}
