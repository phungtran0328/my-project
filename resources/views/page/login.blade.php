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
    <div class="inner-header">
        <div class="container">
            <!--  <div class="pull-left">
                  <h6 class="inner-title">Đăng nhập</h6>
              </div>
            -->
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{route('home')}}">Trang chủ</a> / <span>Đăng nhập</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-md-10" id="divUserAdd" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Đăng nhập</h3>
                        </div>
                        <div class="panel-body">

                            <form class="form-horizontal" action="{{route('login')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @if(Session::has('message'))
                                    <div class="alert alert-danger">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-md-3 control-label required" for="txtUsername">Tên đăng nhập (*)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"
                                               name="username" placeholder="Nhập username">
                                    </div>
                                    <div class="col-md-5">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label required" for="txtPassword">Mật khẩu (*)</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" id="txtPass" name="password" placeholder="Nhập password">
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-2">
                                        <button type="submit" name="btnDangNhap" id="btnDangNhap" class="btn btn-primary btn-block">Đăng nhập</button>

                                    </div>
                                    <div class="col-md-2">

                                        <a href="" class="btn btn-success btn-block">Đăng ký</a>
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
