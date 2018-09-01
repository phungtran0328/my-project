<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/30/2018
 * Time: 10:13 AM
 */
?>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#sign-in">Đăng nhập</a></li>
                        <li><a href="#sign-up">Tạo tài khoản</a></li>
                    </ul>
                    <div id="sign-in" class="panel">
                        <h3 style="text-align: center">Đăng nhập</h3><br>
                        <form action="{{url('/login')}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @if(Session::has('message'))
                                <div class="alert alert-danger">
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="col-md-3 control-label required" for="txtMail">Email (*)</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="user" placeholder="Nhập Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label required" for="txtPass">Mật khẩu (*)</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="pass" placeholder="Mật khẩu từ 6 đến 32 ký tự">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-7">
                                    <input type="submit" name="login" class="btn btn-primary btn-block" value="Đăng nhập">
                                </div>
                            </div>
                        </form>
                        {{--<div class="login-help">
                            <a href="#">Register</a> - <a href="#">Forgot Password</a>
                        </div>--}}
                    </div>

                    <div id="sign-up" class="panel">
                        <h3 style="text-align: center">Tạo tài khoản</h3><br>
                        <form action="{{url('/register')}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $er)
                                        {{$er}}
                                    @endforeach
                                </div>
                            @endif
                            @if(Session::has('thongbao'))
                                <div class="alert alert-success">
                                    {{Session::get('thongbao')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="name">Họ tên (*)</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" placeholder="Nhập họ tên">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="tel">Số điện thoại (*)</label>
                                <div class="col-md-8">
                                    <input type="tel" class="form-control" name="tel" placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="address">Địa chỉ (*)</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="gender">Giới tính (*)</label>
                                <div class="col-md-8">
                                    <label class="radio-inline"><input type="radio" name="gender" value="Nam" checked>Nam</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="Nữ">Nữ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="birthday">Ngày sinh (*)</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" id="birthday" name="birthday">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="email">Email (*)</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" name="email" placeholder="Nhập email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="password">Mật khẩu (*)</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu từ 6 đến 32 ký tự">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label required" for="password-confirm">Nhập lại mật khẩu (*)</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" name="password-confirm" placeholder="Xác nhận lại mật khẩu">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <input type="submit" name="sign-up" class="btn btn-primary btn-block" value="Tạo tài khoản">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="modal-footer"></div>--}}
        </div>
    </div>
</div>
