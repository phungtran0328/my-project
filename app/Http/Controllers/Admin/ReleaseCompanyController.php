<?php

namespace App\Http\Controllers\Admin;

use App\ReleaseCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReleaseCompanyController extends Controller
{
    public function index(){
        $companies=ReleaseCompany::orderBy('CTPH_MA','desc')->paginate(10);
        return view('admin.manage.company.company', compact('companies'));
    }

    public function create(){
        return view('admin.manage.company.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'numeric'
        ],[
            'name.required'=>'Vui lòng nhập tên công ty phát hành !',
            'phone.numeric'=>'Số điện thoại là số !'
        ]);

        $company=new ReleaseCompany();
        $company->CTPH_TEN=$request->input('name');
        $company->CTPH_DIACHI=$request->input('address');
        $company->CTPH_SDT=$request->input('phone');
        $company->CTPH_GHICHU=$request->input('note');
        $company->save();
        return redirect('admin/company')->with('messageAdd','Thêm công ty phát hành thành công !');
    }

    public function show($id){
        $company=ReleaseCompany::where('CTPH_MA',$id)->first();
        return view('admin.manage.company.update',compact('company'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'numeric'
        ],[
            'name.required'=>'Vui lòng nhập tên công ty phát hành !',
            'phone.numeric'=>'Số điện thoại là số !'
        ]);
        $data=array();
        $data[]=[
            $request->input('name'),
            $request->input('address'),
            $request->input('phone'),
            $request->input('note'),
        ];
        ReleaseCompany::where('CTPH_MA',$id)->update([
            'CTPH_TEN'=>$data[0][0],//[0][0] số dòng, số thứ tự trong data
            'CTPH_DIACHI'=>$data[0][1],
            'CTPH_SDT'=>$data[0][2],
            'CTPH_GHICHU'=>$data[0][3]
        ]);
        return redirect('admin/company')->with('messageUpdate','Cập nhật thành công !');
    }

    public function delete($id){
        ReleaseCompany::where('CTPH_MA',$id)->delete();
        return redirect('admin/company')->with('messageRemove','Xóa thành công !');
    }
}
