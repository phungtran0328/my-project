<?php

namespace App\Http\Controllers;

use App\Author;
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
        foreach ($category_book as $key=>$value){
            $book = Book::where('S_MA',$value->S_MA)->first();
            $temp_authors[]= $book->author()->get();
            $translator[] = $book->translator()->get();
        }
        /*for ($i=0;$i<count($temp_authors);$i++){
            if ($temp_authors[$i]!==null){
                $authors = $temp_authors[$i];
            }

        }
        dd($authors);*/


//        dd($category);
        return view('page.category', compact('category','category_book'));
    }
}
