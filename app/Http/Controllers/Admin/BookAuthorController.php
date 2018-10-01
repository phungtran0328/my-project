<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\Translator;
use App\WriteBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors=Author::all();
        $books = Book::all();
        return view('admin.book.create_book_author',compact('authors','books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Trường hợp cập nhật tác giả lưu vào bảng tg_vietsach

        $this->validate($request,[
            'book'=>'required',
            'author'=>'required',
        ],[
            'book.required'=>'Vui lòng chọn sách !',
            'author.required'=>'Vui lòng chọn tác giả !',
        ]);

        $data=array();
        $books=$request->input('book'); //lưu mảng giá trị chọn book
        $authors=$request->input('author'); //lưu mảng giá trị chọn author
//        $books=implode('',$books);
//        $authors=implode(',',$authors);
        if (count($books)>=1 and count($authors)==1){
            //Trường hợp chọn sách >= 1 và tác giả = 1
            for($i=0;$i<count($books);$i++){
                $data[]=[
                    'S_MA'=>$books[$i],
                    'TG_MA'=>$authors[0]
                ];
            }
        }
        if (count($authors)>=1 and count($books)==1){
            //Trường hợp chọn tác giả >= 1 và sách = 1
            for($i=0;$i<count($authors);$i++){
                $data[]=[
                    'TG_MA'=>$authors[$i],
                    'S_MA'=>$books[0]
                ];
            }
        }
//        dd($data);
//        ['S_MA'=>$books,'TG_MA'=>$authors]
        if (WriteBook::insert($data)){
            return redirect('admin/book')->with('messBookAuthor','Cập nhật tác giả cho sách thành công !');
        }
        else {
            return redirect()->back()->with('messErrorAuthor','Cập nhật không thành công !');
        }
    }

    public function storeTrans(Request $request){

        //Trường hợp lưu vào bảng dichsach

        $this->validate($request,[
            'book'=>'required',
            'author'=>'required',
            'translator'=>'required'
        ],[
            'book.required'=>'Vui lòng chọn sách !',
            'author.required'=>'Vui lòng chọn tác giả !',
            'translator.required'=>'Vui lòng nhập tên người dịch !'
        ]);

        $books=$request->input('book'); //lấy giá trị book lưu vào mảng
        $authors=$request->input('author'); //lấy giá trị author lưu vào mảng
        $data=array();
        if (count($books)>=1 and count($authors)==1){
            //Trường hợp chọn sách >= 1 và tác giả = 1
            for($i=0;$i<count($books);$i++){
                $data[]=[
                    'S_MA'=>$books[$i],
                    'TG_MA'=>$authors[0],
                    'DICHGIA'=>$request->input('translator')
                ];
            }
        }
        if (count($authors)>=1 and count($books)==1){
            //Trường hợp chọn tác giả >= 1 và sách = 1
            for($i=0;$i<count($authors);$i++){
                $data[]=[
                    'TG_MA'=>$authors[$i],
                    'S_MA'=>$books[0],
                    'DICHGIA'=>$request->input('translator')
                ];
            }
        }
        if (Translator::insert($data)){
            return redirect('admin/book')->with('messBookTranslator','Cập nhật tác giả và người dịch cho sách thành công !');
        }
        else {
            return redirect()->back()->with('messErrorTranslator','Cập nhật không thành công !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
