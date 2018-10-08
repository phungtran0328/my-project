<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users=User::orderBy('NV_MA','desc')->paginate(10);
        return view('admin.manage.user.user', compact('users'));
    }

    public function create(){
        $roles=Role::all();
        return view('admin.manage.user.create', compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'username' => 'required|unique:nhanvien,NV_TENDANGNHAP',
                //unique: table,column_name => ,column_name -> [column_name]; , column_name -> [ column_name]
                'name'=>'required',
                'phone' => 'required|regex:/^(\84)[0-9]{9}$/',
                //regex: (đầu số 84)[dãy số từ 0-9]{gồm 9 số từ 0-9}
                'birthday' => 'required|before:2006-01-01',
                //before: ngày sinh phải trước ngày 01 tháng 01 năm 2006 (người dùng 12 tuổi)
                'address' => 'required',

            ],
            [
                'username.required' => 'Vui lòng nhập tên đăng nhập !',
                'username.unique'=>'Tên đăng nhập đã có người sử dụng ! ',
                'name.required' => 'Vui lòng nhập họ tên !',
                'address.required' => 'Vui lòng nhập địa chỉ !',
                'phone.required'=>'Vui lòng nhập số điện thoại ! ',
                'phone.regex'=>'Số điện thoại mã 84 gồm 10 số ! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Phải lớn hơn 12 tuổi !'
            ]
        );
        $random=str_random(8);
        //Tạo mật khẩu ngẫu nhiên gồm 8 kí tự
//        $password= Hash::make($random);
//        dd($random);
        $user=new User();
        $user->NV_TEN=$request->input('name');
        $user->NV_GIOITINH=$request->input('gender');
        $user->NV_NGAYSINH=$request->input('birthday');
        $user->NV_DIACHI=$request->input('address');
        $user->NV_SDT=$request->input('phone');
        $user->NV_TENDANGNHAP=$request->input('username');
        $user->NV_MATKHAU=$random;
        $user->save();

        return redirect('admin/user')->with('messageAdd','Thêm nhân viên thành công !');
    }

    public function show($id){
        $user=User::where('NV_MA',$id)->first();
        return view('admin.manage.user.update', compact('user'));
    }

    public function update(Request $request, $id){
        $this->validate($request,
            [
                'name'=>'required',
                'phone' => 'required|regex:/^(\84)[0-9]{9}$/',
                //regex: (đầu số 84)[dãy số từ 0-9]{gồm 9 số từ 0-9}
                'birthday' => 'required|before:2006-01-01',
                //before: ngày sinh phải trước ngày 01 tháng 01 năm 2006 (người dùng 12 tuổi)
                'address' => 'required',

            ],
            [
                'name.required' => 'Vui lòng nhập họ tên !',
                'address.required' => 'Vui lòng nhập địa chỉ !',
                'phone.required'=>'Vui lòng nhập số điện thoại ! ',
                'phone.regex'=>'Số điện thoại mã 84 gồm 10 số ! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Phải lớn hơn 12 tuổi !'
            ]
        );
        $user=User::where('NV_MA',$id)->first();
        $user->NV_TEN=$request->input('name');
        $user->NV_GIOITINH=$request->input('gender');
        $user->NV_NGAYSINH=$request->input('birthday');
        $user->NV_DIACHI=$request->input('address');
        $user->NV_SDT=$request->input('phone');
        $user->save();
        return redirect('admin/user')->with('messageUpdate','Cập nhật thành công !');
    }

    public function delete($id){
        User::destroy($id);
        return redirect('admin/user')->with('messageRemove','Xóa thành công !');
    }
}
