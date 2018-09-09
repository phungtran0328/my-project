<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use Session;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\MessageBag;

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
        return view('page.login');
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
                'email'=>'required|email',
                'password'=>'required',

            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Địa chỉ mail không hợp lệ',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]
        );

//        $credentials = array('KH_EMAIL' => $req->email, 'KH_MATKHAU' => $req->password);

//        dd($credentials);
//        dd(Hash::make($req->password));
//        die();

        $email = $req['email'];
        $password = $req['password'];
//        $user = Customer::where('KH_EMAIL', $email)->first();
//        if($user){
//            if(Hash::check($password, $user->KH_MATKHAU)){
        //check hash pass
//                return "yep";
//            }
//            return "nope";
//        }

        if(Auth::guard('customer')->attempt(['KH_EMAIL' => $email, 'password' => $password])){
            //'password' bắt buộc phải là password vì nó đã được xác định sẵn
            //Nhưng vẫn có thể chỉnh sửa ở file model function getAuthPassword
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
