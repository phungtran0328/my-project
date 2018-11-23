<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/11/2018
 * Time: 9:34 AM
 */
?>
@extends('master')
{{--<style>
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
</style>--}}
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Thanh toán</li>
        </ul>
    </div>

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
                            @if(Session::has('message'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('message')}}
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
                                    <li role="presentation" class="{{$errors->has('*') ? '' : 'active'}}">
                                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Đăng nhập</a></li>
                                    <li role="presentation" class="{{$errors->has('*') ? 'active' : ''}}">
                                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Khách</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" id="showTab">
                                    <div role="tabpanel" class="tab-pane {{$errors->has('*') ? '' : 'active'}}" id="home">
                                        <br><br>
                                        <form class="form-horizontal" action="{{url('/checkout/check')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email (*)</label>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control "
                                                           name="email" placeholder="Nhập email" value="{{old('email')}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label required" for="txtPassword">Mật khẩu (*)</label>
                                                <div class="col-md-7">
                                                    <input type="password" class="form-control" name="password"
                                                           placeholder="Mật khẩu từ 6 đến 32 ký tự" value="{{old('password')}}">
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
                                    <div role="tabpanel" class="tab-pane {{$errors->has('*') ? 'active' : ''}}" id="profile">
                                        <br><br>
                                        <form class="form-horizontal" action="{{url('/checkout/register')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label ">Họ tên (*)</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control " required
                                                           name="username" placeholder="Nhập họ tên" value="{{old('username')}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label required">Địa chỉ (*)</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control " required
                                                           name="address" placeholder="Nhập địa chỉ" value="{{old('address')}}">

                                                </div>
                                                <div class="col-md-4">
                                                    <select name="city" class="form-control" onchange="shipping(this);">
                                                        <option value="">---Chọn tỉnh/thành phố---</option>
                                                        @for($i=0;$i<count($keys);$i++)
                                                            <option value="{{$keys[$i]}}">{{$values[$i]}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label class="col-md-2 control-label ">Số ĐT (*)</label>
                                                <div class="col-md-4">
                                                    <input type="tel" class="form-control " required
                                                           name="phone" placeholder="Nhập số điện thoại" value="{{old('phone')}}">
                                                    <strong style="color: red">{{$errors->first('phone') }}</strong>
                                                </div>
                                                <label class="control-label"></label>
                                            </div>
                                            <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                                <label class="col-md-2 control-label ">Ngày sinh (*)</label>
                                                <div class="col-md-4">
                                                    <input type="date" class="form-control " required
                                                           name="birthday" placeholder="Chọn ngày sinh" value="{{old('birthday')}}">
                                                    <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="col-md-2 control-label required" >Email (*)</label>
                                                <div class="col-md-7">
                                                    <input type="email" class="form-control " required
                                                           name="email" placeholder="Nhập email" value="{{old('email')}}">
                                                    <strong style="color: red">{{$errors->first('email') }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label required" >HTTT (*)</label>
                                                <div class="col-md-7">
                                                    <label><input type="radio" name="checkout" value="Thanh toán bằng tiền mặt khi nhận hàng"
                                                                  checked> Thanh toán bằng tiền mặt khi nhận hàng</label><br>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-7">
                                                    <button type="submit" name="register" class="btn btn-primary btn-block">Đặt hàng</button>
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
                                <p style="margin-bottom: 15px">Địa chỉ: {{\Illuminate\Support\Facades\Auth::guard('customer')->user()->full_address}}</p>
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
                                            <label><input type="radio" name="checkout" value="TT bằng tiền mặt khi nhận hàng"
                                                          checked> Thanh toán bằng tiền mặt khi nhận hàng</label><br>
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
                                <a href="{{route('cart')}}" class="btn btn-default">Sửa</a>
                            </div>
                        </div>
                        @if (sizeof(Cart::content()) > 0)
                            <table class="table">
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
                                <tr>
                                    <th>Phí vận chuyển</th>
                                    @if(!\Illuminate\Support\Facades\Auth::guard('customer')->check())
                                        <td id="ship" style="text-align: right"></td>
                                    @else
                                        @if(\Illuminate\Support\Facades\Auth::guard('customer')->user()->KH_DIACHI2=='CT')
                                            <td style="text-align: right">0 đ</td>
                                        @else
                                            <td style="text-align: right">
                                                {{number_format(18000)}} đ
                                            </td>
                                        @endif
                                    @endif
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-md-7" style="text-align: left; font-size: 15px; margin-bottom: 15px">
                                    <p>Thành tiền:</p>
                                </div>
                                <div class="col-md-5" style="text-align: right; color: red; font-size: 18px; font-weight: bold">
                                    @if(!\Illuminate\Support\Facades\Auth::guard('customer')->check())
                                        <div id="myTotal">
                                            {{Cart::subtotal()}} đ
                                        </div>
                                    @else
                                        @if(\Illuminate\Support\Facades\Auth::guard('customer')->user()->KH_DIACHI2=='CT')
                                            <div>{{Cart::subtotal()}} đ</div>
                                        @else
                                            <div>
                                                <?php $total=str_replace(',','',Cart::subtotal())+18000; ?>
                                                {{number_format($total)}} đ
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function shipping(x) {
            var value=x.value;
            var ship ='';
            if (value!='CT'){
                var ship ='<?php echo str_replace(',','',Cart::subtotal())+18000 ?>';
                var num = 18000;
                document.getElementById('ship').innerHTML=num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+ ' đ';
                document.getElementById('myTotal').innerHTML=ship.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' đ';
            }
            else {
                var ship ='<?php echo Cart::subtotal(); ?>';
                document.getElementById('ship').innerHTML=0 + ' đ';
                document.getElementById('myTotal').innerHTML=ship + ' đ';
            }
        }
    </script>
@endsection
