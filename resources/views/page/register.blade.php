<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/05/2018
 * Time: 4:51 PM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Tạo tài khoản</li>
        </ul>
    </div>
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7" id="divUserAdd" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tạo tài khoản</h3>
                        </div>
                        <div class="panel-body">

                            <form action="{{url('/register')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <div class="col-md-9 form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label class="control-label required">Họ tên (*)</label>
                                    <input type="text" class="form-control "
                                           name="username" placeholder="Nhập họ tên" value="{{old('username')}}">
                                    <strong style="color: red">{{$errors->first('username') }}</strong>
                                </div>

                                <div class="col-md-12 form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="control-label required">Địa chỉ (*)</label>
                                            <input type="text" class="form-control "
                                                   name="address" placeholder="Nhập địa chỉ" value="{{old('address')}}">
                                            <strong style="color: red">{{$errors->first('address') }}</strong>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Tỉnh/Thành phố</label>
                                            <select name="city" class="form-control">
                                                @for($i=0;$i<count($keys);$i++)
                                                    <option value="{{$keys[$i]}}">{{$values[$i]}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="row">
                                        <div class="col-md-6 form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label class="control-label required">Số điện thoại (*)</label>
                                            <input type="tel" class="form-control "
                                                   name="phone" placeholder="Nhập số điện thoại" value="{{old('phone')}}">
                                            <strong style="color: red">{{$errors->first('phone') }}</strong>
                                        </div>
                                        <div class="col-md-6 form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                            <label class=" control-label required">Ngày sinh (*)</label>
                                            <input type="date" class="form-control "
                                                   name="birthday" placeholder="Chọn ngày sinh" value="{{old('birthday')}}">
                                            <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label required">Giới tính</label>
                                        <div class="col-md-3">
                                            <label><input type="radio" name="gender" value="Nam" style="width: 20px" checked>Nam</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><input type="radio" name="gender" value="Nữ" style="width: 20px">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label required">Email (*)</label>
                                    <input type="text" class="form-control "
                                            name="email" placeholder="Nhập email" value="{{old('email')}}">
                                    <strong style="color: red">{{$errors->first('email') }}</strong>
                                </div>
                                <div class="col-md-12 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label required">Mật khẩu (*)</label>
                                            <input type="password" class="form-control" name="password"
                                                   placeholder="Mật khẩu từ 6 đến 32 ký tự">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label required">Xác nhận mật khẩu (*)</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                   placeholder="Xác nhận lại mật khẩu">
                                        </div>
                                    </div>
                                    <strong style="color: red">{{$errors->first('password') }}</strong>
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <button style="width: 300px" name="register" class="btn btn-primary">Tạo tài khoản</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
