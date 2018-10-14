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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách đơn hàng</h5>
                    </div>
                    <div class="panel-body">
                        {{--@can('invoice-in.create')
                            <a href="{{url('/admin/invoice-in/create')}}" class="btn btn-primary" style="width: 150px;">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        @endcan--}}
                        <form class="input-group" action="{{url('admin/order')}}" method="get" style="width: 250px;">
                            <select class="form-control" name="status">
                                <option value="">---Trạng thái đơn hàng---</option>
                                <option value="0">Đang xử lí</option>
                                <option value="1">Đang vận chuyển</option>
                                <option value="2">Giao hàng thành công</option>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default-sm" type="submit">
                                    <i class="glyphicon glyphicon-filter"></i>
                                </button>
                            </span>
                        </form>
                        <hr>
                        @if(Session::has('messInvoice'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messInvoice')}}
                            </div>
                        @endif
                        @if(Session::has('messUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdate')}}
                            </div>
                        @endif
                        @if(Session::has('messComplete'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messComplete')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 7%">Mã ĐH</th>
                                    <th style="width: 14%">KH</th>
                                    <th style="width: 5%">NV</th>
                                    <th style="width: 8%">Ngày đặt</th>
                                    <th style="width: 8%">Tồng tiền</th>
                                    <th style="width: 8%">Phí VC</th>
                                    <th>TTĐH</th>
                                    <th style="width: 20%">HTTT</th>
                                    <th style="width: 10%">Hành động</th>
                                    <th style="width: 6%">Hủy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $index=>$order)
                                    <?php
                                    $temp=\App\Order::where('DH_MA',$order->DH_MA)->first();
                                    $customer=$temp->customer()->first();
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
                                    $user=$temp->user()->first();
                                    ?>
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>#{{$order->DH_MA}}</td>
                                        <td>{{$customer->KH_TEN}}</td>
                                        @if(isset($user))
                                            <td>{{$user->NV_MA}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <?php $date=date_create($order->DH_NGAYDAT); ?>
                                        <td>{{date_format($date,"d/m/Y")}}</td>
                                        <td>{{number_format($order->DH_TONGTIEN)}}</td>
                                        <td>{{$ship}}</td>
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
                                                }
                                            ?>
                                        </td>
                                        <td>{{$order->DH_GHICHU}}</td>
                                        <td class="text-center">
                                            @can('order.update')
                                                @if($order->DH_TTDONHANG==0)
                                                    <a class="btn btn-primary btn-sm" href="{{url('admin/order/invoice',$order->DH_MA)}}">
                                                        Lập HĐ</a>
                                                @elseif($order->DH_TTDONHANG==1)
                                                    <a class="btn btn-danger btn-sm" href="{{url('admin/order/complete',$order->DH_MA)}}">
                                                        Check</a>
                                                    @else
                                                    <a class="btn btn-success btn-sm">Complete</a>
                                                @endif
                                            @endcan
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$orders->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
