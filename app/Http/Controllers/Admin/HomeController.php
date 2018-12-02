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
use App\InvoiceIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        if (!Auth::check()){
            return view('admin.login');
        }

        $date = intval(date('d'));
        $month = intval(date('m'));
        $year = intval(date('Y'));

        //kind-of-book
        if ($request->input('month_kob')==null){
            $month_kob = $month;
        }else{
            $month_kob = $request->input('month_kob');
        }
        if ($request->input('year_kob')==null){
            $year_kob = $year;
        }else{
            $year_kob = $request->input('year_kob');
        }

        //customer
        if ($request->input('month_customer')==null){
            $month_customer = $month;
        }else{
            $month_customer = $request->input('month_customer');
        }
        if ($request->input('year_customer')==null){
            $year_customer = $year;
        }else{
            $year_customer = $request->input('year_customer');
        }

        //book
        if ($request->input('date_book')==null){
            $date_book = $date;
        }else{
            $date_book = $request->input('date_book');
        }
        if ($request->input('month_book')==null){
            $month_book = $month;
        }else{
            $month_book = $request->input('month_book');
        }
        if ($request->input('year_book')==null){
            $year_book = $year;
        }else{
            $year_book = $request->input('year_book');
        }
        $temp_invoice = new Invoice();
        $test = $temp_invoice->getSumKindOfBook($month_kob, $year_kob); //hàm trong model Invoice
        $array_year = $temp_invoice->year();

        $cate_total = array();
        $i = 0;

        foreach ($test as $invoice){
            $book_invoice = Book::where('S_MA',$invoice->S_MA)->first();
            $cate = $book_invoice->kind_of_book()->first();
            //Lấy mảng loại sách của tất cả các sách (chưa xóa trùng - tập hóa đơn):
            // tên loại, giá (sum lấy từ mảng $invoices)
            $cate_total[$i]= ['name'=>$cate->LS_TEN,'total'=>$invoice->total];
            $i++;
        }

        $temp = new Helper();
//      Biểu đồ dùng cho doanh thu theo loại sách tháng hiện tại
        $result = $temp->getUniqueArray($cate_total);
//        dd(array_keys($result));
        $labels = array_keys($result); //Tên cột trong biểu đồ
        $values = array_values($result); //Giá trị của biểu đồ (số hoặc tập số)

        $chart = new RevenueChart();
        $chart->labels($labels);
        $chart->title('Biểu đồ doanh thu từng loại sách tháng '. $month_kob, 20, '#333333');
        $chart->barWidth(0.5);
        $chart->loaderColor('#333333');
        $chart->dataset('Loại sách','bar',$values );

        $result_invoice_month = array();
        $result_invoice_in_month = array();
        $a =0 ;
        $b = 0;
        $data = array();
        $data_invoice = array();

        for ($j=1;$j<13;$j++){
            //Lấy hóa đơn tháng 1-12 trong năm hiện tại
            $invoice_months = Invoice::whereMonth('CREATED_AT','=',$j)
                ->whereYear('CREATED_AT', '=', date('Y'))
                ->get();

            $invoice_in_months = InvoiceIn::whereMonth('CREATED_AT','=',$j)
                ->whereYear('CREATED_AT','=',date('Y'))->get();

            $result_invoice_month[$j] = $temp->getBookDateInvoice($invoice_months); //Truyền vào collection hóa đơn
            $result_invoice_in_month[$j] = $temp->getBookDateInvoiceIn($invoice_in_months);

            //Lấy hóa đơn trong từng tháng 1-12 =>key=tháng, value=total
            for ($c=0; $c<count($result_invoice_month[$j]);$c++){
                $data[$a] = ['name'=>$j, 'total'=>$result_invoice_month[$j][$c]['totalPrice']];
                $a++;
            }

            for ($c=0; $c<count($result_invoice_in_month[$j]);$c++){
                $data_invoice[$b] = ['name'=>$j, 'total'=>$result_invoice_in_month[$j][$c]['totalPrice']];
                $b++;
            }
        }

        //Biểu đồ cho doanh thu năm
        $total_month = $temp->getUniqueArray($data);
        $labels_month = array_keys($total_month);
        $values_month = array_values($total_month);

        $total_invoice_in = $temp->getUniqueArray($data_invoice);
        $values_invoice_in = array_values($total_invoice_in);

//        dd($labels_month, $values_month);
        $chart_month = new RevenueChart();
        $chart_month->labels($labels_month);
        $chart_month->title('Biểu đồ doanh thu năm '.date('Y') ,20, '#333333');
        $chart_month->barWidth(0.5);
        $chart_month->loaderColor('#333333');
        $chart_month->dataset('Doanh thu','bar',$values_month);
        $chart_month->dataset('Vốn','bar',$values_invoice_in);

        $customer = $temp_invoice->getSumCustomer($month_customer, $year_customer);
        $books = $temp_invoice->getSumBook($date_book, $month_book, $year_book);

        return view('admin.home', compact('chart','chart_month','customer','month_kob',
            'month_customer','year_customer','array_year','books','date_book','month_book','year_book'));
    }
}