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
            $authors=Author::paginate(10);
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
        return view('admin.book.author.create_author');
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
        ],[
            'name.required'=>'Vui lòng nhập tên tác giả !',
        ]);
        $author=new Author();
        $author->TG_TEN=$request->name;
        $author->TG_MOTA=$request->description;
        $author->TG_GHICHU=$request->note;
        $author->save();
        return redirect('admin/author')->with('messageAdd','Thêm thành công');
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

    public function getUpdate($id){
        $author=Author::where('TG_MA',$id)->first();
        return view('admin.book.author.update_author',compact('author'));
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
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'Vui lòng nhập tên tác giả !',
        ]);
        $author= Author::where('TG_MA',$id)->first();
        $author->TG_TEN=$request->name;
        $author->TG_MOTA=$request->description;
        $author->TG_GHICHU=$request->note;
        $author->save();
        return redirect('admin/author')->with('messageUpdate','Chỉnh sửa thành công !');
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
        Author::where('TG_MA',$id)->delete();
        return redirect('admin/author')->with('messageRemove','Xóa thành công !');
    }

    public function getSearch(Request $request){
        $authors=Author::where('TG_TEN','LIKE','%'.$request->input('search').'%')->get();
        return view('admin.book.author.search', compact('authors'));
    }
}
