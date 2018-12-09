<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/08/2018
 * Time: 2:07 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm quyền mới</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('admin/role/create')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-8 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label">Tên quyền (*)</label>
                                    <input type="text" class="form-control"
                                           name="name" value="{{old('name')}}">
                                    <strong style="color: red">{{$errors->first('name') }}</strong>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">
                                <label class="control-label">Danh sách quyền (*)</label><br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <select name="roles" class="form-control">
                                            <option value=""> ---Chọn quyền---</option>
                                            <option value="2"> Admin</option>
                                            <option value="1"> Đơn hàng</option>
                                            <option value="3"> Khách hàng</option>
                                            <option value="4"> Hóa đơn nhập</option>
                                            <option value="5"> Hóa đơn xuất</option>
                                            <option value="6"> Sách</option>
                                            <option value="7"> Sao lưu dữ liệu</option>
                                        </select>
                                    </div>
                                </div>
                                <strong style="color: red">{{$errors->first('roles') }}</strong>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Thêm quyền</button>
                                <a class="btn btn-success" href="{{url('/admin/role')}}">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
