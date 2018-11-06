<?php

namespace App\Http\Controllers;

use App\Author;
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
//        dd($temp_authors);
//        dd(unique_multidim_array($temp_authors,'id'));
//        dd(unique_multidim_array($temp_translator,'id'));
        $authors = unique_multidim_array($temp_authors,'id');
        $translators = unique_multidim_array($temp_translator,'id');

        return view('page.category.category', compact('category','category_book', 'category_paginate', 'authors', 'translators'));
    }


    public function authorCategory(Request $request, $id){
        $author = Author::where('TG_MA', $id)->first();
        $temp_books = $author->book()->paginate(2);
        $temp_trans_book = $author->translate_book()->paginate(2);
        $books=array();
        $date=strtotime(date('Y-m-d')); //Lấy thời gian hiện tại=>giây
        if (!is_null($temp_books)){
            for ($i=0;$i<count($temp_books);$i++){
                $temp = Book::where('S_MA', $temp_books[$i]->S_MA)->first();
                $books[0]['category'] = $temp->kind_of_book()->first();
                $books[$i]['id'] = $temp_books[$i]->S_MA;
                $books[$i]['name'] = $temp_books[$i]->S_TEN;
                $books[$i]['in_stock'] = $temp_books[$i]->S_SLTON;
                $books[$i]['price'] = $temp_books[$i]->S_GIA;
                $books[$i]['image'] = $temp->image()->first();
                $books[$i]['promotion'] = $temp->promotion()->first();
                if (isset($books[$i]['promotion'])){
                    $start=strtotime($books[$i]['promotion']->KM_APDUNG);
                    $end=strtotime($books[$i]['promotion']->KM_HANDUNG);
                    if (($start<=$date)and($end>=$date)){
                        $books[$i]['sale']=($temp_books[$i]->S_GIA)*(1-$books[$i]['promotion']->KM_GIAM);
                        //Có khuyến mãi và đang trong thời gian có hiệu lực
                    }else{
                        $books[$i]['sale']=$temp_books[$i]->S_GIA;
                        //Có khuyến mãi nhưng chưa tới thời gian
                    }
                }else{
                    $books[$i]['sale']=$temp_books[$i]->S_GIA; //Không có khuyến mãi
                }
            }
        }
        if (!is_null($temp_trans_book)){
            for ($i = 0; $i < count($temp_trans_book); $i++) {
                $temp = Book::where('S_MA', $temp_trans_book[$i]->S_MA)->first();
                $books[0]['category'] = $temp->kind_of_book()->first();
                $books[$i]['id'] = $temp_trans_book[$i]->S_MA;
                $books[$i]['name'] = $temp_trans_book[$i]->S_TEN;
                $books[$i]['in_stock'] = $temp_trans_book[$i]->S_SLTON;
                $books[$i]['price'] = $temp_trans_book[$i]->S_GIA;
                $books[$i]['image'] = $temp->image()->first();
                $books[$i]['promotion'] = $temp->promotion()->first();
                if (isset($books[$i]['promotion'])) {
                    $start = strtotime($books[$i]['promotion']->KM_APDUNG);
                    $end = strtotime($books[$i]['promotion']->KM_HANDUNG);
                    if (($start <= $date) and ($end >= $date)) {
                        $books[$i]['sale'] = ($temp_trans_book[$i]->S_GIA) * (1 - $books[$i]['promotion']->KM_GIAM);
                        //Có khuyến mãi và đang trong thời gian có hiệu lực
                    } else {
                        $books[$i]['sale'] = $temp_trans_book[$i]->S_GIA;
                        //Có khuyến mãi nhưng chưa tới thời gian
                    }
                } else {
                    $books[$i]['sale'] = $temp_trans_book[$i]->S_GIA; //Không có khuyến mãi
                }
            }
        }
        return view('page.category.author', compact('books', 'author', 'temp_books', 'temp_trans_book'));
    }
}
