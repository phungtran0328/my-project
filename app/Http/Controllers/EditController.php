<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditController extends Controller
{
    public function showEditForm(){
        return view('page.edit');
    }
    public function edit(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'phone'=>'required|regex:/^(\84)[0-9]{8}$/',
            'birthday' => 'required|before:2006-01-01',
            'address' => 'required',

        ],
        [
            'username.required' => 'Vui lòng nhập họ tên !',
            'address.required' => 'Vui lòng nhập địa chỉ !',
            'phone.required'=>'Vui lòng nhập số điện thoại ! ',
            'phone.regex'=>'Số điện thoại mã 84 gồm 10 số ! ',
            'birthday.required'=>'Vui lòng điền ngày sinh !',
            'birthday.before'=>'Phải lớn hơn 12 tuổi !',

        ]);

        $customer= Auth::guard('customer')->user();
        $customer->KH_TEN=$request->username;
        $customer->KH_GIOITINH=$request->gender;
        $customer->KH_SDT=$request->phone;
        $customer->KH_DIACHI=$request->address;
        $customer->KH_NGAYSINH=$request->birthday;
        $customer->save();
        return redirect()->back()->with('message','Cập nhật thông tin thành công !');
    }

    public function showChangePass(){
        return view('page.changePass');
    }

    public function changePass(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|max:32|confirmed',
        ],
            [
                'old_password.required' => 'Vui lòng nhập mật khẩu !',
                'password.required' => 'Vui lòng nhập mật khẩu mới!',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự ! ',
                'password.max'=>'Mật khẩu dài tối đa 32 ký tự ! ',
                'password.confirmed'=>'Xác nhận mật khẩu không đúng. Vui lòng nhập lại !',
            ]);

        $customer= Auth::guard('customer')->user();

        $curr_pw=$request->old_password;
        //Lấy mật khẩu cũ: 123456789

        $pw=$request->password;
        //Lấy mật khẩu mới nhập vào: 123456789

        $hashed=$customer->KH_MATKHAU;
        //Lấy mã hash mật khẩu khách hàng trong database

        if(Hash::check($curr_pw,$hashed)==true){
            //Kiểm tra mật khẩu cũ nhập vào và mã hash mật khẩu trong database, Hash::check($input, $hashed)
            //Hash::check()==true => mật khẩu cũ đúng, lưu mật khẩu mới vào database
            $customer->KH_MATKHAU=Hash::make($pw);
            $customer->save();
            return redirect()->back()->with('message','Thay đổi mật khẩu thành công !');
        }
        else {
            //Hash::check() == false => mật khẩu cũ sai, thông báo lỗi
            return redirect()->back()->with('pass_error','Mật khẩu cũ không đúng !');
        }
    }
}
