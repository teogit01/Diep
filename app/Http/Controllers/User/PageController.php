<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\product;
use App\Models\cart;

class PageController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	$products = product::limit(8)->get();
        if (Auth::check()) {
            $amount_product = cart::where('user_code',Auth::user()->code)->count();
        }
    	return view('page.index',['products'=>$products,'amount_product'=> isset($amount_product) ? $amount_product : 0 ]);
    }

    public function productAll() {
    	$products = product::paginate(10);
        if (Auth::check()) {
            $amount_product = cart::where('user_code',Auth::user()->code)->count();
        }
    	return view('page.product.all',['products'=>$products,'amount_product'=> isset($amount_product) ? $amount_product : 0 ]);
    }
}
