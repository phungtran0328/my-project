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
     * Show the application's register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        $city=new Customer();
        $cities=$city->getCity();
//        sort($cities);
        $keys=array_keys($cities);
        $values=array_values($cities);
//        dd($keys[0]);
        return view('page.register', compact('keys','values'));
    }

    public function create(Request $req){
        $date = date('Y-m-d', strtotime('-12 years'));
        $this->validate($req,
            [
                'username' => 'required',
                'email' => 'required|email|unique:khachhang,KH_EMAIL',
                //unique: table,column_name
                'password' => 'required|min:6|max:32|confirmed',
                'phone' => 'required|regex:/(0)[0-9]{9}$/',
                //  /^(\0)[0-9]{9}$/ kiểu 1
                // /(01)[0-9]{9}/ kiểu 2
                // /(0)[0-9]{9}$/ kiểu 3
                //regex: (đầu số 84 [0])[dãy số từ 0-9]{gồm 9 số từ 0-9}
                'birthday' => 'required|before:'.$date,
                //before: ngày sinh phải trước ngày 01 tháng 01 năm 2006 (người dùng 12 tuổi)
                'address' => 'required',

            ],
            [
                'username.required' => 'Vui lòng nhập họ tên !',
                'email.required'=>'Vui lòng nhập email ! ',
                'email.email'=>'Địa chỉ mail không hợp lệ !',
                'email.unique'=>'Email đã có người sử dụng ! ',
                'password.required'=>'Vui lòng nhập mật khẩu ! ',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự ! ',
                'password.max'=>'Mật khẩu dài tối đa 32 ký tự ! ',
                'password.confirmed'=>'Xác nhận mật khẩu không đúng. Vui lòng nhập lại !',
                'address.required' => 'Vui lòng nhập địa chỉ !',
                'phone.required'=>'Vui lòng nhập số điện thoại ! ',
                'phone.regex'=>'Số điện thoại không hợp lệ ! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Phải lớn hơn 12 tuổi !'
            ]
        );
        $customer=new Customer();
        $customer->KH_TEN=$req->username;
        $customer->KH_GIOITINH=$req->gender;
        $customer->KH_SDT=$req->phone;
        $customer->KH_DIACHI=$req->address;
        $customer->KH_DIACHI2=$req->city;
        $customer->KH_NGAYSINH=$req->birthday;
        $customer->KH_EMAIL=$req->email;
        $customer->KH_MATKHAU=Hash::make($req->password);
        $customer->save();
        return redirect()->back()->with('message','Tạo tài khoản thành công');
    }
}
