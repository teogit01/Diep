<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\cart;
use App\Models\bill;

class BillController extends Controller
{
 	public function __construct() {
        parent::__construct();
    }

    public function index() {

    	//$bills = bill::all()->groupBy('user_code');
        $bills = bill::all();
    	//return $cart;
    	return view('admin.bill.index',['bills'=>$bills]);
    // 	<div style="width: 90%;display: flex;justify-content: center;">
				// 		{{ $users->links() }}
				// </div>
    }

    public function detail(Request $request) {

        $bill = bill::find($request->id);
        // return $bill;
        return view('admin.bill.detail',['bill'=>$bill]);
    }
}
