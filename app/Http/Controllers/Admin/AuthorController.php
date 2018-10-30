<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
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
            $authors=Author::where('TG_TEN','like','%'.$search.'%')
                ->orderBy('TG_MA','desc')->paginate(10);
        }
        else{
            $authors=Author::orderBy('TG_MA','desc')->paginate(10);
        }
        return view('admin.book.author.author',compact('authors','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author=new Author();
        $author->TG_TEN=$request->name_create;
        $author->TG_MOTA=$request->description_create;
        $author->TG_GHICHU=$request->note_create;
        $author->save();
        return redirect()->back()->with('messageAdd','Đã thêm tác giả "'.$author->TG_TEN.'" !');
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

    public function postUpdate(Request $request, $id){
        $author= Author::where('TG_MA',$id)->first();
        $author->TG_TEN=$request->name_update;
        $author->TG_MOTA=$request->description_update;
        $author->TG_GHICHU=$request->note_update;
        $author->save();
        return redirect()->back()->with('messageUpdate','Đã cập nhật tác giả ID: '.$id.' !');

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

    public function delete($id)
    {
        $author = Author::where('TG_MA',$id)->first();
        $book = $author->book()->first();
        $translate = $author->translate_book()->first();
        if (isset($book) or isset($translate->pivot->DICHGIA)){
            return redirect()->back()->with('messageRemoveError','Không thể xóa vì tồn tại sách có tác giả ID: '.$id.' !');
        }
        else{
            Author::where('TG_MA',$id)->delete();
            return redirect()->back()->with('messageRemove','Xóa thành công !');
        }
    }

}
