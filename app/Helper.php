<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/09/2018
 * Time: 4:05 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;

class Helper
{
    public function getSum(array $test) {
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

    function getUniqueArray($data) {
        $groups = array();
        foreach ($data as $item) {
            $key = $item['name'];
            if (!array_key_exists($key, $groups)) {
                //Loại bỏ giá trị trùng
                $groups[$key] = $item['total'];
            } else {
                //Cộng dồn total khi trùng name (name duyệt từ id nên không lo lỗi ký tự)
                $groups[$key]= $groups[$key] + $item['total'];
            }
        }
        return $groups;
    }

    public function getBookDate(Collection $collection){
        $i = 0;
        $data = array();
        foreach ($collection as $month){
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
        return $data;
    }

}