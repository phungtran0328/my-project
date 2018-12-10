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
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách hóa đơn</h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive ">
                            <table id="my_list" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%">Mã HĐ
                                    </th>
                                    <th style="width: 14%">KH</th>
                                    <th style="width: 5%">NV</th>
                                    <th style="width: 8%">Ngày lập</th>
                                    <th style="width: 8%">Tồng tiền</th>
                                    <th style="width: 8%">Phí VC</th>
                                    <th class="text-center">Sách | SL | Giá</th>
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
                                        <td>
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
