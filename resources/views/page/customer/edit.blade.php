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
                    <a href="{{url('/order',Auth::guard('customer')->user()->KH_MA)}}"><i class="glyphicon glyphicon-list-alt" style="font-size: 20px"></i>
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
                    <form action="{{url('/edit',Auth::guard('customer')->user()->KH_MA)}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(Auth::guard('customer')->check())
                            <div class="col-md-12 form-group">
                                <label class=" control-label " >Email</label>
                                <input type="email" class="form-control "
                                       name="email" value="{{Auth::guard('customer')->user()->KH_EMAIL}}" readonly="">
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label class="control-label required" for="username">Họ tên</label>
                                        <input type="text" class="form-control" name="username" value="{{Auth::guard('customer')->user()->KH_TEN}}">
                                        <strong style="color: red">{{$errors->first('username') }}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" style="text-align: left">Giới tính</label>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <label class="col-md-4">
                                                <input type="radio" name="gender" value="Nam"
                                                       style="width: 20px" {{Auth::guard('customer')->user()->KH_GIOITINH=='Nam' ? 'checked' : ''}}>Nam</label>
                                            <label class="col-md-4">
                                                <input type="radio" name="gender" value="Nữ"
                                                       style="width: 20px" {{Auth::guard('customer')->user()->KH_GIOITINH=='Nữ' ? 'checked' : ''}}>Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label class="control-label">Số điện thoại</label>
                                        <input type="tel" class="form-control" name="phone" value="{{Auth::guard('customer')->user()->KH_SDT}}">
                                        <strong style="color: red">{{$errors->first('phone') }}</strong>
                                    </div>
                                    <div class="col-md-4 form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                        <label class="control-label required">Ngày sinh</label>
                                        <input type="date" class="form-control" name="birthday" value="{{Auth::guard('customer')->user()->KH_NGAYSINH}}">
                                        <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label class="control-label required" for="address">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" value="{{Auth::guard('customer')->user()->KH_DIACHI}}">
                                        <strong style="color: red">{{$errors->first('address') }}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Tỉnh/Thành phố</label>
                                        <select name="city" class="form-control">
                                            @for($i=0;$i<count($keys);$i++)
                                                @if(Auth::guard('customer')->user()->KH_DIACHI2==$keys[$i])
                                                    <option value="{{$keys[$i]}}" selected>{{$values[$i]}}</option>
                                                @else
                                                    <option value="{{$keys[$i]}}">{{$values[$i]}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary">Cập nhật</button>
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

