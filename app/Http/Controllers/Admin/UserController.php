<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Role;
use App\User;
use App\User_Role;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $date = date('Y-m-d', strtotime('-18 years'));
        $this->validate($request,
            [
                'username' => 'required|unique:nhanvien,NV_TENDANGNHAP',
                //unique: table,column_name => ,column_name -> [column_name]; , column_name -> [ column_name]
                'phone' => 'required|regex:/(0)[0-9]{9}$/',
                //regex: (đầu số 84)[dãy số từ 0-9]{gồm 9 số từ 0-9}
                'birthday' => 'required|before:'.$date,
                //before: ngày sinh phải trước ngày 01 tháng 01 năm 2000 (nhân viên >= 18 tuổi)
            ],
            [
                'username.required' => 'Vui lòng nhập tên đăng nhập !',
                'username.unique'=>'Tên đăng nhập đã có người sử dụng ! ',
                'phone.required'=>'Vui lòng nhập số điện thoại ! ',
                'phone.regex'=>'Số điện thoại mã 84 gồm 10 số ! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Phải lớn hơn 18 tuổi !'
            ]
        );
        $random=str_random(8);
        //Tạo mật khẩu ngẫu nhiên gồm 8 kí tự
//        $password= Hash::make($random);
//        dd($random);
        $roles = $request->input('role');

        $user=new User();
        $user->NV_TEN=$request->input('name');
        $user->NV_GIOITINH=$request->input('gender');
        $user->NV_NGAYSINH=$request->input('birthday');
        $user->NV_DIACHI=$request->input('address');
        $user->NV_SDT=$request->input('phone');
        $user->NV_TENDANGNHAP=$request->input('username');
        $user->NV_MATKHAU=$random;
        $user->save();

        $data=array();
        for ($i=0;$i<count($roles);$i++){
            $data[]=[
                'NV_MA'=>$user->NV_MA,
                'Q_MA'=>$roles[$i]
            ];
        }
        User_Role::insert($data);
        return redirect('admin/user')->with('messageAdd','Thêm nhân viên thành công !');
    }

    public function update(Request $request, $id){
        $user=User::where('NV_MA',$id)->first();
        $temp = $user->roles()->get();
        $role = $request->input('roles');
        $data=array();
        for ($i=0;$i<count($role);$i++){
            $data[]=[
                'NV_MA'=>$id,
                'Q_MA'=>$role[$i]
            ];
        }
        if (count($temp)==0){
            User_Role::insert($data);
        }
        else{
            for($i=0;$i<count($temp);$i++){
                User_Role::where('NV_MA',$id)->delete();
            }
            User_Role::insert($data);
        }
        return redirect('admin/user')->with('messageUpdate','Cập nhật thành công !');
    }

    public function delete($id){
        User::destroy($id);
        return redirect('admin/user')->with('messageRemove','Xóa thành công !');
    }

    public function print(){
        $user = Auth::user();
        Log::info("Nhân viên đã in danh sách nhân viên: ".$user->NV_MA." - ".$user->NV_TEN."\r\n");
        return redirect()->back();
    }

    public function export(){
        $date = str_slug(date('d-m-Y H:i:s'),'-');
        $user = Auth::user();
        Log::info("Nhân viên đã xuất danh sách nhân viên: ".$user->NV_MA." - ".$user->NV_TEN."\r\n");
        return (new UsersExport())->download($date.'-users.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
