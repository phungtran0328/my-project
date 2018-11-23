<?php

namespace App\Http\Controllers;

use App\Book;
use App\Customer;
use App\Order;
use App\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Exception;

class CheckoutController extends Controller
{
    public function index(){
        $city=new Customer();
        $cities=$city->getCity();
        $keys=array_keys($cities);
        $values=array_values($cities);
        return view('page.shopping.checkout', compact('keys','values'));
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
                'email' => 'unique:khachhang,KH_EMAIL',
                //unique: table,column_name
                'phone' => 'regex:/(0)[0-9]{9}$/',
                //regex: (đầu số 84)[dãy số từ 0-9]{gồm 9 số từ 0-9}
                'birthday' => 'before:2006-01-01',
                //before: ngày sinh phải trước ngày 01 tháng 01 năm 2006 (người dùng 12 tuổi)
            ],
            [
                'email.unique'=>'Email đã có người sử dụng ! ',
                'phone.regex'=>'Số điện thoại không hợp lệ ! ',
                'birthday.before'=>'Phải lớn hơn 12 tuổi !'
            ]
        );

        $carts=Cart::content();
        //Thêm người dùng vào database
        $customer=new Customer();
        $customer->KH_TEN=$request['username'];
        $customer->KH_SDT=$request['phone'];
        $customer->KH_DIACHI=$request['address'];
        $customer->KH_DIACHI2=$request['city'];
        $customer->KH_NGAYSINH=$request['birthday'];
        $customer->KH_EMAIL=$request['email'];
        $customer->save();
        //Thêm đơn hàng
        if ($customer->KH_DIACHI2=='CT'){
            $total=str_replace(',','',Cart::subtotal());
        }
        else{
            $total=str_replace(',','',Cart::subtotal())+18000;
        }

        $order=new Order();
        $order->KH_MA=$customer->KH_MA;
        $order->DH_DCGIAOHANG=$customer->KH_DIACHI;
        $order->DH_NGAYDAT=date('Y-m-d H:i:s');
        $order->DH_TONGTIEN=$total;
        $order->DH_TTDONHANG=0;
        $order->DH_GHICHU=$request['checkout'];
        $order->save();
        //Chuẩn bị dữ liệu để thêm vào DH_CHITIET
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

        //Trừ số lượng mua vào số lượng tồn kho
        /*$getOrder=Order::where('DH_MA',$order->DH_MA)->first();
        $update=$getOrder->book()->get();
//        dd($update);
        foreach ($update as $key=>$value){
            $value->S_SLTON=$value->S_SLTON-$value->pivot->DHCT_SOLUONG;
            $value->save();
        }*/
        Cart::destroy();
        return redirect()->back()->with('messCheck','Bạn đã đặt hàng thành công !');
    }

    public function check(){
        return redirect('/checkout')->with('stepThree','');
    }

    public function checkout(Request $request){
        $carts=Cart::content();
        $user=Auth::guard('customer')->user();
        $city=$user->KH_DIACHI2;

        $order=new Order();
        $order->KH_MA=$user->KH_MA;
        $order->DH_DCGIAOHANG=$user->full_address;
        $order->DH_NGAYDAT=date('Y-m-d H:i:s');
        if ($city=='CT'){
            $order->DH_TONGTIEN=str_replace(',','',Cart::subtotal());
        }else{
            $order->DH_TONGTIEN=str_replace(',','',Cart::subtotal())+18000;
        }
        $order->DH_TTDONHANG=0;
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
        /*$getOrder=Order::where('DH_MA',$order->DH_MA)->first();
        $update=$getOrder->book()->get();
//        dd($update);
        foreach ($update as $key=>$value){
            $value->S_SLTON=$value->S_SLTON-$value->pivot->DHCT_SOLUONG;
            $value->save();
        }*/
        Cart::destroy();
        return redirect()->back()->with('messCheck','Bạn đã đặt hàng thành công !');
    }
}
