<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\type;

class TypeProductController extends Controller
{
	 // Hàm khởi tạo.
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request) {
    	$data = type::all();
    	
    	return view('admin.typeProduct.index',['data'=>$data]);
    }

    public function postAdd(Request $request) {

        $insert = $request;
        $insert['code'] = strtoupper($insert['code']);
    	$config = [
    		'model' => new type(),
    		'request'=> $request,
    	];
    	$this->config($config);
    	$data = $this->model->web_insert($insert);
    	return back()->with('success', 'Thêm thành công');
    }
    public function delete(Request $request) {
    	$id = $request->id;
    	$record = type::findOrFail($id);
        $record->delete();
        // dd($data);
        //return back()->with('success', 'Xóa thành công!');
        $data = type::all();
    	return view('admin.typeProduct.dataUpdateContent',['data'=>$data,'mess'=>'Xoa Thanh Cong!']);
    }
}
