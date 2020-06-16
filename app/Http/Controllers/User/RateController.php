<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\product;
class RateController extends Controller
{
    public function rate(Request $request){

    	$position = $request->position;
    	$idProduct = $request->idProduct;
    	$checkRate = $request->checkRate;
    
    	$product = product::all()->find($idProduct);
    	if ($checkRate == 'rate') {
    		if ($product->rate == $position){
    			$product->rate = $product->rate - 1;	
    		} else {
    			$product->rate = $position;
    		}
    		$product->save();
    	} else {
    		if ( $product->rate == $position){
    			$product->rate = $product->rate + 1;
    		} else {
    			$product->rate = $position;
    		}
    		$product->save();
    	}
    	return view('page.product.updateRate',['product'=>$product]);
    }
}
