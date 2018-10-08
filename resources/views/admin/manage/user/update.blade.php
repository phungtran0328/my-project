<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 8:33 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhân viên</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <a class="btn btn-success" style="width: 200px; margin-left: 20px" href="{{url('/admin/user')}}">
                    <span class="glyphicon glyphicon-arrow-left"></span></a>
                <br><br>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Cập nhật thông tin nhân viên</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{url('admin/user/update',$user->NV_MA)}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label class="control-label">Tên đăng nhập (*)</label>
                                        <input type="text" class="form-control "
                                               name="username" value="{{$user->NV_TENDANGNHAP}}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">Họ tên (*)</label>
                                        <input type="text" class="form-control"
                                               name="name" value="{{$user->NV_TEN}}">
                                        <strong style="color: red">{{$errors->first('name') }}</strong>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label class="control-label">Địa chỉ (*)</label>
                                    <input type="text" class="form-control "
                                           name="address" value="{{$user->NV_DIACHI}}">
                                    <strong style="color: red">{{$errors->first('address') }}</strong>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label class="control-label">Số điện thoại (*)</label>
                                        <input type="tel" class="form-control "
                                               name="phone" value="{{$user->NV_SDT}}">
                                        <strong style="color: red">{{$errors->first('phone') }}</strong>
                                    </div>

                                    <div class="col-md-6 form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                        <label class="control-label">Ngày sinh (*)</label>
                                        <input type="date" class="form-control "
                                               name="birthday" value="{{$user->NV_NGAYSINH}}">
                                        <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Giới tính</label>
                                        @if(($user->NV_GIOITINH)=='Nam')
                                            <label class="col-md-2"><input type="radio" name="gender" value="Nam" style="width: 20px" checked>Nam</label>
                                            <label class="col-md-3"><input type="radio" name="gender" value="Nữ" style="width: 20px">Nữ</label>
                                        @else
                                            <label class="col-md-2"><input type="radio" name="gender" value="Nam" style="width: 20px" >Nam</label>
                                            <label class="col-md-3"><input type="radio" name="gender" value="Nữ" style="width: 20px" checked>Nữ</label>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" style="width: 300px">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Cập nhật quyền của nhân viên</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{url('admin/user/update/role',$user->NV_MA)}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label class="control-label">Tên đăng nhập (*)</label>
                                        <input type="text" class="form-control "
                                               name="username" value="{{$user->NV_TENDANGNHAP}}" readonly>
                                        <input type="hidden" value="{{$user->NV_MA}}">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">
                                    <label class="control-label">Quyền (*)</label>
                                    <select class="form-control" name="roles[]" multiple style="height: 200px">
                                        @foreach($roles as $role)
                                            <option value="{{$role->Q_MA}}" selected>{{$role->Q_TEN}}</option>
                                        @endforeach
                                        @foreach($roles_user as $key=>$value)
                                            <option value="{{$value->Q_MA}}">{{$value->Q_TEN}}</option>
                                        @endforeach
                                    </select>
                                    <strong style="color: red">{{$errors->first('roles') }}</strong>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" style="width: 300px">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
