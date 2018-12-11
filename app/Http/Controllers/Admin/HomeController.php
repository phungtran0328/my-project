<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/30/2018
 * Time: 1:42 PM
 */

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\Charts\RevenueChart;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceIn;
use App\User;
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
        $month_kob = ($request->input('month_kob'))!= null ? $request->input('month_kob') : $month;
        $year_kob = ($request->input('year_kob')) !=null ? $request->input('year_kob') : $year;

        //customer
        $month_customer = ($request->input('month_customer'))!=null ? $request->input('month_customer') : $month;
        $year_customer = ($request->input('year_customer'))!= null ? $request->input('year_customer') : $year;

        //book
        $date_book = ($request->input('date_book')) != null ? $request->input('date_book') : $date;
        $month_book = ($request->input('month_book')) != null ? $request->input('month_book') : $month;
        $year_book = ($request->input('year_book')) !=null ? $request->input('year_book') : $year;

        //revenue
        $year_revenue = ($request->input('year_revenue')) !=null ? $request->input('year_revenue') : $year;

        $temp_invoice = new Invoice();
        $temp_invoice_in = new InvoiceIn();
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
        $labels = array_keys($result); //Tên cột trong biểu đồ
        $values = array_values($result); //Giá trị của biểu đồ (số hoặc tập số)

        $chart = new RevenueChart();
        $chart->labels($labels);
        $chart->title('Biểu đồ doanh thu từng loại sách tháng '. $month_kob . ' năm '. $year_kob, 20, '#666666');
        $chart->barWidth(0.5);
        $chart->dataset('Loại sách','bar',$values)->options([
            'backgroundColor' => '#38a47b'
        ]);

        $result_invoice_month = array();
        $result_invoice_in_month= array();

        for ($j=1;$j<13;$j++){
            $invoice_month = $temp_invoice->getSumKindOfBook($j, $year_revenue); //lấy group sách theo tháng, năm
            $invoice_in_month = $temp_invoice_in->getSumBook($j, $year_revenue);
            $total = 0;
            $total_invoice_in = 0;
            foreach ($invoice_month as $item){
                $total += $item->total;
            }
            foreach ($invoice_in_month as $item){
                $total_invoice_in +=$item->total;
            }
            $result_invoice_month[$j] = ['name'=>$j, 'total'=>$total];
            $result_invoice_in_month[$j] = ['name'=>$j, 'total'=>$total_invoice_in];
        }

        //Biểu đồ cho doanh thu năm
        $total_month = $temp->getUniqueArray($result_invoice_month);
        $labels_month = array_keys($total_month);
        $values_month = array_values($total_month);

        $invoice_in_total = $temp->getUniqueArray($result_invoice_in_month);
        $values_invoice_in = array_values($invoice_in_total);

        $profit = array();
        for ($v=0;$v<count($invoice_in_total);$v++){
            $profit[$v]=$values_month[$v] - $values_invoice_in[$v];
        }

        $chart_month = new RevenueChart();
        $chart_month->labels($labels_month);
        $chart_month->title('Biểu đồ doanh thu năm '.$year_revenue , 20, '#333333');
        $chart_month->dataset('Doanh thu','bar',$values_month)->options([
            'color' => '#ff0000',
            'backgroundColor' => '#270075',
        ]);
        $chart_month->dataset('Vốn','bar',$values_invoice_in)->options([
            'backgroundColor' => '#278cc0',
        ]);

        $customer = $temp_invoice->getSumCustomer($month_customer, $year_customer);
        $books = $temp_invoice->getSumBook($date_book, $month_book, $year_book);

        return view('admin.home', compact('chart','chart_month','customer','month_kob', 'year_kob',
            'month_customer','year_customer','array_year','books','date_book','month_book',
            'year_book', 'year_revenue'));
    }

    public function search(Request $request){
        $search = $request->input('q');
        $books = Book::where('S_TEN','like','%'.$search.'%')->get();
        $authors = Author::where('TG_TEN','like','%'.$search.'%')->get();
        $invoices = Invoice::where('HD_MA','like','%'.$search.'%')->get();
        $invoices_in = InvoiceIn::where('PN_MA','like','%'.$search.'%')->get();
        $employees = User::where('NV_TEN','like','%'.$search.'%')->get();
        return view('admin.search', compact('books','authors','invoices','invoices_in','employees'
        ,'search'));
    }
}