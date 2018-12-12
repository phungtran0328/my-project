<?php

namespace App\Mail;

use App\Customer;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $customer, $order;

    /**
     * Create a new message instance.
     *
     * @param $customer
     * @param $order
     */
    public function __construct($customer, $order)
    {
        $this->customer = $customer;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $temp_customer = Customer::where('KH_EMAIL',$this->customer)->first();
        $temp_order = Order::where('DH_MA',$this->order)->first();
        $total = $temp_order->DH_TONGTIEN;
        $temp = $temp_order->book()->get();
        $i = 0;
        $data = array();
        $sum = 0;
        foreach ($temp as $value){
            $temp_sale = $value->S_GIA-$value->pivot->DHCT_GIA;
            $sum += $value->pivot->DHCT_SOLUONG*$value->pivot->DHCT_GIA;
            $data[$i] = [
                'name'=>$value->S_TEN,
                'qty'=>$value->pivot->DHCT_SOLUONG,
                'price'=>$value->pivot->DHCT_GIA,
                'sale'=>($temp_sale>0) ? $temp_sale : 0,
                'plus'=>$value->pivot->DHCT_SOLUONG*$value->pivot->DHCT_GIA
            ];
            $i++;
        }
        $ship = ($total-$sum > 17000) ? 18000: 0;
        return $this->view('admin.manage.order.order-mail', compact('data','temp_customer','temp_order', 'total', 'sum', 'ship'));
    }
}
