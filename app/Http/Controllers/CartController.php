<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Book;

class CartController extends Controller
{
    public function index(){
        return view('page.shopping.cart');
    }

    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($key, $value) use ($request) {
            return $key->id == $request->id;
        });
        if (!$duplicates->isEmpty()) {
            return redirect('cart')->with('message','Sách đã có trong giỏ hàng!');
        }
        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Book');

        return redirect('cart')->with('messAdd','Sách đã được thêm vào giỏ hàng!');
    }

    public function increment($id)
    {
        $item = Cart::instance('default')->get($id);
        Cart::update($id, $item->qty + 1);
        return redirect()->back();
    }

    public function decrease($id)
    {
        $item = Cart::instance('default')->get($id);
        Cart::update($id, $item->qty - 1);
        return redirect()->back();
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart')->withSuccessMessage('Đã xóa sách khỏi giỏ hàng!');
    }

    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->withSuccessMessage('Giỏ hàng của bạn đã được xóa!');
    }
}
