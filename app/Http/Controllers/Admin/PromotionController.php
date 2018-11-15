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
        $promotions = Promotion::orderBy('KM_MA','desc')->paginate(10);
        return view('admin.book.promotion.promotion', compact('promotions'));
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
        $promotion=new Promotion();
        $promotion->KM_GIAM=$request->promotion_create;
        $promotion->KM_APDUNG=$request->input('start_create');
        $promotion->KM_HANDUNG=$request->input('end_create');
        $promotion->KM_CHITIET=$request->description_create;
        $promotion->save();
        return redirect()->back()->with([
            'messageAdd'=>'Đã thêm khuyến mãi ID: '.$promotion->KM_MA.' !'
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
        $promotion->KM_APDUNG=$request->input('start');
        $promotion->KM_HANDUNG=$request->input('end');
        $promotion->KM_CHITIET=$request->description;
        $promotion->save();
        return redirect('/admin/promotion')->with('messageUpdate','Đã cập nhật khuyến mãi có ID: '.$id.' !');
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
        $promotion = Promotion::where('KM_MA',$id)->first();
        $book = $promotion->book()->first();
        if (isset($book)){
            return redirect()->back()->with('messageRemoveError','Không thể xóa vì tồn tại sách có khuyến mãi ID: '.$id.' !');
        }else{
            $promotion->delete();
            return redirect()->back()->with('messageRemove','Đã xóa khuyến mãi có ID: '.$id.' !');
        }
    }
}
