<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/08/2018
 * Time: 1:56 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quyền</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-md-8">
                    <a class="btn btn-success" style="width: 200px" href="{{url('/admin/role')}}">
                        <span class="glyphicon glyphicon-arrow-left"></span></a>
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Cập nhật thông tin quyền</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{url('admin/user/update',$user->NV_MA)}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">Tên quyền (*)</label>
                                        <input type="text" class="form-control"
                                               name="name" value="{{$user->NV_TEN}}">
                                        <strong style="color: red">{{$errors->first('name') }}</strong>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">
                                    <label class="control-label">Danh sách quyền (*)</label>
                                    <select name="roles[]" multiple>
                                        <option value="">---Chọn quyền---</option>
                                        <option>
                                    </select>
                                    <strong style="color: red">{{$errors->first('address') }}</strong>
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
