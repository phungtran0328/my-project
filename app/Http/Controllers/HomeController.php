<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\KindOfBook;
use App\Slider;

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
        return view('page.home', compact('categories', 'sliders'));
    }
}
