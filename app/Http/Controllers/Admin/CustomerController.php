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
        Customer::destroy($id);
        return redirect('admin/customer')->with('messageRemove','Xóa thành công !');
    }
}
