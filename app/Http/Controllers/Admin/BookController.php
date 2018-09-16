<?php

namespace App\Http\Controllers\Admin;

use App\KindOfBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function showKind_of_book(){
        $kind_of_book=KindOfBook::all();
        return view('admin.book.kind_of_book', compact('kind_of_book'));
    }

    public function kind_of_book(Request $request){
        $this->validate($request,[
           'name' => 'required',
        ],[
            'name.required'=>'Vui lòng nhập tên loại sách !',
        ]);

        $kind_of_book = new KindOfBook();
        $kind_of_book->LS_TEN=$request->name;
        $kind_of_book->LS_MOTA=$request->description;
        $kind_of_book->save();
        return redirect()->back()->with([
            'message'=>'Thêm loại sách mới thành công !',
            'messageAdd'=>'1 loại sách đã được thêm vào'
        ]);
    }

    public function showUpdate($id){
        $kindOfBook=KindOfBook::where('LS_MA', $id)->first();
        return view('admin.book.update_kob', compact('kindOfBook'));
    }

    public function updateKindOfBook(Request $request, $id){
        $this->validate($request,[
            'name' => 'required',
        ],[
            'name.required'=>'Vui lòng nhập tên loại sách !',
        ]);

        $kind_of_book = KindOfBook::where('LS_MA',$id)->first();
        $kind_of_book->LS_TEN=$request->name;
        $kind_of_book->LS_MOTA=$request->description;
        $kind_of_book->save();
        return redirect('/admin/kind-of-book')->with('messageUpdate','Cập nhật thành công !');
    }

    public function deleteKindOfBook($id){
        //Chưa xử lí khóa ngoại
        KindOfBook::where('LS_MA',$id)->delete();
        return redirect()->back()->with('messageDelete','Xóa thành công !');
    }
}
