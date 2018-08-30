<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use Session;
use Hash;
use Exception;

class LoginController extends Controller
{
    protected $redirectTo = '/index';
    protected $guard = 'customer';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('page.login_popup');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function login(Request $req)
    {
        $this->validate($req,
            [
                'user'=>'required',
                'pass'=>'required',

            ],
            [
                'user.required'=>'Vui lòng nhập tài khoản',
                'pass.required'=>'Vui lòng nhập mật khẩu'
            ]
        );

        $auth = Customer::where('KH_EMAIL', '=', $req->user)->where('KH_MATKHAU', '=', $req->pass)->first();
        if($auth){
            Auth::guard('customer')->login($auth);
            return redirect('/index');
        }
        else
        {
            return redirect()->back()->with('message','Sai tên đăng nhập hoặc mật khẩu!');
        }
    }

    public function logout(){
        Auth::guard('customer')->logout();
        return redirect('/index');
    }
}
