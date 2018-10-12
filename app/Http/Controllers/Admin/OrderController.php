<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){
        $status=$request->input('status');
        if (isset($status)){
            $orders=Order::where('DH_TTDONHANG',$status)->orderBy('DH_MA','desc')->paginate(10);
        }
        else{
            $orders=Order::orderBy('DH_MA','desc')->paginate(10);
        }
        return view('admin.manage.order.order', compact('orders'));
    }

    public function complete($id){
        $order=Order::where('DH_MA',$id)->first();
        $order->DH_TTDONHANG=2;
        $order->save();
        return redirect()->back()->with('messComplete','Đã cập nhật trạng thái cho đơn hàng !');
    }
}
