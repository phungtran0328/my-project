<?php

namespace App\Http\Controllers\Admin;

use App\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers=Publisher::paginate(10);
        return view('admin.book.publisher',compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.create_publisher');
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
            'name.required'=>'Vui lòng nhập tên nhà xuất bản !',
        ]);
        $publisher=new Publisher();
        $publisher->NXB_TEN=$request->name;
        $publisher->NXB_GHICHU=$request->note;
        $publisher->save();
        return redirect('admin/publisher')->with('messageAdd','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publisher=Publisher::where('NXB_MA',$id)->first();
        return view('admin.book.update_publisher', compact('publisher'));
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
            'name.required'=>'Vui lòng nhập tên nhà xuất bản !'
        ]);

        $publisher=Publisher::where('NXB_MA', $id)->first();
        $publisher->NXB_TEN=$request->name;
        $publisher->NXB_GHICHU=$request->note;
        $publisher->save();
        return redirect('admin/publisher')->with('messageUpdate','Cập nhật thành công');
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
        Publisher::where('NXB_MA',$id)->delete();
        return redirect('admin/publisher')->with('messageRemove','Xóa thành công !');
    }
}
