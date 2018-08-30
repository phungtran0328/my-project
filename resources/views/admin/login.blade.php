<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:47 PM
 */
?>
@extends('admin/master')
@section('content')
    {{--<div class="inner-header">
        <div class="container">
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="">Trang chủ</a> / <span>Đăng nhập</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>--}}

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="divUserAdd" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Đăng nhập</h3>
                        </div>
                        <div class="panel-body">

                            <form class="form-horizontal" action="{{ url ('/admin/login') }}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @if(Session::has('message'))
                                    <div class="alert alert-danger">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-md-3 control-label required" for="txtUsername">Tên đăng nhập</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control"
                                               name="username" placeholder="Nhập username">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required" for="txtPassword">Mật khẩu</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" id="txtPass" name="password" placeholder="Nhập password">
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label"></label>--}}
                                    {{--<div class="col-md-4">--}}

                                        {{--<input type="checkbox" name="Remember" value="Remember">--}}
                                        {{--<label>Remember me</label>--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                        <button type="submit" name="btnDangNhap" class="btn btn-primary btn-block">Đăng nhập</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>


        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
