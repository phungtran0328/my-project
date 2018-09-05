<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('page.register');
    }

    public function create(Request $req){
        $this->validate($req,
            [
                'username' => 'required|string',
                'email' => 'required|email|unique:khachhang,KH_EMAIL',
                //unique: table, column_name
                'password' => 'required|string|min:6|max:32',
                'phone' => 'required|digits_between:10,12',
                'birthday' => 'required|before:today',
                'address' => 'required|string',

            ],
            [
                'username.required' => 'Vui lòng nhập họ tên',
                'email.required'=>'Vui lòng nhập email! ',
                'email.unique'=>'Email đã có người sử dụng! ',
                'password.required'=>'Vui lòng nhập mật khẩu! ',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự! ',
                'password.max'=>'Mật khẩu dài tối đa 32 ký tự! ',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'phone.required'=>'Vui lòng nhập số điện thoại! ',
                'phone.digits_between'=>'Nhập số từ 10 đến 12 số! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Ngày sinh không được lớn hơn ngày hôm nay'
            ]
        );
        $customer=new Customer();
        $customer->KH_TEN=$req->username;
        $customer->KH_GIOITINH=$req->gender;
        $customer->KH_SDT=$req->phone;
        $customer->KH_DIACHI=$req->address;
        $customer->KH_NGAYSINH=$req->birthday;
        $customer->KH_EMAIL=$req->email;
        $customer->KH_MATKHAU=Hash::make($req->password);
        $customer->save();
        return redirect()->back()->with('message','Tạo tài khoản thành công');
    }
}
