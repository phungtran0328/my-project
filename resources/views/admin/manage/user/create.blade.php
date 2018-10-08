<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 8:32 AM
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
                <div class="col-md-12">
                    <a class="btn btn-success" style="width: 200px" href="{{url('/admin/user')}}">
                        <span class="glyphicon glyphicon-arrow-left"></span></a>
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Thêm mới nhân viên</h5>
                        </div>
                        <div class="panel-body">

                            <form action="{{url('admin/user/create')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-8 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                                <label class="control-label">Tên đăng nhập (*)</label>
                                                <input type="text" class="form-control "
                                                       name="username" placeholder="Nhập username" value="{{old('username')}}">
                                                <strong style="color: red">{{$errors->first('username') }}</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label class="control-label">Họ tên (*)</label>
                                                <input type="text" class="form-control"
                                                       name="name" placeholder="Nhập họ tên" value="{{old('name')}}">
                                                <strong style="color: red">{{$errors->first('name') }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label class="control-label">Địa chỉ (*)</label>
                                            <input type="text" class="form-control "
                                                   name="address" placeholder="Nhập địa chỉ" value="{{old('address')}}">
                                            <strong style="color: red">{{$errors->first('address') }}</strong>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label class="control-label">Số điện thoại (*)</label>
                                                <input type="tel" class="form-control "
                                                       name="phone" placeholder="Nhập số điện thoại" value="{{old('phone')}}">
                                                <strong style="color: red">{{$errors->first('phone') }}</strong>
                                            </div>

                                            <div class="col-md-6 form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                                <label class="control-label">Ngày sinh (*)</label>
                                                <input type="date" class="form-control "
                                                       name="birthday" value="{{old('birthday')}}">
                                                <strong style="color: red">{{$errors->first('birthday') }}</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Giới tính</label>
                                                <label class="col-md-2"><input type="radio" name="gender" value="Nam" style="width: 20px" checked>Nam</label>
                                                <label class="col-md-3"><input type="radio" name="gender" value="Nữ" style="width: 20px">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Chọn quyền nhân viên</label><br>
                                            @foreach($roles as $role)
                                                <label>
                                                    <input type="checkbox" value="{{$role->Q_MA}}" name="role">
                                                    <span>{{$role->Q_TEN}}</span>
                                                </label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" style="width: 300px">Thêm nhân viên</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
