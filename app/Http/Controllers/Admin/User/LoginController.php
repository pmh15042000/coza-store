<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    function index(){
        if(Auth::check()){
            return redirect()->route('admin.home');
        }
        return view('admin.users.login',['title'=>'Trang đăng nhập']);
    }
    function store(LoginRequest $request){
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->route('admin.home');
        }
        Session::flash('error','Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }
}
