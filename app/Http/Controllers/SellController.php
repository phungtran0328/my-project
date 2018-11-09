<?php

namespace App\Http\Controllers;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function getTopSell(){
        /*$months = Invoice::orderBy('CREATED_AT','desc')->get()->groupBy(function ($date){
            return Carbon::parse($date->CREATED_AT)->format('m');
        });

        $subs = $months->map(function ($month){
            return collect($month->toArray())->all(); //Chuyển collection sang dạng array
        });*/
        $data = array();
        $i = 0;
        $months = Invoice::whereMonth('CREATED_AT','=',date('m'))
            ->whereYear('CREATED_AT', '=', date('Y'))
            ->get();
        //Lấy mảng hóa đơn theo tháng, năm

        foreach ($months as $month){
            $temps = $month->book()->get();
            foreach ($temps as $temp){
                //Lấy mảng chứa id, qty, totalPrice => trùng do sách có thể ở nhiều hóa đơn
                $data[$i] = [
                    'id'=>$temp->S_MA,
                    'qty'=>$temp->pivot->HDCT_SOLUONG,
                    'totalPrice'=>$temp->pivot->HDCT_SOLUONG*$temp->pivot->HDCT_GIA
                ];
                $i++;
            }
        }

        $totalMonth = 0;
        for ($j=0; $j<count($data);$j++){
            $totalMonth += ($data[$j]['totalPrice']);
        }
        //Lấy tổng giá của mảng
//        dd($totalMonth);

        function getSum($test) {
            $groups = array();
            foreach ($test as $item) {
                $key = $item['id'];
                if (!array_key_exists($key, $groups)) {
                    //Loại bỏ giá trị trùng
                    $groups[$key] = [
                        'id'=>$item['id'],
                        'qty'=>$item['qty'],
                        'total'=>$item['totalPrice']
                    ];
                } else {
                    //Cộng dồn total, qty khi trùng id
                    $groups[$key]= [
                        'id'=>$item['id'],
                        'qty'=>$groups[$key]['qty'] + $item['qty'],
                        'total'=>$groups[$key]['total'] + $item['totalPrice']
                    ];
                }
            }
            return $groups;
        }

//        $totalMonth = $months->sum('HD_TONGTIEN'); //Lấy tổng tiền trong tháng, năm hiện tại
        //Tổng tiền ở đây bị dính phí vận  chuyển nên không dùng

        $dataSum = getSum($data); //Cộng dồn qty, total khi trùng id sau đó bỏ loại phần tử có id trùng
//        dd($dataSum);
        $qty = array();
        foreach ($dataSum as $key => $row)
        {
            $qty[$key] = $row['qty']; //Lấy mảng chứa qty với $key=id, $value=qty
        }
//        dd($qty);

        array_multisort($qty, SORT_DESC, $dataSum); //Sắp xếp mảng giảm dần theo $qty
//        dd($dataSum);

        return view('page.sell.sell', compact('dataSum'));
    }
}
