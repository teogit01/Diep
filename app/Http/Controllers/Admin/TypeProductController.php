<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\loaisanpham;

class TypeProductController extends Controller
{
	 // Hàm khởi tạo.
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $req) {
    	$data = loaisanpham::all();
    	
    	return view('admin.typeProduct.index',['data'=>$data]);
    }

    public function postAdd(Request $req) {

    	$config = [
    		'model' => new loaisanpham(),
    		'request'=> $req,
    	];
    	$this->config($config);
    	$data = $this->model->web_insert($this->request);
    	return back()->with('success', 'Thêm thành công');
    }
    public function delete(Request $request) {
    	$id = $request->id;
    	$record = loaisanpham::findOrFail($id);
        $record->delete();
        // dd($data);
        //return back()->with('success', 'Xóa thành công!');
        $data = loaisanpham::all();
    	return view('admin.typeProduct.dataUpdateContent',['data'=>$data,'mess'=>'Xoa Thanh Cong!']);
    }
}
