<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/02/2018
 * Time: 9:14 AM
 */?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Gửi yêu cầu</li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session('success')}}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>Gửi yêu cầu</h5>
                        <br>
                        <form action="{{url('/request')}}" method="post">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <div class="form-group">
                                <label class="control-label">Email (*)</label>
                                <input class="form-control" type="email" name="email" placeholder="" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tiêu đề (*)</label>
                                <input class="form-control" name="title" placeholder="" required value="{{old('title')}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nội dung (*)</label>
                                <textarea class="form-control" rows="5" name="content" placeholder="" required value="{{old('content')}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mã đơn hàng (nếu có)</label>
                                <input class="form-control" name="order_id" placeholder="" value="{{old('order_id')}}">
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary ">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
