<?php

namespace App\Http\Controllers\Admin;

use App\ReleaseCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReleaseCompanyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');
        if (isset($search)){
            $companies = ReleaseCompany::where('CTPH_TEN','like','%'.$search.'%')
                ->orderBy('CTPH_MA','desc')->paginate(10);
        }
        else{
            $companies = ReleaseCompany::orderBy('CTPH_MA','desc')->paginate(10);
        }
        return view('admin.manage.company.company', compact('companies','search'));
    }

    /*public function create(){
        return view('admin.manage.company.create');
    }*/

    public function store(Request $request){
        /*$this->validate($request,[
            'name'=>'required',
            'phone'=>'numeric'
        ],[
            'name.required'=>'Vui lòng nhập tên công ty phát hành !',
            'phone.numeric'=>'Số điện thoại là số !'
        ]);*/
//        dd($request->all());
        $company=new ReleaseCompany();
        $company->CTPH_TEN=$request->input('name_create');
        $company->CTPH_DIACHI=$request->input('address_create');
        $company->CTPH_SDT=$request->input('phone_create');
        $company->CTPH_GHICHU=$request->input('note_create');
        $company->save();
        return redirect()->back()->with('messageAdd','Đã thêm công ty phát hành ID: '.$company->CTPH_MA.' !');
    }

    /*public function show($id){
        $company=ReleaseCompany::where('CTPH_MA',$id)->first();
        return view('admin.manage.company.update',compact('company'));
    }*/

    public function update(Request $request, $id){
       /* $this->validate($request,[
            'name'=>'required',
            'phone'=>'numeric'
        ],[
            'name.required'=>'Vui lòng nhập tên công ty phát hành !',
            'phone.numeric'=>'Số điện thoại là số !'
        ]);*/
        $data=array(
            $request->input('name_update'),
            $request->input('address_update'),
            $request->input('phone_update'),
            $request->input('note_update'),
        );

        ReleaseCompany::where('CTPH_MA',$id)->update([
            'CTPH_TEN'=>$data[0],
            'CTPH_DIACHI'=>$data[1],
            'CTPH_SDT'=>$data[2],
            'CTPH_GHICHU'=>$data[3]
        ]);
        return redirect()->back()->with('messageUpdate','Đã cập nhật CTPH ID: '.$id.' !');
    }

    public function delete($id){
        $company = ReleaseCompany::where('CTPH_MA',$id)->first();
        $invoice_in = $company->invoice_in()->first();
        if (isset($invoice_in)){
            return redirect()->back()->with('messageRemoveError','Không thể xóa vì tồn tại phiếu nhập có CTPH ID: '.$id.' !');
        }else{
            $company->delete();
            return redirect()->back()->with('messageRemove','Đã xóa CTPH có ID: '.$id.' !');
        }
    }
}
