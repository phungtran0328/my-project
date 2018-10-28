<?php

namespace App\Http\Controllers\Admin;

use App\KindOfBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KindOfBookController extends Controller
{
    public function showKind_of_book(){
        $kind_of_book=KindOfBook::all();
        $kob_sort=KindOfBook::orderBy('LS_MA','desc')->paginate(10);
        return view('admin.book.kind_of_book.kind_of_book', compact('kind_of_book','kob_sort'));
    }

    public function kind_of_book(Request $request){
        $kind_of_book = new KindOfBook();
        $kind_of_book->LS_TEN=$request->name_create;
        $kind_of_book->LS_CHIETKHAU=$request->input('discount_create');
        $kind_of_book->LS_MOTA=$request->description_create;
        $kind_of_book->save();
        return redirect()->back()->with([
//            'message'=>'Thêm loại sách mới thành công !',
            'messageAdd'=>'Đã thêm loại sách ID: '.$kind_of_book->LS_MA
        ]);
    }

    public function updateKindOfBook(Request $request, $id){
        $kind_of_book = KindOfBook::where('LS_MA',$id)->first();
        $kind_of_book->LS_TEN=$request->name_update;
        $kind_of_book->LS_CHIETKHAU=$request->input('discount_update');
        $kind_of_book->LS_MOTA=$request->description_update;
        $kind_of_book->save();
        return redirect()->back()->with('messageUpdate','Đã cập nhật loại sách ID: '.$id);
    }

    public function deleteKindOfBook($id){
        $kob = KindOfBook::where('LS_MA',$id)->first();
        $book = $kob->book()->first();
        if (isset($book)){
            return redirect()->back()->with('messageDeleteError','Không thể xóa vì tồn tại sách có ID loại sách: '.$id.' !');
        }else{
            KindOfBook::where('LS_MA',$id)->delete();
            return redirect()->back()->with('messageDelete','Đã xóa loại sách có ID: '.$id.' !');
        }
    }
}
