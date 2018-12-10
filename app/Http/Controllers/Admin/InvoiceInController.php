<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Imports\InvoiceInDetailsImport;
use App\InvoiceIn;
use App\InvoiceInDetails;
use App\ReleaseCompany;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceInController extends Controller
{
    public function index(){
        $invoices=InvoiceIn::orderBy('PN_MA','desc')->get();
        return view('admin.manage.invoice_in.invoice_in',compact('invoices'));
    }

    public function create(){
        $users = User::all();
        $companies = ReleaseCompany::all();
        $books = Book::all();
        return view('admin.manage.invoice_in.create', compact('users','companies','books'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'date-in'=>'before: tomorrow',
        ],[
            'date-in.before'=>'Ngày lập không lớn hơn hôm nay !',
        ]);
        $book = $request->input('book');
        $price = $request->input('price');
        $qty = $request->input('qty');
        $data = array();
        $total = 0;

        $invoice = new InvoiceIn();
        $invoice->NV_MA=$request->input('user');
        $invoice->CTPH_MA=$request->input('company');
        $invoice->PN_NGAYNHAP=$request->input('date-in');
        $invoice->PN_GHICHU=$request->input('note');
        $invoice->save();

        if (isset($book[0])){
            for($i=0;$i<count($book);$i++){
                $data[$i]=[
                    'S_MA'=>$book[$i],
                    'PN_MA'=>$invoice->PN_MA,
                    'PNCT_SOLUONG'=>$qty[$i],
                    'PNCT_GIA'=>$price[$i]
                ];
                $total+=($data[$i]['PNCT_SOLUONG'])*($data[$i]['PNCT_GIA']);
            }

            InvoiceInDetails::insert($data);

            InvoiceIn::where('PN_MA',$invoice->PN_MA)->update(['PN_TONGTIEN'=>$total]);
            $temp = InvoiceIn::where('PN_MA',$invoice->PN_MA)->first();
            $update = $temp->book()->get(); //Lấy tập sách thuộc phiếu nhập mới tạo
            foreach ($update as $key=>$value){
                $qty_back = $value->pivot->PNCT_SOLUONG; //Lấy số lượng nhập
                $book_kind_item = $value->kind_of_book()->first(); //Lấy thể loại của sách
                $discount = $book_kind_item->LS_CHIETKHAU; //Lấy chiết khấu theo loại sách
                $price_total = ($value->pivot->PNCT_GIA)*$discount; //giá nhập * chiết khấu
                $value->S_SLTON += $qty_back; //cộng dồn số lượng
                $value->S_GIA = $price_total; //cập nhật lại giá mới
                $value->save();
            }
            return redirect('admin/invoice-in')->with('messAddDetail','Thêm hóa đơn thành công !');
        }
        else {
            return redirect('admin/invoice-in')->with('messAdd','Đã thêm hóa đơn !');
        }
    }

    public function search(Request $request){
        $search = InvoiceIn::where('PN_MA','like','%'.$request->get('q').'%')->get();
        return response()->json($search);
    }

    /*public function import($id){
        $total = 0;
        Excel::import(new InvoiceInDetailsImport, request()->file('f'));
        $temp = InvoiceIn::where('PN_MA',$id)->first();
        dd($temp->book()->get());

        InvoiceIn::where('PN_MA',$id)->update(['PN_TONGTIEN'=>$total]);

        $update = $temp->book()->get(); //Lấy tập sách thuộc phiếu nhập mới tạo
        foreach ($update as $key=>$value){
            $qty_back = $value->pivot->PNCT_SOLUONG; //Lấy số lượng nhập
            $book_kind_item = $value->kind_of_book()->first(); //Lấy thể loại của sách
            $discount = $book_kind_item->LS_CHIETKHAU; //Lấy chiết khấu theo loại sách
            $price_total = ($value->pivot->PNCT_GIA)*$discount; //giá nhập * chiết khấu
            $value->S_SLTON += $qty_back; //cộng dồn số lượng
            $value->S_GIA = $price_total; //cập nhật lại giá mới
            $value->save();
        }
    }*/
}
