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
        $category = $categories->where('LS_MA',$id)->first();
        $category_book = $category->book()->get();
//        dd($category);
        return view('page.category', compact('category','category_book'));
    }
}
