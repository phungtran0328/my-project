<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.book.promotion', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.promotion');
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
            'promotion'=>'required',
            'start' =>'required|date',
            //chưa bắt được after: end
            'end'=>'required|date|after: start',
        ],[
            'promotion.required'=>'Vui lòng chọn giảm giá !',
            'start.required'=>'Vui lòng chọn ngày bắt đầu áp dụng !',
            'end.required'=>'Vui lòng chọn ngày hết hạn !',
            'end.after'=>'Ngày hết hạn phải sau ngày bắt đầu !',
        ]);

        $promotion=new Promotion();
        $promotion->KM_GIAM=$request->promotion;
        $promotion->KM_APDUNG=$request->start;
        $promotion->KM_HANDUNG=$request->end;
        $promotion->KM_CHITIET=$request->description;
        $promotion->save();
        return redirect()->back()->with([
            'message'=>'Thêm thành công !',
            'messageAdd'=>'1 giá khuyến mãi đã được thêm vào !'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion=Promotion::where('KM_MA',$id)->first();
        return view('admin.book.update_promotion', compact('promotion'));
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
            'promotion'=>'required',
            'start' =>'required|date',
            //chưa bắt được after: end
            'end'=>'required|date|after: start',
        ],[
            'promotion.required'=>'Vui lòng chọn giảm giá !',
            'start.required'=>'Vui lòng chọn ngày bắt đầu áp dụng !',
            'end.required'=>'Vui lòng chọn ngày hết hạn !',
            'end.after'=>'Ngày hết hạn phải sau ngày bắt đầu !',
        ]);

        $promotion=Promotion::where('KM_MA',$id)->first();
        $promotion->KM_GIAM=$request->promotion;
        $promotion->KM_APDUNG=$request->start;
        $promotion->KM_HANDUNG=$request->end;
        $promotion->KM_CHITIET=$request->description;
        $promotion->save();
        return redirect('/admin/promotion')->with('messageUpdate','Cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        Promotion::where('KM_MA',$id)->delete();
//        return redirect()->back()->with('messageRemove','Xóa thành công !');
    }

    public function delete($id)
    {
        Promotion::where('KM_MA',$id)->delete();
        return redirect()->back()->with('messageRemove','Xóa thành công !');
    }
}
