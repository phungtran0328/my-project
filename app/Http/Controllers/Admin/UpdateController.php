<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function showUpdateForm(){
        return view('admin.profile');
    }

    public function updateProfile(Request $request){
        $date = date('Y-m-d', strtotime('-18 years'));
        $this->validate($request,[
            'phone'=>'regex:/(0)[0-9]{9}$/',
            'birthday' => 'before:'.$date,
        ],[
            'phone.regex'=>'Số điện thoại không hợp lệ ! ',
            'birthday.before'=>'Phải lớn hơn 12 tuổi !',
        ]);

        $user = Auth::user();
        $user->NV_TEN = $request->name;
        $user->NV_DIACHI = $request->address;
        $user->NV_SDT = $request->phone;
        $user->NV_NGAYSINH = $request->birthday;
        $user->NV_GIOITINH = $request->gender;
        $user->save();
        return redirect()->back()->with('message','Cập nhật thông tin thành công !');
    }

    public function showChangePass(){
        return view('admin.setting');
    }

    public function changePass(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|max:32|confirmed',
        ],[
            'old_password.required' => 'Vui lòng nhập mật khẩu !',
            'password.required' => 'Vui lòng nhập mật khẩu mới!',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự ! ',
            'password.max'=>'Mật khẩu dài tối đa 32 ký tự ! ',
            'password.confirmed'=>'Xác nhận mật khẩu không đúng. Vui lòng nhập lại !',
        ]);

        $user = Auth::user();

        $curr_pw = $request->old_password;
        //Lấy mật khẩu cũ: 123456789

        $pw = $request->password;
        //Lấy mật khẩu mới nhập vào: 123456789

        $hashed = $user->NV_MATKHAU;
        //Lấy mật khẩu khách hàng trong database (có thể hash hoặc không)

        if(Hash::check($curr_pw,$hashed)==true){
            //Kiểm tra mật khẩu cũ nhập vào (chuỗi) và mã hash (hàm băm) mật khẩu trong database
            //Hash::check($input, $hashed)
            //Hash::check()==true => mật khẩu cũ đúng, lưu mật khẩu mới vào database
            $user->NV_MATKHAU = Hash::make($pw);
            $user->save();
            return redirect()->back()->with('message','Thay đổi mật khẩu thành công !');
        }else{
            if ($curr_pw==$hashed){
                $user->NV_MATKHAU = Hash::make($pw);
                $user->save();
                return redirect()->back()->with('message','Thay đổi mật khẩu thành công !');
            }else {
                //Hash::check() == false => mật khẩu cũ sai, thông báo lỗi
                return redirect()->back()->with('pass_error','Mật khẩu cũ không đúng !');
            }
        }
    }
}
