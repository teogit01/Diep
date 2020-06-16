<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\product;
use App\Models\cart;
use App\Models\user;
use App\Models\comment;

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
    // Show All Product
    public function productAll() {
    	$products = product::paginate(10);
        if (Auth::check()) {
            $amount_product = cart::where('user_code',Auth::user()->code)->count();
        }
    	return view('page.product.all',['products'=>$products,'amount_product'=> isset($amount_product) ? $amount_product : 0 ,'phanloai'=>'Tất cả sản phẩm']);
    }
    public function productnam() {
        $products = product::where('nam','1')->paginate(10);
        if (Auth::check()) {
            $amount_product = cart::where('user_code',Auth::user()->code)->count();
        }
        return view('page.product.nam',['products'=>$products,'amount_product'=> isset($amount_product) ? $amount_product : 0 ,'phanloai'=>'Sản phẩm nam']);
    }
    public function productnu() {
        $products = product::where('nu','1')->paginate(10);
        if (Auth::check()) {
            $amount_product = cart::where('user_code',Auth::user()->code)->count();
        }
        return view('page.product.nu',['products'=>$products,'amount_product'=> isset($amount_product) ? $amount_product : 0,'phanloai'=>'Sản phẩm nữ']);
    }
    // Show detail product
    public function detail(Request $request) {
        //$t = 100000;
        //return number_format($t,0,'','.');
        $amount_product = cart::where('user_code',Auth::user()->code)->count();
        $products = product::all();
        $comments = comment::all();
        $product = $products->find($request->id);
        return view('page.product.detail',['product'=>$product,'amount_product'=>$amount_product,'comments'=>$comments]);
    }
    // Profile of user
    
    public function profile(Request $request) {
        $user = Auth::user();
        return view('page.profile.index',['user'=>$user]);
    }

    // Edit profile
    public function edit(Request $request) {
        
        if ($request->hasFile('avatar')){
            $path = public_path('img/avatars');
            $name = Str::random(5).'_'.$request->avatar->getClientOriginalName();
            $request->avatar->move($path,$name);
        }

        $UserId = $request->id;
        $users = user::all();

        $user = $users->find($UserId);
        $user->name = $request->name ? $request->name : $user->name;
        $user->birthday = $request->birthday ? $request->birthday : $user->birthday;
        $user->phone = $request->phone ? $request->phone : $user->phone;
        $user->email = $request->email ? $request->email : $user->email;
        $user->address = $request->address ? $request->address : $user->address;
        $user->avatar = isset($name) ? $name : $user->avatar;
        $user->save();
        
        return back()->with('success','Cập nhật thành công!');  
    }
    // comment
    public function comment(Request $request){
        //return $request->codeUser;
        $comment = new comment();
        $comment->code = Str::random(5);
        $comment->content = $request->comment;
        $comment->user_code = $request->codeUser;
        $comment->product_code = $request->codeProduct;
        $comment->save();
        $comments = comment::all();
        
        
        return view('page.comment.comment',['comments'=>$comments]);
    }

    //delete comment
    public function delComment(Request $request){
        $comment = comment::find($request->id);
        $comment->delete();
        $comments = comment::all();
        return view('page.comment.comment',['comments'=>$comments]);
    }
}   
