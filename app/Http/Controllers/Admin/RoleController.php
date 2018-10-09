<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::orderBy('Q_MA','desc')->paginate(10);
        return view('admin.manage.user.role', compact('roles'));
    }

    public function create(){
        return view('admin.manage.user.create_role');
    }

    public function store(Request $request){
        /*$this->validate($request,[
            'name'=>'required',
            'roles'=>'required'
        ],[
            'name.required'=>'Vui lòng nhập tên quyền !',
            'roles.required'=>'Vui lòng chọn quyền !'
        ]);*/

        $roles=$request->input('roles');
        /*$customer=$request->input('customer');
        $employee=$request->input('employee');
        $book=$request->input('book');
        $invoice=$request->input('invoice');
        $invoiceIn=$request->input('invoice-in');*/
        switch ($roles){
            case 1:
                $data=array(
                    'order.create'=>true,
                    'order.update'=>true,
                    'order.delete'=>true
                );
                break;
            case 2:
                $data=array(
                    'employee.create'=>true,
                    'employee.update'=>true,
                    'employee.delete'=>true
                );
                break;
            case 3:
                $data=array(
                    'customer.create'=>true,
                    'customer.update'=>true,
                    'customer.delete'=>true
                );
                break;
            case 4:
                $data=array(
                    'invoice-in.create'=>true,
                    'invoice-in.update'=>true,
                    'invoice-in.delete'=>true
                );
                break;
            case 5:
                $data=array(
                    'invoice.create'=>true,
                    'invoice.update'=>true,
                    'invoice.delete'=>true
                );
                break;
            case 6:
                $data=array(
                    'book.create'=>true,
                    'book.update'=>true,
                    'book.delete'=>true
                );
                break;
        }

        $role= new Role();
        $role->Q_TEN=$request->input('name');
        $role->Q_QUYEN=$data;
        $role->save();
        return redirect('admin/role')->with('messAdd','Thêm thành công !');
    }

    public function show($id){
        $role=Role::where('Q_MA',$id)->first();
        $results=array();
        $results[]=$role->Q_QUYEN;
        return view('admin.manage.user.update_role', compact('role','results'));
    }

    public function update(Request $request, $id){
        $name=$request->input('name');
        $create=$request->input('create');
        $update=$request->input('update');
        $delete=$request->input('delete');
        $role=Role::where('Q_MA',$id)->first();

        $results=$role->Q_QUYEN;
//        dd($results);
        $key=array_keys($results); //lấy key name
        $results[$key[0]]=$create; //thay đổi giá trị name [0]
        $results[$key[1]]=$update;
        $results[$key[2]]=$delete;
        $role->Q_TEN=$name;
        $role->Q_QUYEN=$results; //cập nhật lại
        $role->save();
        return redirect('admin/role')->with('messUpdate','Cập nhật thành công !');
    }
}
