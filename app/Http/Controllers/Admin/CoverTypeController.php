<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CoverType;

class CoverTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cover_type = CoverType::orderBy('LB_MA','desc')->paginate(10);
        return view('admin.book.cover_type.cover_type', compact('cover_type'));
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
        $cover = new CoverType();
        $cover->LB_TEN=$request->name_create;
        $cover->save();
        return redirect()->back()->with('messageAdd','Đã thêm loại bìa "'.$cover->LB_TEN.'" !');
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

    }

    public function postUpdate(Request $request, $id){
        $cover = CoverType::where('LB_MA', $id)->first();
        $cover->LB_TEN=$request->name_update;
        $cover->save();
        return redirect()->back()->with('messageUpdate','Đã cập nhật loại bìa "'.$cover->LB_TEN. '" !');
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

    public function delete($id){
        $cover = CoverType::where('LB_MA',$id)->first();
        $book = $cover->book()->first();
        if (isset($book)){
            return redirect()->back()->with('messDeleteError','Không thể xóa vì tồn tại sách có loại bìa ID: '.$id.' !');
        }
        else{
            $cover->delete();
            return redirect()->back()->with('messDelete','Đã xóa loại bìa ID: '.$id.' !');
        }
    }
}
