<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){
        $customers=Customer::orderBy('KH_MA','desc')->paginate(10);
        return view('admin.manage.customer.customer', compact('customers'));
    }

    public function delete($id){
        $customer = Customer::where('KH_MA',$id)->first();
        $order = $customer->order()->first();
        if (isset($order)){
            return redirect()->back()->with('messRemoveError','Không thể xóa vì khách hàng ID: '.$id.' có đặt hàng !');
        }else{
            Customer::destroy($id);
            return redirect()->back()->with('messageRemove','Đã xóa khách hàng có ID: '.$id.' !');
        }
    }
}
