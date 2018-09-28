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
        $cover_type = CoverType::all();
        return view('admin.book.cover_type.cover_type', compact('cover_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.cover_type.cover_type');
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
            'name'=>'required'
        ],
            [
                'name.required'=>'Vui lòng nhập tên bìa sách !'
            ]);
        $cover = new CoverType();
        $cover->LB_TEN=$request->name;
        $cover->save();
        return redirect()->back()->with('messageAdd','1 loại bìa đã được thêm vào !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cover=CoverType::where('LB_MA', $id)->first();
        return view('admin.book.cover_type.update_cover', compact('cover'));
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
            'name'=>'required'
        ],
            [
                'name.required'=>'Vui lòng nhập tên bìa sách !'
            ]
        );
        $cover = CoverType::where('LB_MA', $id)->first();
        $cover->LB_TEN=$request->name;
        $cover->save();
        return redirect('/admin/cover-type')->with('messageUpdate','Cập nhật thành công !');
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
