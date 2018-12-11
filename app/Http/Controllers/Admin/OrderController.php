<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.manage.order.order', compact('orders'));
    }

    public function complete($id)
    {
        $user = Auth::user();
        $order = Order::where('DH_MA',$id)->first();
        $temps = $order->book()->get();

        //Trừ số lượng mua vào số lượng tồn kho
        foreach ($temps as $key=>$value){
            $value->S_SLTON=$value->S_SLTON-$value->pivot->DHCT_SOLUONG;
            $value->save();
        }
        $order->DH_TTDONHANG = 2; //Trạng thái giao hàng thành công
        $order->save();
        Log::info("Nhân viên đã chuyển TTDH của ĐH ".$id." sang 'Giao hàng thành công': ".$user->NV_MA." - ".$user->NV_TEN." \r\n" );
        return redirect()->back()->with('messComplete','Đã cập nhật trạng thái cho đơn hàng !');
    }

    public function cancelOrder($id)
    {
        $order=Order::where('DH_MA',$id)->first();
        $user=Auth::user()->NV_MA;
        $order->NV_MA = $user;
        $order->DH_TTDONHANG = 4;
        $order->save();
        Log::info("Nhân viên đã hủy ĐH ".$id.": ".$user->NV_MA." - ".$user->NV_TEN." \r\n" );
        return redirect()->back();
    }
}
