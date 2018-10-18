<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceDetails;
use App\InvoiceIn;
use App\KindOfBook;
use App\Slider;
use App\Book;
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
            ->groupBy('S_MA')->orderBy('HDCT_SOLUONG','desc')->take(4)->get();

//        dd($invoices);
//        $i=0;
        foreach ($invoiceIns as $key=>$value){
            $temp=InvoiceIn::where('PN_MA',$value->PN_MA)->first();
            $book_item[$key]=$temp->book()->get();
            //Mảng trong mảng
//            $i+=count($book_item);
//            echo $invoiceIn->PN_MA;
        }
//        dd(count($book_item));
//        dd($invoiceIns[1]->PN_MA);
        return view('page.home', compact('categories', 'sliders','books','book_item','invoices'));
    }
}
