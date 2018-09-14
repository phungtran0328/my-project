<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function showUpdateForm(){
        return view('admin.profile');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|regex:/^(\84)[0-9]{8}$/',
            'birthday' => 'required|before:2006-01-01',
            'address' => 'required',

        ],
            [
                'name.required' => 'Vui lòng nhập họ tên !',
                'address.required' => 'Vui lòng nhập địa chỉ !',
                'phone.required'=>'Vui lòng nhập số điện thoại ! ',
                'phone.regex'=>'Số điện thoại mã 84 gồm 10 số ! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Phải lớn hơn 12 tuổi !',

            ]);

        $user = Auth::user();
        $user->NV_TEN = $request->name;
        $user->NV_DIACHI = $request->address;
        $user->NV_SDT = $request->phone;
        $user->NV_NGAYSINH = $request->birthday;
        $user->save();
        return redirect()->back()->with('message','Cập nhật thông tin thành công !');
    }
}
