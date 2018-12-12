<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceDetails;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::all();
        return view('admin.manage.invoice.invoice', compact('invoices'));
    }

    public function invoice($id){
        $order = Order::where('DH_MA',$id)->first();
        $user = Auth::user();
        $customer = $order->KH_MA;
        $date = date('Y-m-d H:i:s');
//        dd($date);
        $total = $order->DH_TONGTIEN;
        $temps = $order->book()->get();
        $data = array();

        //Thêm 1 hóa đơn
        $invoice = new Invoice();
        $invoice->KH_MA = $customer;
        $invoice->NV_MA = $user->NV_MA;
        $invoice->HD_NGAYLAP=$date;
        $invoice->HD_TONGTIEN=$total;
        $invoice->save();

        //Lưu mảng chứa giá trị hóa đơn chi tiết
        for($i=0;$i<count($temps);$i++){
            $data[$i]=[
                'S_MA'=>$temps[$i]->S_MA,
                'HD_MA'=>$invoice->HD_MA,
                'HDCT_SOLUONG'=>$temps[$i]->pivot->DHCT_SOLUONG,
                'HDCT_GIA'=>$temps[$i]->pivot->DHCT_GIA
            ];
        }
        //lưu vào table hd_chitiet
        InvoiceDetails::insert($data);

        //Cập nhật lại trạng thái đơn hàng và nhân viên
        $order->DH_TTDONHANG = 1; // Trạng thái đang vận chuyển
        $order->NV_MA = $user->NV_MA;
        $order->save();
        Log::info("Nhân viên đã lập hóa đơn cho ĐH ".$id.": ".$user->NV_MA." - ".$user->NV_TEN." \r\n" );
        $temp_customer = Customer::where('KH_MA',$order->KH_MA)->first();
        $mail = $temp_customer->KH_EMAIL;
        $mailable = new SendMail($mail,$id);
        Mail::to($mail)->send($mailable);
        return redirect()->back()->with('messInvoice','Đã lập hóa đơn cho đơn hàng !');
    }
}
