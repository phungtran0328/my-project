<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        if (isset($status)){
            $orders = Order::where('DH_TTDONHANG',$status)->orderBy('DH_MA','desc')->paginate(10);
        }
        else{
            $orders = Order::orderBy('DH_MA','desc')->paginate(10);
        }
//        $orders=Order::orderBy('DH_MA','desc')->paginate(10);
        return view('admin.manage.order.order', compact('orders','status'));
    }

    public function complete($id)
    {
        $order=Order::where('DH_MA',$id)->first();
        $temps=$order->book()->get();

        //Trừ số lượng mua vào số lượng tồn kho
        foreach ($temps as $key=>$value){
            $value->S_SLTON=$value->S_SLTON-$value->pivot->DHCT_SOLUONG;
            $value->save();
        }
        $order->DH_TTDONHANG=2; //Trạng thái giao hàng thành công
        $order->save();
        return redirect()->back()->with('messComplete','Đã cập nhật trạng thái cho đơn hàng !');
    }

    public function cancelOrder($id)
    {
        $order=Order::where('DH_MA',$id)->first();
        $user=Auth::user()->NV_MA;
        $order->NV_MA = $user;
        $order->DH_TTDONHANG = 4;
        $order->save();
        return redirect()->back();
    }
}
