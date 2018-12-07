<?php

namespace App\Http\Controllers\Admin;

use App\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');
        if (isset($search)){
            $publishers = Publisher::where('NXB_TEN','like','%'.$search.'%')
                ->orderBy('NXB_MA','desc')->paginate(10);
        }
        else{
            $publishers = Publisher::orderBy('NXB_MA','desc')->paginate(10);
        }
        return view('admin.book.publisher.publisher',compact('publishers','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publisher=new Publisher();
        $publisher->NXB_TEN=$request->name_create;
        $publisher->NXB_GHICHU=$request->note_create;
        $publisher->save();
        return redirect()->back()->with('messageAdd','Đã thêm NXB ID: '.$publisher->NXB_MA);
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


    }

    public function postUpdate(Request $request, $id){
        $publisher=Publisher::where('NXB_MA', $id)->first();
        $publisher->NXB_TEN=$request->name_update;
        $publisher->NXB_GHICHU=$request->note_update;
        $publisher->save();
        return redirect()->back()->with('messageUpdate','Đã cập nhật NXB ID: '.$publisher->NXB_MA);
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
        $publisher = Publisher::where('NXB_MA',$id)->first();
        $book = $publisher->book()->first();
        if (isset($book)){
            return redirect()->back()->with('messageRemoveError','Không thể xóa vì tồn tại sách có NXB ID: '.$id.' !');
        }
        else{
            $publisher->delete();
            return redirect()->back()->with('messageRemove','Đã xóa NXB có ID: '.$id.' !');
        }
    }
}
