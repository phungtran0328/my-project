<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/11/2018
 * Time: 9:34 AM
 */?>
@extends('master')
<style>
 /*   .stepwizard-step p {
        margin-top: 0px;
        color:#666;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        !*opacity: 1 !important;
        filter: alpha(opacity=100) !important;*!
    }
    .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
        opacity:1 !important;
        color:#bbb;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content:" ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-index: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }*/
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Session::has('messCheck'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messCheck')}}
                            </div>
                        @endif
                        {{--<div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step col-xs-4">
                                    <a href="#step-1" class="btn btn-success">1</a>
                                    <p>Tùy chọn</p>
                                </div>
                                <div class="stepwizard-step col-xs-4">
                                    <a href="#step-2" type="button" class="btn btn-default" disabled="disabled">2</a>
                                    <p>Địa chỉ giao hàng</p>
                                </div>
                                <div class="stepwizard-step col-xs-4">
                                    <a href="#step-3" type="button" class="btn btn-default" disabled="disabled">3</a>
                                    <p>Thanh toán & Đặt mua</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                @if(!(\Illuminate\Support\Facades\Auth::guard('customer')->check()))
                    <div class="panel panel-default" id="step-1" >
                        <div class="panel-body">
                            <div class="group-tabs">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Đăng nhập</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Khách</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <br><br>
                                        <form class="form-horizontal" action="{{url('/checkout/check')}}" method="POST">
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
                                                    <input type="password" class="form-control" name="password"
                                                           placeholder="Mật khẩu từ 6 đến 32 ký tự" value="{{old('password')}}">
                                                    <strong style="color: red">{{$errors->first('password') }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-7">
                                                    <button type="submit" name="login" class="btn btn-primary btn-block">Đăng nhập</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <br><br>
                                        <form class="form-horizontal" action="{{url('/checkout/register')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                                <label class="col-md-3 control-label required">Họ tên (*)</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control "
                                                           name="username" placeholder="Nhập họ tên" value="{{old('username')}}">
                                                    <strong style="color: red">{{$errors->first('username') }}</strong>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label class="col-md-3 control-label required">Địa chỉ (*)</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control "
                                                           name="address" placeholder="Nhập địa chỉ" value="{{old('address')}}">
                                                    <strong style="color: red">{{$errors->first('address') }}</strong>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label class="col-md-3 control-label required">Số điện thoại (*)</label>
                                                <div class="col-md-4">
                                                    <input type="tel" class="form-control "
                                                           name="phone" placeholder="Nhập số điện thoại" value="{{old('phone')}}">
                                                    <strong style="color: red">{{$errors->first('phone') }}</strong>
                                                </div>
                                                <label class="control-label"></label>
                                            </div>

                                            <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                                <label class="col-md-3 control-label required">Ngày sinh (*)</label>
                                                <div class="col-md-4">
                                                    <input type="date" class="form-control "
                                                           name="birthday" placeholder="Chọn ngày sinh" value="{{old('birthday')}}">
                                                    <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="col-md-3 control-label required" >Email (*)</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control "
                                                           name="email" placeholder="Nhập email" value="{{old('email')}}">
                                                    <strong style="color: red">{{$errors->first('email') }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-7">
                                                    <button type="submit" name="register" class="btn btn-primary btn-block">Tiếp tục</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Auth::guard('customer')->check() and !(Session::has('stepThree')))
                    <div class="panel panel-default" id="step-2" >
                        <div class="panel-body">
                            <p style="font-size: 20px"><b>2. Địa chỉ giao hàng</b></p><br>
                            <div >
                                <p style="margin-bottom: 15px">Họ tên: <b>{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->KH_TEN}}</b></p>
                                <p style="margin-bottom: 15px">Địa chỉ: {{\Illuminate\Support\Facades\Auth::guard('customer')->user()->KH_DIACHI}}</p>
                                <p style="margin-bottom: 15px">Điện thoại: {{\Illuminate\Support\Facades\Auth::guard('customer')->user()->KH_SDT}}</p>
                            </div>
                        </div>
                    </div>
                        <div class="panel panel-default" id="step-3" >
                            <div class="panel-body">
                                <p style="font-size: 20px"><b>3. Thanh toán và đặt mua</b></p><br>
                                <div>
                                    <form action="{{url('/checkout')}}" method="post">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="form-group">
                                            <label><input type="radio" name="checkout" value="Thanh toán bằng tiền mặt khi nhận hàng"
                                                          checked> Thanh toán bằng tiền mặt khi nhận hàng</label><br>
                                            <label><input type="radio" name="checkout" value="Thanh toán qua thẻ nội địa"> Thanh toán qua thẻ nội địa</label>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">ĐẶT HÀNG</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class=" panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-9" style="text-align: left; font-size: 15px; margin-bottom: 15px">
                                Đơn hàng ({{Cart::instance()->count(false)}} sản phẩm)
                            </div>
                            <div class="col-md-3" style="text-align: center; margin-bottom: 15px">
                                <a href="{{url('/cart')}}" class="btn btn-default">Sửa</a>
                            </div>
                        </div>
                        <table class="table">
                            @if (sizeof(Cart::content()) > 0)
                                @foreach(Cart::content() as $item)
                                    <tr>
                                        <th>{{$item->qty}} x {{$item->name}}</th>
                                        <td style="text-align: right">{{number_format($item->price * $item->qty)}} đ</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>Tạm tính</th>
                                    <td style="text-align: right">{{Cart::subtotal()}} đ</td>
                                </tr>
                            @endif
                        </table>
                        <div class="row">
                            <div class="col-md-7" style="text-align: left; font-size: 15px; margin-bottom: 15px">
                                <p>Thành tiền:</p>
                            </div>
                            <div class="col-md-5" style="text-align: center; color: red; font-size: 18px">
                                {{Cart::subtotal()}} đ
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script>

</script>