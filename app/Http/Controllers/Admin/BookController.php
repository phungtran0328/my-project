<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\CoverType;
use App\KindOfBook;
use App\Promotion;
use App\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::paginate(10);
        return view('admin.book.book', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $promotions = Promotion::all();
        $coverTypes = CoverType::all();
        $kindOfBooks = KindOfBook::all();
//        $publisher_name=$publishers->pluck('NXB_TEN')->all();
//        $publisher_id=$publishers->pluck('NXB_MA')->all();
        //dd($publisher_id);
        return view('admin.book.create_book', compact('publishers','promotions','coverTypes','kindOfBooks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'publish_date'=>'required',
            'inventory_num'=>'required',
            'publisher'=>'required',
            'coverType'=>'required',
            'kindOfBook'=>'required',
        ],
            [
                'name.required'=>'Vui lòng nhập tên sách !',
                'price.required'=>'Vui lòng nhập giá sách !',
                'publish_date.required'=>'Vui lòng nhập ngày xuất bản !',
                'inventory_num.required'=>'Vui lòng nhập số lượng tồn !',
                'publisher.required'=>'Vui lòng chọn nhà xuất bản !',
                'coverType.required'=>'Vui lòng chọn loại bìa !',
                'kindOfBook.required'=>'Vui lòng chọn loại sách !',
            ]);

        $book = new Book();
        $book->KM_MA=$request->promotion;
        $book->NXB_MA=$request->publisher;
        $book->LS_MA=$request->kindOfBook;
        $book->LB_MA=$request->coverType;
        $book->S_TEN=$request->name;
        $book->S_SLTON=$request->inventory_num;
        $book->S_KICHTHUOC=$request->size;
        $book->S_SOTRANG=$request->page_num;
        $book->S_NGAYXB=$request->publish_date;
        $book->S_TAIBAN=$request->republish;
        $book->S_GIOITHIEU=$request->description;
        $book->S_GIA=$request->price;
        $book->save();
        return redirect('/admin/book')->with('messAddBook','Thêm sách thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::where('S_MA',$id)->first();
        $publisher = $book->publisher()->first();
        $authors = $book->author()->get();
        $translators = $book->translator()->get();
        $promotion = $book->promotion()->first();
        $kind_of_book = $book->kind_of_book()->first();
        $cover_type = $book->cover_type()->first();
        $images = $book->image()->get();
        return view('admin.book.book_detail',compact('book','publisher','authors','translators','promotion',
            'kind_of_book','cover_type','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book=Book::where('S_MA',$id)->first();
        $publishers = $book->publisher()->get();
//        $authors = $book->author()->get();
//        $translators = $book->translator()->get();
        $promotions = $book->promotion()->get();
        $kindOfBooks = $book->kind_of_book()->get();
        $coverTypes = $book->cover_type()->get();
//        $images = $book->image()->get();
        return view('admin.book.update_book',compact('book','publishers','promotions',
            'kindOfBooks','coverTypes'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
