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
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách hóa đơn nhập</h5>
                    </div>
                    <div class="panel-body">
                        @can('invoice-in.create')
                        <a href="{{url('/admin/invoice-in/create')}}" class="btn btn-primary" style="width: 150px;">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        @endcan
                        <hr>
                        @if(session('messAddDetail'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messAddDetail')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 7%">Mã HĐ</th>
                                    <th style="width: 5%">NV</th>
                                    <th style="width: 15%">CTPH</th>
                                    <th style="width: 15%">Ngày nhập</th>
                                    <th>Sách</th>
                                    <th>Tồng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $index=>$invoice)
                                    <?php
                                        $temp=\App\InvoiceIn::where('PN_MA',$invoice->PN_MA)->first();
                                        $company=$temp->release_company()->first();
                                        $user=$temp->user()->first();
                                        $books=$temp->book()->get();
                                    ?>
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$invoice->PN_MA}}</td>
                                        <td>{{$user->NV_MA}}</td>
                                        <td>{{$company->CTPH_TEN}}</td>
                                        <?php $date=date_create($invoice->PN_NGAYNHAP); ?>
                                        <td>{{date_format($date,"d/m/Y H:i:s")}}</td>
                                        <td>
                                            <table class="table table-bordered">
                                                @foreach($books as $book)
                                                    <tr>
                                                        <td style="width: 60%">{{$book->S_TEN}}</td>
                                                        <td>{{$book->pivot->PNCT_SOLUONG}}</td>
                                                        <td>{{number_format($book->pivot->PNCT_GIA)}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{number_format($invoice->PN_TONGTIEN)}}</td>
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
