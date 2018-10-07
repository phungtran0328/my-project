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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Khách hàng</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách khách hàng</h5>
                    </div>
                    <div class="panel-body">
                        {{--<a href="{{url('admin/user/create')}}" class="btn btn-primary" style="width: 150px;">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        <hr>
                        @if(Session::has('messageAdd'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageAdd')}}
                            </div>
                        @endif
                        @if(Session::has('messageUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageUpdate')}}
                            </div>
                        @endif--}}
                        @if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover" style="width: 1500px">
                                <thead>
                                <tr>
                                    <th style="width: 3%">STT</th>
                                    <th style="width: 10%">Tên</th>
                                    <th style="width: 6%">Giới tính</th>
                                    <th style="width: 4%">Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 4%">SĐT</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th style="width: 8%">Hành động</th>
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
                                        <td>{{$customer->KH_MATKHAU}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="{{url('admin/customer/delete',$customer->KH_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span></a>
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
