<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\cart;
use App\Models\bill;
use App\Models\bill_detail;

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

    public function delete(Request $request){
        $bill = bill::find($request->id);
        $bill->delete();
        return back()->with('success','Xoá thành công!');
    }

    public function detail(Request $request) {
        $bill = bill::find($request->id);
        $bill_detail = bill_detail::where('bill_id','=',$request->id)->get();
        foreach ($bill_detail as $item){
            $products[] = $item->product->name;
            $amounts[] = $item->product_amount;
            $prices[] = $item->product->price;
            $codes[] = $item->product->code;
        }
        //return $amounts;
        return view('admin.bill.detail',['bill'=>$bill,
                                            'products'=>$products,
                                            'amounts'=>$amounts,
                                            'prices'=>$prices,'codes'=>$codes]);
    }

    // duyet hoa don
    public function confirm(Request $request){
        $bill = bill::find($request->id);
        $bill->status = 1;
        $bill->save();
        return 'Đã duyệt';
    }

    public function cancel(Request $request){
        
        $bill = bill::find($request->id);
        $bill->status = 3;
        $bill->save();
        return 'Đã huỷ';
    }
}
