<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/09/2018
 * Time: 4:05 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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

    public function getBookDateInvoice(Collection $collection){
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

    public function getBookDateInvoiceIn(Collection $collection){
        $i = 0;
        $data = array();
        foreach ($collection as $month){
            $temps = $month->book()->get();
            foreach ($temps as $temp){
                //Lấy mảng chứa id, qty, totalPrice => trùng do sách có thể ở nhiều phiếu nhập
                $data[$i] = [
                    'id'=>$temp->S_MA,
                    'qty'=>$temp->pivot->PNCT_SOLUONG,
                    'totalPrice'=>$temp->pivot->PNCT_SOLUONG*$temp->pivot->PNCT_GIA
                ];
                $i++;
            }
        }
        return $data;
    }

    public function getCustomerDate(Collection $collection){
        $i=0;
        $data = array();
        foreach ($collection as $item){
            $temp = $item->customer()->first();
            $data[$i] = [
                'id'=>$temp->KH_MA,
                'name'=>$temp->KH_TEN,
                'address'=>$temp->fulladdress,
                'phone'=>$temp->KH_SDT,

            ];
            $i++;
        }
        return $data;
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}