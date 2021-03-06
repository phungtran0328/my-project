<?php

namespace App\Http\Controllers;

use App\Author;
use App\Helper;
use Illuminate\Http\Request;
use App\KindOfBook;
use App\Book;

class CategoryController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($id){
        $categories = KindOfBook::all();
        $category = $categories->where('LS_MA',$id)->first();
        $category_book = $category->book()->get(); //lấy authors và translator liên tiếp không bị phân ra khi phân trang
        $category_paginate = $category->book()->paginate(8); //phân trang
        $temp_authors = array();
        $temp_translator = array();
        foreach ($category_book as $key=>$value) {
            $book = Book::where('S_MA', $value->S_MA)->first();
            if (!is_null($book->author()->first())){
                foreach ($book->author()->get() as $index => $item) {
                    $temp_authors[$key] = ['id' => $item->TG_MA, 'name' => $item->TG_TEN];
                }
            }
            if (!is_null($book->translator()->first())){
                foreach ($book->translator()->get() as $index => $item) {
                    $temp_translator[$key] = ['id' => $item->TG_MA, 'name' => $item->TG_TEN, 'trans'=>$item->pivot->DICHGIA];
                }
            }
        }
        function unique_multidim_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach($array as $val) {
                if (!in_array($val[$key], $key_array)) {
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
            return $temp_array;
        }

        $authors = unique_multidim_array($temp_authors,'id');
        $translators = unique_multidim_array($temp_translator,'id');

        return view('page.category.category', compact('category','category_book', 'category_paginate', 'authors', 'translators'));
    }


    public function authorCategory($id){
        $author = Author::where('TG_MA', $id)->first();
        $temp_books = $author->book()->paginate(12);
        $temp_trans_book = $author->translate_book()->paginate(12);

        $books=array();
        $temp = new Book();
        if (!is_null($temp_books)){
            for ($i=0;$i<count($temp_books);$i++){
                $books[$i] = $temp->getBookPromotion($temp_books[$i]->S_MA);
            }
        }
        if (!is_null($temp_trans_book)){
            for ($i = 0; $i < count($temp_trans_book); $i++) {
                $books[$i] = $temp->getBookPromotion($temp_trans_book[$i]->S_MA);
            }
        }

        return view('page.category.author', compact('books', 'author','cate', 'temp_books', 'temp_trans_book'));
    }
}
