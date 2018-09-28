<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function getDetail($id){

        $book = Book::where('S_MA', $id)->first();
//        dd($id);
        $publisher = $book->publisher()->first();
//        dd($publisher);
        $authors = $book->author()->get();
        $translators=$book->translator()->get();
//        dd($author);
        $cover_type = $book->cover_type()->first();
//        dd($cover_type);
        $kind_of_book = $book->kind_of_book()->first();
        $images = $book->image()->get();

        return view('page.detail', compact('book','publisher','authors',
            'cover_type','kind_of_book','images','translators'));
    }
}
