<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\InvoiceIn;
use App\InvoiceInDetails;
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

    public function storeDetail(Request $request, $id){
        $this->validate($request,[
            'book'=>'required',
            'price'=>'required',
            'qty'=>'required'
        ],[
            'book.required'=>'Vui lòng chọn sách !',
            'price.required'=>'Vui lòng nhập giá !',
            'qty.required'=>'Vui lòng nhập số lượng !'
        ]);
        $book=$request->input('book');
        $price=$request->input('price');
        $qty=$request->input('qty');
        $data=array();
        $total=0;
        for($i=0;$i<count($book);$i++){
            $data[$i]=[
                'S_MA'=>$book[$i],
                'PN_MA'=>$id,
                'PNCT_SOLUONG'=>$qty[$i],
                'PNCT_GIA'=>$price[$i]
            ];
            $total+=($data[$i]['PNCT_SOLUONG'])*($data[$i]['PNCT_GIA']);
        }

        InvoiceInDetails::insert($data);

        InvoiceIn::where('PN_MA',$id)->update(['PN_TONGTIEN'=>$total]);
        $invoice=InvoiceIn::where('PN_MA',$id)->first();
        $update=$invoice->book()->get();
//        dd($update);
        //Cộng số lượng nhập vào số lượng tồn
        foreach ($update as $key=>$value){
            $value->S_SLTON=$value->S_SLTON+$value->pivot->PNCT_SOLUONG;
            $value->save();
        }
        return redirect('admin/invoice-in')->with('messAddDetail','Thêm hóa đơn chi tiết thành công !');
    }
}
