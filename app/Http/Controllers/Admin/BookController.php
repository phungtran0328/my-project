<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\CoverType;
use App\KindOfBook;
use App\Promotion;
use App\Publisher;
use App\Translator;
use App\WriteBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->input('search');
        if (isset($search)){
            $books=Book::where('S_TEN','like','%'.$search.'%')
                ->orderBy('S_MA','desc')->paginate(10);
        }
        else{
            $books=Book::orderBy('S_MA','desc')->paginate(10);
        }
        //sắp xếp S_MA giảm dần lấy 10 record trên 1 trang
        return view('admin.book.book', compact('books','search'));
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
        $book->S_LUOTXEM=0;
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
        /*$book=Book::where('S_MA',$id)->first();
        $publisher = $book->publisher()->first();
        $authors = $book->author()->get();
        $translators = $book->translator()->get();
        $promotion = $book->promotion()->first();
        $kind_of_book = $book->kind_of_book()->first();
        $cover_type = $book->cover_type()->first();
        $images = $book->image()->get();
        return view('admin.book.book_detail',compact('book'));*/
    }

    public function detail($id){
        $book=Book::where('S_MA',$id)->first();
        return view('admin.book.book_detail',compact('book'));
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
//        $publisher=$book->publisher()->first();
//        $publishers = Publisher::all();
//        $authors = $book->author()->get();
//        $translators = $book->translator()->get();
//        $promotions = Promotion::all();
//        $kindOfBooks = KindOfBook::all();
//        $coverTypes = CoverType::all();
//        $images = $book->image()->get();
        return view('admin.book.update_book',compact('book'));
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
        $this->validate($request,[
            'name'=>'required',
            'publisher'=>'required',
            'kindOfBook'=>'required',
            'coverType'=>'required',
            'price'=>'required',
            'publish_date'=>'before:today',
            'inventory_num'=>'required'
        ],[
            'name.required'=>'Vui lòng nhập tên sách !',
            'publisher.required'=>'Vui lòng chọn nhà xuất bản !',
            'kindOfBook.required'=>'Vui lòng chọn loại sách !',
            'coverType.required'=>'Vui lòng chọn loại bìa !',
            'price.required'=>'Vui lòng nhập giá !',
            'publish_date.before'=>'Ngày xuất bản không lớn hơn hôm nay !',
            'inventory_num.required'=>'Vui lòng nhập số lượng tồn !'
        ]);

        $book=Book::where('S_MA',$id)->first();
        $book->S_TEN=$request->name;
        $book->NXB_MA=$request->publisher;
        $book->LS_MA=$request->kindOfBook;
        $book->LB_MA=$request->coverType;
        $book->S_GIA=$request->price;
        $book->KM_MA=$request->promotion;
        $book->S_NGAYXB=$request->publish_date;
        $book->S_TAIBAN=$request->republish;
        $book->S_KICHTHUOC=$request->size;
        $book->S_SOTRANG=$request->page_num;
        $book->S_SLTON=$request->inventory_num;
        $book->S_GIOITHIEU=$request->description;

        if ($book->save()){
            return redirect('admin/book')->with('messUpdateBook','Cập nhật thành công !');
        }
        else {
            return redirect()->back()->with('messUpdateBookError','Cập nhật không thành công !');
        }
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

    public function delete($id){
        $books=Book::where('S_MA',$id)->first();
        $authors=$books->author()->get();
        $trans=$books->translator()->get();
        if (isset($authors)){
            WriteBook::where('S_MA',$id)->delete();
        }
        if (isset($trans)){
            Translator::where('S_MA',$id)->delete();
        }
        $books->delete();
        return redirect()->back()->with('messDelete','Xóa sách thành công !');
    }

}
