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
        $promotion=$book->promotion()->first();
        $date=strtotime(date('Y-m-d'));
        if (isset($promotion)){
            $start=strtotime($promotion->KM_APDUNG);
            $end=strtotime($promotion->KM_HANDUNG);
            if (($start<=$date)and($end>=$date)){
                $saleoff=($book->S_GIA)-($book->S_GIA)*($promotion->KM_GIAM);
                //trường hợp có khuyến mãi và đang trong thời gian có hiệu lực
            }else{
                $saleoff=$book->S_GIA;
                //Có khuyến mãi nhưng chưa tới thời gian
            }
        }else{
            $saleoff=$book->S_GIA; //không có khuyến mãi
        }

        return view('page.detail', compact('book','publisher','authors',
            'cover_type','kind_of_book','images','translators','promotion','saleoff'));
    }
}
