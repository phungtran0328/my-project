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
    <div class="inner-header">
        <div class="container">
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{url('/index')}}">Trang chủ</a> / <span>Tạo tài khoản</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
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

                            <form class="form-horizontal" action="{{url('/register')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                               <li>{{ $error }} </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                @endif
                                @if(Session::has('message'))
                                    <div class="alert alert-success">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-md-3 control-label required">Họ tên (*)</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control "
                                               name="username" placeholder="Nhập họ tên">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required">Địa chỉ (*)</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control "
                                               name="address" placeholder="Nhập địa chỉ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required">Số điện thoại (*)</label>
                                    <div class="col-md-7">
                                        <input type="tel" class="form-control "
                                               name="phone" placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required">Ngày sinh (*)</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control "
                                               name="birthday" placeholder="Chọn ngày sinh">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required">Giới tính (*)</label>
                                    <div class="col-md-2">
                                        <label><input type="radio" name="gender" value="Nam" style="width: 20px">Nam</label>

                                    </div>
                                    <div class="col-md-3">
                                        <label><input type="radio" name="gender" value="Nữ" style="width: 20px">Nữ</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required" for="txtUsername">Email (*)</label>
                                    <div class="col-md-7">
                                        <input type="email" class="form-control "
                                               name="email" placeholder="Nhập email">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label required" for="txtPassword">Mật khẩu (*)</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" id="txtPass" name="password" placeholder="Mật khẩu từ 6 đến 32 ký tự">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                        <button type="submit" name="register" id="register" class="btn btn-primary btn-block">Tạo tài khoản</button>
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
