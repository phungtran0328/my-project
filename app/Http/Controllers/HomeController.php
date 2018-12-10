<?php

namespace App\Http\Controllers;

use App\Author;
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
        $invoiceIns=InvoiceIn::orderBy('PN_NGAYNHAP','desc')->take(6)->get();
//        $temp = new Invoice();
        $invoices=DB::table('hd_chitiet')->select('S_MA',DB::raw('sum(HDCT_SOLUONG) as total'))
            ->groupBy('S_MA')->orderBy('total','desc')->take(6)->get();
        /*$month = intval(date('m', strtotime('-1 month')));
        $invoices = $temp->getSumKindOfBook($month,intval(date('Y')));*/

        $i =0;
        $temp_results = array();
        foreach ($invoiceIns as $value){
            $book_item=$value->book()->get();
            foreach ($book_item as $item){
                $temp_results[$i] = $item->S_MA;
                $i++;
            }
        }
        $results = array_unique($temp_results);

        return view('page.home', compact('categories', 'sliders','books','results','invoices'));
    }

    public function searchName(Request $request){
        $books = Book::where('S_TEN','like', '%'. $request->get('q'). '%')->get();
        return response()->json($books);
    }

    public function search(Request $request){
        $search = $request->get('q');
        $books = Book::where('S_TEN','like', '%'. $search. '%')->get();
        return view('page.search.search', compact('books','search'));
    }
}
