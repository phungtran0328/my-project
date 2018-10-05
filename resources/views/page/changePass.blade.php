<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/13/2018
 * Time: 1:35 PM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li><a href="{{url('/edit',Auth::guard('customer')->user()->KH_MA)}}">Thông tin tài khoản</a></li>
            <li class="active">Đổi mật khẩu</li>

        </ul>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="aside-menu">
                <li><a href="{{url('/edit',Auth::guard('customer')->user()->KH_MA)}}"><i class="glyphicon glyphicon-info-sign" style="font-size: 20px"></i>Thông tin tài khoản</a></li>
                <li>
                    <a href="{{url('/change-password',Auth::guard('customer')->user()->KH_MA)}}"><i class="fa fa-edit" style="font-size: 20px"></i>
                        Đổi mật khẩu</a>
                </li>
                <li>
                    <a href=""><i class="glyphicon glyphicon-list-alt" style="font-size: 20px"></i>
                        Xem đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Đổi mật khẩu</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{url('/change-password',Auth::guard('customer')->user()->KH_MA)}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @elseif(Session::has('pass_error'))
                            <div class="alert alert-danger">
                                {{Session::get('pass_error')}}
                            </div>
                        @endif
                        <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label required" for="old_password">Mật khẩu cũ</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Nhập mật khẩu hiện tại">
                                <strong style="color: red">{{$errors->first('old_password') }}</strong>
                            </div>
                        </div>
                        <div class="{{ $errors->has('password') ? 'form-group has-error' : '' }}">
                            <div class="form-group ">
                                <label class="col-md-3 control-label required" for="password">Mật khẩu mới</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
                                    <strong style="color: red">{{$errors->first('password') }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label required" for="password_confirmation">Nhập lại</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                                    <strong style="color: red">{{$errors->first('password') }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary btn-block">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <hr>
@endsection
