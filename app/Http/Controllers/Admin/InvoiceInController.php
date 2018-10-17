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
        $invoices=InvoiceIn::orderBy('PN_MA','desc')->paginate(5);
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
        //sl tồn += sl nhập ---cộng dồn sl
        //Giá = (sl tồn/tổng số)*(giá cũ*sl tồn)+(sl nhập/tổng sổ)*(giá mới*sl nhập)
        foreach ($update as $key=>$value){
            $qty_front=$value->S_SLTON; //Lấy số lượng còn tồn lại
            $price_front=$value->S_GIA; //Lấy giá của số lượng tồn (đã *1.4)
            $qty_back=$value->pivot->PNCT_SOLUONG; //Lấy số lượng nhập
            $price_back=$value->pivot->PNCT_GIA; //Lấy giá nhập (chưa *1.4)

            $qty_total=$qty_front+$qty_back; //Lấy tổng số lượng (nhập + đã có)

            $round_front=round($qty_front/$qty_total,2); //Lấy phần trăm sl tồn/tống số lượng
            $price_total_front=$round_front*$price_front;  // (sl tồn/tổng số)*giá
            $price_total_back=(1-$round_front)*$price_back*1.4; // (sl nhập/tổng số)*giá nhập*1.4
            $price_total_sum= $price_total_back+$price_total_front;


            $value->S_SLTON = $qty_total;
            $value->S_GIA = $price_total_sum;
            $value->save();
        }
        return redirect('admin/invoice-in')->with('messAddDetail','Thêm hóa đơn chi tiết thành công !');
    }
}
