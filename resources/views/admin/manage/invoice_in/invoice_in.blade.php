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
                        <div class="row">
                            <div class="col-md-2">
                                @can('invoice-in.create')
                                    <a href="{{url('/admin/invoice-in/create')}}" class="btn btn-primary btn-block">
                                        <span class="glyphicon glyphicon-plus"></span> Thêm
                                    </a>
                                @endcan
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <hr>
                        @if(session('messAddDetail'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messAddDetail')}}
                            </div>
                        @endif
                            @if(session('messAdd'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messAdd')}}
                                </div>
                            @endif
                        @if(session('import'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('import')}}
                            </div>
                        @endif
                        <table id="invoice-in" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 7%">Mã HĐ</th>
                                <th style="width: 5%">NV</th>
                                <th style="width: 15%">CTPH</th>
                                <th style="width: 15%">Ngày nhập</th>
                                <th>Sách</th>
                                <th style="width: 11%">Tồng tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $index=>$invoice)
                                @php
                                $company = $invoice->release_company()->first();
                                $user = $invoice->user()->first();
                                $books = $invoice->book()->get();
                                @endphp
                                <tr>
                                    {{--increment not reset in second page--}}
                                    <td>{{$invoice->PN_MA}}</td>
                                    <td>{{$user->NV_MA}}</td>
                                    <td>{{$company->CTPH_MA}} - {{$company->CTPH_TEN}}</td>
                                    @php $date=date_create($invoice->PN_NGAYNHAP); @endphp
                                    <td>{{date_format($date,"d/m/Y H:i:s")}}</td>
                                    <td>
                                        @if(count($books)>0)
                                        <table class="table table-bordered">
                                            @foreach($books as $book)
                                                <tr>
                                                    <td style="width: 60%">{{$book->S_TEN}}</td>
                                                    <td>{{$book->pivot->PNCT_SOLUONG}}</td>
                                                    <td>{{number_format($book->pivot->PNCT_GIA)}}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                            @else
                                            @can('invoice-in.create')
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailsImport-{{$invoice->PN_MA}}">
                                                    Import
                                                </button>
                                            @endcan
                                        @endif
                                    </td>
                                    <td>{{number_format($invoice->PN_TONGTIEN)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($invoices as $invoice)
        <div class="modal fade" id="detailsImport-{{$invoice->PN_MA}}" tabindex="-1" role="dialog" aria-labelledby="checkModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h3 class="modal-title" id="checkModal">Nhập file {{$invoice->PN_MA}}</h3>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive ">
                            <form action="{{url('admin/invoice-in/import',$invoice->PN_MA)}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <input type="file" name="f" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
