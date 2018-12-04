<?php

namespace App\Http\Controllers;

use App\Book;
use App\Helper;
use App\Invoice;

class SellController extends Controller
{
    public function getTopSell(){
        /*$months = Invoice::orderBy('CREATED_AT','desc')->get()->groupBy(function ($date){
            return Carbon::parse($date->CREATED_AT)->format('m');
        });

        $subs = $months->map(function ($month){
            return collect($month->toArray())->all(); //Chuyển collection sang dạng array
        });*/

        $months = Invoice::whereMonth('CREATED_AT','=',date('m'))
            ->whereYear('CREATED_AT', '=', date('Y'))
            ->get();
        //Lấy mảng hóa đơn theo tháng, năm

        $temps_sum = new Helper();
        $data = $temps_sum->getBookDate($months);

        $totalMonth = 0;
        for ($j=0; $j<count($data);$j++){
            $totalMonth += ($data[$j]['totalPrice']);
        }
        //Lấy tổng giá của mảng

//        $totalMonth = $months->sum('HD_TONGTIEN'); //Lấy tổng tiền trong tháng, năm hiện tại
        //Tổng tiền ở đây bị dính phí vận  chuyển nên không dùng

        $dataSum =$temps_sum->getSum($data); //Cộng dồn qty, total khi trùng id sau đó bỏ loại phần tử có id trùng

        $qty = array();
        foreach ($dataSum as $key => $row)
        {
            $qty[$key] = $row['qty']; //Lấy mảng chứa qty với $key=id, $value=qty
        }

        array_multisort($qty, SORT_DESC, $dataSum); //Sắp xếp mảng giảm dần theo $qty

        return view('page.sell.sell', compact('dataSum'));
    }

    public function getTopSellKindOfBook(){
        $months = Invoice::whereMonth('CREATED_AT','=',date('m'))
            ->whereYear('CREATED_AT', '=', date('Y'))
            ->get();
        //Lấy mảng hóa đơn theo tháng, năm

        $temp = new Helper();
        $data = $temp->getBookDate($months); //Lấy mảng book
        $dataSum = $temp->getSum($data); //Cộng dồn số lượng khi mảng book trùng id

        $qty = array();
        foreach ($dataSum as $key => $row)
        {
            $qty[$key] = $row['qty']; //Lấy mảng chứa qty với $key=id, $value=qty
        }

        array_multisort($qty, SORT_DESC, $dataSum); //Sắp xếp trật tự giảm dần theo số lượng

        $book = new Book();
        $data_finish = $book->getKindOfBook($dataSum, 13); //Lọc ra sách có loại sách = mã loại sách
        // 7: manga, 13: văn học, 4: kinh tế
        return view('page.sell.kind_of_book', compact('data_finish'));
    }

    public function getTopSellEconomic(){
        $months = Invoice::whereMonth('CREATED_AT','=',date('m'))
            ->whereYear('CREATED_AT', '=', date('Y'))
            ->get();
        //Lấy mảng hóa đơn theo tháng, năm

        $temp_sum = new Helper();
        $data = $temp_sum->getBookDate($months);
        $dataSum = $temp_sum->getSum($data); //Cộng dồn số lượng

        $qty = array();
        foreach ($dataSum as $key => $row)
        {
            $qty[$key] = $row['qty']; //Lấy mảng chứa qty với $key=id, $value=qty
        }

        array_multisort($qty, SORT_DESC, $dataSum); //Sắp xếp trật tự giảm dần theo số lượng

        $book = new Book();
        $data_finish = $book->getKindOfBook($dataSum, 4); //Lọc ra sách có loại sách = mã loại sách
        // 7: manga, 13: văn học, 4: kinh tế
        return view('page.sell.kob_economic', compact('data_finish'));
    }
}
