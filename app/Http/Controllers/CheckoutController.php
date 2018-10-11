<?php

namespace App\Http\Controllers;

use App\Book;
use App\Customer;
use App\Order;
use App\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        return view('page.shopping.checkout');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function checkAuth(Request $request){
        $this->validate($request,
            [
                'email'=>'required|email',
                'password'=>'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Địa chỉ mail không hợp lệ',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]
        );
        $email = $request['email'];
        $password = $request['password'];

        if(Auth::guard('customer')->attempt(['KH_EMAIL' => $email, 'password' => $password])){
            //'password' bắt buộc phải là password vì nó đã được xác định sẵn
            //Nhưng vẫn có thể chỉnh sửa ở file model function getAuthPassword
            return redirect()->back();
        }
        else
        {
            return redirect()->back()->with('message','Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }

    public function registerAuth(Request $request){
        $this->validate($request,
            [
                'username' => 'required',
                'email' => 'required|email|unique:khachhang,KH_EMAIL',
                //unique: table,column_name
                'phone' => 'required|regex:/^(\84)[0-9]{9}$/',
                //regex: (đầu số 84)[dãy số từ 0-9]{gồm 9 số từ 0-9}
                'birthday' => 'required|before:2006-01-01',
                //before: ngày sinh phải trước ngày 01 tháng 01 năm 2006 (người dùng 12 tuổi)
                'address' => 'required',
            ],
            [
                'username.required' => 'Vui lòng nhập họ tên !',
                'email.required'=>'Vui lòng nhập email ! ',
                'email.email'=>'Địa chỉ mail không hợp lệ !',
                'email.unique'=>'Email đã có người sử dụng ! ',
                'address.required' => 'Vui lòng nhập địa chỉ !',
                'phone.required'=>'Vui lòng nhập số điện thoại ! ',
                'phone.regex'=>'Số điện thoại mã 84 gồm 10 số ! ',
                'birthday.required'=>'Vui lòng điền ngày sinh !',
                'birthday.before'=>'Phải lớn hơn 12 tuổi !'
            ]
        );
        $customer=new Customer();
        $customer->KH_TEN=$request['username'];
        $customer->KH_SDT=$request['phone'];
        $customer->KH_DIACHI=$request['address'];
        $customer->KH_NGAYSINH=$request['birthday'];
        $customer->KH_EMAIL=$request['email'];
        $customer->save();
        return redirect()->back();
    }

    public function check(){
        return redirect('/checkout')->with('stepThree','');
    }

    public function checkout(Request $request){
        $customer=Auth::guard('customer')->user();
        $carts=Cart::content();
//        dd(count($carts));
        $order=new Order();
        $order->KH_MA=$customer->KH_MA;
        $order->DH_NGAYDAT=date('Y-m-d H:i:s');
        $order->DH_DCGIAOHANG=$customer->KH_DIACHI;
        $order->DH_TONGTIEN=str_replace(',','',Cart::subtotal());
        $order->DH_TTDONHANG='Đang xử lí';
        $order->DH_GHICHU=$request['checkout'];
        $order->save();

        $data=array();
        foreach ($carts as $cart){
            $data[]=[
                'DH_MA'=>$order->DH_MA,
                'S_MA'=>$cart->id,
                'DHCT_SOLUONG'=>$cart->qty,
                'DHCT_GIA'=>$cart->price
            ];
        }
        OrderDetails::insert($data);
        Cart::destroy();
        return redirect()->back()->with('messCheck','Bạn đã đặt hàng thành công !');
    }
}
