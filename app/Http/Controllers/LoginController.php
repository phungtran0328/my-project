<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Session;
use Hash;
use Exception;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('page.login');
    }

    public function login(Request $req)
    {
        $this->validate($req,
            [
                'username'=>'required',
                'password'=>'required'
            ],
            [
                'username.required'=>'Vui lòng nhập tài khoản',
                'password.required'=>'Vui lòng nhập mật khẩu'
            ]
        );

        $auth = User::where('NV_TENDANGNHAP', '=', $req->username)->where('NV_MATKHAU', '=', $req->password)->first();
        if($auth){
            Auth::login($auth);
            return redirect('/index');
        }
        else
        {
            return redirect()->back()->with('message','Sai tên đăng nhập hoặc mật khẩu!');
        }

    }
}
