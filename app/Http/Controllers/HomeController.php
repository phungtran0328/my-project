<?php

namespace App\Http\Controllers;

use App\KindOfBook;
use App\Slider;
use App\Book;

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
        return view('page.home', compact('categories', 'sliders','books'));
    }
}
