<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/12/2018
 * Time: 8:46 AM
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
                        <h3 class="panel-title">Đơn hàng của tôi</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive ">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Mã ĐH</th>
                                    <th>Ngày mua</th>
                                    <th>Tên sách</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th>Hủy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($orders)>0)
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><a href="{{url('/order/view',$order->DH_MA)}}">#{{$order->DH_MA}}</a></td>
                                            <td>
                                                <?php $date=date_create($order->DH_NGAYDAT); ?>
                                                {{date_format($date,'d-m-Y')}}
                                            </td>
                                            <?php
                                                $temp=\App\Order::where('DH_MA',$order->DH_MA)->first();
                                                $books=$temp->book()->get();
                                            ?>
                                            <td>
                                                @if(count($books)>1)
                                                    {{$books[0]->S_TEN}}... và {{count($books)-1}} sách khác
                                                    @else
                                                    {{$books[0]->S_TEN}}
                                                @endif
                                                {{--@foreach($books as $book)
                                                    {{$book->S_TEN}} <br>
                                                @endforeach--}}
                                            </td>
                                            <td>{{number_format($order->DH_TONGTIEN)}}</td>
                                            <td>
                                                <?php
                                                switch ($order->DH_TTDONHANG){
                                                    case 0:
                                                        echo 'Đang xử lí';
                                                        break;
                                                    case 1:
                                                        echo 'Đang vận chuyển';
                                                        break;
                                                    case 2:
                                                        echo 'Giao hàng thành công';
                                                        break;
                                                    case 3:
                                                        echo 'Đang chờ xử lí hủy đơn hàng';
                                                        break;
                                                    case 4:
                                                        echo 'Đã hủy';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            @if($order->DH_TTDONHANG==0)
                                                <td><a href="{{url('order/delete',$order->DH_MA)}}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                                @else
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
