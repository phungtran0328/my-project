<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:14 PM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Đăng nhập</li>
        </ul>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7" id="divUserAdd" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Đăng nhập</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="{{url('/login')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                @if(Session::has('message'))
                                    <div class="alert alert-danger">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label required" for="txtUsername">Email (*)</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control "
                                               name="email" placeholder="Nhập email" value="{{old('email')}}">
                                        <strong style="color: red">{{$errors->first('email') }}</strong>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label required" for="txtPassword">Mật khẩu (*)</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" id="txtPass" name="password"
                                               placeholder="Mật khẩu từ 6 đến 32 ký tự" value="{{old('password')}}">
                                        <strong style="color: red">{{$errors->first('password') }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                        <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Đăng nhập</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                        <a type="submit" name="register" href="{{url('/register')}}" class="btn btn-primary btn-block">Tạo tài khoản</a>
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
