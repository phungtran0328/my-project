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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $this->validate($request,[
//            'translator'=>'required',
            'author'=>'required'
        ],[
//            'translator.required'=>'Vui lòng nhập tên người dịch !',
            'author.required'=>'Vui lòng chọn tác giả !'
        ]);

        $authors=$request->input('author');
//        dd($authors);
        $book_author=array();
        if (!empty($authors)){
            for ($i=0;$i<count($authors);$i++){
                $book_author[]=[
                    'S_MA'=>$request->input('id'),
                    'TG_MA'=>$authors[$i]
                ];
            }
        }
//        dd($book_author);
        if (isset($book_author)){
            $books=WriteBook::where('S_MA',$id)->get();
            //vì S_MA và TG_MA đều là khóa chính nên không thể update where 1 trong 2
            //nên xóa các record có sẵn trong csdl và thêm record mới vào
            for ($i=0;$i<count($books);$i++){
                WriteBook::where('S_MA',$book_author[0]['S_MA'])->delete();
            }
//                dd($book_author);
            WriteBook::insert($book_author);
        }
        return redirect()->back()->with('messUpdateAuthor','Cập nhật tác giả thành công !');
    }

    public function updateTrans(Request $request, $id)
    {
        $this->validate($request,[
            'translator'=>'required',
            'author'=>'required'
        ],[
            'translator.required'=>'Vui lòng nhập tên người dịch !',
            'author.required'=>'Vui lòng chọn tác giả !'
        ]);

        $authors=$request->input('author');
//        dd($authors);
        $book_author=array();
        if (!empty($authors)){
            for ($i=0;$i<count($authors);$i++){
                $book_author[]=[
                    'S_MA'=>$request->input('id'),
                    'TG_MA'=>$authors[$i],
                    'DICHGIA'=>$request->input('translator')
                ];
            }
        }
//        dd($book_author);
        if (isset($book_author)){
            $books=Translator::where('S_MA',$id)->get();
            //vì S_MA và TG_MA đều là khóa chính nên không thể update where 1 trong 2
            //nên xóa các record có sẵn trong csdl và thêm record mới vào
            for ($i=0;$i<count($books);$i++){
                Translator::where('S_MA',$book_author[0]['S_MA'])->delete();
            }
//                dd($book_author);
            Translator::insert($book_author);
        }
        return redirect()->back()->with('messUpdateTranslator','Cập nhật tác giả, dịch giả thành công !');
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
