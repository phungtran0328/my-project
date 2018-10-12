<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceDetails;
use App\Order;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function invoice($id){
        $order=Order::where('DH_MA',$id)->first();
        $user=Auth::user()->NV_MA;
        $customer=$order->KH_MA;
        $date=date('Y-m-d H:i:s');
//        dd($date);
        $total=$order->DH_TONGTIEN;
        $temps=$order->book()->get();
        $data=array();

        //Thêm 1 hóa đơn
        $invoice=new Invoice();
        $invoice->KH_MA=$customer;
        $invoice->NV_MA=$user;
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

        //Trừ số lượng mua vào số lượng tồn kho
        foreach ($temps as $key=>$value){
            $value->S_SLTON=$value->S_SLTON-$value->pivot->DHCT_SOLUONG;
            $value->save();
        }

        //Cập nhật lại trạng thái đơn hàng và nhân viên
        $order->DH_TTDONHANG=1;
        $order->NV_MA=$user;
        $order->save();
        return redirect()->back()->with('messInvoice','Đã lập hóa đơn cho đơn hàng !');
    }
}
