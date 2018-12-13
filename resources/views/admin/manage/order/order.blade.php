<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/12/2018
 * Time: 9:35 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách đơn hàng</h5>
                    </div>
                    <div class="panel-body">
                        @if(session('messInvoice'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messInvoice')}}
                            </div>
                        @endif
                        @if(session('messUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messUpdate')}}
                            </div>
                        @endif
                        @if(session('messComplete'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messComplete')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table id="order" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 7%">Mã ĐH</th>
                                    <th style="width: 14%">KH</th>
                                    <th style="width: 5%">NV</th>
                                    <th style="width: 10%">Ngày đặt</th>
                                    <th style="width: 11%">Tồng tiền</th>
                                    <th style="width: 10%">Phí VC</th>
                                    <th>TTĐH</th>
                                    <th style="width: 20%">HTTT</th>
                                    <th style="width: 10%"></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $index=>$order)
                                    @php
                                    $customer = $order->customer()->first();
                                    if (isset($customer->KH_DIACHI2)){
                                        if ($customer->KH_DIACHI2=='CT'){
                                            $ship=0;
                                        }
                                        else{
                                            $ship=number_format(18000);
                                        }
                                    }else{
                                        $ship='null';
                                    }
                                    $user=$order->user()->first();
                                    @endphp
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>#{{$order->DH_MA}}</td>
                                        <td>{{$customer->KH_TEN}}</td>
                                        @if(isset($user))
                                            <td>{{$user->NV_MA}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        @php $date=date_create($order->DH_NGAYDAT); @endphp
                                        <td>{{date_format($date,"d/m/Y H:i:s")}}</td>
                                        <td>{{number_format($order->DH_TONGTIEN)}}</td>
                                        <td>{{$ship}}</td>
                                        <td>
                                            @php
                                                switch ($order->DH_TTDONHANG){
                                                    case 0:
                                                        echo 'Đang xử lí';
                                                        break;
                                                    case 1:
                                                        echo 'Đang vận chuyển';
                                                        break;
                                                    case 2:
                                                        echo 'Giao hàng thành công'; //Chỉ trường hợp này mới trừ sl tồn
                                                        break;
                                                    case 3:
                                                        echo 'Đang chờ xử lí hủy đơn hàng';
                                                        break;
                                                    case 4:
                                                        echo 'Đã hủy';
                                                        break;
                                                }
                                            @endphp
                                        </td>
                                        <td>{{$order->DH_GHICHU}}</td>
                                        <td class="text-center">
                                            @can('order.update')
                                                @switch($order->DH_TTDONHANG)
                                                    @case(0)
                                                        <a class="btn btn-primary btn-xs" href="{{url('admin/order/invoice',$order->DH_MA)}}">
                                                            Lập HĐ</a>
                                                    @break
                                                    @case(1)
                                                        <a class="btn btn-info btn-xs" href="{{url('admin/order/complete',$order->DH_MA)}}">
                                                            Đang VC</a>
                                                    @break
                                                    @case(2)
                                                        <a class="btn btn-success btn-xs">Đã giao</a>
                                                    @break
                                                    @case(3)
                                                        <a class="btn btn-danger btn-xs" href="{{url('admin/order/cancel',$order->DH_MA)}}">
                                                            Hủy ĐH</a>
                                                    @break
                                                    @case(4)
                                                        <a class="btn btn-default btn-xs">Đã hủy</a>
                                                    @break
                                                @endswitch
                                            @endcan
                                        </td>
                                        {{--<td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
