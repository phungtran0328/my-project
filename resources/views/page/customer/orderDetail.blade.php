<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/16/2018
 * Time: 10:24 AM
 */?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Đơn hàng của tôi</li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="aside-menu">
                    <li><a href="{{url('/edit',Auth::guard('customer')->user()->KH_MA)}}"><i class="glyphicon glyphicon-info-sign" style="font-size: 20px"></i>Thông tin tài khoản</a></li>
                    <li>
                        <a href="{{url('/change-password',Auth::guard('customer')->user()->KH_MA)}}"><i class="fa fa-edit" style="font-size: 20px"></i>
                            Đổi mật khẩu</a>
                    </li>
                    <li>
                        <a href="{{url('/order',Auth::guard('customer')->user()->KH_MA)}}"><i class="glyphicon glyphicon-list-alt" style="font-size: 20px"></i>
                            Xem đơn hàng</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chi tiết đơn hàng #{{$order_id}} - Trạng thái: "{{$status}}" - Ngày đặt: "{{$order_created}}"</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>ĐỊA CHỈ NGƯỜI NHẬN</strong>
                                <div class="panel panel-default panel-body" style="height: 130px">
                                    <p style="font-size: 15px; margin-bottom: 10px;"> {{$customer->KH_TEN}}</p>
                                    <p style="font-size: 13px; "> Địa chỉ: {{$customer->fulladdress}}</p>
                                    <p style="font-size: 13px; "> Số ĐT: {{$customer->KH_SDT}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <strong>HÌNH THỨC GIAO HÀNG</strong>
                                <div class="panel panel-default panel-body" style="height: 130px">
                                    <p> Giao hàng tiêu chuẩn</p>
                                    <p> Phí vận chuyển: {{number_format($shipping)}} đ</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <strong>HÌNH THỨC THANH TOÁN</strong>
                                <div class="panel panel-default panel-body" style="height: 130px">
                                    <p>{{$order_checkout}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive ">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 50%">Tên sách</th>
                                    <th>Số lượng</th>
                                    <th style="width: 20%">Giá</th>
                                    <th>Tạm tính</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-6">
                                                    <img src="images/avatar/{{$book->S_AVATAR}}" >
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-6">
                                                    <a href="{{url('/chi-tiet-sach',$book->S_MA)}}">{{$book->S_TEN}}</a>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            {{$book->pivot->DHCT_SOLUONG}}
                                        </td>
                                        <td>
                                            {{number_format($book->pivot->DHCT_GIA)}}
                                        </td>
                                        <td>
                                            {{number_format($book->pivot->DHCT_GIA*$book->pivot->DHCT_SOLUONG)}}
                                        </td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <p style="margin-bottom: 10px">Tổng tạm tính: </p>
                                        <p style="margin-bottom: 10px">Phí vận chuyển: </p>
                                        <p>Tổng cộng: </p>
                                    </td>
                                    <td>
                                        <p style="margin-bottom: 10px">{{number_format($total)}} đ</p>
                                        <p style="margin-bottom: 10px">{{number_format($shipping)}} đ</p>
                                        <p style="font-size: large; color: red">{{number_format($total+$shipping)}} đ</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
