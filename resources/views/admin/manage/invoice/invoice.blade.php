<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/13/2018
 * Time: 9:39 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hóa đơn</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách hóa đơn</h5>
                    </div>
                    <div class="panel-body">
                        {{--@can('invoice-in.create')
                            <a href="{{url('/admin/invoice-in/create')}}" class="btn btn-primary" style="width: 150px;">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        @endcan--}}

                        <form class="input-group" action="{{url('admin/invoice')}}" method="get" style="width: 350px;">
                           <input class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default-sm" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </form>
                        <hr>
                        {{--@if(Session::has('messInvoice'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messInvoice')}}
                            </div>
                        @endif--}}
                        {{--@if(Session::has('messUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdate')}}
                            </div>
                        @endif--}}
                        {{--@if(Session::has('messComplete'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messComplete')}}
                            </div>
                        @endif--}}
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead >
                                <tr>
                                    <th style="width: 10%">Mã HĐ
                                    </th>
                                    <th style="width: 14%">KH</th>
                                    <th style="width: 5%">NV</th>
                                    <th style="width: 8%">Ngày lập</th>
                                    <th style="width: 8%">Tồng tiền</th>
                                    <th style="width: 8%">Phí VC</th>
                                    <th class="text-center" colspan="3">Sách | SL | Giá</th>
                                    <th style="width: 6%">Hủy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $index=>$invoice)
                                    <?php
                                    $temp=\App\Invoice::where('HD_MA',$invoice->HD_MA)->first();
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
                                    $books=$temp->book()->get();

                                    ?>
                                    <tr>
                                        <td>#{{$invoice->HD_MA}}</td>
                                        <td>{{$customer->KH_TEN}}</td>
                                        <td>{{$user->NV_MA}}</td>
                                        <?php $date=date_create($invoice->HD_NGAYLAP); ?>
                                        <td>{{date_format($date,"d/m/Y H:i:s")}}</td>
                                        <td>{{number_format($invoice->HD_TONGTIEN)}}</td>
                                        <td>{{$ship}}</td>
                                        <td colspan="3">
                                            <table class="table table-bordered">
                                                @foreach($books as $book)
                                                    <tr>
                                                        <td style="width: 65%">{{$book->S_TEN}}</td>
                                                        <td>{{$book->pivot->HDCT_SOLUONG}}</td>
                                                        <td style="width: 22%">{{number_format($book->pivot->HDCT_GIA)}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$invoices->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
