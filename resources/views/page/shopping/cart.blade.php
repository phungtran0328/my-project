<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/09/2018
 * Time: 7:07 PM
 */?>
@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <br>
                <h4>GIỎ HÀNG ({{Cart::instance()->count(false)}})</h4>
                <br>

                @if(Session::has('messRemove'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{Session::get('messRemove')}}
                    </div>
                @endif
                @if(Session::has('messEmpty'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{Session::get('messEmpty')}}
                    </div>
                @endif
                <div class="table-responsive ">
                    @if (sizeof(Cart::content()) > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10%">Hình ảnh</th>
                                <th >Tên sách</th>
                                <th >Số lượng</th>
                                <th>Giá gốc</th>
                                <th>Giá đã giảm</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sum=0; ?>
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td colspan="1">
                                        <a href="{{ url('chi-tiet-sach', [$item->id]) }}">
                                            <?php
                                                $temp=\App\Book::where('S_MA',[$item->id])->first();
                                                $promotion=$temp->promotion()->first();
                                                $total=0;
                                                if ($item->price <> $item->model->S_GIA){
                                                    $percent = ($promotion->KM_GIAM)*100;
                                                }
                                                else{
                                                    $percent=0;
                                                }
                                                $total+=($item->model->S_GIA*$item->qty);
                                                $sum+=$total;
                                                //tổng giá chưa giảm (bởi vì thêm giá khuyến mãi vào cho $item->price)
                                            ?>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <img src="images/avatar/{{$item->model->S_AVATAR}}">
                                                    </div>
                                                </div>
                                        </a>
                                    </td>
                                    <td colspan="1">
                                        <a href="{{ url('chi-tiet-sach', [$item->id]) }}">{{ $item->model->S_TEN }}</a>
                                    </td>
                                    <td style="width: 15%">
                                        <form class="input-group" action="{{url('/cart/update',$item->rowId)}}" method="post">
                                            {!! csrf_field() !!}
                                            <input value="{{$item->qty}}" class="form-control" type="number" min="1" id="qty-num" name="qty">
                                            <input type="hidden" name="id" value="{{$item->rowId}}">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default-sm"><span class="glyphicon glyphicon-refresh"></span></button>
                                            </span>
                                        </form>
                                        <p>{{$errors->has('qty') ? $errors->first('qty') : ''}}</p>
                                    </td>
                                    <td>
                                        <p>{{ number_format($item->model->S_GIA) }} đ</p>
                                    </td>
                                    <td>
                                        <p>{{number_format($item->price)}} đ </p><br>
                                        @if($percent<>0)
                                            <p style="background: orange; width: 50px; color: white">-{{$percent}}%</p>
                                        @endif
                                    </td>
                                    <td>
                                        {{number_format($item->price*$item->qty)}} đ
                                    </td>
                                    <td>
                                        <form action="{{ url('/cart/delete', [$item->rowId]) }}" method="post" class="side-by-side">
                                            {!! csrf_field() !!}
                                            <button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{--Cart::instance('default')->tax(); Cart:total() -> tính luôn cả tax() vào nên không dùng --}}
                            <tr>
                                <td colspan="5">
                                    <a href="{{url('/index')}}" class="btn btn-primary" >Tiếp tục mua sách</a>
                                </td>
                                <td style="text-align: right" colspan="2">
                                    <form action="{{url('/cart/empty')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="submit" class="btn btn-danger" value="Xóa giỏ hàng">
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <table class="table table-bordered" style="border: none; width: 100%">
                                    <tr>
                                        <th style="font-size: 18px; text-align: left;" colspan="50%">TỔNG CHƯA GIẢM</th>
                                        <td style="font-size: 15px; text-align: right" >{{ number_format($sum) }} đ</td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 18px;  text-align: left" colspan="50%">TỔNG CỘNG</th>
                                        <td style="font-size: 18px; text-align: right; color: red; font-weight: bold">{{ Cart::instance('default')->subtotal()}} đ</td>
                                    </tr>
                                </table>
                                <a href="{{route('checkout')}}" class="btn btn-success btn-block">Tiến hành thanh toán</a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{url('/index')}}" class="btn btn-primary">Tiếp tục mua sách</a>
                            </div>
                            <div class="col-md-10 text-center">
                                <h3>Không có quyển sách nào trong giỏ hàng!</h3><br/>

                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
    </div> <!-- end container -->
@endsection
