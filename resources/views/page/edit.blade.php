<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/13/2018
 * Time: 8:47 AM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Thông tin tài khoản</li>
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
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin tài khoản</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{url('/edit',Auth::guard('customer')->user()->KH_MA)}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(Auth::guard('customer')->check())
                            <div class="form-group">
                                <label class="col-md-3 control-label required" for="email">Email</label>
                                <div class="col-md-5">
                                    <input type="email" class="form-control "
                                           name="email" value="{{Auth::guard('customer')->user()->KH_EMAIL}}" readonly="">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label required" for="username">Họ tên</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="username" name="username" value="{{Auth::guard('customer')->user()->KH_TEN}}">
                                    <strong style="color: red">{{$errors->first('username') }}</strong>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label required" for="phone">Số điện thoại</label>
                                <div class="col-md-3">
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{Auth::guard('customer')->user()->KH_SDT}}">
                                    <strong style="color: red">{{$errors->first('phone') }}</strong>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label required" for="gender">Giới tính</label>
                                @if(Auth::guard('customer')->user()->KH_GIOITINH=='Nam')
                                    <div class="col-md-3">
                                        <label><input type="radio" name="gender" value="Nam" style="width: 20px" checked>Nam</label>
                                        <label><input type="radio" name="gender" value="Nữ" style="width: 20px">Nữ</label>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <label><input type="radio" name="gender" value="Nam" style="width: 20px">Nam</label>
                                        <label><input type="radio" name="gender" value="Nữ" style="width: 20px" checked>Nữ</label>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label required" for="birthday">Ngày sinh</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{Auth::guard('customer')->user()->KH_NGAYSINH}}">
                                    <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">

                                <label class="col-md-3 control-label required" for="address">Địa chỉ</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="address" name="address" value="{{Auth::guard('customer')->user()->KH_DIACHI}}">
                                    <strong style="color: red">{{$errors->first('address') }}</strong>
                                </div>
                            </div>

                        @endif

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

