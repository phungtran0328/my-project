<?php

namespace App\Http\Controllers;

use App\Author;
use App\Helper;
use App\Invoice;
use App\InvoiceDetails;
use App\InvoiceIn;
use App\KindOfBook;
use App\Slider;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        $categories = KindOfBook::all();
        $sliders = Slider::orderBy('id','desc')->take(3)->get();
        $books = Book::all();
//        $invoiceIns = InvoiceIn::orderBy('PN_NGAYNHAP','desc')->get();
        $temp_news = Book::select('S_MA')
                    ->where('S_SLTON','>',0)
                    ->orderBy('S_NGAYXB','desc')
                    ->take(6)
                    ->get();
        $temp_views = Book::select('S_MA')
                    ->whereNotIn('S_MA',$temp_news)
                    ->where('S_SLTON','>',0)
                    ->orderBy('S_LUOTXEM','desc')
                    ->take(6)
                    ->get();
//        $temp = new Invoice();
        $temp_invoices = DB::table('hd_chitiet')
                    ->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as total'))
                    ->whereNotIn('S_MA',$temp_news)
                    ->whereNotIn('S_MA',$temp_views)
                    ->groupBy('S_MA')
                    ->orderBy('total','desc')
                    ->take(6)
                    ->get();

        $news = $temp_news->toArray();
        $views = $temp_views->toArray();
        $invoices = $temp_invoices->toArray();
        /*$i =0;
        $temp_results = array();
        foreach ($invoiceIns as $value){
            $book_item = $value->book()->get();
            foreach ($book_item as $item){
                $temp_results[$i] = $item->S_MA;
                $i++;
            }
        }
        $results = array_unique($temp_results);*/

        return view('page.home', compact('categories', 'sliders','views','news','invoices'));
    }

    public function searchName(Request $request){
        $books = Book::where('S_TEN','like', '%'. $request->get('q'). '%')->get();
        return response()->json($books);
    }

    public function search(Request $request){
        $q = $request->get('q');
        $books = Book::where('S_TEN','like', '%'. $q. '%')->paginate(6);
        $count = Book::where('S_TEN','like', '%'. $q. '%')->count();
        return view('page.search.search', compact('books','q','count'));
    }
}
