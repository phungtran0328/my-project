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
        return view('admin.book.promotion.promotion', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.promotion.promotion');
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
            'start' =>'required',
            //chưa bắt được after: end
            'end'=>'required',
        ],[
            'promotion.required'=>'Vui lòng chọn giảm giá !',
            'start.required'=>'Vui lòng chọn ngày bắt đầu áp dụng !',
            'end.required'=>'Vui lòng chọn ngày hết hạn !',
        ]);
        $start=strtotime($request->input('start'));
        $end=strtotime($request->input('end'));
        if ($start>=$end){
            return redirect()->back()
                ->with('messDate','Thời gian áp dụng không được lớn hơn hoặc bằng thời gian kết thúc');
        }

        $promotion=new Promotion();
        $promotion->KM_GIAM=$request->promotion;
        $promotion->KM_APDUNG=$start;
        $promotion->KM_HANDUNG=$end;
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
        return view('admin.book.promotion.update_promotion', compact('promotion'));
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
            'start' =>'required',
            'end'=>'required',
        ],[
            'promotion.required'=>'Vui lòng chọn giảm giá !',
            'start.required'=>'Vui lòng chọn ngày bắt đầu áp dụng !',
            'end.required'=>'Vui lòng chọn ngày hết hạn !',
        ]);

        $start=strtotime($request->input('start'));
        $end=strtotime($request->input('end'));
        if ($start>=$end){
            return redirect()->back()
                ->with('messDate','Thời gian áp dụng không được lớn hơn hoặc bằng thời gian kết thúc');
        }

        $promotion=Promotion::where('KM_MA',$id)->first();
        $promotion->KM_GIAM=$request->promotion;
        $promotion->KM_APDUNG=$start;
        $promotion->KM_HANDUNG=$end;
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
