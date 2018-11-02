<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/30/2018
 * Time: 1:42 PM
 */

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Charts\RevenueChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        if (!Auth::check()){
            return view('admin.login');
        }
        $invoices=DB::table('hd_chitiet')->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as qty'),DB::raw('sum(HDCT_GIA*HDCT_SOLUONG) as total'))
            ->groupBy('S_MA')->orderBy('qty','desc')->get();
        //Lấy mảng sách (xóa trùng) gồm sách, số lượng (sum), giá (sum(sl*giá))
//        dd($invoices);
        $cate_total = array();
        $i = 0;
        foreach ($invoices as $invoice){
            $book_invoice = Book::where('S_MA',$invoice->S_MA)->first();
            $cate = $book_invoice->kind_of_book()->first();
            //Lấy mảng loại sách của tất cả các sách (chưa xóa trùng): tên loại, giá (sum lấy từ mảng $invoices)
            $cate_total[$i]= ['name'=>$cate->LS_TEN,'total'=>$invoice->total];
            $i++;
        }
//        dd($cate_total);
        //total theo loại sách
        function getSum($data) {
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
        $result = getSum($cate_total);
//        dd(array_keys($result));
        $labels = array_keys($result); //Tên cột trong biểu đồ
        $values = array_values($result); //Giá trị của biểu đồ (số hoặc tập số)

        $chart = new RevenueChart();
        $chart->labels($labels);
        $chart->dataset('RevenueCategory','bar',$values);
        $chart->dataset('abc','line',[100000,200000,300000]);

        /*$inputs = DB::table('pn_chitiet')->select('S_MA',DB::raw('sum(PNCT_SOLUONG) as qty'),DB::raw('sum(PNCT_GIA*PNCT_SOLUONG) as total'))
            ->groupBy('S_MA')->orderBy('S_MA','desc')->get();
//        dd($input);
        $qty = array();
        $j = 0;
        foreach ($inputs as $input){
            $book_input = Book::where('S_MA',$input->S_MA)->first();
            $qty[$j] = $input->qty-($book_input->S_SLTON);
            $j++;
        }*/
//        dd($qty);
        return view('admin.home', compact('chart'));
    }
}