<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:34 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Hash;
use Exception;

class LoginController extends Controller
{
    protected $redirectTo = '/admin/index';

    public function showLoginForm()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('admin.login');
    }

    public function login(Request $req){
        $this->validate($req,
            [
                'username'=>'required',
                'password'=>'required'
            ],
            [
                'username.required'=>'Vui lòng nhập tài khoản !',
                'password.required'=>'Vui lòng nhập mật khẩu !'
            ]
        );

        $auth = User::where('NV_TENDANGNHAP', '=', $req->username)->where('NV_MATKHAU', '=', $req->password)->first();
        if($auth){
            Auth::login($auth);
            return redirect('/admin/index');
        }
        else
        {
            return redirect()->back()->with('message','Sai tên đăng nhập hoặc mật khẩu!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
}