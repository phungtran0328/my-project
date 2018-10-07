<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\InvoiceIn;
use App\ReleaseCompany;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceInController extends Controller
{
    public function index(){
        $invoices=InvoiceIn::orderBy('PN_MA','desc')->paginate(10);
        return view('admin.manage.invoice_in.invoice_in',compact('invoices'));
    }

    public function create(){
        $users=User::all();
        $companies=ReleaseCompany::all();
        return view('admin.manage.invoice_in.create', compact('users','companies'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'company'=>'required',
            'date-in'=>'before: tomorrow'
        ],[
            'company.required'=>'Vui lòng chọn công ty phát hành !',
            'date-in.before'=>'Ngày lập không lớn hơn hôm nay !'
        ]);

        $invoice=new InvoiceIn();
        $invoice->NV_MA=$request->input('user');
        $invoice->CTPH_MA=$request->input('company');
        $invoice->PN_NGAYNHAP=$request->input('date-in');
        $invoice->PN_GHICHU=$request->input('note');
        $invoice->save();
        return redirect('admin/invoice-in/create-detail')->with('messAdd','Vui lòng nhập chi tiết hóa đơn !');
    }

    public function createDetail(){
        $invoice=InvoiceIn::orderBy('PN_MA','desc')->first();
        $books=Book::all();
        return view('admin.manage.invoice_in.create_detail',compact('invoice','books'));
    }
}
