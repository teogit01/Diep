<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\user;

class UserController extends Controller
{
 	public function index() {

 		$users = user::orderBy('id','desc')->paginate(10);

 		return view('admin.user.index',['users'=>$users]);
 	}
}
