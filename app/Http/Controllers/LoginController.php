<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\user;
use App\Models\cart;

class LoginController extends Controller
{
	public function __construct() {
        parent::__construct();
    }
    //register
    public function getRegister(){
    	return view('login.register');
    }

    public function postRegister(Request $request) {
    	
    	$values = $request;

    	$values['password'] = Hash::make($request->password);
        $values['code'] = Str::random(5);
        $values['role_code'] = 'Cus';

    	$config = [
    		'model' => new user()
    	];
    	
    	$this->config($config);

    	$data = $this->model->web_insert($values);

    	return redirect('/')->with('success','Đăng ký thành công!');
    }
    // login
    public function getLogin(){
        return view('login.login');
    }

    public function postLogin(Request $request){
        $username = $request->user;
        $password = $request->pass;
        if( Auth::attempt(['username' => $username, 'password' =>$password])) {
            if (Auth::user()->role_code == 'Admin'){
                return redirect('admin');
            } else {
                //$amount_product = cart::where('user_code',Auth::user()->code);
                //return redirect('/',['amount_product'=>$amount_product]);
                return redirect('/')->with('amount_product',1);
            }
        } else {
            return redirect('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
