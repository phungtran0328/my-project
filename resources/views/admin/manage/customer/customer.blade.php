<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 12:10 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách khách hàng</h5>
                    </div>
                    <div class="panel-body">
                        @if(session('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messageRemove')}}
                            </div>
                        @endif
                        @if(session('messRemoveError'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messRemoveError')}}
                            </div>
                        @endif
                        <a class="btn btn-primary" href="{{url('/admin/customer/export')}}">Xuất file Excel</a>
                        <br><br>
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 3%">STT</th>
                                    <th style="width: 15%">Tên</th>
                                    <th style="width: 8%">Giới tính</th>
                                    <th style="width: 8%">Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 4%">SĐT</th>
                                    <th>Email</th>
                                    <th style="width: 6%">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $index=>$customer)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $customers->firstItem()}}</td>
                                        <td>{{$customer->KH_TEN}}</td>
                                        <td>{{$customer->KH_GIOITINH}}</td>
                                        <?php $date=date_create($customer->KH_NGAYSINH); ?>
                                        <td>{{date_format($date,"d/m/Y")}}</td>
                                        <td>{{$customer->KH_DIACHI}}</td>
                                        <td>{{$customer->KH_SDT}}</td>
                                        <td>{{$customer->KH_EMAIL}}</td>
                                        <td class="text-center">
                                            {{--<a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-pencil"></span></a>--}}
                                            @can('customer.delete')
                                            <a class="btn btn-danger btn-sm" href="{{url('admin/customer/delete',$customer->KH_MA)}}" onclick="return confirm('Bạn chắc chắn xóa ?')">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$customers->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
