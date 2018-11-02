<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/30/2018
 * Time: 1:42 PM
 */

namespace App\Http\Controllers\Admin;

use App\Book;
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
//        dd($invoices);
        $cate_total = array();
        $i = 0;
        foreach ($invoices as $invoice){
            $book_invoice = Book::where('S_MA',$invoice->S_MA)->first();
            $cate = $book_invoice->kind_of_book()->first();

            $cate_total[$i]= ['id'=>$cate->LS_MA,'total'=>$invoice->total];
            $i++;
        }
//        dd($cate_total);

        function getSum($data) {
            $groups = array();
            foreach ($data as $item) {
                $key = $item['id'];
                if (!array_key_exists($key, $groups)) {
                    //Loại bỏ giá trị trùng
                    $groups[$key] = array(
                        'id' => $item['id'],
                        'total' => $item['total'],
                    );
                } else {
                    //Cộng dồn total khi trùng id
                    $groups[$key]['total'] = $groups[$key]['total'] + $item['total'];
                }
            }
            return $groups;
        }
        $result = getSum($cate_total);
//        dd($result);
        $inputs = DB::table('pn_chitiet')->select('S_MA',DB::raw('sum(PNCT_SOLUONG) as qty'),DB::raw('sum(PNCT_GIA*PNCT_SOLUONG) as total'))
            ->groupBy('S_MA')->orderBy('S_MA','desc')->get();
//        dd($input);
        $qty = array();
        $j = 0;
        foreach ($inputs as $input){
            $book_input = Book::where('S_MA',$input->S_MA)->first();
            $qty[$j] = $input->qty-($book_input->S_SLTON);
            $j++;
        }
        dd($qty);
        return view('admin.home');
    }
}