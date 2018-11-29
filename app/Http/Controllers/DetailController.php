<?php

namespace App\Http\Controllers;

use App\Book;
use App\Events\ViewBookHandler;
use App\InvoiceIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class DetailController extends Controller
{
    public function getDetail($id){

        $book = Book::where('S_MA', $id)->first();
//        Event::fire(new ViewBookHandler($book));
        Event::fire('book.view',$book); //view in 30s F5
//        dd($id);
        $publisher = $book->publisher()->first();
//        dd($publisher);
        $invoice_in = $book->invoice_in()->first();
        if (isset($invoice_in)){
            $invoice_in_id = $invoice_in->PN_MA;
            $invoice_in_value = InvoiceIn::where('PN_MA',$invoice_in_id)->first();
            $company = $invoice_in_value->release_company()->first();
//            dd($company);
        }
        $authors = $book->author()->get();
        $translators=$book->translator()->get();
//        dd($author);
        $cover_type = $book->cover_type()->first();
//        dd($cover_type);
        $kind_of_book = $book->kind_of_book()->first();

        $temp_book = new Book();
        $temps = $temp_book->getBookPromotion($id);
//        dd($temps['id']);

        $images = $book->image()->get();

        return view('page.detail', compact('book','company','publisher','authors',
            'cover_type','kind_of_book','translators','temps', 'images'));
    }
}
