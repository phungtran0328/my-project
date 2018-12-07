<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetails;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditController extends Controller
{
    public function showEditForm(){
        $city=new Customer();
        $cities=$city->getCity();
//        sort($cities);
        $keys=array_keys($cities);
        $values=array_values($cities);
        return view('page.customer.edit', compact('keys','values'));
    }
    public function edit(Request $request){
        $date = date('Y-m-d', strtotime('-12 years'));
        $this->validate($request,[
            'username'=>'required',
            'phone'=>'required|regex:/(0)[0-9]{9}$/',
            //điện thoại gồm mã 84 (0) và 9 số
            'birthday' => 'required|before:'.$date,
            'address' => 'required',
        ],
        [
            'username.required' => 'Vui lòng nhập họ tên !',
            'address.required' => 'Vui lòng nhập địa chỉ !',
            'phone.required'=>'Vui lòng nhập số điện thoại ! ',
            'phone.regex'=>'Số điện thoại không hợp lệ ! ',
            'birthday.required'=>'Vui lòng điền ngày sinh !',
            'birthday.before'=>'Phải lớn hơn 12 tuổi !',
        ]);

        $customer= Auth::guard('customer')->user();
        $customer->KH_TEN=$request->username;
        $customer->KH_GIOITINH=$request->gender;
        $customer->KH_SDT=$request->phone;
        $customer->KH_DIACHI=$request->address;
        $customer->KH_DIACHI2=$request->city;
        $customer->KH_NGAYSINH=$request->birthday;
        $customer->save();
        return redirect()->back()->with('message','Cập nhật thông tin thành công !');
    }

    public function showChangePass(){
        return view('page.customer.changePass');
    }

    public function changePass(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|max:32|confirmed',
        ],
            [
                'old_password.required' => 'Vui lòng nhập mật khẩu !',
                'password.required' => 'Vui lòng nhập mật khẩu mới!',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự ! ',
                'password.max'=>'Mật khẩu dài tối đa 32 ký tự ! ',
                'password.confirmed'=>'Xác nhận mật khẩu không đúng. Vui lòng nhập lại !',
            ]);

        $customer= Auth::guard('customer')->user();

        $curr_pw=$request->old_password;
        //Lấy mật khẩu cũ: 123456789

        $pw=$request->password;
        //Lấy mật khẩu mới nhập vào: 123456789

        $hashed=$customer->KH_MATKHAU;
        //Lấy mã hash mật khẩu khách hàng trong database

        if(Hash::check($curr_pw,$hashed)==true){
            //Kiểm tra mật khẩu cũ nhập vào (chuỗi) và mã hash (hàm băm) mật khẩu trong database
            //Hash::check($input, $hashed)
            //Hash::check()==true => mật khẩu cũ đúng, lưu mật khẩu mới vào database
            $customer->KH_MATKHAU=Hash::make($pw);
            $customer->save();
            return redirect()->back()->with('message','Thay đổi mật khẩu thành công !');
        }
        else {
            //Hash::check() == false => mật khẩu cũ sai, thông báo lỗi
            return redirect()->back()->with('pass_error','Mật khẩu cũ không đúng !');
        }
    }

    public function showOrder($id){
        $orders=Order::where('KH_MA',$id)->get();
        return view('page.customer.order',compact('orders'));
    }

    public function deleteOrder($id){
        $order = Order::where('DH_MA',$id)->first();
        $order->DH_TTDONHANG = 3;
        $order->save();
        return redirect()->back();
    }

    public function showOrderDetail($id){
        $order = Order::where('DH_MA', $id)->first();
        $books = $order->book()->get();
        $customer = $order->customer()->first();
        $total = 0;
        foreach ($books as $book){
            $total += $book->pivot->DHCT_SOLUONG*$book->pivot->DHCT_GIA;
        }
        $shipping = $order->DH_TONGTIEN - $total;
        $order_id = $id;
        switch ($order->DH_TTDONHANG){
            case 0:
                $status = 'Đang xử lí';
                break;
            case 1:
                $status = 'Đang vận chuyển';
                break;
            case 2:
                $status = 'Giao hàng thành công';
                break;
            case 3:
                $status = 'Đang chờ xử lí hủy đơn hàng';
                break;
            case 4:
                $status = 'Đã hủy';
                break;
        }
        $order_checkout = $order->DH_GHICHU;
        $order_created = $order->CREATED_AT;
        return view('page.customer.orderDetail', compact('books','shipping','total', 'order_id', 'status',
            'order_created','customer','order_checkout'));
    }
}
