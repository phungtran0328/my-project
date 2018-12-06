<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/14/2018
 * Time: 1:50 PM
 */
?>
@extends('admin/master')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Thông tin cá nhân</h3>
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
            @endif
            <form class="form-horizontal" action="" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <fieldset>
                    @if(Auth::check())
                        <div class="form-group">
                            <label class="control-label">Họ tên</label>
                            <input class="form-control" name="name" type="text" value="{{Auth::user()->NV_TEN}}" required>
                        </div>
                        <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
                            <label class="control-label">Số điện thoại</label>
                            <input class="form-control" name="phone" type="tel" value="{{Auth::user()->NV_SDT}}" required>
                            <strong style="color: red">{{$errors->first('phone')}}</strong>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Giới tính</label>
                            <label><input type="radio" name="gender" value="Nam" style="width: 20px" {{Auth::user()->NV_GIOITINH=='Nam' ? 'checked' : ''}}>Nam</label>
                            <label><input type="radio" name="gender" value="Nữ" style="width: 20px" {{Auth::user()->NV_GIOITINH=='Nữ' ? 'checked' : ''}}>Nữ</label>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Địa chỉ</label>
                            <input class="form-control" name="address" type="text" value="{{Auth::user()->NV_DIACHI}}" required>
                        </div>
                        <div class="form-group {{$errors->has('birthday') ? 'has-error' : ''}} ">
                            <label class="control-label">Ngày sinh</label>
                            <input class="form-control" name="birthday" type="date" value="{{Auth::user()->NV_NGAYSINH}}">
                            <strong style="color: red">{{$errors->first('birthday')}}</strong>
                        </div>

                        <!-- Change this to a button or input when using this as a form -->
                        <div class="form-group">
                            <button class="btn btn-success">Cập nhật thông tin</button>
                        </div>
                    @endif
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection
