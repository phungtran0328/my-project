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
        <h3>Giỏ hàng của bạn</h3>
        <hr>
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif
        @if (sizeof(Cart::content()) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th class="table-image"></th>
                    <th >Tên sách</th>
                    <th >Số lượng</th>
                    <th>Giá</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach (Cart::content() as $item)
                    <tr>
                        <td class="table-image">
                            <a href="{{ url('detail', [$item->id]) }}">
                                <img src="" width="70" height="100"  >
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('detail', [$item->id]) }}">{{ $item->model->S_TEN }}</a>
                        </td>
                        <td >
                            <form method="POST" action="" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="submit" name="quantity" value="  +  ">
                                <input type="hidden" name="id" value="}">

                            </form>
                            <form>
                                <input type="tel" value="{{$item->qty}}">
                            </form>


                            <form method="post" action="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="submit" name="quantity" value="  -  ">
                                <input type="hidden" name="id" value="">
                            </form>
                        </td>
                        <td>
                            {{ $item->subtotal() }} VND
                        </td>
                        <td>
                            <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="Xóa">
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="table-image"></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Tổng tiền</td>
                    <td>{{ Cart::instance('default')->subtotal() }} VND</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="table-image"></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Thuế</td>
                    <td>{{ Cart::instance('default')->tax() }} VND</td>
                    <td></td>
                </tr>
                <tr class="border-bottom">
                    <td class="table-image"></td>
                    <td style="padding: 40px;"></td>
                    <td class="small-caps table-bg" style="text-align: right">Thành tiền</td>
                    <td class="table-bg">{{ Cart::total() }} VND</td>
                    <td class="column-spacer"></td>
                </tr>
                </tbody>
            </table>

            <a href="{{url('/index')}}" class="btn btn-primary">Tiếp tục mua sách</a> &nbsp;
            <a href="" class="btn btn-success">Tiến hành thanh toán</a>

            <div style="float:right">
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger" value="Xóa giỏ hàng">
                </form>
            </div>
        @else
            <h3>Không có quyển sách nào trong giỏ hàng!</h3><br/>
            <a href="{{url('/index')}}" class="btn btn-primary">Tiếp tục mua sách</a>
        @endif
        <div class="clearfix"></div>
    </div> <!-- end container -->
@endsection
