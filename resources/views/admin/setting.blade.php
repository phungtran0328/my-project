<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/06/2018
 * Time: 2:57 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Đổi mật khẩu</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-5">
                @if(session('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session('message')}}
                    </div>
                @elseif(session('pass_error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session('pass_error')}}
                    </div>
                @endif
                <form class="form-horizontal" action="{{url('admin/setting',\Illuminate\Support\Facades\Auth::user()->NV_MA)}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                        <label class="control-label" for="old_password">Mật khẩu cũ *</label>
                        <input type="password" class="form-control" name="old_password" placeholder="Nhập mật khẩu hiện tại">
                        <strong style="color: red">{{$errors->first('old_password') }}</strong>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} ">
                        <label class="control-label" for="password">Mật khẩu mới *</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới">
                        <strong style="color: red">{{$errors->first('password') }}</strong>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class=" control-label" for="password_confirmation">Nhập lại mật khẩu mới*</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                        <strong style="color: red">{{$errors->first('password') }}</strong>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
