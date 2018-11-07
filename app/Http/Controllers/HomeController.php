<?php

namespace App\Http\Controllers;

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
        $sliders = Slider::all();
        $books = Book::all();
        $invoiceIns=InvoiceIn::orderBy('PN_NGAYNHAP','desc')->take(3)->get();

        $invoices=DB::table('hd_chitiet')->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as total'))
            ->groupBy('S_MA')->orderBy('total','desc')->take(4)->get();

        /*$cate_data = array();
        foreach ($invoices as $index=>$invoice){
            $book_invoice = Book::where('S_MA',$invoice->S_MA)->first();
            $cate = $book_invoice->kind_of_book()->first();
            $cate_data[$index] = $cate->LS_TEN;
        }*/
//        dd(array_unique($cate_data));
//        dd($cate_data);
//        dd($invoices);
//        $i=0;


//        foreach ($invoiceIns as $key=>$value){
//            $temp=InvoiceIn::where('PN_MA',$value->PN_MA)->first();
//            $book_item[$key]=$temp->book()->get();
//            //Mảng trong mảng
////            $i+=count($book_item);
////            echo $invoiceIn->PN_MA;
//        }
        $i =0;
        $temp_results = array();
        foreach ($invoiceIns as $value){
            $temp=InvoiceIn::where('PN_MA',$value->PN_MA)->first();
            $book_item=$temp->book()->get();
            foreach ($book_item as $item){
                $temp_results[$i] = $item->S_MA;
                $i++;
            }
        }
        $results = array_unique($temp_results);
//        dd(($results));
//        dd(($book_item));
//        dd($invoiceIns[1]->PN_MA);
        return view('page.home', compact('categories', 'sliders','books','results','invoices'));
    }

    public function searchName(Request $request){
        $books = Book::where('S_TEN','like', '%'. $request->get('q'). '%')->get();
        return response()->json($books);
    }

    public function search(Request $request){
        $books = Book::where('S_TEN','like', '%'. $request->get('q'). '%')->get();
        return view('page.search', compact('books'));
    }
}
