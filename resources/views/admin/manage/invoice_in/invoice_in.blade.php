<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 12:33 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hóa đơn nhập</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách hóa đơn nhập</h5>
                    </div>
                    <div class="panel-body">
                        <a href="{{url('/admin/invoice-in/create')}}" class="btn btn-primary" style="width: 150px;">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        <hr>
                        @if(Session::has('messAddDetail'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messAddDetail')}}
                            </div>
                        @endif
                        {{--@if(Session::has('messageUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageUpdate')}}
                            </div>
                        @endif
                        @if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif--}}
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 7%">Mã HĐ</th>
                                    <th style="width: 15%">NV</th>
                                    <th style="width: 20%">CTPH</th>
                                    <th style="width: 10%">Ngày nhập</th>
                                    <th>Tồng tiền</th>
                                    <th style="width: 10%">Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $index=>$invoice)
                                    <?php
                                        $temp=\App\InvoiceIn::where('PN_MA',$invoice->PN_MA)->first();
                                        $company=$temp->release_company()->first();
                                        $user=$temp->user()->first();
                                    ?>
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$invoice->PN_MA}}</td>
                                        <td>{{$user->NV_TEN}}</td>
                                        <td>{{$company->CTPH_TEN}}</td>
                                        <?php $date=date_create($invoice->PN_NGAYNHAP); ?>
                                        <td>{{date_format($date,"d/m/Y")}}</td>
                                        <td>{{number_format($invoice->PN_TONGTIEN)}}</td>
                                        <td>{{$invoice->PN_GHICHU}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
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
