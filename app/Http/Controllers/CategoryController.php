<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KindOfBook;
use App\Book;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($id){
        $categories = KindOfBook::all();
        $category_book = Book::where('LS_MA',$id)->get();

        return view('page.category', compact('categories','category_book'));
    }
}
