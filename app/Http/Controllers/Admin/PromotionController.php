<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::orderBy('KM_MA','desc')->paginate(10);
        return view('admin.book.promotion.promotion', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promotion=new Promotion();
        $promotion->KM_GIAM=$request->promotion_create;
        $promotion->KM_APDUNG=$request->input('start_create');
        $promotion->KM_HANDUNG=$request->input('end_create');
        $promotion->KM_CHITIET=$request->description_create;
        $promotion->save();
        return redirect()->back()->with([
            'Add'=>'Đã thêm khuyến mãi ID: '.$promotion->KM_MA.' !'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promotion=Promotion::where('KM_MA',$id)->first();
        $promotion->KM_GIAM=$request->promotion_update;
        $promotion->KM_APDUNG=$request->input('start_update');
        $promotion->KM_HANDUNG=$request->input('end_update');
        $promotion->KM_CHITIET=$request->description_update;
        $promotion->save();
        return redirect()->back()->with('Update','Đã cập nhật khuyến mãi "'.$promotion->KM_CHITIET.'" !');
    }

    public function updateBook(Request $request, $id){
        $data = $request->input('book_id');
        $books = Book::where('KM_MA',$id)->get();
        //cập nhật khuyến mãi trong sách hiện có km = null
        foreach ($books as $book){
            $book->KM_MA = null;
            $book->save();
        }
        //cập nhật lại khuyến mãi cho sách đã chọn = $id promotion
        foreach ($data as $item){
            $book = Book::where('S_MA', $item)->first();
            $book->KM_MA = $id;
            $book->save();
        }
        return redirect()->back()->with('UpdateBook','Đã cập nhật sách có khuyến mãi ID: "'.$id.'" !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        Promotion::where('KM_MA',$id)->delete();
//        return redirect()->back()->with('messageRemove','Xóa thành công !');
    }

    public function delete($id)
    {
        $promotion = Promotion::where('KM_MA',$id)->first();
        $books = $promotion->book()->get();
        foreach ($books as $book){
            $book->KM_MA = null;
            $book->save();
        }
        $promotion->delete();
        return redirect()->back()->with('Remove','Đã xóa khuyến mãi có ID: '.$id.' !');
    }
}
