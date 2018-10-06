<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/06/2018
 * Time: 11:06 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Công ty phát hành</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Chỉnh sửa công ty phát hành</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('/admin/company/update',$company->CTPH_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                <label class="control-label">Tên công ty phát hành</label>
                                <input type="text" class="form-control" value="{{$company->CTPH_TEN}}" name="name">
                                <strong style="color: red">{{$errors->first('name')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Địa chỉ</label>
                                <input type="text" class="form-control" value="{{$company->CTPH_DIACHI}}" name="address">
                            </div>
                            <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
                                <label class="control-label">Số điện thoại</label>
                                <input type="tel" class="form-control" value="{{$company->CTPH_SDT}}" name="phone">
                                <strong style="color: red">{{$errors->first('phone')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <input type="text" class="form-control" value="{{$company->CTPH_GHICHU}}" name="note">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Cập nhật</button>
                            </div>
                        </form>
                        <a class="btn btn-success btn-block" href="{{url('/admin/company')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
