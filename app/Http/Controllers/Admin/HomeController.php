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
use App\Helper;
use App\Http\Controllers\Controller;
use App\Invoice;
use Carbon\Carbon;
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
        $temp = new Helper();


        $result_month = array();
        $a = 0;
        $data = array();
        for ($j=1;$j<13;$j++){
            $months = Invoice::whereMonth('CREATED_AT','=',$j)
                ->whereYear('CREATED_AT', '=', date('Y'))
                ->get();
            $result_month[$j] = $temp->getBookDate($months);
            for ($c=0; $c<count($result_month[$j]);$c++){
                $data[$a] = ['name'=>$j, 'total'=>$result_month[$j][$c]['totalPrice']];
                $a++;
            }
        }
        $total_month = $temp->getUniqueArray($data);
        $labels_month = array_keys($total_month);
        $values_month = array_values($total_month);
//        dd($labels_month, $values_month);
        $chart_month = new RevenueChart();
        $chart_month->labels($labels_month);
        $chart_month->dataset('Doanh thu năm','bar',$values_month);

        $year = Invoice::whereYear('CREATED_AT', '=', date('Y'))
            ->get();
//        dd($months);


        $result = $temp->getUniqueArray($cate_total);
//        dd(array_keys($result));
        $labels = array_keys($result); //Tên cột trong biểu đồ
        $values = array_values($result); //Giá trị của biểu đồ (số hoặc tập số)

        $chart = new RevenueChart();
        $chart->labels($labels);
        $chart->title('Biểu đồ doanh thu theo từng loại sách ',20, '#333333');
        $chart->barWidth(0.5);
        $chart->loaderColor('#333333');
        $chart->dataset('RevenueCategory','bar',$values );
//        $chart->dataset('abc','line',[100000,200000,300000]);


        return view('admin.home', compact('chart','chart_month'));
    }
}