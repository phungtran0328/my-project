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
        $this->validate($request,[
            'qty'=>'integer',
        ],[
            'qty.integer'=>'Vui lòng nhập số nguyên'
        ]);

        $duplicates = Cart::search(function ($key, $value) use ($request) {
            return $key->id == $request->id;
        });
        if (!$duplicates->isEmpty()) {
            return redirect()->back()->with('message','Sách đã có trong giỏ hàng!');
        }
        Cart::add($request->id, $request->name, $request->qty, $request->price)->associate('App\Book');

        return redirect()->back()->with('messAdd','Sách đã được thêm vào giỏ hàng!');
    }


    /*public function increment($id)
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
    }*/

    public function update(Request $request, $id){
        $item = Cart::instance('default')->get($id);
//        dd($item->id);
        $book_id = Book::where('S_MA', $item->id)->first();
        $max = $book_id->S_SLTON;
        $this->validate($request,[
            'qty_'.$id=>'max:'.$max,
        ],[
            'qty_'.$id.'max'=>'Số lượng cung ứng không đủ, vui lòng nhập lại số lượng!',
        ]);

        Cart::update($id, $item->qty=$request->qty);
        return redirect()->back();
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart')->with('messRemove','Đã xóa sách khỏi giỏ hàng!');
    }

    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->with('messEmpty','Giỏ hàng của bạn đã được xóa!');
    }
}
